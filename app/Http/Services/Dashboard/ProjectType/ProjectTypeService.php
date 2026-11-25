<?php

declare(strict_types=1);

namespace App\Http\Services\Dashboard\ProjectType;

use App\Http\Helpers\Http;
use App\Repository\ProjectTypeRepositoryInterface;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

final class ProjectTypeService
{
    public function __construct(
        private readonly ProjectTypeRepositoryInterface $repository,
    ) {}

    public function index()
    {
        $projectTypes = $this->repository->paginateOrdered();

        return view('dashboard.site.project-types.index', compact('projectTypes'));
    }

    public function create()
    {
        return view('dashboard.site.project-types.create');
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function store(array $data)
    {
        $this->repository->create($data);

        return redirect()->route('project-types.index')->with(['success' => __('messages.created_successfully')]);
    }

    public function edit(string $id)
    {
        $projectType = $this->repository->getById($id);

        return view('dashboard.site.project-types.edit', compact('projectType'));
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(array $data, string $id)
    {
        $this->repository->update($id, $data);

        return redirect()->route('project-types.index')->with(['success' => __('messages.updated_successfully')]);
    }

    public function toggle(string $id)
    {
        $projectType = $this->repository->getById($id);
        $projectType->is_active = ! $projectType->is_active;
        $projectType->save();

        return responseSuccess(Http::OK, __('messages.updated_successfully'), ['success' => true, 'is_active' => $projectType->is_active]);
    }

    public function destroy(string $id)
    {
        $projectType = $this->repository->getById($id);

        if ($projectType->pricingRequests()->exists()) {
            // 200 so the shared delete dialog shows this message instead of its generic error.
            return responseFail(Http::OK, __('dashboard.project_type_in_use'), false);
        }

        $projectType->delete();

        return responseSuccess(Http::OK, __('messages.deleted_successfully'), true);
    }
}
