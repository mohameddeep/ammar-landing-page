<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Slider;

use App\Http\Traits\LanguageToggle;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use function App\Http\Helpers\fileFullPath;

final class SliderResource extends JsonResource
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
            'title' => $this->t('title'),
            'content' => $this->t('content'),
            'image' => fileFullPath($this->image),
        ];
    }
}
