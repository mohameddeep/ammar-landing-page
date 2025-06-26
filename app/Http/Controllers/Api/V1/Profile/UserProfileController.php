<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Profile\UserProfileRequest;
use App\Http\Services\Api\V1\Auth\AuthService;
use App\Http\Services\Api\V1\Profile\UserProfileService;

final class UserProfileController extends Controller
{
    protected AuthService $authService;

    public function __construct(private UserProfileService $profileService) {}

    public function profile()
    {

        return $this->profileService->profile();
    }

    public function updateProfile(UserProfileRequest $request)
    {

        return $this->profileService->updateProfile($request);
    }
}
