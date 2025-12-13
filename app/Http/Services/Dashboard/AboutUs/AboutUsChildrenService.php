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

final class AboutUsChildrenService
{
    use FileTrait;

    public function __construct(
        private readonly AboutUsRepositoryInterface $repository,
    ) {}

    public function index($id)
    {
        $abouts = $this->repository->paginateWithQuery(function($query) use($id){
            $query->Where("parent_id",$id);
        },20);
         $parent=$this->repository->getById($id);

        return view('dashboard.site.about-us.children.index', compact('abouts','parent'));
    }

    public function create($id)
    {
         $parent=$this->repository->getById($id);
        return view('dashboard.site.about-us.children.create',compact('parent'));
    }

    public function store($request,$id)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('image', '_token', 'is_active');
            $parent=$this->repository->getById($id);
            $data['is_active'] = $request->is_active == 'on' ? 1 : 0;

            if ($request->hasFile('image')) {
                $data['image'] = $this->image($request->file('image'), 'abouts');
            }

            store_model($this->repository, $data, true);

            DB::commit();

            return redirect()->route('abouts.children.index',$parent->id)->with(['success' => __('messages.created_successfully')]);
        } catch (Exception $e) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function edit($id)
    {
        $about = $this->repository->getById($id);
        
        return view('dashboard.site.about-us.children.edit', compact('about'));
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

            return redirect()->route('abouts.children.index', $about->parent_id)->with(['success' => __('messages.updated_successfully')]);
        } catch (Exception $e) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    
}
