<?php

namespace App\Pipelines\Order;

use App\Repository\OrderRepositoryInterface;

class CreateOrder
{
    public function __construct(private OrderRepositoryInterface $repository)
    {

    }

    public function handle($request, \Closure $next)
    {
        $cart = $request->cart;

        $data = [
            'user_id' => auth('api')->id(),
            'grand_total' => $cart->total_price,
            'provider_id' => $cart->provider->id,
            'address_id' => $request->address_id,
            'coupon_code' => $request->get('coupon_code'),
        ];
        $order = $this->repository->create($data);
        $request->order = $order;
        return $next($request);
    }

}
