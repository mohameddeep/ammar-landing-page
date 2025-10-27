<?php

namespace App\Pipelines\Order;

use App\Http\Traits\Notification;
use App\Notifications\NewOrderNotification;
use App\Repository\OrderRepositoryInterface;

class CreateOrder
{
    use Notification;
    public function __construct(private OrderRepositoryInterface $repository)
    {

    }

    public function handle($request, \Closure $next)
    {
        $cart = $request->cart;
        

        $data = [
            'user_id' => auth('api')->id(),
            'grand_total' => $cart->final_price,
            'provider_id' => $cart->provider->id,
            'address_id' => $request->address_id,
            'coupon_code' => $cart->coupon_code,
        ];
        $order = $this->repository->create($data);

//        $this->SendNotification(NewOrderNotification::class, $order->provider, $order);
        $request->order = $order;
        return $next($request);
    }

}
