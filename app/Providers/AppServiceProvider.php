<?php

namespace App\Providers;

use App\Exceptions\Handler;
use Carbon\CarbonImmutable;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        app()->singleton(
            abstract: ExceptionHandler::class,
            concrete: Handler::class
        );




        
        DB::prohibitDestructiveCommands(app()->isProduction());
        Model::shouldBeStrict(! app()->isProduction());
        //        Model::unguard();

        Date::use(CarbonImmutable::class);

        // Relation::enforceMorphMap([
        //     'manager' => \App\Models\Manager::class,
        //     // 'user' => User::class,
        // ]);
        Paginator::useBootstrapFive();

        Blade::directive('image', function ($path) {
            return "<?php echo asset('storage/' . $path); ?>";
        });

    }
}
