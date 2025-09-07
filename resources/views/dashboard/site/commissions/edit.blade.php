@php use App\Enums\CommissionValueTypeEnum; @endphp
@extends('dashboard.core.app')
@section('title', __('dashboard.managers'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.Manager') }}"
                                 :breadcrumbs="[['name' => __('dashboard.Manager')], ['name' => __('dashboard.Edit')]]"/>


        <x-cards.page-card>

            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.Create')
                </div>
            </x-slot>

            <x-form.form-component :route="route('commissions.update', $commission->id)" method="PUT">

                <x-input.input-field name="name_ar" type="text" label="{{ __('dashboard.name_ar') }}"
                                     placeholder="{{ __('dashboard.name_ar') }}" value="{{ $commission->name_ar }}"/>

                <x-input.input-field name="name_en" type="text" label="{{ __('dashboard.name_en') }}"
                                     placeholder="{{ __('dashboard.name_en') }}" value="{{ $commission->name_en }}"/>

                <x-input.input-field type="select" name="value_type" label="{{ __('dashboard.value_type') }}"
                                     placeholder="{{ __('dashboard.value_type') }}"
                                     :options="CommissionValueTypeEnum::values()" :value="$commission->value_type"
                                     showName="name_en"/>

                <div class="row mt-3">


                    <x-input.input-field name="value" type="number" label="{{ __('dashboard.value') }}"
                                         placeholder="{{ __('dashboard.value') }}" value="{{ $commission->value }}"/>

                </div>


            </x-form.form-component>

        </x-cards.page-card>
    </div>
@endsection
@section('js_addons')

@endsection
