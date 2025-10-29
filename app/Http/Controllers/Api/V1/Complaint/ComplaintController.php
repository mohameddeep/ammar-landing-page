<?php

namespace App\Http\Controllers\Api\V1\Complaint;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Complaint\ComplaintUsRequest;
use App\Http\Services\Api\V1\Complaint\ComplaintService;

class ComplaintController extends Controller
{
    public function __construct(
        private readonly ComplaintService $service,
    ) {}

    public function index()
    {
        return $this->service->index();
    }
    public function store(ComplaintUsRequest $request)
    {
        return $this->service->store($request);
    }
}
