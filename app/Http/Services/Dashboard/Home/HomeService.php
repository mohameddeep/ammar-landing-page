<?php

namespace App\Http\Services\Dashboard\Home;

use App\Repository\CategoryRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use App\Repository\PackageRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use App\Repository\ProductViewRepositoryInterface;
use App\Repository\SettingRepositoryInterface;
use App\Repository\SubscriptionRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class HomeService
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly PackageRepositoryInterface $packageRepository,
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly ProductRepositoryInterface $productRepository,
        private readonly SubscriptionRepositoryInterface $subscriptionRepository,
        private readonly OrderRepositoryInterface $orderRepository,
    ) {}



     public function home()
    {
        $users = $this->userRepository->count(function($query) {  
        $query->where('type', 'user'); 
    });
        $providers = $this->userRepository->count(function($query) {  
        $query->where('type', 'provider'); 
    });
        $packages = $this->packageRepository->count();
        $categories = $this->categoryRepository->count();
        $products = $this->productRepository->count();
        $subscriptions = $this->subscriptionRepository->count();
        $ordersCount = $this->orderRepository->count();
        $orders = $this->orderRepository->paginateWithQuery(function($query) {  
        $query->latest(); 
    },relations:["provider","user"]);

        return view('dashboard.site.home.index', compact('users','providers','packages','categories','products','subscriptions','orders','ordersCount'));
    }

}
