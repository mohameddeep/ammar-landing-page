<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Service;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

final class WebsiteLocalizationTest extends TestCase
{
    /**
     * mcamara/laravel-localization resolves the route prefix while the app boots, before a
     * test request exists, so the locale is forced through ROUTING_LOCALE and the app rebuilt.
     */
    private function useRoutingLocale(string $locale): void
    {
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

    /** @return array<string, array{string, string, string}> */
    public static function locales(): array
    {
        return [
            'arabic' => ['ar', 'rtl', 'en'],
            'english' => ['en', 'ltr', 'ar'],
        ];
    }

    #[DataProvider('locales')]
    public function test_public_pages_render_with_correct_language_and_direction(string $locale, string $dir, string $other): void
    {
        $this->useRoutingLocale($locale);

        foreach (['', '/services', '/about-us', '/contact-us', '/terms-and-conditions', '/privacy-policy'] as $path) {
            $response = $this->get("/{$locale}{$path}");

            $response->assertOk();
            $response->assertSee('<html lang="'.$locale.'" dir="'.$dir.'">', false);
            $response->assertSee(\App\Support\WebsiteImage::LOGO, false);
            // Language switch keeps the visitor on the same page and bypasses Turbo (so <html dir> updates).
            $response->assertSee('href="'.url("/{$other}{$path}").'" hreflang="'.$other.'"', false);
            $response->assertSee('data-turbo="false"', false);
            // No raw translation keys such as "website.navHome" leak into the page.
            $this->assertDoesNotMatchRegularExpression('/\bwebsite\.[a-z][A-Za-z_]+\b/', (string) $response->getContent());
        }
    }

    #[DataProvider('locales')]
    public function test_service_detail_language_switch_keeps_the_service_id(string $locale, string $dir, string $other): void
    {
        $service = Service::query()->where('is_active', true)->first();
        if (! $service) {
            $this->markTestSkipped('No active service in the database.');
        }

        $this->useRoutingLocale($locale);
        $response = $this->get("/{$locale}/services/{$service->id}?ref=test");

        $response->assertOk();
        $response->assertSee('dir="'.$dir.'"', false);
        $response->assertSee('href="'.url("/{$other}/services/{$service->id}").'?ref=test"', false);
        $response->assertSee('data-fallback-src=', false);
    }

    public function test_home_page_hero_never_points_at_a_broken_storage_url(): void
    {
        $this->useRoutingLocale('en');
        $response = $this->get('/en');

        $response->assertOk();
        $response->assertDontSee('/storage/http', false);
        $response->assertSee('class="slide-image"', false);
    }
}
