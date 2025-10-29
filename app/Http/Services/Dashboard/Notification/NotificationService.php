<?php

namespace App\Http\Services\Dashboard\Notification;

use function App\Http\Helpers\responseFail;
use function App\Http\Helpers\responseSuccess;
use App\Http\Helpers\Http;
use Exception;

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

        try {
           $deleted= auth()->user()->notifications()->where('id', $id)->delete();
            if ($deleted) {
                return responseSuccess(Http::OK, __('messages.deleted_successfully'), true);
            }

            return responseFail(Http::NOT_FOUND, __('messages.Not Found or Already Deleted'));

        } catch (Exception $e) {
            return responseFail(Http::BAD_REQUEST, ['error' => $e->getMessage(), __('messages.Something went wrong')]);
        }
    }
}




