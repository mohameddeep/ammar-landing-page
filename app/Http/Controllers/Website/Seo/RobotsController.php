<?php

namespace App\Http\Controllers\Website\Seo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RobotsController extends Controller
{
    public function __invoke(): Response
    {
        $base = rtrim(config('app.url'), '/');
        $sitemap = $base.'/sitemap.xml';

        $lines = ['User-agent: *'];

        if (config('seo.noindex', false)) {
            $lines[] = 'Disallow: /';
        } else {
            $lines[] = 'Allow: /';
            foreach (array_keys(LaravelLocalization::getSupportedLocales()) as $locale) {
                $lines[] = "Disallow: /{$locale}/admin";
                $lines[] = "Disallow: /{$locale}/admin/";
            }
            $lines[] = 'Disallow: /api/';
        }

        $lines[] = '';
        $lines[] = 'Sitemap: '.$sitemap;

        $body = implode("\n", $lines)."\n";

        return response($body, 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}
