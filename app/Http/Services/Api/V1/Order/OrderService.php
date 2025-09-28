<?php

namespace App\Http\Services\Api\V1\Order;

use App\Enums\OrderStatusEnum;
use App\Exceptions\EmptyCartException;
use App\Http\Helpers\Http;
use App\Http\Resources\V1\Order\OrderResource;
use App\Pipelines\Order\AddTransactionToProviderWallet;
use App\Pipelines\Order\AttachOrderItems;
use App\Pipelines\Order\ClearCart;
use App\Pipelines\Order\CreateOrder;
use App\Pipelines\Order\UpdateProductsQuantity;
use App\Pipelines\Order\ValidateCart;
use App\Repository\OrderRepositoryInterface;
use App\Repository\OrderReturnRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Pipeline;
use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class OrderService
{
    public function __construct(private OrderRepositoryInterface $repository,
                                private OrderReturnRepositoryInterface $orderReturnRepository){}


    public function index()
    {
        $orders = $this->repository->getForUser(relations: ['items.product.user', 'user', 'provider']);
        return responseSuccess(data: OrderResource::collection($orders));
    }

    public function show(string $id)
    {
        $order = $this->repository->getById($id, relations: ['items.product.user', 'user', 'provider']);
        return responseSuccess(data: new OrderResource($order));
    }
    public function store($request)
    {
        try {
            return DB::transaction(function () use ($request) {
                return Pipeline::send($request)
                    ->through([
                        ValidateCart::class,
                        CreateOrder::class,
                        AttachOrderItems::class,
                        UpdateProductsQuantity::class,
                        ClearCart::class,
                        AddTransactionToProviderWallet::class,
                        // TODO payment integration will be implemented
                    ])
                    ->then(function ($request) {
                        return responseSuccess(message: __('messages.created successfully'));
                    });
            });
        }catch (EmptyCartException $e){
            return responseFail($e->getCode(), $e->getMessage());
        }
        catch (\Exception $e){
            return responseFail(message: __('dashboard.Something went wrong!'));
        }
    }

    public function accept($id)
    {
        $order = $this->repository->getById($id, relations: ['items.product.user']);
        $order->update([
            'order_status' => OrderStatusEnum::Processing->value
        ]);

        return responseSuccess(data: new OrderResource($order));
    }

    public function cancel($id)
    {
        $order = $this->repository->getById($id, relations: ['items.product.user']);
        $order->update(['order_status' => OrderStatusEnum::Cancelled->value]);
        return responseSuccess(data: new OrderResource($order));
    }

    public function returnOrder($request, $id)
    {
        $data = $request->validated();
        $order = $this->repository->getById($id, relations: ['items.product.user']);
        $data['order_id'] = $id;
        $data['user_id'] = auth('api')->id();
        $returnOrder = $this->orderReturnRepository->create($data);
        return responseSuccess(message: __('messages.created successfully'));
    }

}
