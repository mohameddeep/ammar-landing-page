<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $guarded = [];

    public function image() : Attribute
    {
        return Attribute::get(function ($value) {
            if (! $value)
                return $value;
            return url('/storage' . $value);
        });
    }
}
