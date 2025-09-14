<?php

namespace App\Http\Services\Api\V1\Product;

use App\Http\Resources\V1\Product\ProductResource;
use App\Repository\FavouriteRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use function App\Http\Helpers\paginatedJsonResponse;
use function App\Http\Helpers\responseSuccess;

class ProductService
{
    public function __construct(private readonly ProductRepositoryInterface $productRepository,
                                private readonly FavouriteRepositoryInterface $favouriteRepository)
    {

    }

    public function index()
    {
        $products = $this->productRepository->getProducts();
        return paginatedJsonResponse(data: ['items' => ProductResource::collection($products)]);
    }

    public function favourites()
    {
        $favourites = auth('api')->user()->favourites;
//        dd($favourites);
        return responseSuccess(data: ProductResource::collection($favourites));
    }

    public function addToFavourite(string $id)
    {
        $this->favouriteRepository->create([
            'product_id' => $id,
            'user_id' => auth('api')->id()
        ]);

        return responseSuccess(message: __('product_added_to_favourite'));
    }

    public function removeFromFavourites(string $id)
    {
        $this->favouriteRepository->removeByProductId($id);
        return responseSuccess();
    }

}
