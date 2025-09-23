<?php

namespace App\Repository\Eloquent;

use App\Models\Order;
use App\Repository\Eloquent\Repository;
use App\Repository\OrderRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class OrderRepository extends Repository implements OrderRepositoryInterface
{
    protected Model $model;

    public function __construct(Order $model){
        parent::__construct($model);
    }

     public function getCountOrders()
    {
        return $this->model->count();
    }

    public function getForUser(array $columns = ['*'], array $relations = [])
    {
        return $this->model->query()
            ->when(request()->filled('status'), fn($query) => $query->where('status', request()->status))
            ->select($columns)
            ->with($relations)
            ->get();
    }
}
