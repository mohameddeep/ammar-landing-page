<?php

namespace App\Http\Services\Dashboard\Order;

use App\Http\Services\Mutual\FileManagerService;
use App\Repository\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function __construct(private readonly OrderRepositoryInterface $Repository,
                                private readonly FileManagerService $fileManagerService)
    {}


}