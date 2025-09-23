<?php

namespace App\Http\Services\Dashboard\Order;
use App\Http\Helpers\Http;
use Exception;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class OrderService
{
    public function __construct(private readonly OrderRepositoryInterface $repository)
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

        return view('dashboard.site.orders.show', compact('order'));
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


}