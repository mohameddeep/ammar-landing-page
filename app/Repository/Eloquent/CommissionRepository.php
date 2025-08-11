<?php

namespace App\Repository\Eloquent;

use App\Models\Commission;
use App\Repository\CommissionRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CommissionRepository extends Repository implements CommissionRepositoryInterface
{
    protected Model $model;

    public function __construct(Commission $model)
    {
        parent::__construct($model);
    }
}
