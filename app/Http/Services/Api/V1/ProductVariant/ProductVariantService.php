<?php

namespace App\Http\Services\Api\V1\ProductVariant;

use App\Http\Resources\V1\ProductVariant\AvilableVariantResource;
use App\Repository\ProductVariantRepositoryInterface;
use function App\Http\Helpers\responseSuccess;

class ProductVariantService
{
    public function __construct(private ProductVariantRepositoryInterface $repository){}

    public function index($request)
    {
        $variants = $this->repository->getVariants($request->product_id, $request->size);
        return responseSuccess(data: AvilableVariantResource::collection($variants));
    }
}
