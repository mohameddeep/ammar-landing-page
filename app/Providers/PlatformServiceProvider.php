<?php

namespace App\Providers;

use App\Http\Services\Api\V1\Auth\AuthMobileService;
use App\Http\Services\Api\V1\Auth\AuthService;
use App\Http\Services\Api\V1\Auth\AuthWebService;
use Illuminate\Support\ServiceProvider;

class PlatformServiceProvider extends ServiceProvider
{
  
    public function register(): void
    {
        // $this->initiate();

        // $this->app->singleton(AuthService::class, UserAuthService::class);
    }

    public function boot(): void
    {
        //
    }
}
