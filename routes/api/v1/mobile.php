<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\Email\ChangeEmailController;
use App\Http\Controllers\Api\V1\Auth\Otp\OtpController;
use App\Http\Controllers\Api\V1\Auth\Password\PasswordController;
use App\Http\Controllers\Api\V1\Profile\UserProfileController;
use App\Http\Controllers\Api\V1\Category\CategoryController;
use App\Http\Controllers\Api\V1\ContactUs\ContactUsController;
use App\Http\Controllers\Api\V1\Home\HomeController;
use App\Http\Controllers\Api\V1\Merchant\MerchantController;
use App\Http\Controllers\Api\V1\Package\PackageController;
use App\Http\Controllers\Api\V1\Profile\MerchantProfileController;
use App\Http\Controllers\Api\V1\Profile\UserProfileController;
use App\Http\Controllers\Api\V1\Subscription\SubscriptionController;
use App\Http\Controllers\Api\V1\UserAddress\UserAddressController;
use Illuminate\Support\Facades\Route;



//user routes  
Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {
    Route::group(['prefix' => 'sign'], function () {
        Route::post('in', 'signIn');
        Route::post('up', 'signUp');
        Route::post('out', 'signOut');
    });
    Route::delete('delete-account', 'deleteAccount')->middleware('auth:api');
});

Route::group(['prefix' => 'otp', 'middleware' => ['auth:api']], function () {
    Route::post('/verify', [OtpController::class, 'verify']);
    Route::get('/', [OtpController::class, 'send']);
});
Route::group(['prefix' => 'email', 'middleware' => ['auth:api']], function () {
    Route::post('/change', [ChangeEmailController::class, 'sendOtp']);
    Route::post('/otp/verify', [ChangeEmailController::class, 'change']);
});

Route::group(['prefix' => 'password'], function () {
    Route::post('/forgot', [PasswordController::class, 'forgot']);
    Route::post('/verify-otp', [PasswordController::class, 'verifyOtp']);
    Route::post('/reset', [PasswordController::class, 'reset']);
    Route::post('/update', [PasswordController::class, 'updatePassword']);
});

Route::group(['middleware' => ['auth:api']], function () {

    // user profile
    Route::group(['prefix' => 'user-profile',
        'controller' => UserProfileController::class], function () {
            Route::get('/', 'profile');
            Route::put('/update', 'updateProfile');
        });

    // user addresses

    Route::group([
        'prefix' => 'user-address',
        'controller' => UserAddressController::class,
    ], function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
        Route::put('/change-status/{id}', 'changeAddressStatus');
    });

    Route::group([
        'prefix' => 'merchants',
        'controller' => MerchantController::class,
    ], function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
    });


    //packages
    Route::group([
        'prefix' => 'packages',
        'controller' => PackageController::class,
    ], function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
    });

            //subscriptions
        Route::group([
            'prefix' => 'subscription',
            'controller' => SubscriptionController::class
        ], function () {
            Route::post('/', 'subscribe');
            Route::post('/apply-coupon', 'applyCoupon');
        });

        //categories
    Route::group(['prefix' => 'categories',
        'controller' => CategoryController::class], function () {
        Route::get('/',  'index');
        Route::get('/{id}',  'show');
        });

});





    Route::get("/home",[HomeController::class,'index']);
    Route::post('/contact-us', ContactUsController::class);
