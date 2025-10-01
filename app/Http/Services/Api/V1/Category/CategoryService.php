<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1\Category;

use App\Http\Resources\V1\Category\CategoryDetailResource;
use App\Http\Resources\V1\Category\CategoryResource;
use App\Repository\CategoryRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;

use function App\Http\Helpers\paginatedJsonResponse;
use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

final class CategoryService
{
    public function __construct(

        private CategoryRepositoryInterface $categoryRepository
    ) {}

    public function index(): JsonResponse
    {
        $categories = $this->categoryRepository->getActiveWithPagination();

        return paginatedJsonResponse(message: __('dashboard_api.show_successfully'), data: ['items' => CategoryResource::collection($categories)]);

    }

    public function show($id): JsonResponse
    {

        try {
            $category = $this->categoryRepository->getById($id);

            return responseSuccess(message: __('dashboard_api.show_successfully'), data: new CategoryDetailResource($category));

        } catch (Exception $exception) {
            return responseFail(message: $exception->getMessage());
        }
    }
}
