<?php

namespace App\Http\Services\Dashboard\Notification;

class NotificationService
{
    public function index()
    {
        $notifications = auth()->user()
            ->notifications()
            ->latest()
            ->paginate(10);

        return view('dashboard.site.notifications.index', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        auth()->user()->notifications()->where('id', $id)->delete();
        return back()->with('success', __('messages.deleted_successfully'));
    }
}




