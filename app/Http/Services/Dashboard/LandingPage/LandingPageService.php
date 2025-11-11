<?php

namespace App\Http\Services\Dashboard\LandingPage;

use App\Http\Traits\FileTrait;
use App\Repository\LandingPageRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function App\Http\Helpers\update_model;

class LandingPageService
{
    use FileTrait;

    public function __construct(
        private LandingPageRepositoryInterface $repository,
    ) {}

    public function header()
    {
        $content = $this->repository->getFirstByKey("header");

        return view('dashboard.site.landing-page.edit', compact('content'));
    }


    public function edit($id)
    {
         $content = $this->repository->getFirstByKey("slider");

        return view('dashboard.site.landing-page.edit', compact('content'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $category = $this->repository->getById($id);
            $data = $request->except('id', 'image', '_method', '_token');
         if ($request->hasFile('image')) {
                $data['image'] = $this->image($request->file('image'), 'landing-pages');
            }

            update_model($this->repository, $id, $data);

            DB::commit();

            return redirect()->route('categories.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (Exception $e) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

  
}
