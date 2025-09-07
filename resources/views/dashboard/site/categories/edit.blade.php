@extends('dashboard.core.app')
@section('title', __('dashboard.managers'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.Manager') }}" :breadcrumbs="[['name' => __('dashboard.Manager')], ['name' => __('dashboard.Edit')]]" />


        <x-cards.page-card>

            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.Create')
                </div>
            </x-slot>

            <x-form.form-component :route="route('categories.update', $category->id)" method="PUT">


                <x-input.input-field name="name_ar" label="{{ __('dashboard.Name_ar') }}"
                    placeholder="{{ __('dashboard.Name_ar') }}" class="custom-class" id="name_ar" :value="$category->name_ar" />


                <x-input.input-field name="name_en" label="{{ __('dashboard.Name_en') }}"
                    placeholder="{{ __('dashboard.Name_en') }}" class="custom-class" id="name_en" :value="$category->name_en" />


                <x-input.input-field type="select" name="parent_id" label="{{ __('dashboard.parent_id') }}"
                    placeholder="{{ __('dashboard.parent_id') }}" :options="$mainCategories" :value="$category->parent_id" showName="name_en" />

                <div class="row mt-3">
                    <x-input.input-field name="image" type="file" label="{{ __('dashboard.Image') }}" id="fileInput" />

                    @if ($category->image)
                        <img src="@image($category->image)" style="width: 250px;" />
                    @endif
                </div>
            </x-form.form-component>

        </x-cards.page-card>
    </div>
@endsection
@section('js_addons')

@endsection
