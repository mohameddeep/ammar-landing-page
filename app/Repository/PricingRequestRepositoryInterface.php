<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\PricingRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PricingRequestRepositoryInterface extends RepositoryInterface
{
    public function paginateLatest(?string $status = null, int $perPage = 15): LengthAwarePaginator;

    public function findWithTypes(int|string $id): PricingRequest;
}
