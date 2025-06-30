<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\Subscription;
use App\Repository\SubscriptionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

final class SubscriptionRepository extends Repository implements  SubscriptionRepositoryInterface
{
    protected Model $model;

    public function __construct(Subscription $model)
    {
        parent::__construct($model);
    }


     public function checkExistingSubscription($id)
    {
        return $this->model->where("merchant_id", auth("merchant-api")->user()->id)
            ->where("package_id", "=", $id)
            ->where("is_active", "=", 1)->exists();
    }

    public function calculateSubscriptionEndDate($package)
    {

        if (empty($package->duration)) {
            return null;
        }
        $numOfMonths = (int)$package->duration;
        return  Carbon::now()->addMonths($numOfMonths);
    }

    public function applyCouponIfValid($couponRepository, $packagePrice, $couponCode)
    {
        $coupon = $couponRepository->findByCode($couponCode);

        if (!$coupon || !$coupon->isValid()) {
            throw new \Exception(__('messages.invalid_coupon'));
        }

        $discountedPrice = $couponRepository->applyDiscount($packagePrice, $coupon);
        $couponRepository->decrementUsage($coupon);

        return [
            "discountPersent" =>$coupon->discount,
            "priceAfterDiscount" =>$discountedPrice,
        ];
    }


}
