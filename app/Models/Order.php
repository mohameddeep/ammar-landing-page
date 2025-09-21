<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];
    protected static function booted()
    {
        static::creating(function ($order) {
            $order->order_num = rand(100000, 999999);
        });
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
