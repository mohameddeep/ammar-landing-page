<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;

interface AboutUsRepositoryInterface extends RepositoryInterface
{
    /**
     * Active top-level tabs with eager-loaded active children (SQL-scoped, not full-table filter).
     */
    public function getActiveRootTabsWithChildren(): Collection;
}