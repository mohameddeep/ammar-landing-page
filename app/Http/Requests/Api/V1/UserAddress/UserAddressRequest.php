<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\UserAddress;

use Illuminate\Foundation\Http\FormRequest;

final class UserAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'phone' => ['nullable', 'string'],
            'street_name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'building_name' => ['nullable', 'string', 'max:255'],
            'landmark' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
            'longitude' => ['nullable', 'string'],
            'latitude' => ['nullable', 'string'],
            'is_default' => ['nullable', 'boolean'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth('api')->user()->id,
        ]);
    }
}
