<?php

use App\Http\Controllers\Website\LandingPage\LandingPageController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {


        Route::get('landing-page', [LandingPageController::class, 'index']);
        Route::get('services', [LandingPageController::class, 'services']);
        Route::get('services/{id}', [LandingPageController::class, 'serviceDetails']);
        // Simple standalone pages for About, Contact, Privacy, and Terms
        Route::view('about-us', 'website.about');
        Route::view('contact-us', 'website.contact');
        Route::view('privacy-policy', 'website.privacy');
        Route::view('terms-and-conditions', 'website.terms');
});


