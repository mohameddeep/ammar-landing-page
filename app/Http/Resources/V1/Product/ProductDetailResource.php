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

        // تحقق إذا المستخدم عامل تسجيل دخول
        $isLoggedIn = auth('api')->check();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'user' => $this->user?->name,
            'category' => $this->category?->t('name'),
            'price' => $this->price,
            'status' => $this->status,
            'rate' => $this->rate(),
            'is_active' => $this->is_active,
            'is_stopped' => $this->is_stopped,
            'images' => ProductImageResource::collection($this->whenLoaded('images')),
            'reviews' => ProductReviewResource::collection($this->whenLoaded('reviews')),
            'available_colors' => $variantData['available_colors'],
            'available_sizes' => $variantData['available_sizes'],
            'can_add_to_cart' => $this->canAddToCart(),

            // فقط لو المستخدم عامل تسجيل دخول
            'is_fav' => $isLoggedIn ? ($this->is_fav ?? false) : false,
            'in_cart' => $isLoggedIn ? ($this->in_cart ?? false) : false,
            'cart_item_id' => $isLoggedIn ? ($this->cart_item_id ?? null) : null,
            'cart_quantity' => $isLoggedIn ? ($this->cart_quantity ?? 0) : 0,
        ];
    }
}
