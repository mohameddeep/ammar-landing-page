<?php

namespace App\Repository\Eloquent;

use App\Models\Favourite;
use App\Repository\FavouriteRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class FavouriteRepository extends Repository implements FavouriteRepositoryInterface
{
    protected Model $model;

    public function __construct(Favourite $model)
    {
        parent::__construct($model);
    }
}
