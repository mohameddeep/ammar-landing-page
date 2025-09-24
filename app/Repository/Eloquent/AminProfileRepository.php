<?php

namespace App\Repository\Eloquent;

use App\Models\Manager;
use App\Repository\AdminProfileRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class AminProfileRepository extends Repository implements AdminProfileRepositoryInterface
{
    protected Model $model;

    public function __construct(Manager $model)
    {
        parent::__construct($model);
    }
}
