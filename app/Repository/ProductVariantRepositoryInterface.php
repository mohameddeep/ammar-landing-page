<?php

namespace App\Repository;

interface ProductVariantRepositoryInterface extends RepositoryInterface
{
    public function getProductVariants($productId);

}
