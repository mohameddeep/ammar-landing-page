<?php

namespace App\Http\Controllers\Dashboard\Coupon;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Coupon\CouponRequest;
use App\Http\Services\Dashboard\Coupon\CouponService;

class CouponController extends Controller
{
    public function __construct(
        private readonly CouponService $service,
    )
    {
    }
    public function index(){
        return $this->service->index();
    }

    public function create(){
        return $this->service->create();
    }

    public function store(CouponRequest $request){
        return $this->service->store($request);
    }

    public function edit($id){
        return $this->service->edit($id);
    }
    public function update(CouponRequest $request,$id){
        return $this->service->update($request,$id);
    }
    public function destroy($id){
        return $this->service->destroy($id);
    }

}
