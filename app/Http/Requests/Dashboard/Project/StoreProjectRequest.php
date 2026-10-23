<?php

declare(strict_types=1);

namespace App\Http\Requests\Dashboard\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title_ar' => ['required', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $this->uniqueSlugRule()],
            'category_ar' => ['nullable', 'string', 'max:255'],
            'category_en' => ['nullable', 'string', 'max:255'],
            'city_ar' => ['nullable', 'string', 'max:255'],
            'city_en' => ['nullable', 'string', 'max:255'],
            'client_ar' => ['nullable', 'string', 'max:255'],
            'client_en' => ['nullable', 'string', 'max:255'],
            'summary_ar' => ['nullable', 'string', 'max:1000'],
            'summary_en' => ['nullable', 'string', 'max:1000'],
            'content_ar' => ['nullable', 'string'],
            'content_en' => ['nullable', 'string'],
            'area' => ['nullable', 'string', 'max:100'],
            'year' => ['nullable', 'integer', 'between:1950,'.(now()->year + 5)],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:100000'],
            'is_active' => ['nullable'],
            'is_featured' => ['nullable'],
            'image' => [$this->imageRequirement(), 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'gallery' => ['nullable', 'array', 'max:30'],
            'gallery.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => $this->filled('slug') ? Str::slug((string) $this->input('slug')) : null,
        ]);
    }

    protected function imageRequirement(): string
    {
        return 'required';
    }

    protected function uniqueSlugRule()
    {
        return Rule::unique('projects', 'slug');
    }

    public function attributes(): array
    {
        return [
            'title_ar' => __('dashboard.title_ar'),
            'title_en' => __('dashboard.title_en'),
            'slug' => __('dashboard.project_slug'),
            'image' => __('dashboard.main_image'),
            'gallery' => __('dashboard.gallery_images'),
            'gallery.*' => __('dashboard.gallery_images'),
            'year' => __('dashboard.project_year'),
        ];
    }
}
