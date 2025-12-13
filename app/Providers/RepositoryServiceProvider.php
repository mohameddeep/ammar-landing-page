<?php

namespace App\Providers;

use App\Repository\AboutUsRepositoryInterface;
use App\Repository\AdminProfileRepositoryInterface;
use App\Repository\ContactUsRepositoryInterface;
use App\Repository\Eloquent\AboutUsRepository;
use App\Repository\Eloquent\ContactUsRepository;
use App\Repository\Eloquent\ManagerRepository;
use App\Repository\Eloquent\PermissionRepository;
use App\Repository\Eloquent\Repository;
use App\Repository\Eloquent\RoleRepository;
use App\Repository\Eloquent\SliderRepository;
use App\Repository\Eloquent\StructureRepository;
use App\Repository\Eloquent\AminProfileRepository;
use App\Repository\ManagerRepositoryInterface;
use App\Repository\PermissionRepositoryInterface;
use App\Repository\RepositoryInterface;
use App\Repository\RoleRepositoryInterface;
use App\Repository\SliderRepositoryInterface;
use App\Repository\StructureRepositoryInterface;
use App\Repository\ServiceRepositoryInterface;
use App\Repository\Eloquent\ServiceRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton(RepositoryInterface::class, Repository::class);
        $this->app->singleton(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->singleton(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->singleton(ManagerRepositoryInterface::class, ManagerRepository::class);
        $this->app->singleton(SliderRepositoryInterface::class, SliderRepository::class);
        $this->app->singleton(ContactUsRepositoryInterface::class, ContactUsRepository::class);
        $this->app->singleton(StructureRepositoryInterface::class, StructureRepository::class);
       $this->app->singleton(AdminProfileRepositoryInterface::class, AminProfileRepository::class);
        $this->app->singleton(AboutUsRepositoryInterface::class, AboutUsRepository::class);
        $this->app->singleton(ServiceRepositoryInterface::class, ServiceRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
