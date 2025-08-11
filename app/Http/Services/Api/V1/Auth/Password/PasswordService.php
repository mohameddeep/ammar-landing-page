<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1\Auth\Password;

use App\Http\Resources\V1\Otp\OtpResource;
use App\Jobs\SendMailJob;
use App\Mail\SendOtpMail;
use App\Repository\OtpRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

final class PasswordService
{
    public function __construct(private UserRepositoryInterface $repository, private OtpRepositoryInterface $otpRepository) {}

     public function forgot($request)
    {
        $user = $this->repository->get('email', $request->email)?->first();
        $user->update(['otp_verified' => false]);
        $otp = $this->otpRepository->generateOtp($user);

        SendMailJob::dispatchAfterResponse($user->email, new SendOtpMail($otp));

        return responseSuccess(message: __('messages.OTP code has been sent'), data: new OtpResource($otp));
    }

    public function verifyOtp($request)
    {
        try {
            DB::beginTransaction();
            $user = $this->repository->get('email', $request->email)?->first();

            if (! $this->otpRepository->check($request->otp, $request->otp_token, $user)) {
                return responseFail(message: __('messages.Wrong OTP code or expired'));
            }

            $user->otp()?->delete();
            $user->update(['otp_verified' => true]);

            $resetToken = Str::random(60);
            Cache::put('reset_token_'.$request->email, $resetToken, now()->addMinutes(10));
            DB::commit();

            return responseSuccess(data: ['reset_token' => $resetToken]);
        } catch (\Exception $e) {
            DB::rollBack();

            return responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function reset($request)
    {
        try {
            DB::beginTransaction();
            $cachedToken = Cache::get('reset_token_'.$request->email);

            if (! $cachedToken || $cachedToken != $request->reset_token) {
                return responseFail(message: __('messages.Invalid or expired reset token.'));
            }

            Cache::forget('reset_token_' . $request->email);
            $user = $this->repository->get('email', $request->email)?->first();

            $this->repository->update($user->id, ['password' => $request->password]);
            DB::commit();

            return responseSuccess(message: __('messages.Password reset successfully.'));
        } catch (\Exception $e) {
            DB::rollBack();

            return responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function updatePassword($request)
    {
        $user = auth("api")->user();

        if (Hash::check($request->new_password, $user->password)) {
            return responseFail(message: __('messages.The new password must be different from the current password.'));
        }

        $updated = $this->repository->update($user->id, ['password' => $request->new_password]);

        return $updated
            ? responseSuccess(message: __('messages.updated successfully'))
            : responseFail(message: __('messages.Something went wrong'));
    }
}
