<?php

namespace App\Http\Controllers\Api\V1\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Coupon\CouponRequest;
use App\Http\Requests\Api\V1\Subscription\SubscriptionRequest;
use App\Http\Services\Api\V1\Subscription\SubscriptionService;

class SubscriptionController extends Controller
{
    public function __construct(
        private readonly SubscriptionService $service,
    )
    {
    }
    public function subscribe(SubscriptionRequest $request){
        return $this->service->subscribe($request);
    }
    public function applyCoupon(CouponRequest $request){
        return $this->service->applyCoupon($request);
    }
}
