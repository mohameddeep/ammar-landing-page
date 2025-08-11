<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Package;

use App\Http\Resources\V1\PackageFeature\PackageFeatureResource;
use App\Http\Traits\LanguageToggle;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class PackageResource extends JsonResource
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
            'duration' => $this->duration,
            'price' => $this->price,
            'product_number' => $this->product_number,
            'is_active' => $this->is_active,
            'features' => PackageFeatureResource::collection($this->whenLoaded('features')),
        ];
    }
}
