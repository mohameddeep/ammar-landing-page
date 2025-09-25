<?php

namespace App\Http\Resources\V1\Product;

use App\Http\Resources\V1\ProductReview\ProductReviewResource;
use App\Repository\ProductVariantRepositoryInterface;
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
        $variantRepository = app(ProductVariantRepositoryInterface::class);
        $variantData = $variantRepository->getProductVariants($this->id);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'user' => $this->user?->name,
            'category' => $this->category?->t('name'),
            'price' => $this->price,
            'status' => $this->status,
            'is_fav' => $this->is_fav ?? false,
            'rate' => $this->rate(),
            'is_active' => $this->is_active,
            'is_stopped' => $this->is_stopped,
            'images' => ProductImageResource::collection($this->whenLoaded('images')),
            'reviews' => ProductReviewResource::collection($this->whenLoaded('reviews')),
            'available_colors' => $variantData['available_colors'],
            'available_sizes' => $variantData['available_sizes'],
            'in_cart' => $this->in_cart,
            'cart_quantity' => $this->cart_quantity,
        ];
    }
}
