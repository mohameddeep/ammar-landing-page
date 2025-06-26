<?php

namespace App\Http\Services\Dashboard\Categories;

use App\Http\Helpers\Http;
use App\Http\Traits\FileTrait;
use App\Repository\CategoryRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use function App\Http\Helpers\delete_model;
use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;
use function App\Http\Helpers\store_model;
use function App\Http\Helpers\update_model;

class CategoryService
{
    use FileTrait;
    public function __construct(
        private CategoryRepositoryInterface $repository,
    ) {}

    public function index()
    {
        $categories = $this->repository->paginate(10);

        return view('dashboard.site.categories.index', compact('categories'));
    }

    public function create()
    {
        $mainCategories = $this->repository->getAll();
        return view('dashboard.site.categories.create', compact('mainCategories'));
    }

    public function store($request)
    {

        DB::beginTransaction();
        try {
            $data = $request->except('id', 'image', '_token', 'is_active');
            $data['is_active'] = $request->is_active == 'on' ? 1 : 0;

            $data['slug'] = Str::slug($data['name_ar']);

            if ($request->hasFile('image')) {
                $data['image'] = $this->image($request->file('image'), 'categories');
            };

            store_model($this->repository, $data, true);

            DB::commit();
            return redirect()->route('categories.index')->with(['success' => __('messages.created_successfully')]);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function edit($id)
    {
        $mainCategories = $this->repository->getAll();
        $category = $this->repository->getById($id);

        return view('dashboard.site.categories.edit', compact('category', 'mainCategories'));
    }




    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $category = $this->repository->getById($id);
            $data = $request->except('id', 'image', 'is_active', '_method', '_token');

            update_model($this->repository, $id, $data);

            DB::commit();
            return redirect()->route('categories.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }


    public function toggle($id)
    {
        $category = $this->repository->getById($id);
        $category->is_active = !$category->is_active;
        $category->save();

        return responseSuccess(Http::OK, __('messages.updated_successfully'),  ['success' => true, 'is_active' => $category->is_active]);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $category = $this->repository->getById($id);
            if ($category->image)
                $this->deleteFile($category->image);
            $deleted =  delete_model($this->repository, $id);
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
