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
    public function chooseContent()
    {
        $content = $this->repository->getFirstByKey("content_one");

        return view('dashboard.site.landing-page.edit', compact('content'));
    }



    public function features()
    {
        $features = $this->repository->getByKey("feature");

        return view('dashboard.site.landing-page.features', compact('features'));
    }
    public function expirenceContent()
    {
        $content = $this->repository->getFirstByKey("content_two");

        return view('dashboard.site.landing-page.edit', compact('content'));
    }

     public function discover()
    {
        $discovers = $this->repository->getByKey("discover");

        return view('dashboard.site.landing-page.discover', compact('discovers'));
    }
    public function downloadSection()
    {
        $content = $this->repository->getFirstByKey("ready_to_transform");

        return view('dashboard.site.landing-page.edit', compact('content'));
    }

    public function edit($id)
    {
        $content = $this->repository->getById($id);

        return view('dashboard.site.landing-page.edit', compact('content'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $content = $this->repository->getById($id);
            $data = $request->except('id', 'image', '_method', '_token');
            if ($request->hasFile('image')) {
                $data['image'] = $this->image($request->file('image'), 'landing-pages');
            }

            update_model($this->repository, $id, $data);

            DB::commit();

            return redirect()->back()->with(['success' => __('messages.updated_successfully')]);
        } catch (Exception $e) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
}
