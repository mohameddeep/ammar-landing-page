@extends('dashboard.core.app')
@section('title', __('dashboard.services'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.services') }}" :breadcrumbs="[
            ['name' => __('dashboard.services'), 'route' => 'services.index'],
            ['name' => __('dashboard.Edit')],
        ]" />

        <x-cards.page-card>

            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.Edit')
                </div>
            </x-slot>

            <x-form.form-component :route="route('services.update', $service->id)" method="PUT">

                <x-input.input-field name="title_ar" label="{{ __('dashboard.title_ar') }}"
                    placeholder="{{ __('dashboard.title_ar') }}" id="title_ar" :value="$service->title_ar" required="true" />

                <x-input.input-field name="title_en" label="{{ __('dashboard.title_en') }}"
                    placeholder="{{ __('dashboard.title_en') }}" id="title_en" :value="$service->title_en" />

                <x-input.input-field class="" type="checkbox" name="is_active" id="is_active"
                    label="{{ __('dashboard.Activate') }}" :value="$service->is_active" />

                <x-input.input-field name="image" type="file" label="{{ __('dashboard.Image') }}" id="image" />

                <div class="col-md-12 mb-3">
                    <img src="@image($service->image)" alt="service image" width="100">
                </div>

                <x-editor.summernote id="content_ar" label="{{ __('dashboard.content_ar') }}" name="content_ar"
                    :value="$service->content_ar" />


                <x-editor.summernote id="content_en" label="{{ __('dashboard.content_en') }}" name="content_en"
                    :value="$service->content_en" />

            </x-form.form-component>

        </x-cards.page-card>
    </div>
@endsection
@section('js_addons')

@endsection
