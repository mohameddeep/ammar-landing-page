<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Complaint;

use App\Http\Traits\LanguageToggle;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use function App\Http\Helpers\fileFullPath;

final class ComplaintResource extends JsonResource
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
            'name' => $this->name,
            'phone' => $this->phone,
            'complaint' => $this->complaint,
            'response' => $this->response,
            'created_at' => $this->created_at?->format('Y-m-d H:i'),
        ];
    }
}
