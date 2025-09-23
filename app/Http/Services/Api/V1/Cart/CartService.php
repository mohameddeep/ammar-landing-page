<?php

namespace App\Http\Services\Api\V1\Cart;

use App\Http\Helpers\Http;
use App\Http\Requests\Api\V1\Cart\CartRequest;
use App\Http\Resources\V1\Cart\CartResource;
use App\Models\Product;
use App\Repository\CartItemRepositoryInterface;
use App\Repository\CartRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class CartService
{
    public function __construct(private CartRepositoryInterface $repository,
                                private CartItemRepositoryInterface $cartItemRepository,
                                private ProductRepositoryInterface $productRepository,){}

    public function index()
    {
        $cart = $this->repository->first('user_id', auth('api')->id(), relations: ['items.product.user']);
         if (! $cart) {
        return responseSuccess(data: null, message: __('messages.cart_is_empty'));

    }
        return responseSuccess(data: new CartResource($cart));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $user = auth('api')->user();
            if (! $user->cart()->exists()) {
                $user->cart()->create();
            }
            $cart = $user->cart;
            $product = $this->productRepository->getById($data['product_id']);
            $checkForAnotherProvider = $cart->products()->where('user_id', '!=', $product->user_id)->exists();
            if ($checkForAnotherProvider) {
                if ($request->get('can_change')){
                    $cart->items()->delete();
                }else{
                    return responseFail(Http::FORBIDDEN, data: ['need_agree' => true]);
                }
            }
            $cart->items()->create([
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
                'color' => $data['color'],
                'size' => $data['size'],
                'unit_price' => $product->price,
                'total_price' => $product->price * $data['quantity'],
            ]);
            DB::commit();
            return responseSuccess(message: __('messages.added_successfully'));
        }catch(\Exception $e){
            DB::rollBack();
            return responseFail(__('dashboard.Something went wrong!'));
        }
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $this->cartItemRepository->update($id, $data);
            $cart = $this->repository->first('user_id', auth('api')->id(), relations: ['items.product.user']);
            DB::commit();
            return responseSuccess(data: new CartResource($cart));
        }catch (\Exception $e){
            DB::rollBack();
            return responseFail(message: __('messages.something_went_wrong'));
        }
    }

    public function destroy($id)
    {
        $this->cartItemRepository->delete($id);
        $cart = $this->repository->first('user_id', auth('api')->id(), relations: ['items.product.user']);
        if (! $cart) {
            return responseSuccess(data: null, message: __('messages.cart_is_empty'));
        }
        return responseSuccess(message: __('messages.deleted_successfully'));
    }



    public function empty()
{
    $user = auth('api')->user();

    if (! $user->cart) {
        return responseSuccess(message: __('messages.cart_is_empty'), data: null);
    }

    $user->cart->items()->delete();

    return responseSuccess(message: __('messages.cart_emptied_successfully'));
}


}
