<?php

use App\Http\Controllers\Dashboard\AdminProfile\AdminProfileController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\Categories\CategoryController;
use App\Http\Controllers\Dashboard\Commissions\CommissionController;
use App\Http\Controllers\Dashboard\Complaint\ComplaintController;
use App\Http\Controllers\Dashboard\Contact\ContactController;
use App\Http\Controllers\Dashboard\Coupon\CouponController;
use App\Http\Controllers\Dashboard\Home\HomeController;
use App\Http\Controllers\Dashboard\Mangers\MangerController;
use App\Http\Controllers\Dashboard\Order\OrderController;
use App\Http\Controllers\Dashboard\OrderReturn\OrderReturnController;
use App\Http\Controllers\Dashboard\Packages\PackageController;
use App\Http\Controllers\Dashboard\Packages\PackageFeatureController;
use App\Http\Controllers\Dashboard\Product\ProductController;
use App\Http\Controllers\Dashboard\Provider\ProviderController;
use App\Http\Controllers\Dashboard\Roles\RoleController;
use App\Http\Controllers\Dashboard\Setting\SettingController as SettingSettingController;
use App\Http\Controllers\Dashboard\Settings\SettingController;
use App\Http\Controllers\Dashboard\Slider\SliderController;
use App\Http\Controllers\Dashboard\Structure\AboutUsController;
use App\Http\Controllers\Dashboard\Structure\TermsAndConditionsController;
use App\Http\Controllers\Dashboard\User\UserController;
use App\Http\Controllers\Dashboard\Subscription\SubscriptionController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use NunoMaduro\Collision\Provider;

// Route::get('/calendar/calendar/calendar', function () {
//     return view('dashboard.site.calendar');
// })->name('calendar.index');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function (): void {
        Route::get('login', [AuthController::class, '_login'])->name('_login');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('/', [HomeController::class, 'index'])->name('/');

        // users route
        Route::resource('users', UserController::class);
                Route::get('users/products/{id}', [UserController::class, 'products'])->name('users.products');
             Route::get('users/transactions/{id}', [ProviderController::class, 'transactions'])->name('users.transactions');
        Route::post('users/transactions/{id}', [ProviderController::class, 'addTransaction'])->name('users.addTransaction');
        Route::delete('users/transactions/{transactionId}', [ProviderController::class, 'deleteTransaction'])->name('users.deleteTransaction');


        //providers route
        Route::resource('providers', ProviderController::class);
        Route::get('providers/products/{id}', [ProviderController::class, 'products'])->name('providers.products');
        Route::get('providers/transactions/{id}', [ProviderController::class, 'transactions'])->name('providers.transactions');
        Route::post('providers/transactions/{id}', [ProviderController::class, 'addTransaction'])->name('providers.addTransaction');
        Route::delete('providers/transactions/{transactionId}', [ProviderController::class, 'deleteTransaction'])->name('providers.deleteTransaction');


        Route::resource('admin-profile', AdminProfileController::class)->only('edit', 'update');
        Route::post('update-password', [AdminProfileController::class, 'updatePassword'])->name('update-password');


        Route::get('edit-setting', [SettingSettingController::class, 'edit'])->name('dashboard.setting.edit');
        Route::put('update-setting', [SettingSettingController::class, 'update'])->name('dashboard.setting.update');
        // roles
        Route::resource('roles', RoleController::class);

        Route::get('role/{id}/managers', [RoleController::class, 'mangers'])->name('roles.mangers');
        Route::controller(MangerController::class)->prefix('managers')->name('managers.')
            ->group(function () {
                Route::get('/{role}/create', 'create')->name('create');
                Route::post('/', 'store')->name('store');
                Route::post('/toggle/{id}', 'toggle')->name('toggle');
                Route::get('/{manager}/edit', 'edit')->name('edit');
                Route::put('/{manager}', 'update')->name('update');
                Route::delete('/{manager}', action: 'destroy')->name('destroy');
            });


            //orders
        Route::controller(OrderController::class)->prefix('orders')->name('orders.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/{id}/show', 'show')->name('show');
                Route::delete('/{id}', action: 'destroy')->name('destroy');
            });

        // Commissions Routes
        Route::resource('commissions', CommissionController::class)->except('show', 'create', 'store', 'destroy');
        Route::post('/commissions/toggle/{id}', [CommissionController::class, 'toggle'])->name('commissions.toggle');

        // package Routes
        Route::resource('packages', PackageController::class);
        Route::post('/packages/toggle/{id}', [PackageController::class, 'toggle'])->name('packages.toggle');
        Route::post('/packages/toggle_hidden/{id}', [PackageController::class, 'toggleHidden'])->name('packages.toggle_hidden');
        Route::post('/packages/feature/toggle/{id}', [PackageFeatureController::class, 'toggle'])->name('packages.toggle.details');
        Route::get('/packages/feature/show/{id}', [PackageFeatureController::class, 'toggle'])->name('packages.show.details');

        // categories Routes
        Route::resource('categories', CategoryController::class);
        Route::post('categories/toggle/{id}', [CategoryController::class, 'toggle'])->name('categories.toggle');
        Route::resource('dashobard/coupons', CouponController::class)->names('dashobard.coupons')->except('show');


        //subscriptions
        Route::controller(SubscriptionController::class)->prefix('subscriptions')->name('subscriptions.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/toggle/{id}', 'toggle')->name('toggle');
                Route::delete('/{id}', action: 'destroy')->name('destroy');
            });


        //products
        Route::controller(ProductController::class)->prefix('dashboard/products')->name('dashboard.products.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/toggle/{id}', 'toggle')->name('toggle');
                Route::delete('/{id}',  'destroy')->name('destroy');
                Route::post('/change-status/{id}',  'changeStatus')->name('changeStatus');
                Route::get('/details/{id}', 'show')->name('details');

            });

            // routes/web.php أو routes/api.php (لو API)

        Route::group(['prefix' => 'structures'], function () {
            Route::resource('about', AboutUsController::class)->only('store', 'index');
            Route::resource('terms_and_conditions', TermsAndConditionsController::class)->only('store', 'index');

        });

        //contacts
        Route::resource('dashboard/contacts', ContactController::class)->only('destroy', 'index');
        //complaints
        Route::resource('dashboard/complaints', ComplaintController::class)->only('destroy', 'index');


        // start sliders
        Route::resource('sliders', controller: SliderController::class)->except(['show']);
        Route::post('sliders/toggle/{id}', [SliderController::class, 'toggle'])->name('sliders.toggle');

        Route::resource('order-returns', OrderReturnController::class);
        Route::group(['prefix' => 'order-returns', 'controller' => OrderReturnController::class], function () {
            Route::get('/{id}/accept', 'accept')->name('order-returns.accept');
            Route::get('/{id}/reject', 'reject')->name('order-returns.reject');
        });
    });
});
