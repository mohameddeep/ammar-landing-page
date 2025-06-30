<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'package_id',
        'merchant_id',
        'end_date',
        'is_active',
    ];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
