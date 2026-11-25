<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard\ProjectType;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProjectType\ProjectTypeRequest;
use App\Http\Services\Dashboard\ProjectType\ProjectTypeService;

final class ProjectTypeController extends Controller
{
    public function __construct(private readonly ProjectTypeService $service) {}

    public function index()
    {
        return $this->service->index();
    }

    public function create()
    {
        return $this->service->create();
    }

    public function store(ProjectTypeRequest $request)
    {
        return $this->service->store($request->validated());
    }

    public function edit(string $id)
    {
        return $this->service->edit($id);
    }

    public function update(ProjectTypeRequest $request, string $id)
    {
        return $this->service->update($request->validated(), $id);
    }

    public function toggle(string $id)
    {
        return $this->service->toggle($id);
    }

    public function destroy(string $id)
    {
        return $this->service->destroy($id);
    }
}
