@extends('dashboard.core.app')
@section('title', __('dashboard.about_us'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.about_us') }}" :breadcrumbs="[['name' => __('dashboard.about_us'), 'route' => 'abouts.index'], ['name' => __('dashboard.Edit')]]" />

        <x-cards.page-card>

            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.Edit')
                </div>
            </x-slot>

            <x-form.form-component :route="route('abouts.update', $about->id)" method="PUT">

                <x-input.input-field name="title_ar" label="{{ __('dashboard.title_ar') }}"
                    placeholder="{{ __('dashboard.title_ar') }}" class="custom-class" id="title_ar" :value="$about->title_ar"
                    required="true" />

                <x-input.input-field name="title_en" label="{{ __('dashboard.title_en') }}"
                    placeholder="{{ __('dashboard.title_en') }}" class="custom-class" id="title_en" :value="$about->title_en" />


                <x-input.input-field name="image" type="file" label="{{ __('dashboard.Image') }}" id="fileInput" />

                <x-editor.summernote id="content_ar" label="{{ __('dashboard.content_ar') }}" name="content_ar"
                    :value="$about->content_ar" />

                <x-editor.summernote id="content_en" label="{{ __('dashboard.content_en') }}" name="content_en"
                    :value="$about->content_en" />

            </x-form.form-component>

        </x-cards.page-card>
    </div>
@endsection
@section('js_addons')

@endsection
