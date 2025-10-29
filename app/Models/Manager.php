<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Notifications\Notifiable;

class Manager extends Authenticatable implements LaratrustUser
{
    use HasRolesAndPermissions,Notifiable;

    protected $guarded = [];

    protected $casts = [
        'password' => 'hashed',
    ];

    protected $hidden = [
        'password',
    ];
}
