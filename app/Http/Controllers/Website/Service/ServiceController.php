<?php

namespace App\Http\Controllers\Website\Service;

use App\Http\Controllers\Controller;
use App\Http\Services\Website\Service\ServiceService;

class ServiceController extends Controller
{
    public function __construct(
        private readonly ServiceService $serviceService,
    ) {}

    public function index()
    {
        return $this->serviceService->index();
    }

    public function show($id)
    {
        return $this->serviceService->show($id);
    }
}
