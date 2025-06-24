<?php

namespace App\Models;

use App\Enums\CommissionTypeEnum;
use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{

    use LanguageToggle;
    protected $guarded = [];

    protected $casts = [
      'type' => CommissionTypeEnum::class,
    ];
}
