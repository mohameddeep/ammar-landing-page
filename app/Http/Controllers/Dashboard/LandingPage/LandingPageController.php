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
    public function chooseContent()
    {

        return $this->service->chooseContent();
    }
    public function features()
    {

        return $this->service->features();
    }
    public function expirenceContent()
    {

        return $this->service->expirenceContent();
    }

    public function discover()
    {

        return $this->service->discover();
    }
    public function downloadSection()
    {

        return $this->service->downloadSection();
    }

    public function edit(string $id)
    {
        return $this->service->edit($id);
    }

    public function update(LandingPageRequest $request,$id)
    {
        return $this->service->update($request, $id);
    }

}
