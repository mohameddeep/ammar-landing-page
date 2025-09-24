<?php

namespace App\Http\Controllers\Dashboard\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Setting\StoreSettingRequest;
use App\Http\Requests\Dashboard\Setting\UpdateSettingRequest;
use App\Http\Services\Dashboard\Setting\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(private readonly SettingService $Setting) {}

    // public function index()
    // {
    //     return $this->Setting->index();
    // }

    // public function create()
    // {
    //     return $this->Setting->create();
    // }

    // public function store(StoreSettingRequest $request)
    // {
    //     return $this->Setting->store($request);
    // }

    public function edit()
    {
        return $this->Setting->edit();
    }

    public function update(Request $request)
    {
        return $this->Setting->update($request);
    }

    // public function destroy(string $id)
    // {
    //     return $this->Setting->destroy($id);
    // }
}
