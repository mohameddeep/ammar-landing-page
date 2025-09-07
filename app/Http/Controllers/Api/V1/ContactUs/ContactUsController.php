<?php

namespace App\Http\Controllers\Api\V1\ContactUs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\ContatUs\ContactUs\ContactUsRequest;
use App\Http\Services\Api\V1\ContactUs\ContactUsService;

class ContactUsController extends Controller
{
    public function __construct(
        private readonly ContactUsService $service,
    ) {}

    public function __invoke(ContactUsRequest $request)
    {
        return $this->service->contactUs($request);
    }
}
