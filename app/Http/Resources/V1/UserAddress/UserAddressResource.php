<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\UserAddress;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class UserAddressResource extends JsonResource
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
            'phone' => $this->phone ?? auth('api')->user()->phone,
            'street_name' => $this->street_name,
            'city' => $this->city,
            'building_name' => $this->building_name,
            'landmark' => $this->landmark,
            'notes' => $this->notes,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'is_default' => $this->is_default,
        ];
    }
}
