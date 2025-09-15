<?php

namespace App\Repository;

interface ProductRepositoryInterface
{
    public function getProducts(int $perPage = 10, array $columns = ['*'], array $relations = []);

    public function getCategoryProducts($categoryId, array $columns = ['*'], array $relations = []);

}
