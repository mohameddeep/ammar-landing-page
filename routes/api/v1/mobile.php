<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\Email\ChangeEmailController;
use App\Http\Controllers\Api\V1\Auth\Otp\OtpController;
use App\Http\Controllers\Api\V1\Auth\Password\PasswordController;
use App\Http\Controllers\Api\V1\Cart\CartController;
use App\Http\Controllers\Api\V1\Category\CategoryController;
use App\Http\Controllers\Api\V1\ContactUs\ContactUsController;
use App\Http\Controllers\Api\V1\Coupon\CouponController;
use App\Http\Controllers\Api\V1\Home\HomeController;
use App\Http\Controllers\Api\V1\Order\OrderController;
use App\Http\Controllers\Api\V1\Package\PackageController;
use App\Http\Controllers\Api\V1\Product\ProductController;
use App\Http\Controllers\Api\V1\Profile\UserProfileController;
use App\Http\Controllers\Api\V1\Setting\SettingController;
use App\Http\Controllers\Api\V1\Structure\AboutUsController;
use App\Http\Controllers\Api\V1\Structure\TermsAndConditionsController;
use App\Http\Controllers\Api\V1\Subscription\SubscriptionController;
use App\Http\Controllers\Api\V1\UserAddress\UserAddressController;
use Illuminate\Support\Facades\Route;

// user routes
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
    // subscriptions
    Route::group([
        'prefix' => 'subscription',
        'controller' => SubscriptionController::class,
    ], function () {
        Route::post('/', 'subscribe');
        Route::post('/apply-coupon', 'applyCoupon');
    });


    Route::group(['prefix' => 'customer', 'middleware' => ['type:customer']], function () {});
    // user profile
    Route::group([
        'prefix' => 'user-profile',
        'controller' => UserProfileController::class,
    ], function () {
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

    Route::apiResource('coupons', CouponController::class)->except('show')->middleware('type:provider');

    Route::group([
        'prefix' => 'products',
        'controller' => ProductController::class,
    ], function () {
        Route::get('/favourites', 'favourites');
        Route::post('/add-to-favourite', 'addToFavourite');
        Route::post('/remove-from-favourite', 'removeFromFavourite');
        Route::post('/{id}/stop', 'stop');
        Route::post('/{id}/continue-selling', 'continue');
        Route::get('/{id}/related', 'related');
    });
    Route::get('products/get-for-user', [ProductController::class, 'getForUser']);
    Route::apiResource('products', ProductController::class);
    Route::post('products/{id}/update-images', [ProductController::class, 'updateImages']);
    Route::apiResource('cart', CartController::class);
    Route::delete('user/cart/empty', [CartController::class, 'empty']);

    Route::group(['prefix' => 'orders', 'controller' => OrderController::class], function () {
        Route::get('/', 'index');
        Route::post('/', 'store')->middleware('type:user');
        Route::get('/{id}', 'show');
        Route::get('/{id}/accept', 'accept');
        Route::get('/{id}/cancel', 'cancel');
        Route::post('/{id}/return', 'returnOrder');
    });
});

Route::get('/home', [HomeController::class, 'index']);
Route::post('/contact-us', ContactUsController::class);
// categories
Route::group([
    'prefix' => 'categories',
    'controller' => CategoryController::class,
], function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
});

// packages
Route::group([
    'prefix' => 'packages',
    'controller' => PackageController::class,
], function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
});

Route::get('setting', [SettingController::class, 'index']);

Route::prefix('structures')->group(function () {
    Route::get('about', AboutUsController::class);

    Route::get('terms_and_conditions', TermsAndConditionsController::class);
});
