<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
     protected $guarded=[];

    public function isValid(): bool
    {
        return $this->usage_count > 0 && (is_null($this->expire_at) || now()->lessThan($this->expire_at));
    }

    public function decrementCount(): void
    {
        if ($this->usage_count > 0) {
            $this->decrement('usage_count');
        }
    }
}
