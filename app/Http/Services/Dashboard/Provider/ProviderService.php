<?php

namespace App\Http\Services\Dashboard\Provider;

use App\Http\Helpers\Http;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

class ProviderService
{
    public function __construct(private readonly UserRepositoryInterface $providerRepository) {}

  
    public function index()
    {
        $providers = $this->providerRepository->paginateWithQuery(function($query) {
            $query->where('type', 'provider');
        }, 10);
        return view('dashboard.site.providers.index', compact('providers'));
    }

    public function create()
    {
        return view('dashboard.site.providers.create');
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();

            $provider = $this->providerRepository->create($data);
            DB::commit();

            return redirect()->route('providers.index')->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function show($id)
    {
        $provider = $this->providerRepository->getById($id);

        return view('dashboard.site.providers.show', compact('provider'));
    }

    public function edit($id)
    {
        $provider = $this->providerRepository->getById($id);

        return view('dashboard.site.providers.edit', compact('provider'));
    }

    public function update($request, $id)
    {
        try {
            $provider = $this->providerRepository->getById($id);
            $data = $request->validated();
            if ($data['password'] == null) {
                unset($data['password']);
            }
            $this->providerRepository->update($id, $data);

            return redirect()->route('providers.update', $provider->id)->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id)
    {
        try {
            $deleted = $this->providerRepository->delete($id);
            if ($deleted) {
                return responseSuccess(Http::OK, __('messages.deleted_successfully'), true);
            } else {
                return responseFail(Http::NOT_FOUND, __('messages.Not Found or Already Deleted'));
            }
        } catch (\Exception $e) {
            return responseFail(Http::BAD_REQUEST, ['error' => $e->getMessage(), __('messages.Something went wrong')]);
        }
    }

}
