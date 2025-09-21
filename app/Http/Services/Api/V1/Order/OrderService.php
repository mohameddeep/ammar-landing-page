<?php

namespace App\Http\Services\Api\V1\Order;

use App\Http\Helpers\Http;
use App\Repository\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class OrderService
{
    public function __construct(private OrderRepositoryInterface $repository){}

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $cart = auth('api')->user()->cart;
            $items = $cart->items;
            if (empty($items)) {
                return responseFail(Http::BAD_REQUEST, message: __('messages.cart_empty'));
            }
            $order = $this->repository->create([
                'user_id' => auth('api')->id(),
                'grand_total' => $cart->total_price,
                'provider_id' => $cart->provider->id,
                'address_id' => $request->address_id,
                'coupon_code' => $request->get('coupon_code'),
            ]);

            foreach ($items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'size' => $item->size,
                    'color' => $item->color,
                    'unit_price' => $item->unit_price,
                    'total_price' => $item->total_price,
                ]);
            }
            DB::commit();
            return responseSuccess(message: __('messages.created successfully'));
        }catch (\Exception $e){
            DB::rollBack();
            dd($e);
            return responseFail(message: $e->getMessage());
        }
    }

}
