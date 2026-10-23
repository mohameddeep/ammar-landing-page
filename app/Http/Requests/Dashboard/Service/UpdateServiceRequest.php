<?php

declare(strict_types=1);

namespace App\Http\Requests\Dashboard\Service;

use App\Models\Service;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateServiceRequest extends FormRequest
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
            'image' => 'nullable|mimes:jpeg,png,jpg,webp',
            'is_active' => 'nullable',
            // Two levels only: a parent must be top-level, not the service itself, and a
            // service that already has sub-services cannot become a child.
            'parent_id' => [
                'nullable',
                'integer',
                Rule::exists('services', 'id')->whereNull('parent_id'),
                Rule::notIn([(int) $this->route('service')]),
                function (string $attribute, mixed $value, Closure $fail) {
                    if ($value !== null && Service::query()->where('parent_id', $this->route('service'))->exists()) {
                        $fail(__('dashboard.parent_service_has_children'));
                    }
                },
            ],
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
