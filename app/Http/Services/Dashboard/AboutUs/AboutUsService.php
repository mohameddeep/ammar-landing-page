<?php

declare(strict_types=1);

namespace App\Http\Services\Dashboard\AboutUs;

use App\Http\Helpers\Http;
use App\Http\Traits\FileTrait;
use App\Repository\AboutUsRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

use function App\Http\Helpers\delete_model;
use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;
use function App\Http\Helpers\store_model;
use function App\Http\Helpers\update_model;

final class AboutUsService
{
    use FileTrait;

    public function __construct(
        private readonly AboutUsRepositoryInterface $repository,
    ) {}

    public function index()
    {
        $abouts = $this->repository->paginateWithQuery(function($query){
            $query->WhereNull("parent_id");
        },20);

        return view('dashboard.site.about-us.index', compact('abouts'));
    }

    public function create()
    {
        return view('dashboard.site.about-us.create');
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('image', '_token', 'is_active');
            $data['is_active'] = $request->is_active == 'on' ? 1 : 0;

            if ($request->hasFile('image')) {
                $data['image'] = $this->image($request->file('image'), 'abouts');
            }

            store_model($this->repository, $data, true);

            DB::commit();

            return redirect()->route('abouts.index')->with(['success' => __('messages.created_successfully')]);
        } catch (Exception $e) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function edit($id)
    {
        $about = $this->repository->getById($id);
        
        return view('dashboard.site.about-us.edit', compact('about'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $about = $this->repository->getById($id);
            $data = $request->except('id', 'image', 'is_active', '_method', '_token');
            if ($request->hasFile('image')) {
                $data['image'] = $this->image($request->file('image'), 'abouts');
            }
            update_model($this->repository, $id, $data);

            DB::commit();

            return redirect()->route('abouts.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (Exception $e) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function toggle($id)
    {
        $about = $this->repository->getById($id);
        $about->is_active = ! $about->is_active;
        $about->save();

        return responseSuccess(Http::OK, __('messages.updated_successfully'), ['success' => true, 'is_active' => $about->is_active]);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $about = $this->repository->getById($id);
            if ($about->image) {
                $this->deleteFile($about->image);
            }
            $deleted = delete_model($this->repository, $id);
            DB::commit();
            if ($deleted) {
                return responseSuccess(Http::OK, __('messages.deleted_successfully'), true);
            } else {
                return responseFail(Http::NOT_FOUND, __('messages.Not Found or Already Deleted'));
            }
        } catch (Exception $e) {
            return responseFail(Http::BAD_REQUEST, ['error' => $e->getMessage(), __('messages.Something went wrong')]);
        }
    }
}
