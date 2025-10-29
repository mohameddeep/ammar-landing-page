<?php

namespace App\Http\Controllers\Dashboard\Notification;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\Notification\NotificationService;

class NotificationController extends Controller
{
    public function __construct(
        private readonly NotificationService $service,
    ) {}

    public function index()
    {
        return $this->service->index();
    }

    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
    public function markAsRead($id)
    {
        return $this->service->markAsRead($id);
    }
}
