<?php

declare(strict_types=1);

namespace App\Repository;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ProjectTypeRepositoryInterface extends RepositoryInterface
{
    public function getActiveOrdered(): Collection;

    public function paginateOrdered(int $perPage = 20): LengthAwarePaginator;
}
