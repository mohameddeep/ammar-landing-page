<?php

namespace App\Http\Resources\V1\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'total_price' => (string)$this->final_price,
            'items' => CartItemResource::collection($this->whenLoaded('items')),
        ];
    }
}
