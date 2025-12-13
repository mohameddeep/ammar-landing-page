@extends('dashboard.core.app')
@section('title', __('dashboard.about_us'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.about_us') }}" :breadcrumbs="[
            ['name' => __('dashboard.about_us'), 'route' => 'abouts.index'],
            ['name' => __('dashboard.Create')],
        ]" />

        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.Create')
                </div>
            </x-slot>
            <x-form.form-component :route="route('abouts.children.store',$parent->id)" method="POST">

                <input type="hidden" name="parent_id" value="{{ $parent->id }}">
                <x-input.input-field name="title_ar" label="{{ __('dashboard.title_ar') }}"
                    placeholder="{{ __('dashboard.title_ar') }}" id="title_ar" required="true" />

                <x-input.input-field name="title_en" label="{{ __('dashboard.title_en') }}"
                    placeholder="{{ __('dashboard.title_en') }}" id="title_en" />


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
