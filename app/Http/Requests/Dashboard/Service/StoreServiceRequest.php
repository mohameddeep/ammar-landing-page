<?php

declare(strict_types=1);

namespace App\Http\Requests\Dashboard\Service;

use Illuminate\Foundation\Http\FormRequest;

final class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title_ar' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'content_ar' => 'nullable|string',
            'content_en' => 'nullable|string',
            'image' => 'required|mimes:jpeg,png,jpg,webp',
            'is_active' => 'nullable',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'is_active' => $this->has('is_active') ? $this->input('is_active') : 0,
        ]);
    }
}
