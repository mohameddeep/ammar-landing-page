<?php

namespace App\Support;

use App\Models\Structure;

final class StructureContent
{
    public static function decode(?Structure $row): ?array
    {
        if (! $row || empty($row->content)) {
            return null;
        }

        $decoded = json_decode((string) $row->content, true);

        return is_array($decoded) ? $decoded : null;
    }

    /**
     * Section content for one locale as a flat ['key' => value] array.
     *
     * Accepts the dashboard shape (['ar' => ['title' => ...]]) and the legacy seeded
     * list shape (['ar' => [['title' => ...], ['content' => ...]]]). Empty values fall
     * back to the other locale, matching LanguageToggle::t().
     *
     * @return array<string, mixed>
     */
    public static function forLocale(?array $content, string $locale): array
    {
        $current = self::flatten($content[$locale] ?? null);
        $fallbackLocale = $locale === 'ar' ? 'en' : 'ar';

        foreach (self::flatten($content[$fallbackLocale] ?? null) as $key => $value) {
            if (self::isEmpty($current[$key] ?? null)) {
                $current[$key] = $value;
            }
        }

        return array_filter($current, fn ($value) => ! self::isEmpty($value));
    }

    /** Treats markup without text (e.g. an empty editor "<p> </p>") as empty. */
    private static function isEmpty(mixed $value): bool
    {
        return blank(is_string($value) ? trim(html_entity_decode(strip_tags($value)), " \t\n\r\0\x0B\u{A0}") : $value);
    }

    /** @return array<string, mixed> */
    private static function flatten(mixed $section): array
    {
        if (! is_array($section)) {
            return [];
        }

        if (! array_is_list($section)) {
            return $section;
        }

        $flat = [];
        foreach ($section as $item) {
            if (is_array($item) && ! array_is_list($item)) {
                $flat = array_merge($flat, $item);
            }
        }

        return $flat;
    }
}
