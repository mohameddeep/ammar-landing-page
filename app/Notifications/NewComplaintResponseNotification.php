<?php

namespace App\Notifications;

use App\Models\Complaint;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewComplaintResponseNotification extends Notification
{
    use Queueable;

  public function __construct(public Complaint $complaint)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }


    public function toDatabase(object $notifiable): array
    {
        return [
            'ar' => [
                'title' => 'تم الرد على الشكوى الخاصة بك',
                'body' => $this->complaint->response,
                'complaint_id' => $this->complaint->id
                        ],
            'en' => [
                'title' => 'Your complaint has been responded to',
                'body' => $this->complaint->response,
                'complaint_id' => $this->complaint->id
            ],
        ];
    }



    
    public function databaseType()
    {
        return 'complaint_response';
    }

    public function firebaseData()
{
    return [
        'type' => $this->databaseType(),
        'complaint_id' => $this->complaint->id,
        'ar' => [
            'title' => 'تم الرد على الشكوى الخاصة بك',
            'body' => $this->complaint->response,
        ],
        'en' => [
            'title' => 'Your complaint has been responded to',
            'body' => $this->complaint->response,
        ],
    ];
}

}
