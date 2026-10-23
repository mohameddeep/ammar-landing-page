<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Support\StructureContent;
use PHPUnit\Framework\TestCase;

final class StructureContentTest extends TestCase
{
    public function test_reads_the_keyed_dashboard_shape(): void
    {
        $content = ['ar' => ['title' => 'خدماتنا', 'content' => 'نص'], 'en' => ['title' => 'Our Services', 'content' => 'Text']];

        $this->assertSame(['title' => 'Our Services', 'content' => 'Text'], StructureContent::forLocale($content, 'en'));
    }

    public function test_reads_the_legacy_list_shape(): void
    {
        $content = ['en' => [['title' => 'service'], ['content' => 'Feature services']]];

        $this->assertSame(['title' => 'service', 'content' => 'Feature services'], StructureContent::forLocale($content, 'en'));
    }

    public function test_empty_values_fall_back_to_the_other_locale(): void
    {
        $content = ['ar' => ['title' => 'من نحن', 'desc' => 'وصف'], 'en' => ['title' => 'About Us', 'desc' => '<p> </p>']];

        $this->assertSame(['title' => 'About Us', 'desc' => 'وصف'], StructureContent::forLocale($content, 'en'));
        $this->assertSame([], StructureContent::forLocale(null, 'ar'));
    }
}
