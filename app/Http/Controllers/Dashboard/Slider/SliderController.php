<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard\Slider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Slider\StoreSliderRequest;
use App\Http\Requests\Dashboard\Slider\UpdateSliderRequest;
use App\Http\Services\Dashboard\Slider\SliderService;

final class SliderController extends Controller
{
    public function __construct(private readonly SliderService $slider) {}

    public function index()
    {
        return $this->slider->index();
    }

    public function create()
    {
        return $this->slider->create();
    }

    public function store(StoreSliderRequest $request)
    {
        return $this->slider->store($request);
    }

    public function edit(string $id)
    {
        return $this->slider->edit($id);
    }

    public function update(UpdateSliderRequest $request, string $id)
    {
        return $this->slider->update($request, $id);
    }

    public function destroy($id)
    {

        return $this->slider->destroy($id);
    }

    public function toggle($id)
    {

        return $this->slider->toggle($id);
    }
}
