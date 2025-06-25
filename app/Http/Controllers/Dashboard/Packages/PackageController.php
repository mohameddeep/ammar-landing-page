<?php

namespace App\Http\Controllers\Dashboard\Packages;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\Packages\PackageService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct(private readonly PackageService $service) {}

    public function index()
    {
        return $this->service->index();
    }
}
