<?php

namespace App\Http\Services\Dashboard\Coupon;

use App\Http\Helpers\Http;
use App\Repository\CouponRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class CouponService
{
    public function __construct(
        private readonly CouponRepositoryInterface $couponRepository,
    ) {}

    public function index() 
{ 
    $coupons = $this->couponRepository->paginateWithQuery(function($query) {  
        $query->where('type', 'admin'); 
    }, 20); 

    return view('dashboard.site.coupons.index', compact('coupons')); 
    }

    public function create()
    {

        return view('dashboard.site.coupons.create');
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $this->couponRepository->create($data);
            DB::commit();

            return redirect()->route('dashobard.coupons.index')->with(['success' => 'تم الاضافه بنجاح']);
        } catch (Exception $exception) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function edit($id)
    {
        $coupon = $this->couponRepository->getById($id);

        return view('dashboard.site.coupons.edit', compact('coupon'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $this->couponRepository->update($id, $data);

            DB::commit();

            return redirect()->route('dashobard.coupons.index')->with(['success' => 'تم التعديل بنجاح']);
        } catch (Exception $exception) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->couponRepository->delete($id);
            if ($deleted) {
                return responseSuccess(Http::OK, __('messages.deleted_successfully'), true);
            }

            return responseFail(Http::NOT_FOUND, __('messages.Not Found or Already Deleted'));

        } catch (Exception $e) {
            return responseFail(Http::BAD_REQUEST, ['error' => $e->getMessage(), __('messages.Something went wrong')]);
        }
    }
}
