<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * Data-only update for CMS content that still holds the original seeded defaults.
 *
 * - Footer: replaces the old placeholder brand ("البناء المتقدم" / "Advanced Building")
 *   with the official company name, only where the value was never edited.
 * - Service section heading: converts the legacy seeded list shape
 *   ([{title}, {content}]) to the keyed shape the dashboard form saves.
 *
 * Values changed from the dashboard are left untouched. No schema changes.
 */
return new class extends Migration
{
    private const OLD_NAME = ['ar' => 'البناء المتقدم', 'en' => 'Advanced Building'];

    private const NEW_NAME = [
        'ar' => 'المسار السريع للخدمات الهندسية والتقنية',
        'en' => 'Fast Track Engineering & Technical Services',
    ];

    private const OLD_COPYRIGHT = [
        'ar' => '© 2024 البناء المتقدم. جميع الحقوق محفوظة.',
        'en' => '© 2024 Advanced Building. All rights reserved.',
    ];

    public function up(): void
    {
        $this->updateFooter();
        $this->updateServiceHeading();
    }

    public function down(): void
    {
        // Content repair only; previous placeholder values are intentionally not restored.
    }

    private function updateFooter(): void
    {
        $content = $this->content('footer');
        if ($content === null) {
            return;
        }

        $year = date('Y');
        $newCopyright = [
            'ar' => "© {$year} ".self::NEW_NAME['ar'].'. جميع الحقوق محفوظة.',
            'en' => "© {$year} ".self::NEW_NAME['en'].'. All rights reserved.',
        ];

        $changed = false;
        foreach (['ar', 'en'] as $locale) {
            if (($content['website_name'][$locale] ?? null) === self::OLD_NAME[$locale]) {
                $content['website_name'][$locale] = self::NEW_NAME[$locale];
                $changed = true;
            }
            if (($content['copyright'][$locale] ?? null) === self::OLD_COPYRIGHT[$locale]) {
                $content['copyright'][$locale] = $newCopyright[$locale];
                $changed = true;
            }
        }

        if ($changed) {
            $this->save('footer', $content);
        }
    }

    private function updateServiceHeading(): void
    {
        $content = $this->content('service');
        if ($content === null) {
            return;
        }

        $changed = false;
        foreach (['ar', 'en'] as $locale) {
            $section = $content[$locale] ?? null;
            if (! is_array($section) || ! array_is_list($section)) {
                continue;
            }

            $flat = [];
            foreach ($section as $item) {
                if (is_array($item)) {
                    $flat = array_merge($flat, array_map(fn ($value) => is_string($value) ? trim($value) : $value, $item));
                }
            }
            $content[$locale] = $flat;
            $changed = true;
        }

        // The seeded English heading was a placeholder ("service" / "Feature services").
        if (($content['en']['title'] ?? null) === 'service' && ($content['en']['content'] ?? null) === 'Feature services') {
            $content['en']['title'] = 'Our Services';
            $content['en']['content'] = 'Our Distinguished Services';
            $changed = true;
        }

        if ($changed) {
            $this->save('service', $content);
        }
    }

    private function content(string $key): ?array
    {
        $raw = DB::table('structures')->where('key', $key)->value('content');
        $decoded = is_string($raw) ? json_decode($raw, true) : null;

        return is_array($decoded) ? $decoded : null;
    }

    private function save(string $key, array $content): void
    {
        DB::table('structures')->where('key', $key)->update([
            'content' => json_encode($content, JSON_UNESCAPED_UNICODE),
            'updated_at' => now(),
        ]);

        // Same invalidation as StructureRepository::publish().
        Cache::forget('structure.'.$key);
        Cache::forever('structures.cache_epoch', (int) Cache::get('structures.cache_epoch', 0) + 1);
    }
};
