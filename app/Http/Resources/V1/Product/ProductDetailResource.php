<?php

namespace App\Http\Resources\V1\Product;

use App\Http\Resources\V1\ProductReview\ProductReviewResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'user' => $this->user?->name,
            'category' => $this->category?->t('name'),
            'price' => $this->price,
            'status' => $this->status,
            'is_fav' => $this->is_fav,
            'rate' => $this->rate(),
            'reviews' => ProductReviewResource::collection($this->whenLoaded('reviews')),
            'available_colors' => $this->colors(),
            'available_sizes'  => $this->sizes(),

        ];
    }
}
