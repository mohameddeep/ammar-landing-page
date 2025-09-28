<?php

namespace App\Http\Services\Dashboard\OrderReturn;

use App\Enums\OrderReturnStatusEnum;
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

    public function show($id)
    {
        $returnOrder = $this->Repository->getById($id);
        return view('dashboard.site.order-returns.show', compact('returnOrder'));
    }

    public  function accept($id)
    {
        DB::beginTransaction();
        try {
            $returnOrder = $this->Repository->getById($id);
            $this->Repository->update($id, ['status' => OrderReturnStatusEnum::ACCEPTED]);

        }
    }


}
