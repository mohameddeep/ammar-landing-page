<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Profile\MerchantProfileRequest;
use App\Http\Services\Api\V1\Auth\AuthService;
use App\Http\Services\Api\V1\Profile\MerchantProfileService;

final class MerchantProfileController extends Controller
{
    protected AuthService $authService;

    public function __construct(private MerchantProfileService $profileService) {}

    public function profile()
    {

        return $this->profileService->profile();
    }

    public function updateProfile(MerchantProfileRequest $request)
    {

        return $this->profileService->updateProfile($request);
    }
}
