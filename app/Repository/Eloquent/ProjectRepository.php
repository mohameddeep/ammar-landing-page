<?php

namespace App\Repository\Eloquent;

use App\Models\Project;
use App\Repository\ProjectRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ProjectRepository extends Repository implements ProjectRepositoryInterface
{
    protected Model $model;

    public function __construct(Project $model)
    {
        parent::__construct($model);
    }

    public function getActiveForGallery(): Collection
    {
        return $this->model::query()->active()->ordered()->get();
    }

    public function findActiveBySlug(string $slug): ?Project
    {
        return $this->model::query()->active()->where('slug', $slug)->with('images')->first();
    }

    public function getRelated(Project $project, int $limit = 3): Collection
    {
        return $this->model::query()
            ->active()
            ->whereKeyNot($project->id)
            ->when($project->category_en || $project->category_ar, fn ($query) => $query->orderByRaw(
                '(category_en <=> ? OR category_ar <=> ?) DESC',
                [$project->category_en, $project->category_ar]
            ))
            ->ordered()
            ->limit($limit)
            ->get();
    }

    public function paginateForDashboard(int $perPage = 10): LengthAwarePaginator
    {
        return $this->model::query()->withCount('images')->ordered()->paginate($perPage);
    }
}
