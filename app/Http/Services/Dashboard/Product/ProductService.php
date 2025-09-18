<?php

namespace App\Http\Services\Dashboard\Product;

use App\Http\Helpers\Http;
use App\Http\Traits\FileTrait;
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
        $category = $this->repository->getById($id);
        $category->is_active = ! $category->is_active;
        $category->save();

        return responseSuccess(Http::OK, __('messages.updated_successfully'), ['success' => true, 'is_active' => $category->is_active]);
    }
}
