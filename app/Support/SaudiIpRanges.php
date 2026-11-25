<?php

declare(strict_types=1);

namespace App\Support;

use Symfony\Component\HttpFoundation\IpUtils;

/**
 * IP ranges registered to Saudi Arabia, kept locally so visitor IPs never leave the server.
 * Source: RIPE NCC delegation statistics. Refresh with `php artisan visitors:update-saudi-ips`.
 */
final class SaudiIpRanges
{
    public const SOURCE = 'https://ftp.ripe.net/pub/stats/ripencc/delegated-ripencc-latest';

    public static function path(): string
    {
        return resource_path('data/saudi-ip-ranges.txt');
    }

    /**
     * Null when the list is unavailable, so the country is recorded as unknown.
     */
    public static function contains(?string $ip): ?bool
    {
        if (! $ip || ! is_readable(self::path())) {
            return null;
        }

        $ranges = file(self::path(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        return $ranges ? IpUtils::checkIp($ip, $ranges) : null;
    }

    /**
     * Convert a RIPE delegation file into a list of Saudi CIDR blocks.
     *
     * @return array<int, string>
     */
    public static function parse(string $delegations): array
    {
        $ranges = [];

        foreach (preg_split('/\R/', $delegations) ?: [] as $line) {
            $parts = explode('|', $line);
            if (count($parts) < 7 || $parts[1] !== 'SA') {
                continue;
            }

            [, , $type, $start, $value] = $parts;

            if ($type === 'ipv4' && filter_var($start, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) && (int) $value > 0) {
                array_push($ranges, ...self::ipv4Blocks((int) ip2long($start), (int) $value));
            }

            if ($type === 'ipv6' && filter_var($start, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) && (int) $value >= 8 && (int) $value <= 128) {
                $ranges[] = $start.'/'.(int) $value;
            }
        }

        return $ranges;
    }

    /**
     * An IPv4 allocation is "start + address count", which is not always one CIDR block.
     *
     * @return array<int, string>
     */
    private static function ipv4Blocks(int $start, int $count): array
    {
        $blocks = [];

        while ($count > 0) {
            // Largest block that is aligned on the start address and fits in what is left.
            $size = $start === 0 ? 1 << 31 : $start & -$start;
            while ($size > $count) {
                $size >>= 1;
            }

            $blocks[] = long2ip($start).'/'.(32 - (int) log($size, 2));
            $start += $size;
            $count -= $size;
        }

        return $blocks;
    }
}
