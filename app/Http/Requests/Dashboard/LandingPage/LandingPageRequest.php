<?php

namespace App\Http\Requests\Dashboard\LandingPage;

use Illuminate\Foundation\Http\FormRequest;

class LandingPageRequest extends FormRequest
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
            'title_ar' => ['nullable', 'string', 'max:255'],
            'title_en' => ['nullable', 'string', 'max:255'],
            'content_ar' => ['nullable', 'string'],
            'content_en' => ['nullable', 'string'],
            'ios_link' => ['nullable', 'string', 'max:255'],
            'android_link' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable',  'max:2048']
            ];
    }
}
