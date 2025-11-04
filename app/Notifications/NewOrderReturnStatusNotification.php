<?php

namespace App\Notifications;

use App\Models\OrderReturn;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewOrderReturnStatusNotification extends Notification
{
    use Queueable;

    public function __construct(public OrderReturn $orderReturn)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(): array
    {
        $status = $this->orderReturn->status->value;

        $titles = [
            'accepted' => [
                'ar' => 'تم قبول طلب الإرجاع الخاص بك',
                'en' => 'Your return request has been accepted',
            ],
            'rejected' => [
                'ar' => 'تم رفض طلب الإرجاع الخاص بك',
                'en' => 'Your return request has been rejected',
            ],
        ];

        return [
            'ar' => [
                'title' => $titles[$status]['ar'],
                'body' => 'رقم الطلب: #' . $this->orderReturn->order_id,
                'order_return_id' => $this->orderReturn->id,
            ],
            'en' => [
                'title' => $titles[$status]['en'],
                'body' => 'Order ID: #' . $this->orderReturn->order_id,
                'order_return_id' => $this->orderReturn->id,
            ],
        ];
    }

    public function databaseType()
    {
        return 'order_return_status';
    }

    public function firebaseData()
    {
        $status = $this->orderReturn->status->value;

        $titles = [
            'accepted' => [
                'ar' => 'تم قبول طلب الإرجاع الخاص بك',
                'en' => 'Your return request has been accepted',
            ],
            'rejected' => [
                'ar' => 'تم رفض طلب الإرجاع الخاص بك',
                'en' => 'Your return request has been rejected',
            ],
        ];

        return [
            'type' => $this->databaseType(),
            'order_return_id' => $this->orderReturn->id,
            'ar' => [
                'title' => $titles[$status]['ar'],
                'body' => 'رقم الطلب: #' . $this->orderReturn->order_id,
            ],
            'en' => [
                'title' => $titles[$status]['en'],
                'body' => 'Order ID: #' . $this->orderReturn->order_id,
            ],
        ];
    }
}
