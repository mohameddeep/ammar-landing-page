<?php

namespace App\Http\Resources\V1\Product;

use App\Http\Resources\V1\ProductReview\ProductReviewResource;
use App\Http\Resources\V1\ProductVariant\ProductVariantResource;
use App\Repository\ProductVariantRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class ProductResource extends JsonResource
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
            'is_active' => $this->is_active,
            'is_stopped' => $this->is_stopped,
            'images' => ProductImageResource::collection($this->whenLoaded('images')),
        ];
    }
}
