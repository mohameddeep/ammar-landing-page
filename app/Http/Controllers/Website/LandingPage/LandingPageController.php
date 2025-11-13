<?php

namespace App\Http\Controllers\Website\LandingPage;

use App\Http\Controllers\Controller;
use App\Http\Services\Website\LandingPage\LandingPageService;

class LandingPageController extends Controller
{
    public function __construct(private readonly LandingPageService $service) {}

    public function index()
    {

        return $this->service->index();
    }

}
