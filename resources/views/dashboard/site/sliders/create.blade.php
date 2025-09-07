@extends('dashboard.core.app')
@section('title', __('dashboard.sliders'))
@section('css_addons')

@endsection
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.sliders') }}" :breadcrumbs="[['name' => __('dashboard.sliders')], ['name' => __('dashboard.Edit')]]" />



        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.Create')
                </div>
            </x-slot>
            <x-form.form-component :route="route('sliders.store')" method="POST">

                <x-input.input-field name="title_ar" label="{{ __('dashboard.title_ar') }}"
                    placeholder="{{ __('dashboard.title_ar') }}" id="title_ar" required="true" />

                <x-input.input-field name="title_en" label="{{ __('dashboard.title_en') }}"
                    placeholder="{{ __('dashboard.title_en') }}" id="title_en" required="true" />

                <x-input.input-field name="content_ar" label="{{ __('dashboard.content_ar') }}"
                    placeholder="{{ __('dashboard.content_ar') }}" id="content_ar" required="true" />

                <x-input.input-field name="content_en" label="{{ __('dashboard.content_en') }}"
                    placeholder="{{ __('dashboard.content_en') }}" id="content_en" required="true" />



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
