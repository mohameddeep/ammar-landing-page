<?php

declare(strict_types=1);

namespace App\Http\Services\Api\V1\Notification;

use App\Http\Resources\V1\Notification\NotificationResource;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;

final class NotificationService
{
    public function index()
    {
        $user = auth('api')->user();
        $notifications = $user->notifications()->latest()->get();
        $unreadCount = $user->unreadNotifications()->count();

        return responseSuccess(message: __('messages.show_successfully'), data: [
            'unread_count' => $unreadCount,
            'notifications' => NotificationResource::collection($notifications),
        ]);
    }

    public function unread()
    {
        $user = auth('api')->user();

        $notifications = $user->unreadNotifications()
            ->latest()
            ->get();

        $unreadCount = $user->unreadNotifications()->count();

        return responseSuccess(message: __('messages.show_successfully'), data: [
            'unread_count' => $unreadCount,
            'notifications' => NotificationResource::collection($notifications),
        ]);
    }

    public function markAllAsRead()
    {
        $user = auth('api')->user();
        $user->unreadNotifications->markAsRead();

        return responseSuccess(message: __('messages.all_notifications_marked_as_read'));
    }

    public function markAsRead($id)
    {
        $user = auth('api')->user();
        $notification = $user->notifications()->find($id);

        if (! $notification) {
            return responseFail(message: __('messages.notification_not_found'));
        }

        $notification->markAsRead();

        return responseSuccess(message: __('messages.notification_marked_as_read'));
    }
}
