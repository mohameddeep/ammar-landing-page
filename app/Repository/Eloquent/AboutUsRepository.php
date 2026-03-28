<?php

namespace App\Repository\Eloquent;

use App\Models\AboutUs;
use App\Repository\AboutUsRepositoryInterface;
use App\Repository\Eloquent\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AboutUsRepository extends Repository implements AboutUsRepositoryInterface
{
    protected Model $model;

    public function __construct(AboutUs $model)
    {
        parent::__construct($model);
    }

    public function getActiveRootTabsWithChildren(): Collection
    {
        return $this->model::query()
            ->where('is_active', true)
            ->whereNull('parent_id')
            ->with('children')
            ->orderBy('id')
            ->get();
    }
}