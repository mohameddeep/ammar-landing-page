<?php

namespace App\Http\Controllers\Dashboard\Complaint;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\Complaint\ComplaintService;

class ComplaintController extends Controller
{
    public function __construct(
        private readonly ComplaintService $service,
    ) {}

    public function index()
    {
        return $this->service->index();
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}
