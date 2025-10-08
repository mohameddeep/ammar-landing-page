<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\V1\Profile;
use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

final class UserProfileRequest extends FormRequest
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
        $userId = $this->user()->id; // 👈 جاب id للمستخدم الحالي

        return [
            'name' => ['nullable', 'string'],
            'brand_name' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'phone' => [
                'nullable',
                'string',
                'regex:/^(\+9665|9665|05)[0-9]{8}$/',
                Rule::unique('users', 'phone')->ignore($userId),
            ],
            'email' => [
                'nullable',
                'email:rfc,dns',
                'string',
                Rule::unique('users', 'email')->ignore($userId),
            ],
        ];
    }
}
