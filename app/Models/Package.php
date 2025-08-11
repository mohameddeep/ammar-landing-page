<?php

namespace App\Models;

use App\Enums\PackageTypeEnum;
use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use LanguageToggle;

    protected $casts = [
        'type' => PackageTypeEnum::class,
    ];

    protected $guarded = [];

    public function features()
    {
        return $this->hasMany(PackageFeature::class);
    }

    public function merchants()
    {
        return $this->belongsToMany(Merchant::class, 'subscriptions')
            ->withPivot('end_date', 'is_active')
            ->withTimestamps();
    }
}
