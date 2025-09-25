<?php

namespace App\Http\Controllers\Api\V1\ProductVariant;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\ProductVariant\ProductVariantService;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    public function __construct(private ProductVariantService $productVariantService)
    {
    }

    public function index(Request $request)
    {
        return $this->productVariantService->index($request);
    }
}
