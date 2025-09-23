<?php

namespace App\Http\Controllers\Dashboard\Contact;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\Contact\ContactService;

class ContactController extends Controller
{
    public function __construct(
        private readonly ContactService $service,
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
