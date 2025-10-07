<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Category;

use App\Http\Resources\V1\Product\ProductResource;
use App\Http\Traits\LanguageToggle;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use function App\Http\Helpers\fileFullPath;

final class CategoryDetailResource extends JsonResource
{
    use LanguageToggle;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
{
    $sort = $request->get('sort'); // 🔥 مثال: ?sort=price أو rating أو orders

    $productRepository = app(ProductRepositoryInterface::class);
    $products = $productRepository->getCategoryProducts(
        $this->id,
        sort: $sort,
        relations: ['user', 'category']
    );

    return [
        'id' => $this->id,
        'name' => $this->t('name'),
        'slug' => $this->slug,
        'image' => fileFullPath((string)$this->image),
        'products' => ProductResource::collection($products),
    ];
}

}
