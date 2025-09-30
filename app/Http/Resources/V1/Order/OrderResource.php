<?php

namespace App\Http\Resources\V1\Order;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_num' => $this->order_num,
            'status' => $this->order_status,
            'total_price' => (string)$this->grand_total,
            'can_accept' => $this->can_accept,
            'can_return' => $this->can_return,
            'can_review' => $this->can_review,
            'order_date' => $this->created_at->format('d M Y'),
            'arrival_date' => $this->created_at->format('d M Y'),
            'items' => OrderItemResource::collection($this->whenLoaded('items')),
            'auth_user_type' => auth('api')?->user()?->type ?? null,
        ];
    }
}
