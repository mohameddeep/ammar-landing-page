<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    public function totalPrice() : Attribute
    {
        return Attribute::get(fn() => $this->items()->sum("total_price"));
    }

    public function canAccept() : Attribute
    {
        return Attribute::get(function () {
            return auth('api')->check() &&
                auth('api')->id() == $this->provider_id &&
                $this->order_status == OrderStatusEnum::Pending->value;
        });
    }

    public function canReturn() : Attribute
    {
        return Attribute::get(function () {
            return auth('api')->check() &&
                auth('api')->id() == $this->user_id &&
                ! in_array($this->order_status, [OrderStatusEnum::Cancelled, OrderStatusEnum::Refunded]) &&
                Carbon::parse($this->created_at)->subDays(14) < Carbon::now();
        });
    }

    public function canReview() : Attribute
    {
        return Attribute::get(function () {
            return auth('api')->check() &&
                auth('api')->id() == $this->user_id &&
                in_array($this->order_status, [OrderStatusEnum::Delivered, OrderStatusEnum::Refunded]);
        });
    }
}
