<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Coupon extends Model
{
    protected $guarded = [];

    public function isValid(): bool
    {
        return $this->usage_count > 0 && (is_null($this->expire_at) || now()->lessThan(Carbon::parse($this->expire_at)));
    }

    public function decrementCount(): void
    {
        if ($this->usage_count > 0) {
            $this->decrement('usage_count');
        }
    }
}
