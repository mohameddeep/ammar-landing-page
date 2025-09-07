<?php

namespace App\Repository\Eloquent;

use App\Models\Coupon;
use App\Repository\CouponRepositoryInterface;

class CouponRepository extends Repository implements CouponRepositoryInterface
{
    public function __construct(Coupon $model)
    {
        parent::__construct($model);
    }

    public function findByCode(string $code)
    {
        return $this->model->where('code', $code)->first();
    }

    public function applyDiscount($packagePrice, $coupon): float
    {
        $discountAmount = $packagePrice * ($coupon->discount / 100);

        return $packagePrice - $discountAmount;
    }

    public function decrementUsage($coupon): void
    {
        $coupon->decrement('usage_count');
    }
}
