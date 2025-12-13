<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use LanguageToggle;

    protected $guarded = [];
}
