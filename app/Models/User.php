<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTAuth;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function token()
    {
        return JWTAuth::fromUser($this);
    }

    public function otp(): HasOne
    {
        return $this->HasOne(Otp::class, 'user_id', 'id')->latestOfMany();
    }

    public function otps(): HasMany
    {
        return $this->HasMany(Otp::class, 'user_id', 'id');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class, 'user_id', 'id');
    }

    public function Packages(): HasMany
    {
        return $this->hasMany(Package::class, 'user_id', 'id');
    }

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class, 'user_id', 'id');
    }

    public function currentSubscription()
    {
        return $this->hasOne(Subscription::class, 'user_id', 'id')->where('is_active', 1)->latestOfMany();
    }

    public function favourites()
    {
        return $this->hasManyThrough(Product::class, Favourite::class, 'user_id', 'id', 'id', 'product_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'user_id', 'id');
    }


}
