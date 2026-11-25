<?php

namespace App\Models;

use App\Enums\PricingRequestStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PricingRequest extends Model
{
    protected $guarded = [];

    protected $casts = ['status' => PricingRequestStatus::class];

    public function projectTypes(): BelongsToMany
    {
        return $this->belongsToMany(ProjectType::class);
    }
}
