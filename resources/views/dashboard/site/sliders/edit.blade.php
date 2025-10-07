@extends('dashboard.core.app')
@section('title', __('dashboard.sliders'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.sliders') }}" :breadcrumbs="[
            ['name' => __('dashboard.sliders'), 'route' => 'sliders.index'],
            ['name' => __('dashboard.Edit')],
        ]" />

        <x-cards.page-card>

            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.Create')
                </div>
            </x-slot>

            <x-form.form-component :route="route('sliders.update', $slider->id)" method="PUT">
            
                <x-input.input-field name="title_ar" label="{{ __('dashboard.title_ar') }}" placeholder="{{ __('dashboard.title_ar') }}"
                    class="custom-class" id="nameInput" :value="$slider->title_ar"/>


                <x-input.input-field name="title_en" label="{{ __('dashboard.title_en') }}" placeholder="{{ __('dashboard.title_en') }}"
                    class="custom-class" id="nameInput"  :value="$slider->title_en"/>

                    <x-input.input-field name="content_ar" label="{{ __('dashboard.content_ar') }}" placeholder="{{ __('dashboard.content_ar') }}"
                    class="custom-class" id="nameInput" :value="$slider->content_ar"/>


                <x-input.input-field name="content_en" label="{{ __('dashboard.content_en') }}" placeholder="{{ __('dashboard.content_en') }}"
                    class="custom-class" id="nameInput"  :value="$slider->content_en"/>

                     
                                <x-input.input-field 
                                type="select" 
                                name="product_id" 
                                label="{{ __('dashboard.products') }}" 
                                :options="$products" 
                                showName="name" 
                                id="product_id" 
                                :value="$slider->product_id ?? null"
                            />
           
                    <x-input.input-field name="image" type="file" label="{{ __('dashboard.Image') }}"
                    id="fileInput" />
                
            </x-form.form-component>

        </x-cards.page-card>
    </div>
@endsection
@section('js_addons')

@endsection
