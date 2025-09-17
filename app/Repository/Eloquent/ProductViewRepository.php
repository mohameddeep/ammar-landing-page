<?php

namespace App\Repository\Eloquent;

use App\Models\ProductView;
use App\Repository\Eloquent\Repository;
use App\Repository\ProductViewRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ProductViewRepository extends Repository implements ProductViewRepositoryInterface
{
    protected Model $model;

    public function __construct(ProductView $model){
        parent::__construct($model);
    }
}