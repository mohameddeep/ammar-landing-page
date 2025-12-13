<?php

declare(strict_types=1);

namespace App\Http\Services\Dashboard\Service;

use App\Http\Helpers\Http;
use App\Http\Traits\FileTrait;
use App\Repository\ServiceRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;

use function App\Http\Helpers\delete_model;
use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;
use function App\Http\Helpers\store_model;
use function App\Http\Helpers\update_model;

final class ServiceService
{
    use FileTrait;

    public function __construct(
        private readonly ServiceRepositoryInterface $repository,
    ) {}

    public function index()
    {
        $services = $this->repository->paginate(10);

        return view('dashboard.site.services.index', compact('services'));
    }

    public function create()
    {
        return view('dashboard.site.services.create');
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {
            $data = $request->except('image', '_token', 'is_active');
            $data['is_active'] = $request->is_active == 'on' ? 1 : 0;

            if ($request->hasFile('image')) {
                $data['image'] = $this->image($request->file('image'), 'services');
            }

            store_model($this->repository, $data, true);

            DB::commit();

            return redirect()->route('services.index')->with(['success' => __('messages.created_successfully')]);
        } catch (Exception $e) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function edit($id)
    {
        $service = $this->repository->getById($id);
        
        return view('dashboard.site.services.edit', compact('service'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            // $service = $this->repository->getById($id); // Unused variable
            $data = $request->except('id', 'image', 'is_active', '_method', '_token');
            $data['is_active'] = $request->input('is_active') == 'on' || $request->input('is_active') == 1 ? 1 : 0; 
            // Note: UpdateServiceRequest merge prepared is_active, but SliderService handled it manually too? 
            // SliderService logic: $data['is_active'] was NOT explicitly set in update??
            // Wait, SliderService update: $data = $request->except(...)
            // Does it handle is_active?
            // SliderService checks $request->hasFile('image').
            // SliderService update method REMOVES 'is_active' from data via `except`.
            // DOES IT NOT UPDATE IS_ACTIVE in update()?
            // Ah, toggle() handles is_active. Maybe edit/update DOES NOT support changing is_active? The form might not have it.
            // But looking at SliderService::store, it sets is_active.
            // Looking at SliderService::update, it explicitly excludes is_active.
            // I will follow SliderService's pattern for update (exclude is_active) if that's the intention,
            // OR I will include it if `UpdateServiceRequest` prepares it.
            // The `UpdateServiceRequest` I wrote prepares `is_active`.
            // Let's check SliderService again.
            // line 74: $data = $request->except('id', 'image', 'is_active', '_method', '_token');
            // So SliderService update() does NOT update is_active. is_active is updated via toggle().
            // I will do the same to match the pattern.
            
            if ($request->hasFile('image')) {
                $data['image'] = $this->image($request->file('image'), 'services');
            }
            update_model($this->repository, $id, $data);

            DB::commit();

            return redirect()->route('services.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (Exception $e) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function toggle($id)
    {
        $service = $this->repository->getById($id);
        $service->is_active = ! $service->is_active;
        $service->save();

        return responseSuccess(Http::OK, __('messages.updated_successfully'), ['success' => true, 'is_active' => $service->is_active]);
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $service = $this->repository->getById($id);
            if ($service->image) {
                $this->deleteFile($service->image);
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
