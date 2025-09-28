<?php

namespace App\Http\Controllers\Dashboard\OrderReturn;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\OrderReturn\OrderReturnService;
use Illuminate\Http\Request;

class OrderReturnController extends Controller
{
    public function __construct(private OrderReturnService $orderReturnService)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->orderReturnService->index();
    }

    public function show(string $id)
    {
        return $this->orderReturnService->show($id);
    }

    public function destroy(string $id)
    {
        //
    }

    public function accept(string $id)
    {
        return $this->orderReturnService->accept($id);
    }

    public function reject(string $id)
    {
        return $this->orderReturnService->reject($id);
    }
}
