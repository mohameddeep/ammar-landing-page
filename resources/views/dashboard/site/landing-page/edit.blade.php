@extends('dashboard.core.app')
@section('title', __('dashboard.Edit'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.Edit') }}" :breadcrumbs="[['name' => __('dashboard.Edit')]]" />


        <x-cards.page-card>

            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.Create')
                </div>
            </x-slot>

            <x-form.form-component :route="route('landingPage.update', $content->id)" method="PUT">


                <x-input.input-field name="title_ar" label="{{ __('dashboard.title_ar') }}"
                    placeholder="{{ __('dashboard.title_ar') }}" class="custom-class" id="title_ar" :value="$content->title_ar" />


                <x-input.input-field name="title_en" label="{{ __('dashboard.title_en') }}"
                    placeholder="{{ __('dashboard.title_en') }}" class="custom-class" id="title_en" :value="$content->title_en" />



                @if ($content->key == 'header' || $content->key == 'ready_to_transform')
                    <x-input.input-field name="android_link" label="{{ __('dashboard.android_link') }}"
                        placeholder="{{ __('dashboard.android_link') }}" class="custom-class" id="android_link"
                        :value="$content->android_link" />


                    <x-input.input-field name="ios_link" label="{{ __('dashboard.ios_link') }}"
                        placeholder="{{ __('dashboard.ios_link') }}" class="custom-class" id="ios_link"
                        :value="$content->ios_link" />
                @endif
                <div class="col-md-6">
                    <x-editor.summernote id="content_ar" label="{{ __('dashboard.content_ar') }}" name="content_ar"
                        :value="old('content_ar') ?? ($content->content_ar ?? '')" />
                </div>


                <div class="col-md-6">

                    <x-editor.summernote id="content_en" label="{{ __('dashboard.content_en') }}" name="content_en"
                        :value="old('content_en') ?? ($content->content_en ?? '')" />
                </div>

                @if ($content->key !== 'content_one' && $content->key !== 'content_two')

                    <div class="row mt-3">
                        <x-input.input-field name="image" type="file" label="{{ __('dashboard.Image') }}"
                            id="fileInput" />

                        @if ($content->image)
                            <img src="@image($content->image)" style="width: 250px;" />
                        @endif
                    </div>

                @endif

            </x-form.form-component>

        </x-cards.page-card>
    </div>
@endsection
@section('js_addons')

@endsection
