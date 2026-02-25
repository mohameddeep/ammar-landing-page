<?php

namespace App\Http\Services\Website\Terms;

use App\Repository\StructureRepositoryInterface;

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
        // Fetch Terms structure content
        $termsStructure = $this->structureRepository->structure('terms_and_conditions');
        $termsContent = null;
        if ($termsStructure && $termsStructure->content) {
            $termsContent = json_decode($termsStructure->content, true);
        }

        return view('website.terms', compact('termsContent'));
    }
}

