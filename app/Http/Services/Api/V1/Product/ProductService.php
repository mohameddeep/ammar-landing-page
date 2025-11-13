<?php

namespace App\Http\Services\Api\V1\Product;

use App\Http\Resources\V1\Product\ProductDetailResource;
use App\Http\Resources\V1\Product\ProductResource;
use App\Http\Traits\FileTrait;
use App\Jobs\CheckForNewViewerForProduct;
use App\Models\Product;
use App\Repository\FavouriteRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
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
        $response = Gate::inspect('create', Product::class);
        if ($response->denied())
        return responseFail(message: __('messages.your_subscription_ended'));
        DB::beginTransaction();
        try {
            $data = $request->except('images', 'variants');
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
            $this->addVariants($product, $request->variants);
            $subscription = auth('api')->user()->currentSubscription();
            if ($subscription) {
                $subscription->decrement('dress_count');
            }
            DB::commit();
            return responseSuccess(message: __('messages.created successfully'), data: new ProductDetailResource($product));
        }catch (\Exception $e){
            DB::rollBack();
//            dd($e);
            return responseFail(message: $e->getMessage());
        }
    }

    public function show($id)
    {
        $product = $this->productRepository->getById($id, relations: ['user', 'category', 'reviews.user', 'variants', 'images', 'views']);
        if( auth('api')->user()){
        $viewer = auth('api')->user();
        dispatch(new CheckForNewViewerForProduct($product, $viewer));
        }

        return responseSuccess(data: new ProductDetailResource($product));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('images', 'variants', '_method');
            $product = $this->productRepository->getById($id, relations: ['user', 'category', 'reviews.user', 'variants', 'images']);
            if ($request->has('images')) {
                $product->images()->delete();
                $images = $request->images;
                foreach ($images as $image) {
                    $image = $this->image($image, 'product/images');
                    $product->images()->create([
                        'image' => $image,
                    ]);
                }
            }
            $product->variants()->delete();
            $this->addVariants($product, $request->variants);
            $this->productRepository->update($id, $data);
            DB::commit();
            $product = $this->productRepository->getById($id, relations: ['user', 'category', 'reviews.user', 'variants']);
            return responseSuccess(message: __('messages.updated_successfully'), data: new ProductDetailResource($product));
        }catch (\Exception $e){
            DB::rollBack();
            return responseFail(message: __('dashboard.Something went wrong!'));
        }
    }

    public function destroy($id)
    {
        $product = $this->productRepository->getById($id, relations: ['user', 'category', 'reviews.user']);
        $response = Gate::inspect('delete', $product);
        if ($response->denied())
            return responseFail(message: __('messages.unauthorized'));
        $this->productRepository->delete($id);
        return responseSuccess(message: __('messages.deleted_successfully'));
    }


    public function favourites()
    {
        $favourites = auth('api')->user()->favourites;
        $favourites->load('user', 'category', 'images');
        return responseSuccess(data: ProductResource::collection($favourites));
    }

    public function addToFavourite($request)
    {


        $userId = auth('api')->id();
    $productId = $request->product_id;

    $exists = $this->productRepository->checkProductAddToFavourite($productId);

    if ($exists) {
        return responseFail(message: __('messages.product_already_in_favourite'));
    }

        $this->favouriteRepository->create([
            'product_id' => $request->product_id,
            'user_id' => auth('api')->id()
        ]);

        return responseSuccess(message: __('messages.product_added_to_favourite'));
    }

    public function removeFromFavourites($request)
    {
        $this->favouriteRepository->removeByProductId($request->product_id);
        return responseSuccess();
    }

    public function stop($id)
    {
        $this->productRepository->update($id, [
            'is_stopped' => 1
        ]);
        return responseSuccess();
    }

    public function continue($id)
    {
        Gate::authorize('create', Product::class);
        $this->productRepository->update($id, [
            'is_stopped' => 0
        ]);
        return responseSuccess();
    }

    public function related($id)
    {
        $product = $this->productRepository->getById($id);
        $products = $this->productRepository->getRelated($product, relations: ['user', 'category', 'reviews.user', 'variants', 'images']);
        return responseSuccess(data: ProductResource::collection($products));
    }

    public function updateImages($request, $id)
    {
        $product = $this->productRepository->getById($id, relations: ['user', 'category', 'reviews.user', 'images']);
        if ($request->has('deleted_images')) {
            foreach ($request->deleted_images as $image) {
                $product->images()->where('id', $image)->delete();
            }
        }
        if ($request->has('images')) {
            $images = $request->images;
            foreach ($images as $image) {
                $image = $this->image($image, 'product/images');
                $product->images()->create([
                    'image' => $image,
                ]);
            }
        }
        $product->refresh();
        return responseSuccess(data: new ProductDetailResource($product));
    }

    public function getForUser()
    {
        $products = $this->productRepository->getForUser(relations: ['user', 'category', 'reviews.user', 'variants', 'images']);
        return responseSuccess(data: ProductResource::collection($products));
    }

    public function review($request, $id)
    {
        $product = $this->productRepository->getById($id, relations: ['user', 'category', 'reviews.user']);
        $product->reviews()->create([
            'user_id' => auth('api')->id(),
            'rating' => $request->rating,
            'comment' => $request->comment ?? null,
        ]);
        return responseSuccess(message: __('messages.created successfully'));
    }

    private function addVariants($product, $variants)
    {
        foreach ($variants as $variant)
        {
            $size  = $variant['size'];
            $colors = $variant['colors'];
            foreach ($colors as $color)
            {
                $product->variants()->create([
                    'size' => $size,
                    'color' => $color['color'],
                    'quantity' => $color['quantity'],
                ]);
            }
        }
    }

}
