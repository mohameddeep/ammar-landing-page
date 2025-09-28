@extends('dashboard.core.app')
@section('title', __('dashboard.order_returns'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.order_returns') }}" :breadcrumbs="[['name' => __('dashboard.order_returns'), 'route' => 'order_returns.index']]" />
        <!-- Page Header Close -->
        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.order_returns')
                </div>

                <div class="card-tools">
                    <a href="{{ route('order-returns.index', ['status' => 'pending']) }}" class="btn btn-outline-secondary {{request()->status == 'pending' || ! request()->status ? 'active' : ''}}">@lang('dashboard.pending')</a>
                    <a href="{{ route('order-returns.index', ['status' => 'accepted']) }}" class="btn btn-outline-secondary {{request()->status == 'accepted' ? 'active' : ''}}">@lang('dashboard.accepted')</a>
                    <a href="{{ route('order-returns.index', ['status' => 'rejected']) }}" class="btn btn-outline-secondary {{request()->status == 'rejected' ? 'active' : ''}}">@lang('dashboard.rejected')</a>
                </div>

            </x-slot>
            <div class="table-responsive">
               <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.order_number')</th>
                            <th>@lang('dashboard.username')</th>
                            <th>@lang('dashboard.status')</th>
                            <th>@lang('dashboard.return_reason')</th>
                            <th>@lang('dashboard.Operations')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($returnOrders as $order)
                            <tr id="row-{{ $order->id }}">
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $order->order?->order_num }}
                                </td>
                                <td>
                                    {{ $order->user?->name }}
                                </td>
                                <td><span class="{{ $order->status->color() }}">{{ $order->status }}</span></td>
                                <td>{{ substr($order->reason, 0, 100) }}</td>
                                <td>
                                    <div class="hstack gap-2 fs-15">
                                        <x-buttons.show-button :route="route('order-returns.show', $order->id)"/>
{{--                                        <x-buttons.delete-button :route="route('return_orders.destroy', $order->id)" :itemId="$order->id" />--}}
                                        @if(request()->status == 'pending' || ! request()->status)
                                            <a href="{{ route('order-returns.accept', $order->id) }}" class="btn btn-outline-secondary">@lang('dashboard.accept')</a>
                                            <a href="{{ route('order-returns.reject', $order->id) }}" class="btn btn-outline-secondary">@lang('dashboard.reject')</a>
                                        @endif
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
                    {{ $returnOrders->links() }}
                </div>

            </x-slot>
        </x-cards.page-card>
    </div>
@endsection
