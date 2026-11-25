<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProjectType extends Model
{
    use LanguageToggle;

    protected $guarded = [];

    protected $casts = ['is_active' => 'boolean'];

    public function pricingRequests(): BelongsToMany
    {
        return $this->belongsToMany(PricingRequest::class);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
