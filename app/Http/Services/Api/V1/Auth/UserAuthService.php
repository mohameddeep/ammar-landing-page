<?php

namespace App\Http\Services\Api\V1\Auth;

use App\Http\Helpers\Http;
use App\Http\Services\Api\V1\Auth\Otp\OtpService;
use App\Repository\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Api\V1\Auth\SignUpRequest;
use App\Http\Resources\V1\User\UserResource;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class UserAuthService extends AuthService
{

 public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly OtpService $otpService    ) {}
    public static function platform(): string
    {
        return 'user mobile';
    }

     protected function getGuard(): string {
        return 'api'; 
    }

    protected function getRepository() {
        return $this->userRepository;
    }

    public function signUp( $request)
    {
        // DB::beginTransaction();
        // try {
            $data = $request->validated();
            $user = $this->userRepository->create($data);
            $this->otpService->generate($user);
            $this->userRepository->update($user->id, ['is_active' => true]);
            DB::commit();

            return responseSuccess(Http::CREATED, __('messages.created successfully'),  new UserResource($user, true));
        // } catch (Exception $e) {
        //     DB::rollBack();
        //     return responseFail(Http::BAD_REQUEST, __('messages.Something went wrong'));
        // }
    }
}
