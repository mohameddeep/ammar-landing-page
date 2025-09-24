@extends('dashboard.core.app')
@section('title', __('dashboard.Profile'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.website_info') }}" :breadcrumbs="[['name' => __('dashboard.website_info')]]" />



        <x-cards.page-card>

            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.website_info')
                </div>
            </x-slot>
            <x-form.form-component :route="route('dashboard.setting.update')" method="PUT">
                @csrf

                @foreach ($setting as $setting) 
                <x-input.input-field 
                    name="{{ $setting->key }}" 
                    type="text" 
                    label="{{ ucfirst(str_replace('_', ' ', $setting->key)) }}" 
                    value="{{ $setting->value }}" 
                /> 
            @endforeach
            </x-form.form-component>


        </x-cards.page-card>


    </div>
@endsection
@section('js_addons')

@endsection
