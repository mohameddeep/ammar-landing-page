<?php

namespace App\Http\Controllers\Dashboard\LandingPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Categories\CategoryRequest;
use App\Http\Requests\Dashboard\LandingPage\LandingPageRequest;
use App\Http\Services\Dashboard\Categories\CategoryService;
use App\Http\Services\Dashboard\LandingPage\LandingPageService;

class LandingPageController extends Controller
{
    public function __construct(private readonly LandingPageService $service) {}

    public function header()
    {

        return $this->service->header();
    }

   

    public function edit(string $id)
    {
        return $this->service->edit($id);
    }

    public function update(LandingPageRequest $request, string $id)
    {
        return $this->service->update($request, $id);
    }

    public function toggle($id)
    {
        return $this->service->toggle($id);
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
