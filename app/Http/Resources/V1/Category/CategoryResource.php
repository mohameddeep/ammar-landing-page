<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Category;

use App\Http\Resources\V1\Product\ProductResource;
use App\Http\Traits\LanguageToggle;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use function App\Http\Helpers\fileFullPath;

final class CategoryResource extends JsonResource
{
    use LanguageToggle;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $sort = $request->query('sort');

        $productsQuery = $this->products()
            ->with(['user', 'category', 'images'])
            ->filterBySort($sort)
            ->limit(4);

        return [
            'id' => $this->id,
            'name' => $this->t('name'),
            'slug' => $this->slug,
<<<<<<< HEAD
            'image' => fileFullPath((string) $this->image),
=======
        'image' => fileFullPath((string) $this->image),
>>>>>>> 10bd7b6e (add changes)
            'products' => $this->whenLoaded('products', fn() =>
                ProductResource::collection($productsQuery->get())
            ),
        ];
    }
}
