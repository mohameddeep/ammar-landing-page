<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1\Coupon;

use App\Http\Resources\V1\Package\PackageResource;
use App\Repository\CouponRepositoryInterface;
use App\Repository\PackageRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Helpers\Http;
use App\Http\Requests\Api\V1\Coupon\UpdateCouponRequest;
use App\Http\Resources\V1\Coupon\CouponResource;

use function App\Http\Helpers\paginatedJsonResponse;
use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

final class CouponService
{
    public function __construct(

        private CouponRepositoryInterface $couponRepository
    ) {}

   
     public function index()
    {
         $coupons = $this->couponRepository->paginateWithQuery(function($query)  { 
        $query->where('type', 'provider');
    }, 20); 

        return paginatedJsonResponse(
        message: 'success',
        data: ['items' => CouponResource::collection($coupons)]
    ); 
    }


    public function store($request)
    {
       
        try {
            $data = $request->validated();
            $this->couponRepository->create($data);


             return responseSuccess(Http::OK, __('messages.created successfully'));
         } catch (Exception $e) {
          

             return responseFail(message: __('messages.Something went wrong'));
         }
    }


   public function update(UpdateCouponRequest $request, $id)
{
    try {
        $data = $request->validated();
        $this->couponRepository->update($id, $data);

        return responseSuccess(message: __('messages.updated_successfully'));
    } catch (\Exception $e) {
        return responseFail(message: __('messages.something_went_wrong'));
    }
}
    public function destroy($id): JsonResponse
    {
        try {

            $this->couponRepository->delete($id);

            return responseSuccess(message: __('messages.deleted successfully'));
        } catch (Exception $e) {
            return responseFail(message: __('messages.Something went wrong'));
        }
    }
}
