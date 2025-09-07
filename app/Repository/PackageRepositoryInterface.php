<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Coupon;

interface PackageRepositoryInterface extends RepositoryInterface
{
    public function getPackagesByUserType();
}
