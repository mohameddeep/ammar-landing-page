<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Package;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Package\PackageService;

final class PackageController extends Controller
{
    public function __construct(private PackageService $packageService) {}

    public function index()
    {
        return $this->packageService->index();
    }

    public function show($id)
    {
        return $this->packageService->show($id);
    }

}
