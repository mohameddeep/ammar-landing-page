<?php

namespace App\Http\Services\Dashboard\Packages;

use App\Http\Helpers\Http;
use App\Repository\PackageRepositoryInterface;

use function App\Http\Helpers\responseSuccess;

class PackageService
{
    public function __construct(
        private PackageRepositoryInterface $repository,
    ) {}

    public function index()
    {
        $packages = $this->repository->getAll(relations: ['features']);

        return view('dashboard.site.packages.index', compact('packages'));
    }





    public function edit($id)
    {
        $commission = $this->repository->getById($id);
        return view('dashboard.site.commissions.edit', compact('commission'));
    }

    public function update($request, $id)
    {
        try {
            $data = $request->validated();
            $commission = $this->repository->update($id, $data);
            return redirect()->route('commissions.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }




    public function toggle($request, $id)
    {
        $commission = $this->repository->getById($id);

        $commission->is_active = $request->input('is_active');
        $commission->save();

        return responseSuccess(Http::OK, __('messages.updated_successfully'), [
            'success' => true,
            'is_active' => $commission->is_active,
        ]);
    }
}
