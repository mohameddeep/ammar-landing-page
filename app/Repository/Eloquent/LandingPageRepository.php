<?php

namespace App\Repository\Eloquent;

use App\Models\LandingPage;
use App\Repository\LandingPageRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class LandingPageRepository extends Repository implements LandingPageRepositoryInterface
{
    protected Model $model;

    public function __construct(LandingPage $model)
    {
        parent::__construct($model);
    }

      public function getByKey($key=null)
{
    return $this->model->where("key", $key)->get();
}

      public function getFirstByKey($key=null)
{
    return $this->model->where("key", $key)->first();
}


}
