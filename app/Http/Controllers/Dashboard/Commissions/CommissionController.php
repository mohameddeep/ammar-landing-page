<?php

namespace App\Http\Controllers\Dashboard\Commissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Commissions\CommissionRequest;
use App\Http\Services\Dashboard\Commissions\CommissionService;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function __construct(private readonly CommissionService $service) {}

    public function index()
    {
        return $this->service->index();
    }

    public function toggle(Request $request, $id)
    {
        return $this->service->toggle($request, $id);
    }

    public function edit($id)
    {
        return $this->service->edit($id);
    }

    public function update(CommissionRequest $request, $id)
    {
        return $this->service->update($request, $id);
    }
}
