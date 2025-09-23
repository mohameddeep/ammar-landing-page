<?php

namespace App\Repository\Eloquent;

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
}
