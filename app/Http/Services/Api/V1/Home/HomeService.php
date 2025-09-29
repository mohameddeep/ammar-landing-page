<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1\Home;

use App\Http\Resources\V1\Category\CategoryResource;
use App\Http\Resources\V1\Order\OrderResource;
use App\Http\Resources\V1\Slider\SliderResource;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use App\Repository\SliderRepositoryInterface;
use Illuminate\Http\JsonResponse;

use function App\Http\Helpers\responseSuccess;

final class HomeService
{
    public function __construct(

        private CategoryRepositoryInterface $categoryRepository,
        private SliderRepositoryInterface $sliderRepository,
        private OrderRepositoryInterface $orderRepository,
    ) {}

    public function index(): JsonResponse
    {
        $categories = $this->categoryRepository->getActive(relations: ['products']);
        $sliders = $this->sliderRepository->getActive();

        return responseSuccess(message: __('dashboard_api.show_successfully'), data: [
            'categories' => CategoryResource::collection($categories),
            'sliders' => SliderResource::collection($sliders),
        ]);

    }

    public function HomeForProvider()
    {
        $latestOrders = $this->orderRepository->getForProvider(limit: 4);
        $query = function ($query) {
            return $query->where('provider_id', auth('api')->id());
        };
        $ordersCount = $this->orderRepository->count($query);
        $totalSales = $this->orderRepository->getSalesForProvider();

        $data = [
            'latest_orders' => OrderResource::collection($latestOrders),
            'orders_count' => $ordersCount,
            'total_sales' => $totalSales,
        ];

        return responseSuccess(message: __('dashboard_api.show_successfully'), data: $data);
    }
}
