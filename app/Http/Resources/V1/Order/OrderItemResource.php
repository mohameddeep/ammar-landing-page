<?php

namespace App\Http\Resources\V1\Order;

use App\Http\Resources\V1\Product\ProductImageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
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
            'product' => [
                'id' => $this->product?->id,
                'name' => $this->product?->name,
                'price' => $this->product->price,
                'user' => $this->product?->user?->brand_name ?? $this->product?->user?->name,
                'images' => ProductImageResource::collection($this->whenLoaded('product.images')),

            ],
            'color' => $this->color,
            'size' => $this->size,
            'quantity' => $this->quantity
        ];
    }
}
