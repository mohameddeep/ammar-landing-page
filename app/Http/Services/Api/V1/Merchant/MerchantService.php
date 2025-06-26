<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1\Merchant;


use App\Http\Resources\V1\merchant\MerchantResource;
use App\Repository\MerchantRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use function App\Http\Helpers\paginatedJsonResponse;
use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

final class MerchantService
{

    public function __construct(

        private MerchantRepositoryInterface $merchantRepository
    ) {}

    public function index(): JsonResponse
    {
        $merchants = $this->merchantRepository->getActiveWithPagination();


        return paginatedJsonResponse(message: __('dashboard_api.show_successfully'),  data: ['items' => MerchantResource::collection($merchants)]);

    }


    public function show($id): JsonResponse
    {

        try {
            $merchant = $this->merchantRepository->getById($id);

            return responseSuccess(message: __('dashboard_api.show_successfully'), data: new MerchantResource($merchant));

        } catch (Exception $exception) {
            return responseFail(message: $exception->getMessage());
        }
    }

}
