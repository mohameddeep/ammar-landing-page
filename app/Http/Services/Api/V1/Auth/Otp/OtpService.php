<?php

namespace App\Http\Services\Api\V1\Auth\Otp;

use App\Http\Resources\V1\Otp\OtpResource;
use App\Jobs\SendMailJob;
use App\Mail\SendOtpMail;
use App\Repository\OtpRepositoryInterface;
use Illuminate\Support\Facades\DB;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class OtpService
{
    public function __construct(
        private readonly OtpRepositoryInterface $otpRepository,
    ) {}

    public function generate($user = null)
    {
        $otp = $this->otpRepository->generateOtp($user);
        auth()->user()?->update([
            'otp_verified' => false,
        ]);
        $email = $user->email ?? auth()->user()->email;
        // TODO :Sending OTP in email
        SendMailJob::dispatchAfterResponse($email, new SendOtpMail($otp));

        return responseSuccess(message: __('messages.OTP_Is_Send'), data: OtpResource::make($otp));
    }

    public function verify($request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            if (! $this->otpRepository->check($data['otp'], $data['otp_token'])) {
                return responseFail(message: __('messages.Wrong OTP code or expired'));
            }

            auth()->user()?->otps()?->delete();
            auth()->user()?->update([
                'otp_verified' => true,
            ]);
            DB::commit();

            return responseSuccess(message: __('messages.Your account has been verified successfully'));
        } catch (\Exception $e) {
            return $e;
            DB::rollBack();

            return responseFail(message: __('messages.Something went wrong'));
        }
    }
}
