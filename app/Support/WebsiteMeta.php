<?php

namespace App\Support;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class WebsiteMeta
{
    /**
     * Production origin (https, no trailing slash), taken from config so every
     * canonical/hreflang/OG URL is absolute and independent of the request host.
     */
    public static function baseUrl(): string
    {
        $base = rtrim((string) (config('seo.site_url') ?: config('app.url')), '/');

        if (app()->isProduction() && str_starts_with($base, 'http://')) {
            $base = 'https://'.substr($base, 7);
        }

        return $base;
    }

    /**
     * Absolute URL for a path on the production origin.
     */
    public static function url(string $path = '/'): string
    {
        return self::baseUrl().'/'.ltrim($path, '/');
    }

    /**
     * Self-referencing canonical: production origin + current path, no query string.
     */
    public static function canonicalUrl(): string
    {
        return rtrim(self::url(request()->path()), '/') ?: self::baseUrl();
    }

    /**
     * Reciprocal hreflang set for the current page (every supported locale + x-default).
     *
     * @return array<int, array{hreflang: string, href: string}>
     */
    public static function hreflangAlternates(): array
    {
        $locales = array_keys(LaravelLocalization::getSupportedLocales());
        $segments = array_values(array_filter(explode('/', request()->path())));
        if ($segments !== [] && in_array($segments[0], $locales, true)) {
            array_shift($segments);
        }
        $rest = implode('/', $segments);

        $href = fn (string $locale): string => self::url($locale.($rest !== '' ? '/'.$rest : ''));

        $alternates = [];
        foreach ($locales as $locale) {
            $alternates[] = ['hreflang' => $locale, 'href' => $href($locale)];
        }

        $default = in_array(config('app.locale'), $locales, true) ? config('app.locale') : $locales[0];
        $alternates[] = ['hreflang' => 'x-default', 'href' => $href($default)];

        return $alternates;
    }

    public static function absoluteOgImage(?string $relativeOrAbsolute = null): ?string
    {
        // Branded share image when neither the page nor SEO_OG_IMAGE provides one.
        $raw = $relativeOrAbsolute ?: config('seo.og_image') ?: 'images/branding/og-image.png';
        if (! $raw) {
            return null;
        }
        if (Str::startsWith($raw, ['http://', 'https://'])) {
            return self::forceHttps($raw);
        }

        return self::url($raw);
    }

    /**
     * Plain-text description (HTML and entities removed), trimmed on a word boundary.
     */
    public static function metaDescription(?string $explicit = null, int $limit = 160): string
    {
        $text = RichText::text($explicit);
        if ($text === '') {
            $text = RichText::text(__('website.seoDefaultDescription'));
        }

        return self::limitWords($text, $limit);
    }

    public static function limitWords(string $text, int $limit): string
    {
        if (mb_strlen($text) <= $limit) {
            return $text;
        }

        $cut = mb_substr($text, 0, $limit);
        $lastSpace = mb_strrpos($cut, ' ');

        return rtrim($lastSpace !== false && $lastSpace > $limit * 0.6 ? mb_substr($cut, 0, $lastSpace) : $cut, " ,.;:-–—،").'…';
    }

    /**
     * BreadcrumbList structured data. Items: [['name' => ..., 'url' => ...], ...] (last may omit url).
     *
     * @param  array<int, array{name: string, url?: string}>  $items
     * @return array<string, mixed>
     */
    public static function breadcrumbs(array $items): array
    {
        $list = [];
        foreach (array_values($items) as $i => $item) {
            $entry = ['@type' => 'ListItem', 'position' => $i + 1, 'name' => RichText::text($item['name'])];
            $entry['item'] = $item['url'] ?? self::canonicalUrl();
            $list[] = $entry;
        }

        return ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $list];
    }

    public static function jsonLd(array $data): string
    {
        return '<script type="application/ld+json">'
            .json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG)
            .'</script>';
    }

    private static function forceHttps(string $url): string
    {
        return app()->isProduction() && str_starts_with($url, 'http://') ? 'https://'.substr($url, 7) : $url;
    }
}
