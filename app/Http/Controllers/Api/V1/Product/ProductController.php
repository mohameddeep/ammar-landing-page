<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Product\ProductRequest;
use App\Http\Requests\Api\V1\Product\UpdateImagesRequest;
use App\Http\Services\Api\V1\Product\ProductService;
use App\Models\Product;
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

    public function store(ProductRequest $request)
    {
        return $this->service->store($request);
    }
    public function show($id)
    {
        return $this->service->show($id);
    }

    public function update(ProductRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }

    public function favourites()
    {
        return $this->service->favourites();
    }

    public function addToFavourite(Request $request)
    {
        return $this->service->addToFavourite($request);
    }

    public function removeFromFavourite(Request $request)
    {
        return $this->service->removeFromFavourites($request);
    }

    public function stop(string $id)
    {
        return $this->service->stop($id);
    }

    public function continue(string $id)
    {
        return $this->service->continue($id);
    }

    public function related(string $id)
    {
        return $this->service->related($id);
    }

    public function updateImages(UpdateImagesRequest $request, string $id)
    {
        return $this->service->updateImages($request, $id);
    }

    public function getForUser()
    {
        return $this->service->getForUser();
    }
}
