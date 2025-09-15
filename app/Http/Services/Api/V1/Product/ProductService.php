<?php

namespace App\Http\Services\Api\V1\Product;

use App\Http\Resources\V1\Product\ProductDetailResource;
use App\Http\Resources\V1\Product\ProductResource;
use App\Http\Traits\FileTrait;
use App\Repository\FavouriteRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;
use function App\Http\Helpers\paginatedJsonResponse;
use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class ProductService
{
    use FileTrait;
    public function __construct(private readonly ProductRepositoryInterface $productRepository,
                                private readonly FavouriteRepositoryInterface $favouriteRepository)
    {

    }

    public function index()
    {
        $products = $this->productRepository->getProducts(relations: ['user', 'category', 'images']);
        return paginatedJsonResponse(data: ['items' => ProductResource::collection($products)]);
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('images', 'sizes', 'colors');
            $data['user_id'] = auth('api')->id();
            $product = $this->productRepository->create($data);
            if ($request->has('images')) {
                $images = $request->images;
                foreach ($images as $image) {
                    $image = $this->image($image, 'product/images');
                    $product->images()->create([
                        'image' => $image,
                    ]);
                }
            }
            if ($request->has('sizes')) {
                $this->addVariants($product, $request->sizes, 'size');
            }
            if ($request->has('colors')) {
                $this->addVariants($product, $request->colors, 'color');
            }
            $subscription = auth('api')->user()->currentSubscription;
            if ($subscription) {
                $subscription->decrement('dress_count');
            }
            DB::commit();
            return responseSuccess(message: __('messages.created successfully'), data: new ProductDetailResource($product));
        }catch (\Exception $e){
            DB::rollBack();
            return responseFail(message: __('dashboard.Something went wrong!'));
        }
    }

    public function show($id)
    {
        $product = $this->productRepository->getById($id, relations: ['user', 'category', 'reviews.user', 'variants', 'images']);
        return responseSuccess(data: new ProductDetailResource($product));
    }


    public function favourites()
    {
        $favourites = auth('api')->user()->favourites;
        $favourites->load('user', 'category');
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

    private function addVariants($product, $values, $type)
    {
        $product->variants()->createMany(
            collect($values)->map(fn($value) => [
                'type'  => $type,
                'value' => $value,
            ])->toArray()
        );
    }

}
