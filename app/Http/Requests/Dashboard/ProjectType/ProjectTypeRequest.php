<?php

declare(strict_types=1);

namespace App\Http\Requests\Dashboard\ProjectType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class ProjectTypeRequest extends FormRequest
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
        $id = $this->route('project_type');

        return [
            'name_ar' => ['required', 'string', 'max:255', Rule::unique('project_types', 'name_ar')->ignore($id)],
            'name_en' => ['required', 'string', 'max:255', Rule::unique('project_types', 'name_en')->ignore($id)],
            'sort_order' => ['required', 'integer', 'min:0', 'max:100000'],
            'is_active' => ['required', 'boolean'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name_ar' => __('dashboard.name_ar'),
            'name_en' => __('dashboard.name_en'),
            'sort_order' => __('dashboard.sort_order'),
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->boolean('is_active'),
            'sort_order' => $this->input('sort_order') ?? 0,
        ]);
    }
}
