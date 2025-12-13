@extends('dashboard.core.app')
@section('title', __('dashboard.sliders'))

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

                <x-input.input-field name="title_one_ar" label="{{ __('dashboard.title_one_ar') }}"
                    placeholder="{{ __('dashboard.title_one_ar') }}" id="title_one_ar" required="true" />

                <x-input.input-field name="title_one_en" label="{{ __('dashboard.title_one_en') }}"
                    placeholder="{{ __('dashboard.title_one_en') }}" id="title_one_en" required="true" />

                <x-input.input-field name="title_two_ar" label="{{ __('dashboard.title_two_ar') }}"
                    placeholder="{{ __('dashboard.title_two_ar') }}" id="title_two_ar" required="true" />

                <x-input.input-field name="title_two_en" label="{{ __('dashboard.title_two_en') }}"
                    placeholder="{{ __('dashboard.title_two_en') }}" id="title_two_en" required="true" />

                <x-input.input-field name="title_three_ar" label="{{ __('dashboard.title_three_ar') }}"
                    placeholder="{{ __('dashboard.title_three_ar') }}" id="title_three_ar" required="true" />

                <x-input.input-field name="title_three_en" label="{{ __('dashboard.title_three_en') }}"
                    placeholder="{{ __('dashboard.title_three_en') }}" id="title_three_en" required="true" />

                <x-input.input-field class="" type="checkbox" name="is_active" id="is_active"
                    label="{{ __('dashboard.Activate') }}" />


                <x-input.input-field name="image" type="file" label="{{ __('dashboard.Image') }}" />


                <x-editor.summernote id="content_ar" label="{{ __('dashboard.content_ar') }}" name="content_ar"
                    :value="old('content_ar')" />


                <x-editor.summernote id="content_en" label="{{ __('dashboard.content_en') }}" name="content_en"
                    :value="old('content_en')" />

            </x-form.form-component>
        </x-cards.page-card>
    </div>
@endsection
@push('scripts')
@endpush
