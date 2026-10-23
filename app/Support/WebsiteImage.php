<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Resolves public website image URLs and provides local fallback images.
 *
 * Stored values come in several shapes: a path on the public disk ("sliders/x.jpg"),
 * a "storage/..." path, a public asset path ("/assets/..."), or an absolute URL.
 * Database values are never modified; a local fallback is returned only when the
 * stored image is empty or missing locally. Remote URLs that fail in the browser are
 * handled by the onerror fallback in <x-website.image>.
 */
final class WebsiteImage
{
    /** Brand lockup for dark backgrounds (website header/footer). */
    public const LOGO = 'images/branding/fast-track-logo-dark.png';

    /** Brand lockup for light backgrounds (dashboard, login). */
    public const LOGO_LIGHT = 'images/branding/fast-track-logo-light.png';

    /** Square brand mark (icons, collapsed sidebar). */
    public const MARK = 'images/branding/fast-track-mark.svg';

    /** Previous official logo, kept for reference / easy switch-back. */
    public const LOGO_OFFICIAL = 'images/branding/logo-horizontal.png';

    private const HERO = 'images/defaults/hero-architecture.svg';

    private const CONSTRUCTION = 'images/defaults/construction-site.svg';

    private const BLUEPRINT = 'images/defaults/blueprint.svg';

    private const COMMERCIAL = 'images/defaults/commercial-building.svg';

    private const STRUCTURE = 'images/defaults/building-structure.svg';

    /** @var array<string, list<string>> public paths, rotated by an integer seed */
    private const FALLBACKS = [
        'hero' => [self::HERO, self::COMMERCIAL, self::CONSTRUCTION],
        'service' => [self::CONSTRUCTION, self::BLUEPRINT, self::COMMERCIAL, self::STRUCTURE],
        'project' => [self::COMMERCIAL, self::STRUCTURE, self::HERO, self::CONSTRUCTION],
        'about' => [self::STRUCTURE],
        'icon' => ['assets/images/icons/sex.svg'],
        'logo' => [self::LOGO],
        'generic' => [self::HERO],
    ];

    /** Keyword => fallback image, matched against a service title (any locale). */
    private const SERVICE_KEYWORDS = [
        'completion' => self::STRUCTURE,
        'certificate' => self::STRUCTURE,
        'إتمام' => self::STRUCTURE,
        'consult' => self::BLUEPRINT,
        'design' => self::BLUEPRINT,
        'engineer' => self::BLUEPRINT,
        'استشار' => self::BLUEPRINT,
        'تصميم' => self::BLUEPRINT,
        'هندس' => self::BLUEPRINT,
        'permit' => self::COMMERCIAL,
        'licens' => self::COMMERCIAL,
        'رخص' => self::COMMERCIAL,
        'ترخيص' => self::COMMERCIAL,
        'contract' => self::CONSTRUCTION,
        'supervis' => self::CONSTRUCTION,
        'مقاول' => self::CONSTRUCTION,
        'إشراف' => self::CONSTRUCTION,
    ];

    public static function url(?string $value, string $type = 'generic', int|string|null $seed = null): string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return self::fallback($type, $seed);
        }

        if (Str::startsWith($value, 'data:image/')) {
            return $value;
        }

        if (Str::startsWith($value, ['http://', 'https://', '//'])) {
            if (self::isOwnHost($value)) {
                return self::localUrl((string) parse_url($value, PHP_URL_PATH)) ?? self::fallback($type, $seed);
            }

            return $value;
        }

        return self::localUrl($value) ?? self::fallback($type, $seed);
    }

    public static function fallback(string $type = 'generic', int|string|null $seed = null): string
    {
        $options = self::FALLBACKS[$type] ?? self::FALLBACKS['generic'];
        $file = $options[0];

        if (is_int($seed)) {
            $file = $options[abs($seed) % count($options)];
        } elseif (is_string($seed) && $seed !== '') {
            $file = self::matchKeyword($seed, $type) ?? $options[crc32($seed) % count($options)];
        }

        return asset($file);
    }

    /** The logo uploaded from the dashboard footer settings, otherwise the official logo. */
    public static function logo(?string $cmsLogo = null): string
    {
        return self::url($cmsLogo, 'logo');
    }

    private static function matchKeyword(string $seed, string $type): ?string
    {
        if ($type !== 'service') {
            return null;
        }

        $haystack = Str::lower($seed);
        foreach (self::SERVICE_KEYWORDS as $keyword => $file) {
            if (Str::contains($haystack, $keyword)) {
                return $file;
            }
        }

        return null;
    }

    private static function localUrl(string $path): ?string
    {
        $path = ltrim(str_replace('\\', '/', $path), '/');

        if ($path === '' || Str::contains($path, '..')) {
            return null;
        }

        if (Str::startsWith($path, 'storage/')) {
            $diskPath = Str::after($path, 'storage/');

            return Storage::disk('public')->exists($diskPath) ? asset($path) : null;
        }

        if (is_file(public_path($path))) {
            return asset($path);
        }

        return Storage::disk('public')->exists($path) ? asset('storage/'.$path) : null;
    }

    private static function isOwnHost(string $url): bool
    {
        $host = parse_url(Str::startsWith($url, '//') ? 'http:'.$url : $url, PHP_URL_HOST);
        if (! is_string($host)) {
            return false;
        }

        $ownHosts = array_filter([
            parse_url((string) config('app.url'), PHP_URL_HOST),
            app()->bound('request') ? request()->getHost() : null,
        ]);

        return in_array(Str::lower($host), array_map(fn ($ownHost) => Str::lower((string) $ownHost), $ownHosts), true);
    }
}
