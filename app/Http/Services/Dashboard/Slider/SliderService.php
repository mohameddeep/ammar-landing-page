<?php

declare(strict_types=1);

namespace App\Http\Services\Dashboard\Slider;

use App\Http\Helpers\Http;
use App\Http\Traits\FileTrait;
use App\Repository\SliderRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

use function App\Http\Helpers\delete_model;
use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;
use function App\Http\Helpers\store_model;
use function App\Http\Helpers\update_model;

final class SliderService
{
    use FileTrait;

    public function __construct(
        private readonly SliderRepositoryInterface $repository,
    ) {}

    public function index()
    {
        $sliders = $this->repository->paginate(10);

        return view('dashboard.site.sliders.index', compact('sliders'));
    }

    public function create()
    {

        return view('dashboard.site.sliders.create');
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('image', '_token', 'is_active');
            $data['is_active'] = $request->is_active == 'on' ? 1 : 0;

            if ($request->hasFile('image')) {
                $data['image'] = $this->image($request->file('image'), 'sliders');
            }

            store_model($this->repository, $data, true);

            DB::commit();

            return redirect()->route('sliders.index')->with(['success' => __('messages.created_successfully')]);
        } catch (Exception $e) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function edit($id)
    {
        $slider = $this->repository->getById($id);

        return view('dashboard.site.sliders.edit', compact('slider'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $slider = $this->repository->getById($id);
            $data = $request->except('id', 'image', 'is_active', '_method', '_token');

            update_model($this->repository, $id, $data);

            DB::commit();

            return redirect()->route('sliders.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (Exception $e) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function toggle($id)
    {
        $slider = $this->repository->getById($id);
        $slider->is_active = ! $slider->is_active;
        $slider->save();

        return responseSuccess(Http::OK, __('messages.updated_successfully'), ['success' => true, 'is_active' => $slider->is_active]);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $slider = $this->repository->getById($id);
            if ($slider->image) {
                $this->deleteFile($slider->image);
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
