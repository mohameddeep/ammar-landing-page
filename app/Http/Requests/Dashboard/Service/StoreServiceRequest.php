<?php

declare(strict_types=1);

namespace App\Http\Requests\Dashboard\Service;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            // Two levels only: a parent must itself be a top-level service.
            'parent_id' => ['nullable', 'integer', Rule::exists('services', 'id')->whereNull('parent_id')],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'is_active' => $this->has('is_active') ? $this->input('is_active') : 0,
            'parent_id' => $this->filled('parent_id') ? $this->input('parent_id') : null,
        ]);
    }
}
