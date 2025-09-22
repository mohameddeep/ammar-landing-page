<?php

namespace App\Http\Controllers\Api\V1\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Cart\CartRequest;
use App\Http\Services\Api\V1\Cart\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function __construct(private CartService $cartService)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->cartService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CartRequest $request)
    {
        return $this->cartService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->cartService->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CartRequest $request, string $id)
    {
        return $this->cartService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->cartService->destroy($id);
    }
    public function empty( $id)
    {
        return $this->cartService->empty($id);
    }
}
