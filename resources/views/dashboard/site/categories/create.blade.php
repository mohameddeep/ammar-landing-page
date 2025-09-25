@extends('dashboard.core.app')
@section('title', __('dashboard.categories'))
@section('css_addons')

@endsection
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.categories') }}" :breadcrumbs="[['name' => __('dashboard.categories')], ['name' => __('dashboard.Edit')]]" />



        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.Create')
                </div>
            </x-slot>
            <x-form.form-component :route="route('categories.store')" method="POST">

                <x-input.input-field name="name_ar" label="{{ __('dashboard.name_ar') }}"
                    placeholder="{{ __('dashboard.name_ar') }}" id="name_ar" required="true" />

                <x-input.input-field name="name_en" label="{{ __('dashboard.name_en') }}"
                    placeholder="{{ __('dashboard.name_en') }}" id="name_en" required="true" />


                <div class="row mt-3">
                    <x-input.input-field class="" type="checkbox" name="is_active" id="is_active"
                        label="{{ __('dashboard.Activate') }}" />
                </div>

                <x-input.input-field name="image" type="file" label="{{ __('dashboard.Image') }}" />

            </x-form.form-component>
        </x-cards.page-card>
    </div>
@endsection
@push('scripts')
@endpush
