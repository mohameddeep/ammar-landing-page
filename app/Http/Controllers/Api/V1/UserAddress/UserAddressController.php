<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\UserAddress;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\UserAddress\ChangeUserAddressRequest;
use App\Http\Requests\Api\V1\UserAddress\UserAddressRequest;
use App\Http\Services\Api\V1\UserAddress\UserAddressService;

final class UserAddressController extends Controller
{
    public function __construct(private UserAddressService $userAddressService) {}

    public function index()
    {
        return $this->userAddressService->index();
    }

    public function show($id)
    {
        return $this->userAddressService->show($id);
    }

    public function store(UserAddressRequest $request)
    {
        return $this->userAddressService->store($request);
    }

    public function update($id, UserAddressRequest $request)
    {
        return $this->userAddressService->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->userAddressService->destroy($id);
    }

    public function changeAddressStatus($id, ChangeUserAddressRequest $request)
    {
        return $this->userAddressService->changeAddressStatus($id, $request);
    }
}
