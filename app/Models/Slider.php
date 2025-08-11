<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\LanguageToggle;
class Slider extends Model
{
    use LanguageToggle;
    protected $guarded = [];
}
