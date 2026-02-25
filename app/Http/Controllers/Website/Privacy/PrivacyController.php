<?php

namespace App\Http\Controllers\Website\Privacy;

use App\Http\Controllers\Controller;
use App\Http\Services\Website\Privacy\PrivacyService;
use Illuminate\View\View;

class PrivacyController extends Controller
{
    public function __construct(
        private readonly PrivacyService $privacyService,
    ) {}

    /**
     * Display the privacy policy page
     *
     * @return View
     */
    public function index(): View
    {
        return $this->privacyService->index();
    }
}

