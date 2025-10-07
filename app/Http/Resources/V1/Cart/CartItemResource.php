<?php

namespace App\Http\Resources\V1\Cart;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
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
                'category' => $this->product->category_id ,
                'user' => $this->product?->user?->brand_name ?? $this->product?->user?->name,
                'image' =>$this->product?->firstImage
            ],
            'color' => $this->color,
            'size' => $this->size,
            'quantity' => $this->quantity
        ];
    }
}
