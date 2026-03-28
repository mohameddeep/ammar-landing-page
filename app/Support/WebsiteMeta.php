<?php

namespace App\Support;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class WebsiteMeta
{
    public static function canonicalUrl(): string
    {
        if (! request()->isMethod('GET')) {
            return URL::to('/');
        }

        return URL::current();
    }

    /**
     * @return array<int, array{hreflang: string, href: string}>
     */
    public static function hreflangAlternates(): array
    {
        $alternates = [];
        $locales = array_keys(LaravelLocalization::getSupportedLocales());
        $segments = array_values(array_filter(explode('/', request()->path())));
        if ($segments !== [] && in_array($segments[0], $locales, true)) {
            array_shift($segments);
        }
        $pathWithoutLocale = $segments === [] ? '/' : '/'.implode('/', $segments);

        foreach ($locales as $locale) {
            $href = LaravelLocalization::getLocalizedURL($locale, $pathWithoutLocale);
            if (is_string($href) && $href !== '') {
                $alternates[] = ['hreflang' => $locale, 'href' => $href];
            }
        }

        $default = config('app.locale', 'ar');
        $defaultHref = LaravelLocalization::getLocalizedURL($default, $pathWithoutLocale);
        if (is_string($defaultHref) && $defaultHref !== '') {
            $alternates[] = ['hreflang' => 'x-default', 'href' => $defaultHref];
        }

        return $alternates;
    }

    public static function absoluteOgImage(?string $relativeOrAbsolute = null): ?string
    {
        $raw = $relativeOrAbsolute ?: config('seo.og_image');
        if (! $raw) {
            return null;
        }
        if (Str::startsWith($raw, ['http://', 'https://'])) {
            return $raw;
        }

        return URL::asset(ltrim($raw, '/'));
    }

    public static function metaDescription(?string $explicit = null): string
    {
        if ($explicit !== null && $explicit !== '') {
            return Str::limit(strip_tags($explicit), 160, '');
        }

        return Str::limit(strip_tags(__('website.seoDefaultDescription')), 160, '');
    }
}
