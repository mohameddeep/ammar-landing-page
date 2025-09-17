<?php

namespace App\Jobs;

use App\Http\Traits\Notification;
use App\Models\Product;
use App\Models\User;
use App\Notifications\NewProductViewNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;

class CheckForNewViewerForProduct implements ShouldQueue
{
    use Queueable, SerializesModels, Notification;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Product $product,
        public User $viewer,
    )
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if ($this->viewer->id != $this->product->user_id){
            $checkNewViewer = $this->product->views()
                ->where('user_id', $this->viewer->id)
                ->exists();
            if ($checkNewViewer){
                $this->product->views()->create([
                    'user_id' => $this->viewer->id
                ]);
                $this->SendNotification(NewProductViewNotification::class, $this->product->user, $this->product);
            }
        }
    }
}
