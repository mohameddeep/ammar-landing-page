<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface ServiceRepositoryInterface extends RepositoryInterface
{
    /**
     * Active services excluding one id, limited (for “related” blocks without loading all rows).
     * When $parentId is given, only siblings under that parent are returned.
     */
    public function getOtherActive(int|string $excludeId, int $limit = 3, int|string|null $parentId = null): Collection;

    /**
     * Active top-level services (no parent) with their active children loaded.
     */
    public function getActiveTopLevelWithChildren(): Collection;

    /**
     * Top-level services that can be chosen as a parent in the dashboard.
     */
    public function getParentOptions(int|string|null $excludeId = null): Collection;

    /**
     * All top-level services (active and inactive) with all their children, in display order.
     */
    public function getTreeForDashboard(): Collection;

    /**
     * Saves a new display order for services of one level (all share the same parent).
     * Returns false when the ids are unknown or span different levels.
     *
     * @param  array<int, int|string>  $ids  ids in the desired order
     */
    public function reorder(array $ids): bool;
}
