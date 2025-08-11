<?php

declare(strict_types=1);

namespace App\Http\Requests\Dashboard\Slider;

use Illuminate\Foundation\Http\FormRequest;

final class StoreSliderRequest extends FormRequest
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

            'title_ar' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'content_ar' => 'nullable|string',
            'content_en' => 'nullable|string',
            'image' => 'required|mimes:jpeg,png,jpg',
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
