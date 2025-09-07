<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\Package;
use App\Repository\PackageRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

final class PackageRepository extends Repository implements PackageRepositoryInterface
{
    protected Model $model;

    public function __construct(Package $model)
    {
        parent::__construct($model);
    }

    public function getPackagesByUserType()
    {
        $user = auth()->user();

        $type = match ($user->type) {
            'store' => 'store',
            'designer' => 'designer',
            default => 'individual',
        };

        return $this->model->with([
            'features' => function ($q) {
                $q->where('is_active', 1);
            },
        ])
            ->where('type', $type)
            ->where('coming_soon', false)
            ->paginate(10);
    }
}
