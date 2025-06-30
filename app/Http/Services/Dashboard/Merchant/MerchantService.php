<?php

namespace App\Http\Services\Dashboard\Merchant;

use App\Http\Helpers\Http;
use App\Repository\MerchantRepositoryInterface;
use App\Repository\RoleRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class MerchantService
{
    public function __construct(
        private readonly MerchantRepositoryInterface $repository,
        private RoleRepositoryInterface $roleRepository,
    ) {}

    public function index()
    {
        $merchants = $this->repository->paginate(10);
        return view('dashboard.site.merchants.index', compact('merchants'));
    }

    public function create()
    {
        return view('dashboard.site.merchants.create');
    }

    public function show($id)
    {
        $merchant = $this->repository->getById($id, relations: ['products', 'packages']);

        return view('dashboard.site.merchants.show', compact('merchant'));
    }
    public function store($request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();


            $user = $this->repository->create($data);
            DB::commit();
            return redirect()->route('users.index', $user->id)->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }


    public function update($request, $id)
    {
        try {
            $user = $this->repository->getById($id);
            $data = $request->validated();
            if ($data['password'] == null) {
                unset($data['password']);
            }
            $this->repository->update($id, $data);
            return redirect()->route('users.update', $user->id)->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->repository->delete($id);
            if ($deleted) {
                return responseSuccess(Http::OK, __('messages.deleted_successfully'), true);
            } else {
                return responseFail(Http::NOT_FOUND, __('messages.Not Found or Already Deleted'));
            }
        } catch (\Exception $e) {
            return responseFail(Http::BAD_REQUEST, ['error' => $e->getMessage(), __('messages.Something went wrong')]);
        }
    }

    public function toggleActivate($id)
    {
        $merchant = $this->repository->getById($id);
        $merchant->is_active = !$merchant->is_active;
        $merchant->save();

        return responseSuccess(Http::OK, __('messages.updated_successfully'),  ['success' => true, 'is_active' => $merchant->is_active]);
    }
    public function toggleFeature($id)
    {
        $merchant = $this->repository->getById($id);
        $merchant->is_featured = !$merchant->is_featured;
        $merchant->save();

        return responseSuccess(Http::OK, __('messages.updated_successfully'),  ['success' => true, 'is_featured' => $merchant->is_active]);
    }
}
