<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Categories\CategoryRequest;
use App\Http\Services\Dashboard\Categories\CategoryService;

class CategoryController extends Controller
{
    public function __construct(private readonly CategoryService $service) {}

    public function index()
    {

        return $this->service->index();
    }

    public function create()
    {
        return $this->service->create();
    }

    public function store(CategoryRequest $request)
    {
        return $this->service->store($request);
    }

    public function edit(string $id)
    {
        return $this->service->edit($id);
    }

    public function update(CategoryRequest $request, string $id)
    {
        return $this->service->update($request, $id);
    }

    public function toggle($id)
    {
        return $this->service->toggle($id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
