<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Product\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private readonly ProductService $service)
    {
    }

    public function index()
    {
        return $this->service->index();
    }

    public function favourites()
    {
        return $this->service->favourites();
    }

    public function addToFavourite(string $id)
    {
        return $this->service->addToFavourite($id);
    }

    public function removeFromFavourite(string $id)
    {
        return $this->service->removeFromFavourites($id);
    }
}
