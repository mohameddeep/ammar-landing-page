<?php

namespace App\Http\Controllers\Website\Seo;

use App\Http\Controllers\Controller;
use App\Repository\ServiceRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SitemapController extends Controller
{
    public function __construct(
        private readonly ServiceRepositoryInterface $serviceRepository,
    ) {}

    public function __invoke(): Response
    {
        $lastmod = Carbon::now()->toAtomString();
        $locales = array_keys(LaravelLocalization::getSupportedLocales());
        $urls = [];

        $staticSuffixes = [
            ['suffix' => '', 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['suffix' => 'services', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['suffix' => 'about-us', 'priority' => '0.85', 'changefreq' => 'monthly'],
            ['suffix' => 'contact-us', 'priority' => '0.85', 'changefreq' => 'monthly'],
            ['suffix' => 'terms-and-conditions', 'priority' => '0.4', 'changefreq' => 'yearly'],
            ['suffix' => 'privacy-policy', 'priority' => '0.4', 'changefreq' => 'yearly'],
        ];

        foreach ($locales as $locale) {
            foreach ($staticSuffixes as $item) {
                $path = $item['suffix'] === '' ? $locale : $locale.'/'.$item['suffix'];
                $urls[] = [
                    'loc' => URL::to('/'.$path),
                    'lastmod' => $lastmod,
                    'priority' => $item['priority'],
                    'changefreq' => $item['changefreq'],
                ];
            }

            foreach ($this->serviceRepository->getActive() as $service) {
                $urls[] = [
                    'loc' => URL::to('/'.$locale.'/services/'.$service->id),
                    'lastmod' => $lastmod,
                    'priority' => '0.8',
                    'changefreq' => 'monthly',
                ];
            }
        }

        $xml = view('website.seo.sitemap-xml', ['urls' => $urls])->render();

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
