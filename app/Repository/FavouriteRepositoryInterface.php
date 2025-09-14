<?php

namespace App\Repository;

interface FavouriteRepositoryInterface extends RepositoryInterface
{
    public function removeByProductId(string $productId);
}
