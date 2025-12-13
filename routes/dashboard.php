<?php

use App\Http\Controllers\Dashboard\AboutUs\AboutUsChildrenController;
use App\Http\Controllers\Dashboard\AboutUs\AboutUsController;
use App\Http\Controllers\Dashboard\AdminProfile\AdminProfileController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\Contact\ContactController;
use App\Http\Controllers\Dashboard\Home\HomeController;
use App\Http\Controllers\Dashboard\Setting\SettingController as SettingSettingController;
use App\Http\Controllers\Dashboard\Slider\SliderController;
use App\Http\Controllers\Dashboard\Service\ServiceController;
use App\Http\Controllers\Dashboard\Structure\AboutUsController as StructureAboutUsController;
use App\Http\Controllers\Dashboard\Structure\LandingPageFooterController;
use App\Http\Controllers\Dashboard\Structure\TermsAndConditionsController;
use App\Http\Controllers\Dashboard\Structure\ServiceStructureController;
use App\Http\Controllers\Dashboard\Structure\PolicyController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Route::get('/calendar/calendar/calendar', function () {
//     return view('dashboard.site.calendar');
// })->name('calendar.index');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::group(['prefix' => 'auth', 'as' => 'auth.'], function (): void {
            Route::get('login', [AuthController::class, '_login'])->name('_login');
            Route::post('login', [AuthController::class, 'login'])->name('login');
            Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        });

        Route::group(['middleware' => 'auth'], function () {
            Route::get('/', [HomeController::class, 'index'])->name('/');



            Route::resource('admin-profile', AdminProfileController::class)->only('edit', 'update');
            Route::post('update-password', [AdminProfileController::class, 'updatePassword'])->name('update-password');





            //contacts
            Route::resource('dashboard/contacts', ContactController::class)->only('destroy', 'index');

            // start sliders
            Route::resource('sliders', controller: SliderController::class)->except(['show']);
            Route::post('sliders/toggle/{id}', [SliderController::class, 'toggle'])->name('sliders.toggle');
            // start sliders
            Route::resource('abouts', controller: AboutUsController::class)->except(['show']);
            Route::post('abouts/toggle/{id}', [AboutUsController::class, 'toggle'])->name('abouts.toggle');

            // Services
            Route::resource('services', controller: ServiceController::class)->except(['show']);
            Route::post('services/toggle/{id}', [ServiceController::class, 'toggle'])->name('services.toggle');

            // About Us Children
            Route::controller(AboutUsChildrenController::class)->group(function () {
                 Route::get('abouts/{id}/children', 'index')->name('abouts.children.index');
                 Route::get('abouts/{id}/children/create', 'create')->name('abouts.children.create');
                 Route::post('abouts/{id}/children', 'store')->name('abouts.children.store');
                 Route::get('abouts-children/{id}/edit', 'edit')->name('abouts.children.edit');
                 Route::put('abouts-children/{id}', 'update')->name('abouts.children.update');
            });


              Route::group(['prefix' => 'structures'], function () {
            Route::resource('about', StructureAboutUsController::class)->only('store', 'index');
            Route::resource('terms_and_conditions', TermsAndConditionsController::class)->only('store', 'index');
            Route::resource('footer', LandingPageFooterController::class)->only('store', 'index');
            Route::resource('service_structure', ServiceStructureController::class)->only('store', 'index');
            Route::resource('policy', PolicyController::class)->only('store', 'index');
        });
        });
    });
});
