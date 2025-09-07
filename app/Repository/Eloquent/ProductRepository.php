<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\Coupon;
use App\Models\Package;
use App\Models\Product;
use App\Repository\PackageRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

final class ProductRepository extends Repository implements ProductRepositoryInterface
{
    protected Model $model;

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function getProducts(int $perPage = 10, array $columns = ['*'], array $relations = [])
    {
        $query = $this->model->query();

        $query->when(request()->filled('search'), function ($query) {
            $searchItem = "%" . request()->search . "%";
            $columns = ['name_en', 'name_ar', 'slug', 'detail_en', 'detail_ar', 'price'];
            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', $searchItem);
            }
        });

        return $query->select($columns)->with($relations)->paginate($perPage);
    }

}
