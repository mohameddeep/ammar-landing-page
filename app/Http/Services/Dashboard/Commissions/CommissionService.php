<?php

namespace App\Http\Services\Dashboard\Commissions;

use App\Http\Helpers\Http;
use App\Repository\CommissionRepositoryInterface;

use function App\Http\Helpers\responseSuccess;

class CommissionService
{
    public function __construct(
        private CommissionRepositoryInterface $repository,
    ) {}

    public function index()
    {
        $commissions = $this->repository->getAll();

        return view('dashboard.site.commissions.index', compact('commissions'));
    }





    public function edit($id)
    {
        $commission = $this->repository->getById($id);
        return view('dashboard.site.commissions.edit', compact('commission'));
    }

    public function update($request, $id)
    {
        try {
            $data = $request->all();
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
