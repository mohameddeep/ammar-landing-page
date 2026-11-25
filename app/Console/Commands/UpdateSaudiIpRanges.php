<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Support\SaudiIpRanges;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

final class UpdateSaudiIpRanges extends Command
{
    protected $signature = 'visitors:update-saudi-ips';

    protected $description = 'Download the latest Saudi IP ranges used to count visitors from Saudi Arabia';

    public function handle(): int
    {
        $response = Http::timeout(120)->get(SaudiIpRanges::SOURCE);
        $ranges = $response->successful() ? SaudiIpRanges::parse($response->body()) : [];

        // Keep the current list if the download is broken or suspiciously small.
        if (count($ranges) < 100) {
            $this->error('Download failed or returned too few ranges. The current list was not changed.');

            return self::FAILURE;
        }

        File::ensureDirectoryExists(dirname(SaudiIpRanges::path()));
        File::put(SaudiIpRanges::path(), implode("\n", $ranges)."\n");

        $this->info(count($ranges).' ranges saved.');

        return self::SUCCESS;
    }
}
