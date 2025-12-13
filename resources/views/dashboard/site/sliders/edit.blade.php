@extends('dashboard.core.app')
@section('title', __('dashboard.sliders'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.sliders') }}" :breadcrumbs="[['name' => __('dashboard.sliders'), 'route' => 'sliders.index'], ['name' => __('dashboard.Edit')]]" />

        <x-cards.page-card>

            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.Create')
                </div>
            </x-slot>

            <x-form.form-component :route="route('sliders.update', $slider->id)" method="PUT">

                <x-input.input-field name="title_one_ar" label="{{ __('dashboard.title_one_ar') }}"
                    placeholder="{{ __('dashboard.title_one_ar') }}" class="custom-class" id="nameInput" :value="$slider->title_one_ar" />

                <x-input.input-field name="title_one_en" label="{{ __('dashboard.title_one_en') }}"
                    placeholder="{{ __('dashboard.title_one_en') }}" class="custom-class" id="nameInput"
                    :value="$slider->title_one_en" />

                <x-input.input-field name="title_two_ar" label="{{ __('dashboard.title_two_ar') }}"
                    placeholder="{{ __('dashboard.title_two_ar') }}" class="custom-class" id="nameInput"
                    :value="$slider->title_two_ar" />

                <x-input.input-field name="title_two_en" label="{{ __('dashboard.title_two_en') }}"
                    placeholder="{{ __('dashboard.title_two_en') }}" class="custom-class" id="nameInput"
                    :value="$slider->title_two_en" />

                <x-input.input-field name="title_three_ar" label="{{ __('dashboard.title_three_ar') }}"
                    placeholder="{{ __('dashboard.title_three_ar') }}" class="custom-class" id="nameInput"
                    :value="$slider->title_three_ar" />

                <x-input.input-field name="title_three_en" label="{{ __('dashboard.title_three_en') }}"
                    placeholder="{{ __('dashboard.title_three_en') }}" class="custom-class" id="nameInput"
                    :value="$slider->title_three_en" />

                <x-editor.summernote id="content_ar" label="{{ __('dashboard.content_ar') }}" name="content_ar"
                    :value="$slider->content_ar" />


                <x-editor.summernote id="content_en" label="{{ __('dashboard.content_en') }}" name="content_en"
                    :value="$slider->content_en" />


                <x-input.input-field name="image" type="file" label="{{ __('dashboard.Image') }}" id="fileInput" />

            </x-form.form-component>

        </x-cards.page-card>
    </div>
@endsection
@section('js_addons')

@endsection
