<?php

declare(strict_types=1);

namespace App\Repository\Eloquent;

use App\Models\Coupon;
use App\Models\Package;
use App\Models\Product;
use App\Repository\PackageRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

final class ProductRepository extends Repository implements ProductRepositoryInterface
{
    protected Model $model;

    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function getProducts(int $perPage = 10, array $columns = ['*'], array $relations = [])
    {
        $query = $this->model->query()
                ->where(function ($query) {
                    $query->where('is_active', true)
                        ->where('is_stopped', false)
                        ->where('status', 'approved');
                });

        $query->search();
        $query->withExists(['favourites as is_fav' =>  function ($q) {
            $q->where('user_id', auth('api')->id());
        }]);

        return $query->with($relations)->paginate($perPage);
    }

    public function getCategoryProducts($categoryId, array $columns = ['*'], array $relations = [])
    {
        return $this->model->query()
            ->where('category_id', $categoryId)
            ->where('is_active', true)
            ->where('is_stopped', false)
            ->where('status', 'approved')
            ->search()
            ->withExists(['favourites as is_fav' =>  function ($q) {
                $q->where('user_id', auth('api')->id());
            }])
            ->with($relations)
            ->get();
    }

    public function getRelated($product, array $columns = ['*'], array $relations = [], $count = 4)
    {
        return $this->model->query()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->where('is_stopped', false)
            ->where('status', 'approved')
            ->withExists(['favourites as is_fav' =>  function ($q) {
                $q->where('user_id', auth('api')->id());
            }])
            ->with($relations)
            ->inRandomOrder()
            ->limit($count)
            ->get();
    }


    public function checkProductAddToFavourite($productId)
    {
        return $this->model->query()
            ->where('id', $productId)
            ->whereHas('favourites', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->exists();
    }

    public function getForUser(int $perPage = 10, array $columns = ['*'], array $relations = [])
    {
        return $this->model->query()
            ->where('user_id', auth('api')->id())
            ->when(request()->filled('category_id'), function ($q) {
                $q->where('category_id', request()->category_id);
            })
            ->when(request()->filled('status'), function ($q) {
                $q->where('status', request()->input('status'));
            })
            ->select($columns)
            ->with($relations)
            ->paginate($perPage);
    }


    public function getProductsByFilter($request){
                  $query = $this->model->with(['category', 'images']);

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function($q) use ($search) {
            $q->where('name', 'LIKE', "%{$search}%")
              ->orWhere('description', 'LIKE', "%{$search}%");
        });
    }

    return $query->paginate(20);

    }

}
