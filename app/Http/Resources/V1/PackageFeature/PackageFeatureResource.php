<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\PackageFeature;

use App\Http\Traits\LanguageToggle;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class PackageFeatureResource extends JsonResource
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
            'feature' => $this->t('feature'),
        ];
    }
}
