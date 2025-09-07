<?php

namespace App\Http\Requests\Dashboard\Categories;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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

        $categoryId = $this->route('category');

        return [
            'name_ar' => ['required', 'string', 'max:255', 'unique:categories,name_ar,'.$categoryId],
            'name_en' => ['nullable', 'string', 'max:255', 'unique:categories,name_en,'.$categoryId],
            'slug' => ['nullable', 'string', 'max:255', 'unique:categories,slug,'.$categoryId],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'is_active' => 'in:on,',
            'parent_id' => ['nullable', 'exists:categories,id'],
        ];
    }
}
