<?php

namespace App\Http\Services\Api\V1\Auth\Password;

use App\Repository\OtpRepositoryInterface;
use App\Repository\UserRepositoryInterface;

class UserPasswordService extends PasswordService
{
    public function __construct(
        private UserRepositoryInterface $repository,
        OtpRepositoryInterface $otpRepository
    ) {
        parent::__construct($otpRepository);
    }

    protected function getRepository(): UserRepositoryInterface
    {
        return $this->repository;
    }

    protected function getGuard(): string
    {
        return 'api';
    }
}
