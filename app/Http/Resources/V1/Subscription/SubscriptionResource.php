<?php

namespace App\Http\Resources\V1\Subscription;

use App\Http\Resources\V1\Package\PackageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
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
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'remaining_dresses' => $this->dress_count,
            'package' => new PackageResource($this->whenLoaded('package')),
        ];
    }
}
