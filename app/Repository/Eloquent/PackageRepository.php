<?php

namespace App\Repository\Eloquent;


use App\Models\Package;
use Illuminate\Database\Eloquent\Model;
use App\Repository\PackageRepositoryInterface;

class PackageRepository extends Repository implements PackageRepositoryInterface
{
    protected Model $model;

    public function __construct(Package $model)
    {
        parent::__construct($model);
    }
}
