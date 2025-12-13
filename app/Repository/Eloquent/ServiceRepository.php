<?php

namespace App\Repository\Eloquent;

use App\Models\Service;
use App\Repository\ServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ServiceRepository extends Repository implements ServiceRepositoryInterface
{
    protected Model $model;

    public function __construct(Service $model)
    {
        parent::__construct($model);
    }
}
