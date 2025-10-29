<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewComplaintNotification extends Notification
{
    use Queueable;

    public function __construct(public $title, public $body, public $data = [])
    {
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * نوع الإشعار لتصنيفه في الـ frontend أو الـ mobile app
     */
    public function databaseType()
    {
        return 'complaint_new';
    }

    public function toArray($notifiable)
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'data' => $this->data,
            'type' => $this->databaseType(),
        ];
    }
}
