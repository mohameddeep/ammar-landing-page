<?php

namespace App\Repository\Eloquent;

use App\Models\Otp;
use App\Repository\OtpRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Str;

class OtpRepository extends Repository implements OtpRepositoryInterface
{
    public function __construct(Otp $model)
    {
        parent::__construct($model);
    }

    private function getCurrentUser()
    {
        return auth('api')->user();
    }

    public function generateOtp($user = null)
    {
        if (! $user) {
            $user = $this->getCurrentUser();
        }
        $user->otps()?->delete();

        return $user->otp()?->create([
            'otp' => 1111,
           // 'otp' => rand(1234, 9999),
            'expire_at' => Carbon::now()->addMinutes(5),
            'token' => Str::random(30),
            'email' => $user?->email ?? null,
        ]);
    }

    public function generateOtpForEmail($email, $user = null)
    {
        if (! $user) {
            $user = $this->getCurrentUser();
        }
        $user->otps()?->delete();

        return $user->otp()?->create([
            'email' => $email,
             'otp' => 1111,
            // 'otp' => rand(1234, 9999),
            'expire_at' => Carbon::now()->addMinutes(5),
            'token' => Str::random(30),
        ]);
    }

    public function check($otp, $token, $user = null)
    {
        if (! $user) {
            $user = $this->getCurrentUser();
        }

        return $this->model::query()
            ->where('user_id', $user->id)
            ->where('otp', $otp)
            ->where('token', $token)
            ->where('expire_at', '>', Carbon::now())
            ->exists();
    }

    public function checkForEmail($otp, $token, $email)
    {

        $user = $this->getCurrentUser();

        return $this->model::query()
            ->where('user_id', $user->id)
            ->where('otp', $otp)
            ->where('email', $email)
            ->where('token', $token)
            ->where('expire_at', '>', Carbon::now())
            ->exists();
    }
}
