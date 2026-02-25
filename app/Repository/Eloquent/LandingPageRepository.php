<?php

namespace App\Repository\Eloquent;

use App\Models\Structure;
use App\Repository\LandingPageRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class LandingPageRepository extends Repository implements LandingPageRepositoryInterface
{
    protected Model $model;

    public function __construct(Structure $model)
    {
        parent::__construct($model);
    }

    public function getFirstByKey(string $key)
    {
        return $this->model::query()->where('key', $key)->first();
    }

    public function getByKey(string $key)
    {
        return $this->model::query()->where('key', $key)->get();
    }
}

