<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1\Home;

use App\Http\Resources\V1\Category\CategoryResource;
use App\Http\Resources\V1\Slider\SliderResource;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\SliderRepositoryInterface;
use Illuminate\Http\JsonResponse;

use function App\Http\Helpers\responseSuccess;

final class HomeService
{
    public function __construct(

        private CategoryRepositoryInterface $categoryRepository,
        private SliderRepositoryInterface $sliderRepository,
    ) {}

    public function index(): JsonResponse
    {
        $categories = $this->categoryRepository->getParentCategories();
        $sliders = $this->sliderRepository->getActive();

        return responseSuccess(message: __('dashboard_api.show_successfully'), data: [
            'categories' => CategoryResource::collection($categories),
            'sliders' => SliderResource::collection($sliders),
        ]);

    }
}
