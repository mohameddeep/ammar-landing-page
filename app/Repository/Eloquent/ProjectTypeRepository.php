<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\ProjectType;
use App\Repository\ProjectTypeRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class ProjectTypeRepository extends Repository implements ProjectTypeRepositoryInterface
{
    protected Model $model;

    public function __construct(ProjectType $model)
    {
        parent::__construct($model);
    }

    public function getActiveOrdered(): Collection
    {
        return $this->model::query()->where('is_active', true)->ordered()->get();
    }

    public function paginateOrdered(int $perPage = 20): LengthAwarePaginator
    {
        return $this->model::query()->withCount('pricingRequests')->ordered()->paginate($perPage);
    }
}
