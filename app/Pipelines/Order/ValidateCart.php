<?php

namespace App\Pipelines\Order;

use App\Exceptions\EmptyCartException;
use App\Http\Helpers\Http;
use function App\Http\Helpers\responseFail;

class ValidateCart
{
    public function handle($request, \Closure $next)
    {
        $cart = auth('api')->user()->cart;

        if (!$cart || $cart->items->isEmpty()) {
            throw new EmptyCartException();
        }

        $request->cart = $cart;

        return $next($request);
    }
}
