<?php

namespace App\Http\Controllers\Dashboard\Merchant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Merchant\MerchantRequest;
use App\Http\Services\Dashboard\Merchant\MerchantService;

class MerchantController extends Controller
{
    public function __construct(private readonly MerchantService $service) {}

    public function index()
    {
        return $this->service->index();
    }

    public function show($id)
    {
        return $this->service->show($id);
    }

    public function create()
    {
        return $this->service->create();
    }

    public function store(MerchantRequest $request)
    {
        return $this->service->store($request);
    }

    public function edit(string $id)
    {
        return $this->service->edit($id);
    }

    public function update(MerchantRequest $request, string $id)
    {
        return $this->service->update($request, $id);
    }

    public function destroy(string $id)
    {

        return $this->service->destroy($id);
    }

    public function toggleActivate($id)
    {
        return $this->service->toggleActivate($id);
    }

    public function toggleFeature($id)
    {
        return $this->service->toggleFeature($id);
    }
}
