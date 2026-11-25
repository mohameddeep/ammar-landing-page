<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\PricingRequest;
use App\Repository\PricingRequestRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

final class PricingRequestRepository extends Repository implements PricingRequestRepositoryInterface
{
    protected Model $model;

    public function __construct(PricingRequest $model)
    {
        parent::__construct($model);
    }

    public function paginateLatest(?string $status = null, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model::query()
            ->with('projectTypes')
            ->when($status, fn ($query) => $query->where('status', $status))
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function findWithTypes(int|string $id): PricingRequest
    {
        return $this->model::query()->with('projectTypes')->findOrFail($id);
    }
}
