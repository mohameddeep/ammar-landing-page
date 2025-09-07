<?php

declare(strict_types=1);

namespace App\Repository;

interface UserAddressRepositoryInterface extends RepositoryInterface
{
    public function getuserAddresses();

    public function updateUserAddressStatus();
}
