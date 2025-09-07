<?php

namespace App\Http\Services\Api\V1\Auth\Otp;

use App\Http\Resources\V1\Otp\OtpResource;
use App\Http\Resources\V1\User\UserResource;
use App\Jobs\SendMailJob;
use App\Mail\SendOtpMail;
use App\Repository\OtpRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class OtpService
{
    public function __construct(
        private readonly OtpRepositoryInterface $otpRepository,
        private readonly UserRepositoryInterface $userRepository,
    ) {}

    public function generate($user = null)
    {
        $user = $user ?? auth('api')->user();
        $otp = $this->otpRepository->generateOtp($user);
        $this->userRepository->update($user->id, [
            'otp_verified' => 0,
        ]);
        $user->refresh();
        $email = $user->email ?? auth()->user()->email;
        // TODO :Sending OTP in email
//        SendMailJob::dispatchAfterResponse($email, new SendOtpMail($otp));

        return responseSuccess(message: __('messages.OTP_Is_Send'), data: OtpResource::make($otp));
    }

    public function verify($request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $user = auth('api')->user();
            if (!$user) {
                return responseFail(message: __('dashboard.Something went wrong!'));
            }
            if (! $this->otpRepository->check($data['otp'], $data['otp_token'])) {
                return responseFail(message: __('messages.Wrong OTP code or expired'));
            }

            auth('api')->user()?->otps()?->delete();
            auth('api')->user()?->update([
                'otp_verified' => 1,
            ]);

            DB::commit();

            return responseSuccess(message: __('messages.Your account has been verified successfully'), data: new UserResource($user, true));
        } catch (\Exception $e) {
//            return $e;
            DB::rollBack();

            return responseFail(message: __('messages.Something went wrong'));
        }
    }
}
