<?php

namespace App\Pipelines\Order;

use App\Repository\TransactionRepositoryInterface;

class AddTransactionToProviderWallet
{
    public function __construct(private readonly TransactionRepositoryInterface $repository)
    {
    }

    public function handle($request, \Closure $next)
    {
        $order = $request->order;
        $this->repository->create([
            'user_id' => $order->provider->id,
            'amount' => $order->grand_total,
            'type' => 'increase',
            'reason' => 'new order',
        ]);

        return $next($request);
    }

}
