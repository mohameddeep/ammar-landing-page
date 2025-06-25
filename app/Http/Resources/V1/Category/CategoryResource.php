<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Category;

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

        return [
            'id' => $this->id,
            'name' => $this->t('name'),
            'slug' => $this->slug,
            'image' => fileFullPath($this->image),
        ];
    }
}
