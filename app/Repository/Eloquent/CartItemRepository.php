<?php

namespace App\Repository\Eloquent;

use App\Models\Cart;
use App\Models\CartItem;
use App\Repository\CartItemRepositoryInterface;
use App\Repository\Eloquent\Repository;
use App\Repository\CartRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CartItemRepository extends Repository implements CartItemRepositoryInterface
{
    protected Model $model;

    public function __construct(CartItem $model){
        parent::__construct($model);
    }
}
