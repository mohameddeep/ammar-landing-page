<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\Merchant\SignUpRequest;
use App\Http\Requests\Api\V1\Auth\SignInRequest;
use App\Http\Services\Api\V1\Auth\MerchantAuthService;


class MerchantAuthController extends Controller
{
    public function __construct(
        private readonly MerchantAuthService $auth,
    )
    {
    }

    public function signUp(SignUpRequest $request) {
        return $this->auth->signUp($request);
    }

    public function signIn(SignInRequest $request) {
        return $this->auth->signIn($request);
    }

    public function signOut()
    {
        return $this->auth->signOut();
    }

    public function deleteAccount()
    {
        return $this->auth->deleteAccount();
    }

    // public function whatIsMyPlatform()
    // {
    //     return $this->auth->whatIsMyPlatform();
    // }
}
