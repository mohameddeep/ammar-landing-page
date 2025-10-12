<?php

namespace App\Models;

use App\Http\Traits\LanguageToggle;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use LanguageToggle;

    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

     public function products(): HasMany
{
    return $this->hasMany(Product::class, 'category_id', 'id')
                ->whereHas('variants', function ($query) {
                    $query->where('quantity', '>', 0);
                });
}

    public function productsCount(): Attribute
    {
        return Attribute::get(
            get: function () {
                return $this->products()?->count();
            }
        );
    }

    public function subCategoriesCount(): Attribute
    {
        return Attribute::get(
            get: function () {
                return $this->children()?->count();
            }
        );
    }
}
