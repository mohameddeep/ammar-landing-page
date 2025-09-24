@extends('dashboard.core.app')
@section('title', __('dashboard.coupons'))
@section('content')
<div class="container-fluid px-5 py-3">
    <!-- Page Header -->
    <x-breadcrumb.breadcrumb title="{{ __('dashboard.coupons') }}" :breadcrumbs="[
            ['name' => __('dashboard.coupons'), 'route' => 'dashobard.coupons.index'],
            ['name' => __('dashboard.Edit')],
        ]" />

    <x-cards.page-card>

        <x-slot name="header">
            <div class="card-title">
                @lang('dashboard.Edit')
            </div>
        </x-slot>

        <x-form.form-component :route="route('dashobard.coupons.update', $coupon->id)" method="PUT">

            <x-input.input-field name="name" label="{{ __('dashboard.Name') }}" placeholder="{{ __('dashboard.Name_ar') }}" class="custom-class" id="nameInput" :value="$coupon->name"/>


            <x-input.input-field name="code" label="{{ __('dashboard.code') }}" placeholder="{{ __('dashboard.code') }}" class="custom-class" id="nameInput" :value="$coupon->code"/>

            <x-input.input-field name="discount" type="number" label="{{ __('dashboard.discount') }}" placeholder="{{ __('dashboard.discount') }}" class="custom-class" id="nameInput"  :value="$coupon->discount"/>

            <x-input.input-field name="usage_count" type="number" label="{{ __('dashboard.usage_count') }}" placeholder="{{ __('dashboard.usage_count') }}" class="custom-class" id="nameInput" :value="$coupon->usage_count"/>


            <x-input.input-field name="expire_at" type="datetime-local" label="{{ __('dashboard.expire_at') }}" placeholder="{{ __('dashboard.expire_at') }}" class="custom-class" id="nameInput" :value="$coupon->expire_at"/>



        </x-form.form-component>

    </x-cards.page-card>
</div>
@endsection
@section('js_addons')

@endsection
