<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProductViewNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Product $product,
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toDatabase(): array
    {
        return [
            'ar' => [
                'title' => 'قام شخصا ما بمشاهدة المنتج الخاص بك',
                'product_id' => $this->product->id,
            ],
            'en' => [
                'title' => 'New Product View',
                'product_id' => $this->product->id,
            ]
        ];
    }

    public function databaseType()
    {
        return 'new-product-view';
    }

    public function firebaseData()
    {
        return array_merge($this->toDatabase(), ["type" => $this->databaseType()]) ?? [];
    }
}
