<?php

namespace App\Http\Services\Dashboard\Provider;

use App\Http\Services\Dashboard\BaseService;
use App\Repository\TransactionRepositoryInterface;
use App\Repository\UserRepositoryInterface;

class ProviderService extends BaseService
{
    public function __construct(UserRepositoryInterface $providerRepository,TransactionRepositoryInterface $transactionRepository)
    {
        parent::__construct($providerRepository,$transactionRepository, 'provider', 'dashboard.site.providers');
    }

    public function products($id)
    {
        $provider = $this->repository->getById($id);
        $products = $provider->products()->with(['images', 'category', 'user'])->paginate(20);

        return view("dashboard.site.products.index", compact("products"));
    }
}
