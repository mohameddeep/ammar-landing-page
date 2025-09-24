<?php

namespace App\Pipelines\Order;

class ClearCart
{
    public function handle($request, \Closure $next)
    {
        $cart = $request->cart;

        $cart->items()->delete();
        unset($request->cart);

        return $next($request);
    }
}
