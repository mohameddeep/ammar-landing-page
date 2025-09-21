@extends('dashboard.core.app')
@section('title', __('dashboard.providers'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.providers') }}" :breadcrumbs="[['name' => __('dashboard.providers'), 'route' => 'providers.index'], ['name' => __('dashboard.Edit')]]" />

        <x-cards.page-card>

            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.Create')
                </div>
            </x-slot>

            <x-form.form-component :route="route('providers.update', $provider->id)" method="PUT">


                <x-input.input-field name="name" label="{{ __('dashboard.Name') }}" placeholder="{{ __('dashboard.Name') }}"
                    value="{{ $provider->name }}" required="true" />

                <x-input.input-field name="brand_name" label="{{ __('dashboard.brand_Name') }}" placeholder="{{ __('dashboard.brand_Name') }}"
                    value="{{ $provider->brand_name }}" required="true" />
                <x-input.input-field name="phone" label="{{ __('dashboard.phone') }}" placeholder="{{ __('dashboard.phone') }}"
                    value="{{ $provider->phone }}" required="true" />


                <x-input.input-field name="password" type="password" label="{{ __('dashboard.password') }}"
                    placeholder="{{ __('dashboard.password') }}" />

                <x-input.input-field name="password_confirmation" type="password"
                    label="{{ __('dashboard.password_confirmation') }}"
                    placeholder="{{ __('dashboard.password_confirmation') }}" />
            </x-form.form-component>

        </x-cards.page-card>
    </div>
@endsection
@section('js_addons')

@endsection
