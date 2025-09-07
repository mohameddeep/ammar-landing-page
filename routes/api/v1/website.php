<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Auth\Email\ChangeEmailController;
use App\Http\Controllers\Api\V1\Auth\Otp\OtpController;
use App\Http\Controllers\Api\V1\Auth\Password\PasswordController;
use App\Http\Resources\V1\User\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use function App\Http\Helpers\paginatedJsonResponse;

Route::get('/test-exception', function () {
    request()->headers->set('Accept', 'application/json');
    throw new NotFoundHttpException;
});
Route::get('test', function () {
    $users = User::paginate(10);

    return paginatedJsonResponse(
        __('messages.Data fetched successfully'),

        // must write items
        ['items' => UserResource::collection($users)],
    );
});

Route::group(['prefix' => 'auth', 'controller' => AuthController::class], function () {
    Route::group(['prefix' => 'sign'], function () {
        Route::post('in', 'signIn');
        Route::post('up', 'signUp');
        Route::post('out', 'signOut')->middleware('auth:api');
    });
    Route::get('what-is-my-platform', 'whatIsMyPlatform'); // returns 'platform: website!'
});
