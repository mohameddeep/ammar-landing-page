@extends('dashboard.core.app')
@section('title', __('dashboard.providers'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- BreadCrumb -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.providers') }}" :breadcrumbs="[['name' => __('dashboard.providers'), 'route' => 'providers.index'], ['name' => __('dashboard.Create')]]" />
        <!-- BreadCrumb -->

        <!-- Page Card -->
        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.Create')
                </div>
            </x-slot>
            <x-form.form-component :route="route('providers.store')" method="POST">
                <input hidden name="company_id" value="{{ request('company') }}">
                <x-input.input-field name="name" label="{{ __('dashboard.Name') }}" placeholder="{{ __('dashboard.Name') }}"
                    class="custom-class" id="nameInput" required="true" />

                <x-input.input-field name="brand_name" label="{{ __('dashboard.brand_name') }}" placeholder="{{ __('dashboard.brand_name') }}"
                    class="custom-class" id="brandNameInput" required="true" />

                <x-input.input-field name="phone" label="{{ __('dashboard.Phone') }}" placeholder="{{ __('dashboard.Phone') }}"
                    class="custom-class" id="phoneInput" required="true" />

                {{-- <x-input.input-field name="password" type="password" label="{{ __('dashboard.password') }}"
                    placeholder="{{ __('dashboard.password') }}" required="true" />

                <x-input.input-field name="password_confirmation" type="password"
                    label="{{ __('dashboard.password_confirmation') }}"
                    placeholder="{{ __('dashboard.password_confirmation') }}" required="true" /> --}}

            </x-form.form-component>
        </x-cards.page-card>
        <!-- Page Card -->

    </div>
@endsection
