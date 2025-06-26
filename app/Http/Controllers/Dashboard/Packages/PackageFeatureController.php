<?php

namespace App\Http\Controllers\Dashboard\Packages;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\Packages\PackageFeatureService;
use Illuminate\Http\Request;

class PackageFeatureController extends Controller
{
    public function __construct(private readonly PackageFeatureService $service) {}


    public function toggle(Request $request, $id)
    {
        return $this->service->toggle($request, $id);
    }
}
