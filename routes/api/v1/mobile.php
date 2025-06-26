<?php

use App\Http\Controllers\Api\V1\Auth\UserAuthController;
use App\Http\Controllers\Api\V1\Auth\Email\ChangeEmailController;
use App\Http\Controllers\Api\V1\Auth\MerchantAuthController;
use App\Http\Controllers\Api\V1\Auth\Otp\OtpController;
use App\Http\Controllers\Api\V1\Auth\Password\MerchantPasswordController;
use App\Http\Controllers\Api\V1\Auth\Password\UserPasswordController;
use App\Http\Controllers\Api\V1\Profile\MerchantProfileController;
use App\Http\Controllers\Api\V1\Profile\UserProfileController;
use App\Http\Controllers\Api\V1\Category\CategoryController;
use App\Http\Controllers\Api\V1\Home\HomeController;
use App\Http\Controllers\Api\V1\Merchant\MerchantController;
use App\Http\Controllers\Api\V1\Package\PackageController;
use App\Http\Controllers\Api\V1\UserAddress\UserAddressController;
use Illuminate\Support\Facades\Route;



//user routes  
Route::group(['prefix' => 'auth', 'controller' => UserAuthController::class], function () {
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
    Route::post('/forgot', [UserPasswordController::class, 'forgot']);
    Route::post('/verify-otp', [UserPasswordController::class, 'verifyOtp']);
    Route::post('/reset', [UserPasswordController::class, 'reset']);
    Route::post('/update', [UserPasswordController::class, 'updatePassword']);
});

Route::group([ 'middleware' => ['auth:api']], function () {


    // user profile
   Route::group(['prefix' => 'user-profile',
   'controller' => UserProfileController::class], function () {
    Route::get('/',  'profile');
    Route::put('/update',  'updateProfile');
    });


    // user addresses

    Route::group([
        'prefix' => 'user-address',
        'controller' => UserAddressController::class
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
        'controller' => MerchantController::class
    ], function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
    });

});






    // merchant routes
    Route::group(['prefix' => 'auth', 'controller' => MerchantAuthController::class], function () {
        Route::group(['prefix' => 'merchant/sign'], function () {
            Route::post('in', 'signIn');
            Route::post('up', 'signUp');
            Route::post('out', 'signOut');
        });
        Route::delete('delete-account/merchant', 'deleteAccount')->middleware('auth:merchant-api');
    });

    Route::group(['prefix' => 'merchant/otp', 'middleware' => ['auth:merchant-api']], function () {
        Route::post('/verify', [OtpController::class, 'verify']);
        Route::get('/', [OtpController::class, 'send']);
    });
    Route::group(['prefix' => 'merchant/email', 'middleware' => ['auth:merchant-api']], function () {
        Route::post('/change', [ChangeEmailController::class, 'sendOtp']);
        Route::post('/otp/verify', [ChangeEmailController::class, 'change']);
    });



    Route::group(['prefix' => 'merchant/password'], function () {
        Route::post('/forgot', [MerchantPasswordController::class, 'forgot']);
        Route::post('/verify-otp', [MerchantPasswordController::class, 'verifyOtp']);
        Route::post('/reset', [MerchantPasswordController::class, 'reset']);
        Route::post('/update', [MerchantPasswordController::class, 'updatePassword']);
    });



    Route::group([ 'middleware' => ['auth:merchant-api']], function () {


        // user profile
    Route::group(['prefix' => 'merchant-profile',
    'controller' => MerchantProfileController::class], function () {
        Route::get('/',  'profile');
        Route::put('/update',  'updateProfile');
        });

    


//packages
    Route::group([
        'prefix' => 'packages',
        'controller' => PackageController::class
    ], function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
    });
});


//categories
Route::group(['prefix' => 'categories',
    'controller' => CategoryController::class], function () {
    Route::get('/',  'index');
    Route::get('/{id}',  'show');
    });


    Route::get("/home",[HomeController::class,'index']);