<?php

namespace App\Http\Resources\V1\Setting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->t('slug'),
            'key' => $this->key,
            'value' => $this->value,

        ];
    }
}
