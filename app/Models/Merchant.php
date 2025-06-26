<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Facades\JWTAuth;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;


class Merchant extends  Authenticatable implements JWTSubject , LaratrustUser
{
      use HasApiTokens, HasFactory, Notifiable , HasRolesAndPermissions;



        protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'otp_verified',
        'is_active',
        'type',
        'fcm_token',
        'is_featured',
        "image"
    ];

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


   public function otp()
{
    return $this->morphOne(Otp::class, 'otppable');
}
    public function otps()
{
    return $this->morphMany(Otp::class, 'otppable');
}
}
