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
    public function provider()
    {
        return $this->belongsTo(User::class,'provider_id')->where("type", "provider");
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->where("type","user");
    }
    public function address()
    {
        return $this->belongsTo(UserAddress::class,'address_id');
    }
}
