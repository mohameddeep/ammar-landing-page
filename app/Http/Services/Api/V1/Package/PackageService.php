<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1\Package;

use App\Http\Resources\V1\Package\PackageResource;
use App\Repository\PackageRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use function App\Http\Helpers\paginatedJsonResponse;
use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

final class PackageService
{
   

    public function __construct(

        private PackageRepositoryInterface $packageRepository
    ) {}

    public function index(): JsonResponse
    {
        $categories = $this->packageRepository->getPackagesByUserType();

        return paginatedJsonResponse(message: __('dashboard_api.show_successfully'),  data: ['items' => PackageResource::collection($categories)]);

    }

   

    public function show($id): JsonResponse
    {

        try {
            $package = $this->packageRepository->getById($id,relations:["features" => function ($q) {
        $q->where('is_active', 1);
    }
]);

            return responseSuccess(message: __('dashboard_api.show_successfully'), data: new PackageResource($package));

        } catch (Exception $exception) {
            return responseFail(message: $exception->getMessage());
        }
    }

  
}
