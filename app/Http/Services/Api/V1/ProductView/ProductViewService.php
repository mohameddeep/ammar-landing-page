<?php

namespace App\Http\Services\Api\V1\ProductView;

use App\Repository\ProductViewRepositoryInterface;

class ProductViewService
{
    public function __construct(private ProductViewRepositoryInterface $repository){}


}