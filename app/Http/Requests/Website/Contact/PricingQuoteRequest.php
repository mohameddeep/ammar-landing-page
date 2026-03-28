<?php

namespace App\Http\Requests\Website\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PricingQuoteRequest extends FormRequest
{
    public const PROJECT_TYPE_SLUGS = [
        'residential_building',
        'commercial_showrooms',
        'villa',
        'warehouses',
        'other',
        'tourism',
        'hospital',
        'hotel',
    ];

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'pricing_form' => ['required', 'in:1'],
            'name' => ['required', 'string', 'min:2', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^[+]?[0-9\s\-\(\)]{8,20}$/', 'max:20'],
            'project_types' => ['required', 'array', 'min:1'],
            'project_types.*' => ['string', Rule::in(self::PROJECT_TYPE_SLUGS)],
            'project_space' => ['required', 'string', 'max:400'],
            'city' => ['required', 'string', 'max:400'],
            'attachment' => ['nullable', 'file', 'max:10240', 'mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => __('website.pricingQuoteName'),
            'email' => __('website.pricingQuoteEmail'),
            'phone' => __('website.pricingQuotePhone'),
            'project_types' => __('website.pricingQuoteProjectType'),
            'project_space' => __('website.pricingQuoteSpace'),
            'city' => __('website.pricingQuoteCity'),
            'attachment' => __('website.pricingQuoteAttachment'),
            'notes' => __('website.pricingQuoteNotes'),
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => __('validation.phone_regex'),
            'project_types.required' => __('website.pricingQuoteTypesRequired'),
        ];
    }
}
