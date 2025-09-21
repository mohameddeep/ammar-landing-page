<?php

namespace App\Http\Controllers\Dashboard\Provider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Provider\ProviderRequest;
use App\Http\Requests\Dashboard\User\UserRequest;
use App\Http\Services\Dashboard\Provider\ProviderService;
use App\Http\Services\Dashboard\user\UserService;

class ProviderController extends Controller
{
    public function __construct(private readonly ProviderService $provider) {}

   
    public function index()
    {
        return $this->provider->index();
    }

    public function show($id)
    {
        return $this->provider->show($id);
    }

    public function create()
    {
        return $this->provider->create();
    }

    public function store(ProviderRequest $request)
    {
        return $this->provider->store($request);
    }

    public function edit(string $id)
    {
     
        return $this->provider->edit($id);
    }

    public function update(ProviderRequest $request, string $id)
    {

        return $this->provider->update($request, $id);
    }

    public function destroy(string $id)
    {

        return $this->provider->destroy($id);
    }
}
