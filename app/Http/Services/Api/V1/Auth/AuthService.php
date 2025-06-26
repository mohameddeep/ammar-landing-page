<?php

namespace App\Http\Services\Api\V1\Auth;

use App\Http\Helpers\Http;
use App\Http\Requests\Api\V1\Auth\SignInRequest;
use App\Http\Resources\V1\User\UserResource;
use App\Http\Services\Api\V1\Auth\Otp\OtpService;
use App\Http\Services\PlatformService;

use App\Repository\UserRepositoryInterface;


use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

abstract class AuthService extends PlatformService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly OtpService $otpService,
    ) {}

    

    public function signIn(SignInRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $token = auth($this->getGuard())->attempt($credentials);

        if ($token) {
            return responseSuccess(Http::CREATED, __('messages.Successfully authenticated'), new UserResource(auth($this->getGuard())->user(), true));
        }

        return responseFail(Http::UNAUTHORIZED, __('messages.wrong credentials'));
    }

    public function signOut()
    {
        auth($this->getGuard())->logout();
        return responseSuccess(Http::OK, __('messages.Successfully loggedOut'));
    }

    public function deleteAccount()
    {
        $user = auth($this->getGuard())->user();
        // dd($user);

        if ($user) {
            $user->delete();
            return responseSuccess(message: 'تم حذف الحساب بنجاح');
        }

        return responseFail(message: 'فشل في حذف الحساب');
    }
}
