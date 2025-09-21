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
}