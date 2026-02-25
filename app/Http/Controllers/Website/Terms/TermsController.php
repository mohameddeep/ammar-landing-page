<?php

namespace App\Http\Controllers\Website\Terms;

use App\Http\Controllers\Controller;
use App\Http\Services\Website\Terms\TermsService;
use Illuminate\View\View;

class TermsController extends Controller
{
    public function __construct(
        private readonly TermsService $termsService,
    ) {}

    /**
     * Display the terms and conditions page
     *
     * @return View
     */
    public function index(): View
    {
        return $this->termsService->index();
    }
}

