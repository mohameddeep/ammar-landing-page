<?php

namespace App\Repository;

interface CouponRepositoryInterface extends RepositoryInterface
{
    public function findByCode(string $code);

    public function applyDiscount($packagePrice, $coupon);

    public function decrementUsage($coupon);
}
