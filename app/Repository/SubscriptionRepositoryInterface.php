<?php

declare(strict_types=1);

namespace App\Repository;

interface SubscriptionRepositoryInterface extends RepositoryInterface
{
    public function applyCouponIfValid($couponRepository, $packagePrice, $couponCode);

    public function checkExistingSubscription($id);

    public function calculateSubscriptionEndDate($package);
}
