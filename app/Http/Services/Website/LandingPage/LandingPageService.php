<?php

namespace App\Http\Services\Website\LandingPage;

use App\Support\StructureContent;
use App\Repository\StructureRepositoryInterface;
use App\Repository\SliderRepositoryInterface;
use App\Repository\ServiceRepositoryInterface;
use App\Repository\AboutUsRepositoryInterface;

class LandingPageService
{
    

    public function __construct(
        private StructureRepositoryInterface $structureRepository,
        private SliderRepositoryInterface $sliderRepository,
        private ServiceRepositoryInterface $serviceRepository,
        private AboutUsRepositoryInterface $aboutUsRepository,
    ) {}

    public function index()
    {
        $sliders = $this->sliderRepository->getActive();
        $services = $this->serviceRepository->getActive();

        $structures = $this->structureRepository->structuresForKeys(['about', 'service', 'footer']);

        $aboutContent = StructureContent::decode($structures['about'] ?? null);
        $serviceContent = StructureContent::decode($structures['service'] ?? null);
        $footerContent = StructureContent::decode($structures['footer'] ?? null);

        $aboutTabs = $this->aboutUsRepository->getActiveRootTabsWithChildren()
            ->map(function ($tab) {
                return [
                    'id' => $tab->id,
                    'title' => $tab->t('title'),
                    'key' => 'tab_'.$tab->id,
                    'children' => $tab->children->sortBy('id')->values(),
                ];
            });

        return view('website.landing-page.index', compact('sliders', 'services', 'aboutContent', 'aboutTabs', 'serviceContent', 'footerContent'));
    }
}
