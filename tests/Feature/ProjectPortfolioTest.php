<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Manager;
use App\Models\Project;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

final class ProjectPortfolioTest extends TestCase
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

    private function makeProject(array $overrides = []): Project
    {
        return Project::query()->create($overrides + [
            'slug' => 'test-villa-'.uniqid(),
            'title_ar' => 'فيلا اختبارية',
            'title_en' => 'Test Villa',
            'category_ar' => 'سكني',
            'category_en' => 'Residential',
            'city_ar' => 'الرياض',
            'city_en' => 'Riyadh',
            'is_active' => true,
        ]);
    }

    /** @return array<string, array{string, string, string}> */
    public static function locales(): array
    {
        return ['arabic' => ['ar', 'rtl', 'مشاريعنا'], 'english' => ['en', 'ltr', 'Our Projects']];
    }

    #[DataProvider('locales')]
    public function test_gallery_lists_only_active_projects(string $locale, string $dir, string $navLabel): void
    {
        $this->useRoutingLocale($locale);
        $active = $this->makeProject();
        $hidden = $this->makeProject(['title_en' => 'Hidden Draft', 'title_ar' => 'مسودة مخفية', 'is_active' => false]);

        $response = $this->get("/{$locale}/projects");

        $response->assertOk();
        $response->assertSee('dir="'.$dir.'"', false);
        $response->assertSee($navLabel);
        $response->assertSee('aria-current="page"', false);
        $response->assertSee(route('website.projects.show', $active->slug), false);
        $response->assertDontSee($hidden->slug);
    }

    #[DataProvider('locales')]
    public function test_project_page_shows_details_gallery_and_keeps_slug_on_language_switch(string $locale, string $dir): void
    {
        $this->useRoutingLocale($locale);
        $project = $this->makeProject(['image' => 'projects/missing.jpg']);
        $project->images()->create(['image' => 'projects/gallery/missing.jpg', 'sort_order' => 1]);
        $other = $locale === 'ar' ? 'en' : 'ar';

        $response = $this->get("/{$locale}/projects/{$project->slug}");

        $response->assertOk();
        $response->assertSee('dir="'.$dir.'"', false);
        $response->assertSee($project->t('title'));
        $response->assertSee('data-lightbox-gallery', false);
        $this->assertSame(2, substr_count((string) $response->getContent(), 'data-lightbox-index='));
        // Missing files fall back to local illustrations.
        $response->assertSee('images/defaults/', false);
        $response->assertSee('href="'.url("/{$other}/projects/{$project->slug}").'" hreflang="'.$other.'"', false);
    }

    public function test_inactive_or_unknown_project_returns_404(): void
    {
        $this->useRoutingLocale('en');
        $hidden = $this->makeProject(['is_active' => false]);

        $this->get("/en/projects/{$hidden->slug}")->assertNotFound();
        $this->get('/en/projects/does-not-exist')->assertNotFound();
    }

    public function test_dashboard_creates_updates_and_deletes_a_project_with_gallery(): void
    {
        $this->useRoutingLocale('en');
        Storage::fake('public'); // after the app refresh, or the fake would be discarded
        $manager = Manager::query()->first() ?? $this->markTestSkipped('No manager account to log in with.');
        $this->actingAs($manager);

        $this->post('/en/admin/projects', [
            'title_ar' => 'برج تجاري',
            'title_en' => 'Commercial Tower',
            'category_en' => 'Commercial',
            'year' => 2024,
            'is_active' => '1',
            'image' => UploadedFile::fake()->image('main.jpg', 1200, 800),
            'gallery' => [UploadedFile::fake()->image('a.jpg'), UploadedFile::fake()->image('b.jpg')],
        ])->assertRedirect();

        $project = Project::query()->where('title_en', 'Commercial Tower')->with('images')->firstOrFail();
        $this->assertSame('commercial-tower', $project->slug);
        $this->assertCount(2, $project->images);
        $this->assertNotSame($project->images[0]->image, $project->images[1]->image, 'Gallery files must not overwrite each other');
        Storage::disk('public')->assertExists([$project->image, $project->images[0]->image, $project->images[1]->image]);

        // Same title again gets a unique slug.
        $this->post('/en/admin/projects', [
            'title_ar' => 'برج تجاري',
            'title_en' => 'Commercial Tower',
            'image' => UploadedFile::fake()->image('main2.jpg'),
        ])->assertRedirect();
        $this->assertTrue(Project::query()->where('slug', 'commercial-tower-2')->exists());

        $oldMain = $project->image;
        $this->put("/en/admin/projects/{$project->id}", [
            'title_ar' => 'برج تجاري',
            'title_en' => 'Commercial Tower',
            'slug' => 'commercial-tower',
            'image' => UploadedFile::fake()->image('new-main.jpg'),
            'gallery' => [UploadedFile::fake()->image('c.jpg')],
        ])->assertRedirect();
        $project->refresh()->load('images');
        Storage::disk('public')->assertMissing($oldMain);
        $this->assertCount(3, $project->images);
        $this->assertFalse($project->is_active, 'Unchecked "active" switch deactivates the project');

        $removed = $project->images->first();
        $this->deleteJson("/en/admin/projects/images/{$removed->id}")->assertOk()->assertJsonPath('data', true);
        Storage::disk('public')->assertMissing($removed->image);

        $files = array_merge([$project->image], $project->images()->pluck('image')->all());
        $this->deleteJson("/en/admin/projects/{$project->id}")->assertOk();
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
        $this->assertDatabaseMissing('project_images', ['project_id' => $project->id]);
        foreach ($files as $file) {
            Storage::disk('public')->assertMissing($file);
        }
    }

    public function test_dashboard_validation_rejects_bad_slug_and_missing_image(): void
    {
        $this->useRoutingLocale('en');
        $manager = Manager::query()->first() ?? $this->markTestSkipped('No manager account to log in with.');
        $this->actingAs($manager);

        $this->from('/en/admin/projects/create')
            ->post('/en/admin/projects', ['title_ar' => 'مشروع', 'slug' => 'not valid!', 'gallery' => ['not-a-file']])
            ->assertSessionHasErrors(['image', 'gallery.0']);
    }

    public function test_guests_cannot_reach_project_dashboard(): void
    {
        $this->useRoutingLocale('en');

        $this->get('/en/admin/projects')->assertRedirect();
        $this->post('/en/admin/projects', [])->assertRedirect();
    }
}
