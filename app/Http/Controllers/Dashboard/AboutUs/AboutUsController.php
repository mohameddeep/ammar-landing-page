<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard\AboutUs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AboutUs\StoreAboutUsRequest;
use App\Http\Services\Dashboard\AboutUs\AboutUsService;

final class AboutUsController extends Controller
{
    public function __construct(private readonly AboutUsService $aboutUsService) {}

    public function index()
    {
        return $this->aboutUsService->index();
    }

    public function create()
    {
        return $this->aboutUsService->create();
    }

    public function store(StoreAboutUsRequest $request)
    {
        return $this->aboutUsService->store($request);
    }

    public function edit(string $id)
    {
        return $this->aboutUsService->edit($id);
    }

    public function update(StoreAboutUsRequest $request, string $id)
    {
        return $this->aboutUsService->update($request, $id);
    }

    public function destroy($id)
    {

        return $this->aboutUsService->destroy($id);
    }

    public function toggle($id)
    {

        return $this->aboutUsService->toggle($id);
    }
}
