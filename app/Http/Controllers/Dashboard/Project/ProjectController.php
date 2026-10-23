<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Project\StoreProjectRequest;
use App\Http\Requests\Dashboard\Project\UpdateProjectRequest;
use App\Http\Services\Dashboard\Project\ProjectService;

final class ProjectController extends Controller
{
    public function __construct(private readonly ProjectService $project) {}

    public function index()
    {
        return $this->project->index();
    }

    public function create()
    {
        return $this->project->create();
    }

    public function store(StoreProjectRequest $request)
    {
        return $this->project->store($request);
    }

    public function edit(string $id)
    {
        return $this->project->edit($id);
    }

    public function update(UpdateProjectRequest $request, string $id)
    {
        return $this->project->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->project->destroy($id);
    }

    public function toggle($id)
    {
        return $this->project->toggle($id);
    }

    public function destroyImage($image)
    {
        return $this->project->destroyImage($image);
    }
}
