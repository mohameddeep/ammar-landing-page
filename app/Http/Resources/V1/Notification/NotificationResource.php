<?php

namespace App\Http\Resources\V1\Notification;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        $locale = app()->getLocale();

        $data = $this->data ?? [];

        $localized = $data[$locale] ?? $data['en'] ?? [];

        return [
            'id' => $this->id,
            'title' => $localized['title'] ?? '',
            'body' => $localized['body'] ?? '',
            'type' => $this->type,
            'complaint_id' => $localized['complaint_id'] ?? ($data['complaint_id'] ?? null),
            'read_at' => $this->read_at,
            'created_at' => $this->created_at?->format('Y-m-d H:i'),
        ];
    }
}
