<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected $casts = ['first_visited_at' => 'datetime'];
}
