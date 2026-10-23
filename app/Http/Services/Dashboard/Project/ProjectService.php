<?php

declare(strict_types=1);

namespace App\Http\Services\Dashboard\Project;

use App\Http\Helpers\Http;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Repository\ProjectRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

final class ProjectService
{
    private const DISK = 'public';

    /** Text fields copied straight from the validated request. */
    private const FIELDS = [
        'title_ar', 'title_en', 'category_ar', 'category_en', 'city_ar', 'city_en',
        'client_ar', 'client_en', 'summary_ar', 'summary_en', 'content_ar', 'content_en',
        'area', 'year', 'sort_order',
    ];

    public function __construct(
        private readonly ProjectRepositoryInterface $repository,
    ) {}

    public function index()
    {
        $projects = $this->repository->paginateForDashboard(10);

        return view('dashboard.site.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('dashboard.site.projects.create');
    }

    public function store($request)
    {
        $stored = [];

        try {
            DB::transaction(function () use ($request, &$stored) {
                $data = $this->payload($request);
                $data['slug'] = Project::uniqueSlug($request->input('slug') ?: ($data['title_en'] ?: $data['title_ar']));

                if ($request->hasFile('image')) {
                    $data['image'] = $stored[] = $this->upload($request->file('image'), 'projects');
                }

                $project = Project::query()->create($data);
                $stored = array_merge($stored, $this->addGallery($project, $request->file('gallery', [])));
            });
        } catch (Throwable $e) {
            $this->deleteFiles($stored);
            Log::error('Project store failed', ['error' => $e->getMessage()]);

            return back()->withInput()->with(['error' => __('messages.Something went wrong')]);
        }

        return redirect()->route('projects.index')->with(['success' => __('messages.created_successfully')]);
    }

    public function edit($id)
    {
        $project = Project::query()->with('images')->findOrFail($id);

        return view('dashboard.site.projects.edit', compact('project'));
    }

    public function update($request, $id)
    {
        $project = Project::query()->findOrFail($id);
        $stored = [];
        $oldImage = null;

        try {
            DB::transaction(function () use ($request, $project, &$stored, &$oldImage) {
                $data = $this->payload($request);
                $data['slug'] = Project::uniqueSlug(
                    $request->input('slug') ?: ($data['title_en'] ?: $data['title_ar']),
                    $project->id
                );

                if ($request->hasFile('image')) {
                    $oldImage = $project->image;
                    $data['image'] = $stored[] = $this->upload($request->file('image'), 'projects');
                }

                $project->update($data);
                $stored = array_merge($stored, $this->addGallery($project, $request->file('gallery', [])));
            });
        } catch (Throwable $e) {
            $this->deleteFiles($stored);
            Log::error('Project update failed', ['id' => $id, 'error' => $e->getMessage()]);

            return back()->withInput()->with(['error' => __('messages.Something went wrong')]);
        }

        // Old main image is removed only after the new one is saved.
        $this->deleteFiles([$oldImage]);

        return redirect()->route('projects.edit', $project->id)->with(['success' => __('messages.updated_successfully')]);
    }

    public function toggle($id)
    {
        $project = Project::query()->findOrFail($id);
        $project->update(['is_active' => ! $project->is_active]);

        return responseSuccess(Http::OK, __('messages.updated_successfully'), ['success' => true, 'is_active' => $project->is_active]);
    }

    public function destroy($id)
    {
        $project = Project::query()->with('images')->find($id);
        if (! $project) {
            return responseFail(Http::NOT_FOUND, __('messages.Not Found or Already Deleted'));
        }

        $files = array_merge([$project->image], $project->images->pluck('image')->all());
        $project->delete(); // gallery rows cascade
        $this->deleteFiles($files);

        return responseSuccess(Http::OK, __('messages.deleted_successfully'), true);
    }

    public function destroyImage($imageId)
    {
        $image = ProjectImage::query()->find($imageId);
        if (! $image) {
            return responseFail(Http::NOT_FOUND, __('messages.Not Found or Already Deleted'));
        }

        $path = $image->image;
        $image->delete();
        $this->deleteFiles([$path]);

        return responseSuccess(Http::OK, __('messages.deleted_successfully'), true);
    }

    /** @return array<string, mixed> */
    private function payload($request): array
    {
        $data = $request->only(self::FIELDS);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        return $data;
    }

    /**
     * Stores gallery uploads after the current last image.
     *
     * @param  array<int, UploadedFile>|UploadedFile|null  $files
     * @return list<string> stored paths
     */
    private function addGallery(Project $project, array|UploadedFile|null $files): array
    {
        $files = array_filter(is_array($files) ? $files : [$files]);
        $order = (int) $project->images()->max('sort_order');
        $stored = [];

        foreach ($files as $file) {
            $path = $stored[] = $this->upload($file, 'projects/gallery');
            $project->images()->create(['image' => $path, 'sort_order' => ++$order]);
        }

        return $stored;
    }

    /** Unique, hashed filename on the public disk (same relative format as FileTrait). */
    private function upload(UploadedFile $file, string $folder): string
    {
        return $file->store($folder, self::DISK);
    }

    /** @param  array<int, string|null>  $paths */
    private function deleteFiles(array $paths): void
    {
        $paths = array_values(array_filter($paths, fn ($path) => is_string($path) && $path !== '' && ! str_contains($path, '://')));
        if ($paths !== []) {
            Storage::disk(self::DISK)->delete($paths);
        }
    }
}
