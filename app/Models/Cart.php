<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $guarded = [];

    public function items() : HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, CartItem::class, 'cart_id', 'id', 'id', 'product_id');
    }

    public function totalPrice() : Attribute
    {
        return Attribute::get(fn() => $this->items()->sum('total_price'));
    }
}
