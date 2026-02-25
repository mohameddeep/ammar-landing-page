<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use LanguageToggle;

    protected $fillable = [
        'title_ar',
        'title_en',
        'content_ar',
        'content_en',
        'image',
        'is_active',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id')->where('is_active', true);
    }
    
    public function activeChildren()
    {
        return $this->hasMany(self::class, 'parent_id')->where('is_active', true)->orderBy('id');
    }
}
