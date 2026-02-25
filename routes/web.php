<?php

use App\Http\Controllers\Website\LandingPage\LandingPageController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;




Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
], function () {


        Route::get('/', [LandingPageController::class, 'index'])->name('website.landing-page');
        Route::get('services', [\App\Http\Controllers\Website\Service\ServiceController::class, 'index'])->name('website.services.index');
        Route::get('services/{id}', [\App\Http\Controllers\Website\Service\ServiceController::class, 'show'])->name('website.service.show');
        
        // Contact form submission
        Route::post('contact', [\App\Http\Controllers\Website\Contact\ContactController::class, 'store'])->name('website.contact.store');
        
        // Contact page
        Route::get('contact-us', [\App\Http\Controllers\Website\Contact\ContactController::class, 'index'])->name('website.contact.index');
        
        // Terms and Conditions page
        Route::get('terms-and-conditions', [\App\Http\Controllers\Website\Terms\TermsController::class, 'index'])->name('website.terms.index');
        
        // Privacy Policy page
        Route::get('privacy-policy', [\App\Http\Controllers\Website\Privacy\PrivacyController::class, 'index'])->name('website.privacy.index');
        
        // About page
        Route::get('about-us', [\App\Http\Controllers\Website\About\AboutController::class, 'index'])->name('website.about.index');
});


