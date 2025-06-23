<?php

namespace App\Http\Services\Api\V1\Auth\Profile;

use App\Http\Helpers\Http;
use App\Http\Resources\V1\User\UserProfileResource;
use App\Http\Resources\V1\User\UserResource;
use App\Repository\OtpRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class ProfileService
{
    public function __construct(
        private readonly OtpRepositoryInterface $otpRepository,
    ) {}

 
   final public function userProfile()
    {

        return responseSuccess( data: new UserProfileResource(auth('api')->user()));

    }

    final public function updateUserProfile($request)
    {

        DB::beginTransaction();
        try {
            $data = $request->validated();
            $user = auth('api')->user();
            $user->update($data);
            DB::commit();

            return responseSuccess(Http::CREATED, __('messages.updated successfully'), new UserProfileResource($user));
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage(), $e->getFile());

            return responseFail(Http::BAD_REQUEST, __('messages.Something went wrong'));
        }

    }
}
