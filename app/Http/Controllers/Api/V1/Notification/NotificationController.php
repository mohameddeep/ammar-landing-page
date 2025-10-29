<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1\Notification;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\V1\Notification\NotificationService;

final class NotificationController extends Controller
{
    public function __construct(private NotificationService $notificationService) {}

    public function index()
    {
        return $this->notificationService->index();
    }

    public function unread()
    {
        return $this->notificationService->unread();
    }

    public function markAllAsRead()
    {
        return $this->notificationService->markAllAsRead();
    }

    public function markAsRead($id)
    {
        return $this->notificationService->markAsRead($id);
    }
}
