<?php

namespace App\Repository\Eloquent;

use App\Models\Commission;
use Illuminate\Database\Eloquent\Model;
use App\Repository\CommissionRepositoryInterface;

class CommissionRepository extends Repository implements CommissionRepositoryInterface
{
    protected Model $model;

    public function __construct(Commission $model)
    {
        parent::__construct($model);
    }
}
