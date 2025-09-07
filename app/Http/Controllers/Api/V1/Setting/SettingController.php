<?php

namespace App\Http\Controllers\Api\V1\Setting;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Setting\SettingService;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    public function __construct(
        private readonly SettingService $SettingService
    ) {}

    public function index(): JsonResponse
    {
        return $this->SettingService->index();
    }

    public function settings_production(): JsonResponse
    {
        return $this->SettingService->settings_production();
    }
}
