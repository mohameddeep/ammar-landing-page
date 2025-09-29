<?php

namespace App\Models;

use App\Http\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    public function firstImage()
    {
        return $this->hasOne(ProductImage::class, 'product_id', 'id');
    }

    public function isFav() : Attribute
    {
        return Attribute::get(function ($value) {
            if (!is_null($value)) {
                return (bool) $value;
            }

            return $this->favourites()->where('user_id', auth('api')->id())->exists();
        });
    }

    public function inCart() : Attribute
    {
        return Attribute::get(function () {
            $cart = auth('api')->user()->cart;
            if (is_null($cart)) {
                return false;
            }
            $existsInCart = $cart->items()->where('product_id', $this->id)->exists();
            return (bool) $existsInCart;
        });
    }

    public function cartItemId() : Attribute
    {
        return Attribute::get(function () {
            $cart = auth('api')->user()->cart;
            if (is_null($cart)) {
                return null;
            }
            $cartItem = $cart->items()->where('product_id', $this->id)->first();
            if (is_null($cartItem)) {
                return null;
            }
            return $cartItem->id;
        });
    }

    public function cartQuantity() : Attribute
    {
        return Attribute::get(function () {
            $cart = auth('api')->user()->cart;
            if (is_null($cart)) {
                return 0;
            }

            $item = $cart->items()->where('product_id', $this->id)->first();
            if (is_null($item)) {
                return 0;
            }
            return $item->quantity;
        });
    }


}
