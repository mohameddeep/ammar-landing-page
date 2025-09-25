<?php

namespace App\Repository;

interface ProductVariantRepositoryInterface extends RepositoryInterface
{
    public function getProductVariants($productId);

    public function getVariants($productId, $size);

    public function getVariant($productId, $size, $color);
}
