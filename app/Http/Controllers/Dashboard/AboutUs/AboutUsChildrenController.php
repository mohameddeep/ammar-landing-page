<?php

declare(strict_types=1);

namespace App\Http\Controllers\Dashboard\AboutUs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AboutUs\StoreAboutUsRequest;
use App\Http\Services\Dashboard\AboutUs\AboutUsChildrenService;

final class AboutUsChildrenController extends Controller
{
    public function __construct(private readonly AboutUsChildrenService $aboutUsChildrenService) {}

    public function index($id)
    {
        return $this->aboutUsChildrenService->index($id);
    }

    public function create($id)
    {
        return $this->aboutUsChildrenService->create($id);
    }

    public function store(StoreAboutUsRequest $request,$id)
    {
        return $this->aboutUsChildrenService->store($request,$id);
    }

    public function edit(string $id)
    {
        return $this->aboutUsChildrenService->edit($id);
    }

    public function update(StoreAboutUsRequest $request, string $id)
    {
        return $this->aboutUsChildrenService->update($request, $id);
    }

    
    public function destroy($id)
    {
        return $this->aboutUsChildrenService->destroy($id);
    }

    public function toggle($id)
    {
        return $this->aboutUsChildrenService->toggle($id);
    }
}
