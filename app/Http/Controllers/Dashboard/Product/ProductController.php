<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\ChangeProductStatusRequest;
use App\Http\Services\Dashboard\Product\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private readonly ProductService $service) {}

    public function index(Request $request)
    {

        return $this->service->index($request);
    }

   

    public function toggle($id)
    {
        return $this->service->toggle($id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }

     public function changeStatus(ChangeProductStatusRequest $request, $id){
        return $this->service->changeStatus($request, $id);
     }


     
     public function show($id){
        return $this->service->show($id);
     }
   
}
