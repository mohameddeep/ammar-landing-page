<?php

namespace App\Http\Services\Website\About;

use App\Repository\AboutUsRepositoryInterface;
use App\Repository\StructureRepositoryInterface;

class AboutService
{
    public function __construct(
        private readonly AboutUsRepositoryInterface $aboutUsRepository,
        private readonly StructureRepositoryInterface $structureRepository,
    ) {}

    public function index()
    {
        // Fetch About structure content
        $aboutStructure = $this->structureRepository->structure('about');
        $aboutContent = null;
        if ($aboutStructure && $aboutStructure->content) {
            $aboutContent = json_decode($aboutStructure->content, true);
        }

        // Fetch Footer structure content
        $footerStructure = $this->structureRepository->structure('footer');
        $footerContent = null;
        if ($footerStructure && $footerStructure->content) {
            $footerContent = json_decode($footerStructure->content, true);
        }

        // Fetch AboutUs tabs (parents with null parent_id) with children relationship loaded
        $aboutTabs = $this->aboutUsRepository->getActive(['*'], ['children'])
            ->where('parent_id', null)
            ->sortBy('id')
            ->map(function ($tab) {
                // Filter children to only active ones and sort by id
                $activeChildren = $tab->children->where('is_active', true)->sortBy('id')->values();
                
                return [
                    'id' => $tab->id,
                    'title' => $tab->t('title'),
                    'key' => 'tab_' . $tab->id,
                    'children' => $activeChildren,
                ];
            });

        return view('website.about', compact('aboutContent', 'aboutTabs', 'footerContent'));
    }
}

