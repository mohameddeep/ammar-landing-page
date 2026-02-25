<?php

namespace App\Http\Services\Website\Privacy;

use App\Repository\StructureRepositoryInterface;

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
        // Fetch Privacy Policy structure content
        $privacyStructure = $this->structureRepository->structure('privacy_policy');
        $privacyContent = null;
        if ($privacyStructure && $privacyStructure->content) {
            $privacyContent = json_decode($privacyStructure->content, true);
        }

        return view('website.privacy', compact('privacyContent'));
    }
}

