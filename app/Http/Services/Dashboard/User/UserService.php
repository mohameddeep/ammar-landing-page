<?php

namespace App\Http\Services\Dashboard\User;

use App\Http\Services\Dashboard\BaseService;
use App\Repository\TransactionRepositoryInterface;
use App\Repository\UserRepositoryInterface;

class UserService extends BaseService
{
    public function __construct(UserRepositoryInterface $userRepository,TransactionRepositoryInterface $transactionRepository)
    {
        parent::__construct($userRepository,$transactionRepository, 'user', 'dashboard.site.users');
    }

    public function products($id)
    {
        $user = $this->repository->getById($id);
        $products = $user->products()->with(['images', 'category', 'user'])->paginate(20);

        return view("dashboard.site.products.index", compact("products"));
    }

}
