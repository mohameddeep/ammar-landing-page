<?php

namespace App\Pipelines\Order;

use App\Repository\ProductVariantRepositoryInterface;

class UpdateProductsQuantity
{
    public function __construct(private ProductVariantRepositoryInterface $repository)
    {
    }

    public function handle($request, \Closure $next)
    {
        $order = $request->order;
        $items = $order->items;
        $items->load('product.variants');
        foreach ($items as $item)
        {
            $variant = $this->repository->getVariant($item->product_id, $item->size, $item->color);
            $variant->decrement('quantity', $item->quantity);
        }

        return $next($request);
    }
}
