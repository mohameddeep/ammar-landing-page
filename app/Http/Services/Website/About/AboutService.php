<?php

namespace App\Http\Services\Website\About;

use App\Repository\AboutUsRepositoryInterface;
use App\Support\StructureContent;
use App\Repository\StructureRepositoryInterface;

class AboutService
{
    public function __construct(
        private readonly AboutUsRepositoryInterface $aboutUsRepository,
        private readonly StructureRepositoryInterface $structureRepository,
    ) {}

    public function index()
    {
        $structures = $this->structureRepository->structuresForKeys(['about', 'footer']);
        $aboutContent = StructureContent::decode($structures['about'] ?? null);
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

        return view('website.about', compact('aboutContent', 'aboutTabs', 'footerContent'));
    }
}

