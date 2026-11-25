<?php

declare(strict_types=1);

namespace App\Http\Requests\Dashboard\PricingRequest;

use App\Enums\PricingRequestStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdatePricingRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, array<int, mixed>>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::enum(PricingRequestStatus::class)],
            'admin_notes' => ['nullable', 'string', 'max:5000'],
        ];
    }
}
