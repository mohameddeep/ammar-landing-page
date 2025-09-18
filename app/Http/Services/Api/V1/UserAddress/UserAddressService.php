<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1\UserAddress;

use App\Http\Helpers\Http;
use App\Http\Resources\V1\UserAddress\UserAddressResource;
use App\Repository\UserAddressRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

final class UserAddressService
{
    public function __construct(

        private UserAddressRepositoryInterface $userAddressRepository
    ) {}

    public function index(): JsonResponse
    {
        $userAddresses = $this->userAddressRepository->getuserAddresses();

        return responseSuccess(message: __('dashboard_api.show_successfully'), data: UserAddressResource::collection($userAddresses));

    }

    public function store($request): JsonResponse
    {
         DB::beginTransaction();
         try {
        $data = $request->validated();

        $address = $this->userAddressRepository->create($data);
        DB::commit();

        return responseSuccess(Http::OK, __('messages.created successfully'), new UserAddressResource($address));
         } catch (Exception $e) {
             DB::rollback();

             return responseFail(message: __('messages.Something went wrong'));
         }
    }

    public function show($id): JsonResponse
    {

        try {
            $userAddress = $this->userAddressRepository->getById($id);

            return responseSuccess(message: __('dashboard_api.show_successfully'), data: new UserAddressResource($userAddress));

        } catch (Exception $exception) {
            return responseFail(message: $exception->getMessage());
        }
    }

    public function update($id, $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $this->userAddressRepository->update($id, $data);
            DB::commit();

            return responseSuccess(message: __('messages.updated successfully'));
        } catch (Exception $e) {
            DB::rollback();

            return responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function destroy($id): JsonResponse
    {
        try {

            $this->userAddressRepository->delete($id);

            return responseSuccess(message: __('messages.deleted successfully'));
        } catch (Exception $e) {
            return responseFail(message: __('messages.Something went wrong'));
        }
    }

    public function changeAddressStatus($id, $request): JsonResponse
    {

        DB::beginTransaction();
        try {

            $userAddress = $this->userAddressRepository->getById($id);

            $this->userAddressRepository->updateUserAddressStatus();
            $this->userAddressRepository->update($userAddress->id, ['is_default' => $request->is_default]);

            DB::commit();

            return responseSuccess(Http::OK, __('dashboard_api.updated_successfully'));
        } catch (Exception $e) {
            DB::rollback();

            return responseFail(message: __('messages.Something went wrong'));
        }

    }
}
