<?php

use App\Http\Controllers\Website\LandingPage\LandingPageController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {


        Route::get('landing-page', [LandingPageController::class, 'index']);


});


// Route::get('/site', function () {
//     return view('dashboard.site.index');
// });

// Route::get('/login', function () {
//     return view('dashboard.site.auth.login');
// });
