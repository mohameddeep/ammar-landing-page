<?php

namespace App\Http\Services\Api\V1\Profile;

use App\Http\Helpers\Http;
use App\Http\Resources\V1\merchant\MerchantResource;
use App\Http\Traits\FileTrait;
use App\Repository\OtpRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class MerchantProfileService
{
    use FileTrait;
    public function __construct(
        private readonly OtpRepositoryInterface $otpRepository,
    ) {}

 
   final public function profile()
    {

        return responseSuccess( data: new MerchantResource(auth('merchant-api')->user()));
    }

    final public function updateProfile($request)
    {

        DB::beginTransaction();
        try {
            $data = $request->validated();
             if ($request->hasFile('image')) {
                $data['image'] = $this->image($request->file('image'), 'merchants/images');
            }
            $user = auth('merchant-api')->user();
            $user->update(attributes: $data);
            DB::commit();

            return responseSuccess(Http::CREATED, __('messages.updated successfully'), new MerchantResource($user));
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage(), $e->getFile());

            return responseFail(Http::BAD_REQUEST, __('messages.Something went wrong'));
        }

    }
}
