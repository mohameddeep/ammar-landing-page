<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1\Subscription;

use App\Repository\CouponRepositoryInterface;
use App\Repository\PackageRepositoryInterface;
use App\Repository\SubscriptionRepositoryInterface;
use Exception;

use Illuminate\Support\Facades\DB;
use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

final class SubscriptionService
{
    public function __construct(
        private readonly SubscriptionRepositoryInterface $repository,
        private readonly PackageRepositoryInterface $packageRepository,
        private readonly CouponRepositoryInterface $couponRepository,
    ) {}

    public function applyCoupon($request)
    {
        try {
            $coupon = $this->couponRepository->findByCode($request->coupon_code);
            if (!$coupon || ! $coupon->isValid()) {
                return responseFail(message: __('messages.invalid_coupon'));
            }
            $package = $this->packageRepository->getById($request->package_id);

            return responseSuccess(200, message: 'تم الخصم بنجاح', data: [
                'discount' => (int) $coupon->discount,
                'price' => $package->price,
                'priceAfterDiscount' => (int) $package->price - $coupon->discount,

            ]);
        } catch (Exception $e) {
            return responseFail(message: __('dashboard.Something went wrong!'));
        }
    }

    public function subscribe($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->except(['coupon_code']);
            if ($this->repository->checkExistingSubscription($request->package_id)) {
                return responseFail(message: __('messages.you_already_subscribed_to_this_package'));
            }
            $package = $this->packageRepository->getById($request->package_id);

            if ($request->has('coupon_code')) {
                $coupon = $this->couponRepository->findByCode($request->coupon_code);
                if (!$coupon || ! $coupon->isValid()) {
                    return responseFail(message: __('messages.invalid_coupon'));
                }
                $data['price'] = (int) $package->price - $coupon->discount;
            }else{
                $data['price'] = $package->price;
            }
            $data['end_date'] = $this->repository->calculateSubscriptionEndDate($package);
            $data['user_id'] = auth('api')->id();
            $this->repository->create($data);
            if ($coupon){
                $coupon->decrementCount();
            }
            DB::commit();
            return responseSuccess(message: __('messages.subscribed_successfully'));
        } catch (Exception $e) {
            DB::rollBack();
            return responseFail(message: $e->getMessage());
        }
    }
}
