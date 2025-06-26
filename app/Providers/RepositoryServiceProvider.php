<?php

namespace App\Providers;

use App\Repository\CategoryRepositoryInterface;
use App\Repository\Eloquent\CategoryRepository;
use App\Repository\Eloquent\ManagerRepository;
use App\Repository\Eloquent\MerchantRepository;
use App\Repository\Eloquent\OtpRepository;
use App\Repository\Eloquent\PackageFeatureRepository;
use App\Repository\Eloquent\PackageRepository;
use App\Repository\Eloquent\PermissionRepository;
use App\Repository\Eloquent\Repository;
use App\Repository\Eloquent\RoleRepository;
use App\Repository\Eloquent\SettingsRepository;
use App\Repository\Eloquent\SliderRepository;
use App\Repository\Eloquent\UserAddressRepository;
use App\Repository\Eloquent\UserRepository;
use App\Repository\ManagerRepositoryInterface;
use App\Repository\MerchantRepositoryInterface;
use App\Repository\OtpRepositoryInterface;
use App\Repository\PackageFeatureRepositoryInterface;
use App\Repository\PackageRepositoryInterface;
use App\Repository\PermissionRepositoryInterface;
use App\Repository\RepositoryInterface;
use App\Repository\RoleRepositoryInterface;
use App\Repository\SettingsRepositoryInterface;
use App\Repository\SliderRepositoryInterface;
use App\Repository\UserAddressRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Http\Services\Api\V1\Auth\UserAuthService;
use App\Http\Services\Api\V1\Auth\Otp\OtpService;
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton(RepositoryInterface::class, Repository::class);
        $this->app->singleton(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(SettingsRepositoryInterface::class, SettingsRepository::class);
        $this->app->singleton(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->singleton(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->singleton(ManagerRepositoryInterface::class, ManagerRepository::class);
        $this->app->singleton(OtpRepositoryInterface::class, OtpRepository::class);
        $this->app->singleton(UserAddressRepositoryInterface::class, UserAddressRepository::class);
        $this->app->singleton(SliderRepositoryInterface::class, SliderRepository::class);
        $this->app->singleton(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->singleton(PackageRepositoryInterface::class, PackageRepository::class);
        $this->app->singleton(PackageFeatureRepositoryInterface::class, PackageFeatureRepository::class);
        $this->app->singleton(MerchantRepositoryInterface::class, MerchantRepository::class);


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
