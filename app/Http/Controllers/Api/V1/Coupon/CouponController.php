<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Coupon;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Coupon\StoreCouponRequest;
use App\Http\Requests\Api\V1\Coupon\UpdateCouponRequest;
use App\Http\Services\Api\V1\Coupon\CouponService;
use App\Http\Services\Api\V1\Package\PackageService;

final class CouponController extends Controller
{
    public function __construct(private CouponService $couponService) {}


    public function index()

   {
        return $this->couponService->index();
    }

    

    public function store(StoreCouponRequest $request)
    {
        return $this->couponService->store($request);
    }

  public function update(UpdateCouponRequest $request, $id)
{
    return $this->couponService->update($request, $id);
}
    public function destroy($id)
    {
        return $this->couponService->destroy($id);
    }
}
