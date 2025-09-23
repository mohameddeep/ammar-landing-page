<?php

declare(strict_types=1);

namespace App\Http\Resources\V1\Coupon;

use App\Http\Traits\LanguageToggle;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use function App\Http\Helpers\fileFullPath;

final class CouponResource extends JsonResource
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
            'code' => $this->code,
            'name' => $this->name,
            'discount' => $this->discount,
            'usage_count' => $this->usage_count,
            'expire_at' => $this->expire_at,
        ];
    }
}
