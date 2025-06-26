<?php

namespace App\Http\Services\Dashboard\Packages;

use App\Enums\PackageTypeEnum;
use App\Http\Helpers\Http;
use App\Repository\PackageFeatureRepositoryInterface;
use App\Repository\PackageRepositoryInterface;
use Illuminate\Support\Facades\DB;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;
use function App\Http\Helpers\update_model;

class PackageService
{
    public function __construct(
        private PackageRepositoryInterface $repository,
        private PackageFeatureRepositoryInterface $featureRepository,
    ) {}

    public function index()
    {
        $packages = $this->repository->getAll(relations: ['features']);

        return view('dashboard.site.packages.index', compact('packages'));
    }


    public function create()
    {
        $types = PackageTypeEnum::values();

        return view('dashboard.site.packages.create', compact('types'));
    }



    public function edit($id)
    {
        $types = PackageTypeEnum::values();
        $package = $this->repository->getById($id, relations: ['features']);
        return view('dashboard.site.packages.edit', compact('types', 'package'));
    }
    public function store($request)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $package = $this->repository->create(
                collect($data)->except('features')->toArray()
            );

            foreach ($data['features'] ?? [] as $feature) {
                $this->featureRepository->create([
                    'package_id' => $package->id,
                    'feature_ar' => $feature['feature_ar'] ?? '',
                    'feature_en' => $feature['feature_en'] ?? '',
                    'is_active'  => isset($feature['is_active']) ? 1 : 0,
                ]);
            }
            DB::commit();
            return redirect()->route('packages.index')->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
    public function update($request, $id)
    {
        try {
            DB::beginTransaction();

            $data = $request->validated();
            $packageData = collect($data)->except('features')->toArray();

            update_model($this->repository, $id, $packageData);


            $this->featureRepository->deleteBy(['package_id' => $id]);

            foreach ($data['features'] ?? [] as $feature) {
                $this->featureRepository->create([
                    'package_id' => $id,
                    'feature_ar' => $feature['feature_ar'] ?? '',
                    'feature_en' => $feature['feature_en'] ?? '',
                    'is_active'  => isset($feature['is_active']) ? 1 : 0,
                ]);
            }

            DB::commit();
            return redirect()->route('packages.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }







    public function toggleHidden($request, $id)
    {
        $package = $this->repository->getById($id);

        $package->is_hidden = $request->input('is_hidden');
        $package->save();
        return responseSuccess(Http::OK, __('messages.updated_successfully'), [
            'success' => true,
            'is_hidden' => $package->is_hidden,
        ]);
    }

    public function toggle($request, $id)
    {
        $package = $this->repository->getById($id);

        $package->is_active = $request->input('is_active');
        $package->save();

        return responseSuccess(Http::OK, __('messages.updated_successfully'), [
            'success' => true,
            'is_active' => $package->is_active,
        ]);
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
}
