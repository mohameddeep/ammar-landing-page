<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderReturn extends Model
{
    protected $guarded = [];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function address() : HasOne
    {
        return $this->hasOne(UserAddress::class, 'id', 'address_id');
    }

    public function order() : HasOne
    {
        return $this->hasOne(Order::class, 'id', 'order_id');
    }
}
