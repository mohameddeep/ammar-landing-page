@extends('dashboard.core.app')
@section('title', __('dashboard.providers'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.providers') }}" :breadcrumbs="[['name' => __('dashboard.providers'), 'route' => 'providers.index']]" />
        <!-- Page Header Close -->
        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.providers')
                </div>
                <div class="d-flex">
                    <div class="py-2 d-flex justify-content-end align-items-center">
                
                        <x-buttons.create-button :route="route('providers.create')" />
                    </div>
                </div>
            </x-slot>
            <div class="table-responsive">
                <table class="table text-nowrap" id="providers_table">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.Name')</th>
                            <th>@lang('dashboard.brand_name')</th>
                            <th>@lang('dashboard.Phone')</th>
                            <th>@lang('dashboard.Operations')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($providers as $provider)
                            <tr id="row-{{ $provider->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $provider->name }}</td>
                                <td>{{ $provider->brand_name }}</td>
                                <td>{{ $provider->phone }}</td>
                                <td>
                                    <div class="hstack gap-2 fs-15">
                                        <x-buttons.show-button :route="route('providers.products', $provider->id)" :tooltip-title="__('dashboard.my-products')"/>
                                        <x-buttons.edit-button :route="route('providers.edit', $provider->id)" />
                                        <x-buttons.delete-button :route="route('providers.destroy', $provider->id)" :itemId="$provider->id" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            @include('dashboard.core.includes.no-entries', ['columns' => 5])
                        @endforelse
                    </tbody>
                </table>
            </div>
            <x-slot name="footer">
                <div class="d-flex justify-content-end align-items-center">
                    {{ $providers->links() }}
                </div>

            </x-slot>
        </x-cards.page-card>
    </div>
@endsection
@section('js_addons')

@endsection
