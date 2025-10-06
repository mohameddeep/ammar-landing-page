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
                <div class="py-2 d-flex justify-content-end align-items-center">
                        <form method="GET" action="{{ route('providers.index') }}" class="d-flex align-items-center m-1"
                            role="search">
                            <input class="form-control" type="search" name="search" value="{{ request('search') }}"
                                placeholder="@lang('dashboard.search')" aria-label="Search">
                            <button class="btn btn-light ms-2" type="submit">@lang('dashboard.search')</button>
                        </form>

                        <a href="{{ route('providers.index') }}" class="btn btn-secondary ms-2" title="@lang('dashboard.reset')">
                            <i class="bi bi-arrow-repeat"></i>
                        </a>

                    </div>
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
                            <th>@lang('dashboard.wallet_balance')</th>
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
                                <td>{{ $provider->wallet_balance }}</td>
                                <td>
                                    <div class="hstack gap-2 fs-15">
                                        <x-buttons.show-button :route="route('providers.products', $provider->id)" :tooltip-title="__('dashboard.my-products')"/>
                                        <x-buttons.show-button :route="route('providers.transactions', $provider->id)" :tooltip-title="__('dashboard.transactions')"/>
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
