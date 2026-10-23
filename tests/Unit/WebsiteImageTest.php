<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Support\WebsiteImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

final class WebsiteImageTest extends TestCase
{
    public function test_empty_values_use_a_local_fallback(): void
    {
        $this->assertSame(asset('images/defaults/hero-architecture.svg'), WebsiteImage::url(null, 'hero'));
        $this->assertSame(asset('images/defaults/hero-architecture.svg'), WebsiteImage::url('   ', 'hero', 0));
        $this->assertSame(asset('images/defaults/commercial-building.svg'), WebsiteImage::url('', 'hero', 1));
    }

    public function test_every_fallback_file_exists(): void
    {
        foreach (['hero', 'service', 'about', 'icon', 'logo', 'generic'] as $type) {
            foreach (range(0, 3) as $seed) {
                $path = public_path(ltrim((string) parse_url(WebsiteImage::fallback($type, $seed), PHP_URL_PATH), '/'));
                $this->assertFileExists($path, "Missing fallback for {$type}#{$seed}");
            }
        }
    }

    public function test_missing_local_files_fall_back(): void
    {
        Storage::fake('public');

        $this->assertSame(WebsiteImage::fallback('service', 0), WebsiteImage::url('services/missing.jpg', 'service', 0));
        $this->assertSame(WebsiteImage::fallback('service', 0), WebsiteImage::url('storage/services/missing.jpg', 'service', 0));
        $this->assertSame(WebsiteImage::fallback('hero'), WebsiteImage::url('../../.env', 'hero'));
    }

    public function test_existing_uploads_are_preserved(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('sliders/a.jpg', UploadedFile::fake()->image('a.jpg')->getContent());

        $this->assertSame(asset('storage/sliders/a.jpg'), WebsiteImage::url('sliders/a.jpg', 'hero'));
        $this->assertSame(asset('storage/sliders/a.jpg'), WebsiteImage::url('storage/sliders/a.jpg', 'hero'));
    }

    public function test_public_assets_and_remote_urls_are_kept(): void
    {
        $this->assertSame(asset('assets/images/icons/four.svg'), WebsiteImage::url('/assets/images/icons/four.svg', 'icon'));
        $this->assertSame('https://images.example.com/a.jpg', WebsiteImage::url('https://images.example.com/a.jpg', 'hero'));
    }

    public function test_service_fallback_matches_service_kind(): void
    {
        $this->assertSame(asset('images/defaults/building-structure.svg'), WebsiteImage::fallback('service', 'Construction Completion Certificates'));
        $this->assertSame(asset('images/defaults/commercial-building.svg'), WebsiteImage::fallback('service', 'رخص البناء'));
        $this->assertSame(asset('images/defaults/construction-site.svg'), WebsiteImage::fallback('service', 'Contracting and Supervision'));
    }

    public function test_logo_defaults_to_official_branding(): void
    {
        $this->assertSame(asset(WebsiteImage::LOGO), WebsiteImage::logo(null));
        $this->assertFileExists(public_path(WebsiteImage::LOGO));
    }
}
