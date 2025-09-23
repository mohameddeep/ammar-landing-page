<?php

namespace App\Repository;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getProducts(int $perPage = 10, array $columns = ['*'], array $relations = []);

    public function getCategoryProducts($categoryId, array $columns = ['*'], array $relations = []);

    public function getRelated($product, array $columns = ['*'], array $relations = [], $count = 4);

        public function checkProductAddToFavourite($productId);
            public function getProductsByFilter($request);

    public function getForUser(int $perPage = 10, array $columns = ['*'], array $relations = []);


}
