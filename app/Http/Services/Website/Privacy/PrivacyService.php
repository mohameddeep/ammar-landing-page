<?php

namespace App\Http\Services\Website\Privacy;

use App\Repository\StructureRepositoryInterface;
use App\Support\StructureContent;

class PrivacyService
{
    public function __construct(
        private readonly StructureRepositoryInterface $structureRepository,
    ) {}

    /**
     * Get privacy policy page data
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $structures = $this->structureRepository->structuresForKeys(['privacy_policy', 'footer']);
        $privacyContent = StructureContent::decode($structures['privacy_policy'] ?? null);
        $footerContent = StructureContent::decode($structures['footer'] ?? null);

        return view('website.privacy', compact('privacyContent', 'footerContent'));
    }
}

