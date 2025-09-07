<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\UserAddress;
use App\Repository\UserAddressRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

final class UserAddressRepository extends Repository implements UserAddressRepositoryInterface
{
    protected Model $model;

    public function __construct(UserAddress $model)
    {
        parent::__construct($model);
    }

    public function updateUserAddressStatus()
    {
        auth('api')->user()->addresses()->update(['is_default' => false]);
    }

    public function getuserAddresses()
    {
        return auth('api')->user()->addresses;
    }
}
