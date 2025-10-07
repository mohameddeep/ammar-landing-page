<?php

namespace App\Http\Services\Dashboard\OrderReturn;

use App\Enums\OrderReturnStatusEnum;
use App\Repository\OrderReturnRepositoryInterface;
use App\Repository\TransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderReturnService
{
    public function __construct(private readonly OrderReturnRepositoryInterface $Repository,
                                private readonly TransactionRepositoryInterface $TransactionRepository,
                                )
    {}

    public function index()
    {
        $query = function ($query) {
            $query->where('status', request('status') ?? 'pending');
        };
          $returnOrders = $this->Repository->paginateWithQuery(query: $query, relations: ['user', 'order', 'address']);
          return view('dashboard.site.order-returns.index', compact('returnOrders'));
    }

    public function show($id)
    {
        $returnOrder = $this->Repository->getById($id,relations:['order.items.product.firstImage']);
        return view('dashboard.site.order-returns.show', compact('returnOrder'));
    }

    public  function accept($id)
    {
        DB::beginTransaction();
        try {
            $returnOrder = $this->Repository->getById($id);
            $this->Repository->update($id, ['status' => OrderReturnStatusEnum::ACCEPTED]);
            $total_price = $returnOrder->order->total_price;
            $this->TransactionRepository->create([
                'user_id' => $returnOrder->user_id,
                'amount' => $total_price,
                'type' => 'increase',
                'reason' => 'return order'
            ]);
            $returnOrder->user?->increment('wallet_balance', $total_price);
            $provider = $returnOrder->order->provider;
            $this->TransactionRepository->create([
                'user_id' => $provider->id,
                'amount' => $total_price,
                'type' => 'increase',
                'reason' => 'return order'
            ]);
            $provider->decrement('wallet_balance', $total_price);
            DB::commit();
            return redirect()->back()->with('success', __('messages.updated_successfully'));
        }catch (\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('error', __('dashboard.Something went wrong!'));
        }
    }

    public function reject($id)
    {
        $returnOrder = $this->Repository->getById($id);
        $this->Repository->update($id, ['status' => OrderReturnStatusEnum::REJECTED]);
        return redirect()->back()->with('success', __('messages.updated_successfully'));
    }


}
