<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\Product\ProductService;

class ProductController extends Controller
{
    public function __construct(private readonly ProductService $service) {}

    public function index()
    {

        return $this->service->index();
    }

   

    public function toggle($id)
    {
        return $this->service->toggle($id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
