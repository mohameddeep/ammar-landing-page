@extends('dashboard.core.app')
@section('title', __('dashboard.orders'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.orders') }}" :breadcrumbs="[['name' => __('dashboard.orders'), 'route' => 'orders.index']]" />

        <!-- Page Header Close -->
        <div class="row ">
            <div class="col-xl-12">
                <x-cards.page-card>
                    <div class="card custom-card">
                        <div class="card-body d-flex align-items-center flex-wrap">
                            <div class="flex-fill">
                                <span class="mb-0 fs-14 text-muted">
                                    @lang('dashboard.total_orders') :
                                    <span class="fw-semibold text-success">{{ $ordersCount }}</span>
                                </span>
                            </div>

                            {{-- Dropdown --}}
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle m-1" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{-- لو فيه status اختاره، لو لأ اعرض النص الافتراضي --}}
                                    {{ request('status') ? __('dashboard.statuses.' . request('status')) : __('dashboard.filter_by_order_status') }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    {{-- زرار يرجع لكل الطلبات --}}
                                    <li>
                                        <a class="dropdown-item" href="{{ route('orders.index') }}">
                                            @lang('dashboard.all_orders')
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>

                                    {{-- الحالات --}}
                                    @foreach (['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('orders.index', ['status' => $status]) }}">
                                                @lang('dashboard.statuses.' . $status)
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            {{-- Search --}}
                            {{-- Search --}}
                            <form method="GET" action="{{ route('orders.index') }}" class="d-flex align-items-center m-1"
                                role="search">
                                <input class="form-control" type="search" name="search" value="{{ request('search') }}"
                                    placeholder="@lang('dashboard.search')" aria-label="Search">
                                <button class="btn btn-light ms-2" type="submit">@lang('dashboard.search')</button>
                            </form>

                            <a href="{{ route('orders.index') }}" class="btn btn-secondary ms-2" title="@lang('dashboard.reset')">
                                <i class="bi bi-arrow-repeat"></i>
                            </a>


                        </div>
                    </div>
                </x-cards.page-card>

            </div>

            @forelse($orders as $order)
                <div class="col-xl-6 col-xxl-3 col-lg-6 col-md-6 col-sm-12">
                    <x-cards.page-card>

                        <div class="card-header d-block">
                            <div class="d-sm-flex d-block align-items-center">
                                <div class="flex-fill">
                                    <span class="fs-14 fw-semibold">@lang('dashboard.provider_name') :</span>
                                    <span class="d-sm-block">{{ $order?->provider?->name }}</span>
                                </div>
                                <div class="text-sm-center">
                                    <span class="fs-14 fw-semibold">@lang('dashboard.order_id') :</span>
                                    <span class="d-sm-block">{{ $order->order_num }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="orders-delivery-address">
                                    <p class="mb-1 fw-semibold">@lang('dashboard.user_name')</p>
                                    <p class="text-muted mb-0">
                                        {{ $order?->user?->name }}
                                    </p>
                                </div>
                                <div class="delivery-date text-center ms-auto">
                                    <span class="fs-18 text-primary fw-bold">{{ $order->created_at->format('d') }}</span>
                                    <span class="fw-semibold">{{ $order->created_at->format('F') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-sm-flex d-block align-items-center justify-content-between">
                            <div><span class="text-muted me-2">@lang('dashboard.status'):</span><span
                                    class="badge bg-success-transparent">{{ $order->order_status }}</span></div>
                            <div class="mt-sm-0 mt-2">
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary-light">
                                    @lang('dashboard.order_details')</a>
                            </div>

                        </div>

                    </x-cards.page-card>
                </div>
            @empty
                @include('dashboard.core.includes.no-entries', ['columns' => 5])
            @endforelse
        </div>
        <div class="d-flex justify-content-end align-items-center">
            {{ $orders->links() }}
        </div>
    </div>
    </div>
@endsection
