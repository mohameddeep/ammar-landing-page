<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use LanguageToggle;

    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
