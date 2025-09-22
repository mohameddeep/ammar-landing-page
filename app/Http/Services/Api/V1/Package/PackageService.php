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
    $type = request()->query('type'); // user أو provider
    $packages = $this->packageRepository->getActiveWithPagination(
        relations: ['features'],
        type: $type
    );

    return paginatedJsonResponse(
        message: 'success',
        data: ['items' => PackageResource::collection($packages)]
    ); 
}


    public function show($id): JsonResponse
    {

        try {
            $package = $this->packageRepository->getById($id, relations: [
                'features' => function ($q) {
                    $q->where('is_active', 1);
                },
            ]);

            return responseSuccess(message: 'success', data: new PackageResource($package));
        } catch (Exception $exception) {
            return responseFail(message: $exception->getMessage());
        }
    }
}
