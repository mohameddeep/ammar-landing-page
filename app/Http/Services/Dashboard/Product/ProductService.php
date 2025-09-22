<?php

namespace App\Http\Services\Dashboard\Product;

use App\Http\Helpers\Http;
use App\Http\Traits\FileTrait;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Repository\CategoryRepositoryInterface;
use App\Repository\ProductRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use function App\Http\Helpers\delete_model;
use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;
use function App\Http\Helpers\store_model;
use function App\Http\Helpers\update_model;

class ProductService
{
    use FileTrait;

    public function __construct(
        private ProductRepositoryInterface $repository,
    ) {}

    public function index()
    {
        $products = $this->repository->paginate(relations: ['category', 'images']);

        return view('dashboard.site.products.index', compact('products'));
    }


    public function destroy($id) 
{ 
    DB::beginTransaction(); 
    try { 
        $product = $this->repository->getById($id); 

        foreach ($product->images as $image) {
            $this->deleteFile($image->image);
            $image->delete();  
        }
        $deleted = delete_model($this->repository, $id); 

        DB::commit(); 

        if ($deleted) { 
            return responseSuccess(Http::OK, __('messages.deleted_successfully'), true); 
        } else { 
            return responseFail(Http::NOT_FOUND, __('messages.Not Found or Already Deleted')); 
        } 
    } catch (Exception $e) { 
        DB::rollBack();
        return responseFail(Http::BAD_REQUEST, ['error' => $e->getMessage(), __('messages.Something went wrong')]); 
    } 
}



    public function toggle($id)
    {
        $product = $this->repository->getById($id);
        $product->is_active = ! $product->is_active;
        $product->save();

        return responseSuccess(Http::OK, __('messages.updated_successfully'), ['success' => true, 'is_active' => $product->is_active]);
    }

    public function changeStatus($request, $id)
{
   $request->validated();

    $product = $this->repository->getById($id);
    $product->status = $request->status;
    $product->save();

    return response()->json([
        'success' => true,
        'new_status' => $product->status,
        'new_status_text' => __(
            $product->status == 'approved' 
                ? 'dashboard.approved' 
                : 'dashboard.rejected'
        ),
    ]);
}



public function show($id)
{
    $product = $this->repository->getById($id, relations: ['variants','reviews', 'images', 'category', 'user']);

     $rating = round($product->reviews->avg('rating') ?? 0.0, 1);
        $fullStars = floor($rating);
        $halfStar = ($rating - $fullStars) >= 0.5;
        $reviewsCount = $product->reviews->count();

        $starRatings = [
            5 => $product->reviews->where('rating', 5)->count(),
            4 => $product->reviews->where('rating', 4)->count(),
            3 => $product->reviews->where('rating', 3)->count(),
            2 => $product->reviews->where('rating', 2)->count(),
            1 => $product->reviews->where('rating', 1)->count(),
        ];

        $totalReviews = array_sum($starRatings);

    return view('dashboard.site.products.show', compact('product', 'rating', 'fullStars', 'halfStar', 'reviewsCount', 'starRatings', 'totalReviews'));
}



}
