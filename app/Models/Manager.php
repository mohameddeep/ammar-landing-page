<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Manager extends Authenticatable implements LaratrustUser
{
    use HasRolesAndPermissions;
    protected $guarded = [];
    protected $casts = [
        'password' => 'hashed',
    ];
    protected $hidden = [
        'password',
    ];
}
