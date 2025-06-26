<?php

namespace App\Http\Services\Api\V1\Auth\Password;

use App\Repository\MerchantRepositoryInterface;

class MerchantPasswordService extends PasswordService
{
    public function __construct(
        private MerchantRepositoryInterface $repository,
        \App\Repository\OtpRepositoryInterface $otpRepository
    ) {
        parent::__construct($otpRepository);
    }

    protected function getRepository(): MerchantRepositoryInterface
    {
        return $this->repository;
    }

    protected function getGuard(): string
    {
        return 'merchant-api';
    }
}
