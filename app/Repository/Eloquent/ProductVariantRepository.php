<?php

namespace App\Repository\Eloquent;

use App\Models\ProductVariant;
use App\Repository\Eloquent\Repository;
use App\Repository\ProductVariantRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class ProductVariantRepository extends Repository implements ProductVariantRepositoryInterface
{
    protected Model $model;

    public function __construct(ProductVariant $model)
    {
        parent::__construct($model);
    }

    public function getProductVariants($productId)
    {
        $available_colors = $this->model->where('product_id', $productId)
            ->where('quantity', '>', 0)
            ->distinct('color')
            ->pluck('color');

        $available_sizes = $this->model->where('product_id', $productId)
            ->where('quantity', '>', 0)
            ->distinct('size')
            ->pluck('size');

        return [
            'available_colors' => $available_colors,
            'available_sizes' => $available_sizes,
        ];
    }

    public function getVariants($productId, $size)
    {
        return $this->model->query()
            ->where('product_id', $productId)
            ->where('size', $size)
            ->get();
    }

    public function getVariant($productId, $size, $color)
    {
        return $this->model->query()
            ->where('product_id', $productId)
            ->where('size', $size)
            ->where('color', $color)
            ->first();
    }
}
