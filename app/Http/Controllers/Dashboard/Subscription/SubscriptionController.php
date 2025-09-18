<?php

namespace App\Http\Controllers\Dashboard\Subscription;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\Subscription\SubscriptionService;

class SubscriptionController extends Controller
{
    public function __construct(
        private readonly SubscriptionService $service,
    ) {}

    public function index()
    {
        return $this->service->index();
    }


    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
    public function toggle($id)
    {
        return $this->service->toggle($id);
    }
}
