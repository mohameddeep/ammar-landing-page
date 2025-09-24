@extends('dashboard.core.app')
@section('title', __('dashboard.coupons'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.coupons') }}" :breadcrumbs="[['name' => __('dashboard.coupons'), 'route' => 'coupons.index']]" />
        <!-- Page Header Close -->
        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.coupons')
                </div>
                <div class="d-flex">
                    <div class="py-2 d-flex justify-content-end align-items-center">
                        <x-buttons.create-button :route="route('dashobard.coupons.create')" />
                    </div>
                </div>
            </x-slot>
            <div class="table-responsive">
                <table class="table text-nowrap" id="users_table">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.Name')</th>
                            <th>@lang('dashboard.code')</th>
                            <th>@lang('dashboard.discount')</th>
                            <th>@lang('dashboard.usage_count')</th>
                            <th>@lang('dashboard.expire_at')</th>
                            <th>@lang('dashboard.Operations')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($coupons as $coupon)
                            <tr id="row-{{ $coupon->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $coupon->name }}</td>
                                <td>{{ $coupon->code }}</td>
                              <td>{{(int)$coupon->discount}} %</td>
                                <td>{{ $coupon->usage_count }}</td>
                                <td>{{ $coupon->expire_at }}</td>
                                
                                <td>
                                    <div class="hstack gap-2 fs-15">
                                        <x-buttons.edit-button :route="route('dashobard.coupons.edit', $coupon->id)" />
                                        <x-buttons.delete-button :route="route('dashobard.coupons.destroy', $coupon->id)" :itemId="$coupon->id" />
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
                    {{ $coupons->links() }}
                </div>

            </x-slot>
        </x-cards.page-card>
    </div>
@endsection
