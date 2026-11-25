@extends('dashboard.core.app')
@section('title', __('dashboard.project_types'))

@section('content')
    <div class="container-fluid px-5 py-3">
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.project_types') }}" :breadcrumbs="[['name' => __('dashboard.project_types'), 'route' => 'project-types.index'], ['name' => __('dashboard.Create')]]" />

        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">@lang('dashboard.Create')</div>
            </x-slot>
            <x-form.form-component :route="route('project-types.store')" method="POST">
                <x-input.input-field name="name_ar" id="name_ar" label="{{ __('dashboard.name_ar') }}"
                    placeholder="{{ __('dashboard.name_ar') }}" required="true" />

                <x-input.input-field name="name_en" id="name_en" label="{{ __('dashboard.name_en') }}"
                    placeholder="{{ __('dashboard.name_en') }}" required="true" />

                <x-input.input-field name="sort_order" id="sort_order" type="number"
                    label="{{ __('dashboard.sort_order') }}" value="0" />

                <x-input.input-field class="" type="checkbox" name="is_active" id="is_active"
                    label="{{ __('dashboard.Activate') }}" value="1" />
            </x-form.form-component>
        </x-cards.page-card>
    </div>
@endsection
