<?php

namespace App\Models;

use App\Enums\PackageTypeEnum;
use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Model;

class PackageFeature extends Model
{
    use LanguageToggle;

    protected $guarded = [];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
