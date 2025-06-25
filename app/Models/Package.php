<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use LanguageToggle;
    protected $guarded = [];



    public function getDurationInDaysAttribute()
    {
        return (int) $this->duration;
    }
}
