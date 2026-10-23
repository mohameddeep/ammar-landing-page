@extends('dashboard.core.app')
@section('title', __('dashboard.projects'))

@section('content')
    <div class="container-fluid px-5 py-3">
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.projects') }}" :breadcrumbs="[
            ['name' => __('dashboard.projects'), 'route' => 'projects.index'],
            ['name' => __('dashboard.Create')],
        ]" />

        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">@lang('dashboard.Create')</div>
            </x-slot>
            <x-form.form-component :route="route('projects.store')" method="POST">
                @include('dashboard.site.projects.partials.form')
            </x-form.form-component>
        </x-cards.page-card>
    </div>
@endsection
