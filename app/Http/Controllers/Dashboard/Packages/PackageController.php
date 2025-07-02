<?php

namespace App\Http\Controllers\Dashboard\Packages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Packages\PackageRequest;
use App\Http\Services\Dashboard\Packages\PackageService;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function __construct(private readonly PackageService $service) {}

    public function index()
    {
        return $this->service->index();
    }

    public function store(PackageRequest $request)
    {
        return $this->service->store($request);
    }

    public function create()
    {
        return $this->service->create();
    }

    public function edit($id)
    {
        return $this->service->edit($id);
    }

    public function update(PackageRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }

    public function toggleHidden(Request $request, $id)
    {
        return $this->service->toggleHidden($request, $id);
    }

    public function toggle(Request $request, $id)
    {
        return $this->service->toggle($request, $id);
    }

    public function destroy(string $id)
    {

        return $this->service->destroy($id);
    }
}
