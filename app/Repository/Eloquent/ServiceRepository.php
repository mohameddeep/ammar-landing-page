<?php

namespace App\Repository\Eloquent;

use App\Models\Service;
use App\Repository\ServiceRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ServiceRepository extends Repository implements ServiceRepositoryInterface
{
    protected Model $model;

    public function __construct(Service $model)
    {
        parent::__construct($model);
    }

    public function getOtherActive(int|string $excludeId, int $limit = 3, int|string|null $parentId = null): Collection
    {
        return $this->model::query()
            ->where('is_active', true)
            ->where('id', '!=', $excludeId)
            ->when($parentId !== null, fn ($query) => $query->where('parent_id', $parentId))
            ->ordered()
            ->limit($limit)
            ->get();
    }

    public function getActiveTopLevelWithChildren(): Collection
    {
        return $this->model::query()
            ->topLevel()
            ->where('is_active', true)
            ->with('activeChildren')
            ->ordered()
            ->get();
    }

    public function getParentOptions(int|string|null $excludeId = null): Collection
    {
        return $this->model::query()
            ->topLevel()
            ->when($excludeId !== null, fn ($query) => $query->where('id', '!=', $excludeId))
            ->ordered()
            ->get(['id', 'title_ar', 'title_en']);
    }

    public function getTreeForDashboard(): Collection
    {
        return $this->model::query()
            ->topLevel()
            ->with('children')
            ->ordered()
            ->get();
    }

    public function reorder(array $ids): bool
    {
        $ids = array_values(array_unique(array_map('intval', $ids)));
        $parents = $this->model::query()->whereKey($ids)->pluck('parent_id')->unique();

        // All ids must exist and belong to the same level (same parent or all top level).
        if (count($ids) === 0 || $parents->count() !== 1 || $this->model::query()->whereKey($ids)->count() !== count($ids)) {
            return false;
        }

        DB::transaction(function () use ($ids) {
            foreach ($ids as $position => $id) {
                $this->model::query()->whereKey($id)->update(['sort_order' => $position + 1]);
            }
        });

        return true;
    }
}
