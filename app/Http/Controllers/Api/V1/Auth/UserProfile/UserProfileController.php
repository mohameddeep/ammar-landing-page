<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Auth\UserProfile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\UserProfileRequest;
use App\Http\Services\Api\V1\Auth\AuthService;
use App\Http\Services\Api\V1\Auth\Profile\ProfileService;

final class UserProfileController extends Controller
{
    protected AuthService $authService;

    public function __construct(private ProfileService $profileService) {}

    public function userProfile()
    {

        return $this->profileService->userProfile();
    }

    public function updateUserProfile(UserProfileRequest $request)
    {

        return $this->profileService->updateUserProfile($request);
    }
}
