<?php

namespace App\Http\Controllers\Website\Seo;

use App\Http\Controllers\Controller;
use App\Repository\ProjectRepositoryInterface;
use App\Repository\ServiceRepositoryInterface;
use App\Support\WebsiteMeta;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SitemapController extends Controller
{
    public function __construct(
        private readonly ServiceRepositoryInterface $serviceRepository,
        private readonly ProjectRepositoryInterface $projectRepository,
    ) {}

    public function __invoke(): Response
    {
        $xml = Cache::remember('sitemap.xml.'.md5(WebsiteMeta::baseUrl()), 3600, fn (): string => $this->build());

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    private function build(): string
    {
        $locales = array_keys(LaravelLocalization::getSupportedLocales());
        $default = in_array(config('app.locale'), $locales, true) ? config('app.locale') : $locales[0];

        $services = $this->serviceRepository->getActive(['id', 'updated_at']);
        $projects = $this->projectRepository->getActiveForGallery();

        $servicesLastmod = $services->max('updated_at');
        $projectsLastmod = $projects->max('updated_at');
        $siteLastmod = collect([$servicesLastmod, $projectsLastmod])->filter()->max();

        // [path without locale, lastmod, changefreq, priority]
        $pages = [
            ['', $siteLastmod, 'weekly', '1.0'],
            ['services', $servicesLastmod, 'weekly', '0.9'],
            ['projects', $projectsLastmod, 'weekly', '0.9'],
            ['about-us', null, 'monthly', '0.7'],
            ['contact-us', null, 'monthly', '0.7'],
            ['terms-and-conditions', null, 'yearly', '0.3'],
            ['privacy-policy', null, 'yearly', '0.3'],
        ];
        foreach ($services as $service) {
            $pages[] = ['services/'.$service->id, $service->updated_at, 'monthly', '0.8'];
        }
        foreach ($projects as $project) {
            $pages[] = ['projects/'.$project->slug, $project->updated_at, 'monthly', '0.8'];
        }

        $urls = [];
        foreach ($pages as [$suffix, $lastmod, $changefreq, $priority]) {
            $alternates = [];
            foreach ($locales as $locale) {
                $alternates[] = ['hreflang' => $locale, 'href' => WebsiteMeta::url($locale.($suffix !== '' ? '/'.$suffix : ''))];
            }
            $alternates[] = ['hreflang' => 'x-default', 'href' => WebsiteMeta::url($default.($suffix !== '' ? '/'.$suffix : ''))];

            foreach ($locales as $locale) {
                $urls[] = [
                    'loc' => WebsiteMeta::url($locale.($suffix !== '' ? '/'.$suffix : '')),
                    'lastmod' => $lastmod?->toAtomString(),
                    'changefreq' => $changefreq,
                    'priority' => $priority,
                    'alternates' => $alternates,
                ];
            }
        }

        return view('website.seo.sitemap-xml', ['urls' => $urls])->render();
    }
}
