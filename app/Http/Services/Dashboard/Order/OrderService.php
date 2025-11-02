<?php

namespace App\Http\Services\Dashboard\Order;
use App\Http\Helpers\Http;
use Exception;
use App\Http\Services\Mutual\FileManagerService;
use App\Models\Coupon;
use App\Repository\CouponRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class OrderService
{
    public function __construct(
        private readonly OrderRepositoryInterface $repository,
        private readonly CouponRepositoryInterface $couponRepository,
    )
    {}


    public function index($request)
    {
        // $orders = $this->repository->paginate(relations:['provider','address','user']);
        $orders = $this->repository->getOrdersByFilter($request);
        $ordersCount = $this->repository->getCountOrders();

        return view('dashboard.site.orders.index', compact('orders','ordersCount'));
    }

    
    public function show($id)
    {
        $order = $this->repository->getById($id, relations: ['items.product.firstImage','user','provider','address']);
        $coupon = Coupon::where('code', $order->coupon_code)->value('discount') ?? 0;

        return view('dashboard.site.orders.show', compact('order','coupon'));
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->repository->delete($id);
            if ($deleted) {
                    responseSuccess(Http::OK, __('messages.deleted_successfully'), true);
            }

                responseFail(Http::NOT_FOUND, __('messages.Not Found or Already Deleted'));

        } catch (Exception $e) {
                responseFail(Http::BAD_REQUEST, ['error' => $e->getMessage(), __('messages.Something went wrong')]);
        }
    }
    



    public function updateStatus($request, $id)
{
    $order = $this->repository->getById($id);

    $order->order_status = $request->input('order_status');
    $order->save();

    return redirect()->back()->with(['success' => __('messages.updated_successfully')]);

}



}