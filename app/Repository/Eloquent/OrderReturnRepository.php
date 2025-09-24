<?php

namespace App\Repository\Eloquent;

use App\Models\OrderReturn;
use App\Repository\OrderReturnRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class OrderReturnRepository extends Repository implements OrderReturnRepositoryInterface
{
    protected Model $model;

    public function __construct(OrderReturn $model){
        parent::__construct($model);
    }
}
