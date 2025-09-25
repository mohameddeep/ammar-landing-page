<?php

namespace App\Http\Services\Dashboard\OrderReturn;

use App\Http\Services\Mutual\FileManagerService;
use App\Repository\OrderReturnRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderReturnService
{
    public function __construct(private readonly OrderReturnRepositoryInterface $Repository,
                                private readonly FileManagerService $fileManagerService)
    {}

    public function index()
    {
          $returnOrders = $this->Repository->paginate(relations: ['user', 'order', 'address']);
          return view('dashboard.site.order-returns.index', compact('returnOrders'));
    }


}
