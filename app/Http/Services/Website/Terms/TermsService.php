<?php

namespace App\Http\Services\Website\Terms;

use App\Repository\StructureRepositoryInterface;
use App\Support\StructureContent;

class TermsService
{
    public function __construct(
        private readonly StructureRepositoryInterface $structureRepository,
    ) {}

    /**
     * Get terms and conditions page data
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $structures = $this->structureRepository->structuresForKeys(['terms_and_conditions', 'footer']);
        $termsContent = StructureContent::decode($structures['terms_and_conditions'] ?? null);
        $footerContent = StructureContent::decode($structures['footer'] ?? null);

        return view('website.terms', compact('termsContent', 'footerContent'));
    }
}

