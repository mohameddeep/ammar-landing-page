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
            'total_price' => $this->total_price,
            'can_accept' => $this->can_accept,
            'can_return' => $this->can_return,
            'can_review' => $this->can_review,
            'items' => OrderItemResource::collection($this->whenLoaded('items'))
        ];
    }
}
