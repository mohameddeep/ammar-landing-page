<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Service;
use Tests\TestCase;

final class ServiceHierarchyTest extends TestCase
{
    private function useRoutingLocale(string $locale): void
    {
        // See WebsiteLocalizationTest: the localized route prefix is resolved at boot.
        putenv("ROUTING_LOCALE={$locale}");
        $_ENV['ROUTING_LOCALE'] = $_SERVER['ROUTING_LOCALE'] = $locale;
        $this->refreshApplication();
    }

    protected function tearDown(): void
    {
        putenv('ROUTING_LOCALE');
        unset($_ENV['ROUTING_LOCALE'], $_SERVER['ROUTING_LOCALE']);
        parent::tearDown();
    }

    private function parentWithChildren(): Service
    {
        $parent = Service::query()->topLevel()->where('is_active', true)
            ->whereHas('children', fn ($query) => $query->where('is_active', true))
            ->with('activeChildren')
            ->first();

        if (! $parent) {
            $this->markTestSkipped('No active parent service with active children in the database.');
        }

        return $parent;
    }

    public function test_parent_page_lists_its_children(): void
    {
        $parent = $this->parentWithChildren();
        $child = $parent->activeChildren->first();

        $this->useRoutingLocale('en');
        $response = $this->get("/en/services/{$parent->id}");

        $response->assertOk();
        $response->assertSee('id="sub-services"', false);
        $response->assertSee(route('website.service.show', $child->id), false);
    }

    public function test_child_page_shows_parent_in_breadcrumb(): void
    {
        $parent = $this->parentWithChildren();
        $child = $parent->activeChildren->first();

        $this->useRoutingLocale('ar');
        $response = $this->get("/ar/services/{$child->id}");

        $response->assertOk();
        $response->assertSee(route('website.service.show', $parent->id), false);
        $response->assertDontSee('id="sub-services"', false);
    }

    public function test_navbar_and_services_page_show_parents_with_children(): void
    {
        $parent = $this->parentWithChildren();
        $child = $parent->activeChildren->first();

        $this->useRoutingLocale('en');
        $response = $this->get('/en/services');

        $response->assertOk();
        $response->assertSee('nav-dropdown__flyout', false);
        $response->assertSee('service-children', false);
        $response->assertSee(route('website.service.show', $child->id), false);
        // Children are listed under their parent, not as separate top-level cards.
        $this->assertSame(
            Service::query()->topLevel()->where('is_active', true)->count(),
            substr_count((string) $response->getContent(), 'data-service-card')
        );
    }
}
