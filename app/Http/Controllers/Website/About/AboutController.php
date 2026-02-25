<?php

namespace App\Http\Controllers\Website\About;

use App\Http\Controllers\Controller;
use App\Http\Services\Website\About\AboutService;

class AboutController extends Controller
{
    public function __construct(
        private readonly AboutService $aboutService,
    ) {}

    public function index()
    {
        return $this->aboutService->index();
    }
}

