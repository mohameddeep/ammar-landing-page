<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Manager;
use App\Models\Service;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

final class ServiceOrderingTest extends TestCase
{
    use DatabaseTransactions;

    private function useRoutingLocale(string $locale): void
    {
        // The localized route prefix is resolved at boot (see WebsiteLocalizationTest).
        putenv("ROUTING_LOCALE={$locale}");
        $_ENV['ROUTING_LOCALE'] = $_SERVER['ROUTING_LOCALE'] = $locale;
        $this->refreshApplication();
        $this->setUpTraits();
    }

    protected function tearDown(): void
    {
        putenv('ROUTING_LOCALE');
        unset($_ENV['ROUTING_LOCALE'], $_SERVER['ROUTING_LOCALE']);
        parent::tearDown();
    }

    private function actingAsManager(): void
    {
        $manager = Manager::query()->first() ?? $this->markTestSkipped('No manager account to log in with.');
        $this->actingAs($manager);
    }

    private function makeService(string $title, ?int $parentId = null): Service
    {
        return Service::query()->create([
            'title_ar' => $title,
            'title_en' => $title,
            'parent_id' => $parentId,
            'is_active' => true,
            'sort_order' => Service::nextSortOrder($parentId),
        ]);
    }

    public function test_reorder_saves_new_order_and_website_follows_it(): void
    {
        $this->useRoutingLocale('en');
        $this->actingAsManager();

        $parent = $this->makeService('Zeta Parent Order Test');
        $first = $this->makeService('Child Alpha Order Test', $parent->id);
        $second = $this->makeService('Child Beta Order Test', $parent->id);
        $third = $this->makeService('Child Gamma Order Test', $parent->id);

        $this->postJson('/en/admin/services/reorder', ['ids' => [$third->id, $first->id, $second->id]])
            ->assertOk()
            ->assertJsonPath('data', true);

        $this->assertSame([1, 2, 3], [$third->fresh()->sort_order, $first->fresh()->sort_order, $second->fresh()->sort_order]);

        // Public parent page lists the children in the saved order.
        $html = (string) $this->get("/en/services/{$parent->id}")->assertOk()->getContent();
        $positions = array_map(fn ($s) => strpos($html, $s->title_en), [$third, $first, $second]);
        $this->assertSame($positions, collect($positions)->sort()->values()->all(), 'Children must render in the saved order');
    }

    public function test_reorder_rejects_services_from_different_levels(): void
    {
        $this->useRoutingLocale('en');
        $this->actingAsManager();

        $parent = $this->makeService('Mixed Parent Order Test');
        $child = $this->makeService('Mixed Child Order Test', $parent->id);

        $this->postJson('/en/admin/services/reorder', ['ids' => [$parent->id, $child->id]])->assertStatus(422);
        // Unknown ids fail validation; the app's handler answers JSON validation errors with 400.
        $this->postJson('/en/admin/services/reorder', ['ids' => [999999999]])->assertClientError();
        // Rejected requests leave the stored order untouched.
        $this->assertSame($parent->sort_order, $parent->fresh()->sort_order);
        $this->assertSame($child->sort_order, $child->fresh()->sort_order);
    }

    public function test_new_services_go_to_the_end_of_their_level(): void
    {
        $parent = $this->makeService('End Parent Order Test');
        $a = $this->makeService('End A', $parent->id);
        $b = $this->makeService('End B', $parent->id);

        $this->assertSame($a->sort_order + 1, $b->sort_order);
        $this->assertSame($b->sort_order + 1, Service::nextSortOrder($parent->id));
    }

    public function test_dashboard_services_page_shows_tree(): void
    {
        $this->useRoutingLocale('en');
        $this->actingAsManager();

        $parent = $this->makeService('Tree Parent Order Test');
        $this->makeService('Tree Child Order Test', $parent->id);

        $this->get('/en/admin/services')
            ->assertOk()
            ->assertSee('data-sortable-list', false)
            ->assertSee('svc-row--child', false)
            ->assertSee('Tree Child Order Test')
            ->assertSee(route('services.create', ['parent' => $parent->id]), false);
    }
}
