<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\PackageFeature;
use App\Repository\PackageFeatureRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

final class PackageFeatureRepository extends Repository implements PackageFeatureRepositoryInterface
{
    protected Model $model;

    public function __construct(PackageFeature $model)
    {
        parent::__construct($model);
    }

    public function deleteBy(array $conditions)
    {
        return $this->model->where($conditions)->delete();
    }
}
