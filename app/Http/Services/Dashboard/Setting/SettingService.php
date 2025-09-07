<?php

namespace App\Http\Services\Dashboard\Setting;

use App\Repository\SettingRepositoryInterface;
use Illuminate\Support\Facades\DB;

class SettingService
{
    public function __construct(private readonly SettingRepositoryInterface $settingRepository) {}

    public function index()
    {
        $settings = $this->settingRepository->getAllSettings();

        return view('dashboard.site.settings.index', compact('settings'));
    }

    public function create()
    {
        return view('dashboard.site.settings.create');
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();

            $setting = $this->settingRepository->create($data);
            DB::commit();

            return redirect()->route('settings.index')->with(['success' => __('messages.created_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function edit($id)
    {
        $setting = $this->settingRepository->getById($id);

        return view('dashboard.site.settings.edit', compact('setting'));
    }

    public function update($request, $id)
    {
        try {
            $setting = $this->settingRepository->getById($id);
            $data = $request->validated();

            $this->settingRepository->update($id, $data);

            return redirect()->route('settings.index')->with(['success' => __('messages.updated_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }

    public function destroy($id)
    {
        try {
            $this->settingRepository->delete($id);

            return redirect()->back()->with(['success' => __('messages.deleted_successfully')]);
        } catch (\Exception $e) {
            return back()->with(['error' => __('messages.Something went wrong')]);
        }
    }
}
