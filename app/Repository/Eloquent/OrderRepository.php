<?php

namespace App\Repository\Eloquent;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Repository\Eloquent\Repository;
use App\Repository\OrderRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class OrderRepository extends Repository implements OrderRepositoryInterface
{
    protected Model $model;

    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function getCountOrders()
    {
        return $this->model->count();
    }

    public function getForUser(array $columns = ['*'], array $relations = [])
    {
        return $this->model->query()
            ->where('user_id', auth('api')->id())
            ->when(request()->filled('status'), fn($query) => $query->where('order_status', request()->status))
            ->select($columns)
            ->with($relations)
            ->latest()
            ->get();
    }



    public function getOrdersByFilter($request)
    {

        $query = $this->model->with(['provider', 'address', 'user']);

        // Filter by status only
        $currentStatus = null;
        if ($request->filled('status')) {
            $currentStatus = $request->status;
            $query->where('order_status', $currentStatus);
        }

        //filter by order number
        if ($request->filled('search')) {
            $query->where('order_num', 'LIKE', '%' . $request->search . '%');
        }

        $orders = $query->paginate();

        return $orders;
    }

    public function getForProvider($limit = null, array $columns = ['*'], array $relations = [])
    {
        return $this->model->query()
            ->where('provider_id', auth('api')->id())
            ->when(request()->filled('status'), fn($query) => $query->where('order_status', request()->status))
            ->when($limit, fn($query) => $query->limit($limit))
            ->select($columns)
            ->with($relations)
            ->latest()
            ->get();
    }

    public function getSalesForProvider()
    {
        return $this->model->query()
            ->where('provider_id', auth('api')->id())
            ->whereNotIn('order_status', [OrderStatusEnum::Cancelled, OrderStatusEnum::Refunded])
            ->sum('grand_total');
    }
}
