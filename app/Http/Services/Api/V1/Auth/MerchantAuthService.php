<?php

namespace App\Http\Services\Api\V1\Auth;

use App\Http\Helpers\Http;
use App\Http\Resources\V1\User\UserResource;
use App\Http\Services\Api\V1\Auth\Otp\OtpService;
use App\Repository\MerchantRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class MerchantAuthService extends AuthService
{
    public function __construct(
        private readonly MerchantRepositoryInterface $merchantRepository,
        private readonly OtpService $otpService
    ) {}

    public static function platform(): string
    {
        return 'user mobile';
    }

    protected function getGuard(): string
    {
        return 'merchant-api';
    }

    protected function getRepository()
    {
        return $this->merchantRepository;
    }

    public function signUp($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $user = $this->merchantRepository->create($data);
            $this->otpService->generate($user);
            $this->merchantRepository->update($user->id, ['is_active' => true]);
            DB::commit();

            return responseSuccess(Http::CREATED, __('messages.created successfully'), new UserResource($user, true));
        } catch (Exception $e) {
            DB::rollBack();

            return responseFail(Http::BAD_REQUEST, __('messages.Something went wrong'));
        }
    }
}
