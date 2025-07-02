<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1\Subscription;

use App\Repository\CouponRepositoryInterface;
use App\Repository\PackageRepositoryInterface;
use App\Repository\SubscriptionRepositoryInterface;
use Exception;

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
            $response = $this->repository->applyCouponIfValid($this->couponRepository, $request->price, $request->coupon_code);

            return responseSuccess(200, message: 'تم الخصم بنجاح', data: [
                'discount' => (int) $response['discountPersent'],
                'price' => $request->price,
                'priceAfterDiscount' => $response['priceAfterDiscount'],

            ]);
        } catch (Exception $e) {
            return responseFail(message: $e->getMessage());
        }
    }

    public function subscribe($request)
    {

        try {
            $data = $request->validated();
            if ($this->repository->checkExistingSubscription($request->package_id)) {

                return responseFail(message: __('messages.you_already_subscribed_to_this_package'));
            }
            $package = $this->packageRepository->getById($request->package_id);

            $data['end_date'] = $this->repository->calculateSubscriptionEndDate($package);

            $this->repository->create($data);

            return responseSuccess(message: __('messages.subscribed_successfully'));
        } catch (Exception $e) {
            return responseFail(message: $e->getMessage());
        }
    }
}
