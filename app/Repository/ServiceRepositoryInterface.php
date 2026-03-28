<?php

namespace App\Repository;

use Illuminate\Support\Collection;

interface ServiceRepositoryInterface extends RepositoryInterface
{
    /**
     * Active services excluding one id, limited (for “related” blocks without loading all rows).
     */
    public function getOtherActive(int|string $excludeId, int $limit = 3): Collection;
}
