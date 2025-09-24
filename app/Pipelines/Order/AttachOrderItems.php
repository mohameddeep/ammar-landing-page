<?php

namespace App\Pipelines\Order;

class AttachOrderItems
{

    public function handle($request, \Closure $next)
    {
        $order = $request->order;

        foreach ($request->cart->items as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'size' => $item->size,
                'color' => $item->color,
                'unit_price' => $item->unit_price,
                'total_price' => $item->total_price,
            ]);
        }

        return $next($request);
    }

}
