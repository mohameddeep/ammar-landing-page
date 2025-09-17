<?php

namespace App\Models;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use Searchable;

    protected $appends  = ['is_fav'];
    protected $guarded = [];

    protected array $searchable = [
        'name',
        'description',
        'price',
        'category.name_ar',
        'category.name_en'
    ];
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviews() : HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function rate()
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function colors()
    {
        return $this->variants()->where('type', 'color')->pluck('value')->toArray();
    }

    public function sizes()
    {
        return $this->variants()->where('type', 'size')->pluck('value')->toArray();
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function favourites() : HasMany
    {
        return $this->hasMany(Favourite::class);
    }

    public function views() : HasMany
    {
        return $this->hasMany(ProductView::class);
    }
}
