@extends('dashboard.core.app')
@section('title', __('dashboard.users'))
@section('content')
    <div class="container-fluid">

        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.Home') }}" />
        <!-- Page Header Close -->

        <!-- Start::row-1 -->
        <div class="row">
            <div class="col-xxl-12 col-xl-12">
                <div class="row">

                    <div class="col-lg-6 col-sm-6 col-md-6 col-xl-6">
                        <a href="{{ route('users.index') }}" class="text-decoration-none">

                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-center ecommerce-icon success px-0">
                                          <span class="rounded p-3 bg-success-transparent">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" 
         viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0z" fill="none"/>
        <path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 
                 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 
                 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 
                 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5C15 
                 14.17 10.33 13 8 13zm8 0c-.29 0-.62.02-.97.05 
                 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/>
    </svg>
</span>

                                        </div>
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 ps-0">
                                            <div class="mb-2">@lang('dashboard.users')</div>
                                            <div class="text-muted mb-1 fs-12">
                                                <span class="text-dark fw-semibold fs-20 lh-1 vertical-bottom">
                                                    {{ $users }}
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xl-6">
                        <a href="{{ route('providers.index') }}" class="text-decoration-none">

                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-center ecommerce-icon success px-0">
                                           <span class="rounded p-3 bg-success-transparent">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" 
         viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0z" fill="none"/>
        <path d="M12 12c2.21 0 4-1.79 
                 4-4s-1.79-4-4-4-4 1.79-4 
                 4 1.79 4 4 4zm0 2c-2.67 
                 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
    </svg>
</span>

                                        </div>
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 ps-0">
                                            <div class="mb-2">@lang('dashboard.providers')</div>
                                            <div class="text-muted mb-1 fs-12">
                                                <span class="text-dark fw-semibold fs-20 lh-1 vertical-bottom">
                                                    {{ $providers }}
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xl-6">
                        <a href="{{ route('packages.index') }}" class="text-decoration-none">

                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-center ecommerce-icon warning px-0">
                                           <span class="rounded p-3 bg-warning-transparent">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" 
         viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0z" fill="none"/>
        <path d="M21 16V8c0-1.1-.9-2-2-2h-2V4c0-1.1-.9-2-2-2H9C7.9 
                 2 7 2.9 7 4v2H5C3.9 6 3 6.9 
                 3 8v8c0 1.1.9 2 2 2h2v2c0 
                 1.1.9 2 2 2h6c1.1 0 2-.9 
                 2-2v-2h2c1.1 0 2-.9 
                 2-2zm-6 6H9v-6h6v6z"/>
    </svg>
</span>

                                        </div>
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 ps-0">
                                            <div class="mb-2">@lang('dashboard.packages')</div>
                                            <div class="text-muted mb-1 fs-12">
                                                <span class="text-dark fw-semibold fs-20 lh-1 vertical-bottom">
                                                    {{ $packages }}
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xl-6">
                        <a href="{{ route('categories.index') }}" class="text-decoration-none">

                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-center ecommerce-icon warning px-0">
                                           <span class="rounded p-3 bg-warning-transparent">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px" 
         viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0z" fill="none"/>
        <path d="M3 5v4h4V5H3zm0 
                 10v4h4v-4H3zm7-10v4h11V5H10zm0 
                 10v4h11v-4H10z"/>
    </svg>
</span>

                                        </div>
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 ps-0">
                                            <div class="mb-2">@lang('dashboard.categories')</div>
                                            <div class="text-muted mb-1 fs-12">
                                                <span class="text-dark fw-semibold fs-20 lh-1 vertical-bottom">
                                                    {{ $categories }}
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xl-6">
                        <a href="{{ route('products.index') }}" class="text-decoration-none">

                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-center ecommerce-icon warning px-0">
                                          <span class="rounded p-3 bg-danger-transparent">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px"
         viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0z" fill="none"/>
        <path d="M16 6V4a4 4 0 0 
                 0-8 0v2H4v16h16V6h-4zm-6-2a2 
                 2 0 0 1 4 0v2h-4V4zm8 
                 18H6V8h12v14z"/>
    </svg>
</span>

                                        </div>
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 ps-0">
                                            <div class="mb-2">@lang('dashboard.products')</div>
                                            <div class="text-muted mb-1 fs-12">
                                                <span class="text-dark fw-semibold fs-20 lh-1 vertical-bottom">
                                                    {{ $products }}
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xl-6">
                        <a href="{{ route('subscriptions.index') }}" class="text-decoration-none">

                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-center ecommerce-icon warning px-0">
                                           <span class="rounded p-3 bg-info-transparent">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px"
         viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0z" fill="none"/>
        <path d="M20 6H4v12h16V6zm0-2c1.1 
                 0 2 .9 2 2v12c0 1.1-.9 2-2 
                 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 
                 2-2h16zM8 10h8v2H8v-2zm0 4h5v2H8v-2z"/>
    </svg>
</span>

                                        </div>
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 ps-0">
                                            <div class="mb-2">@lang('dashboard.subscriptions')</div>
                                            <div class="text-muted mb-1 fs-12">
                                                <span class="text-dark fw-semibold fs-20 lh-1 vertical-bottom">
                                                    {{ $subscriptions }}
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xl-6">
                        <a href="{{ route('orders.index') }}" class="text-decoration-none">

                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-center ecommerce-icon warning px-0">
                                           <span class="rounded p-3 bg-primary-transparent">
    <svg xmlns="http://www.w3.org/2000/svg" height="24px" width="24px"
         viewBox="0 0 24 24" fill="currentColor">
        <path d="M0 0h24v24H0z" fill="none"/>
        <path d="M7 18c-1.1 0-1.99.9-1.99 
                 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 
                 0c-1.1 0-1.99.9-1.99 
                 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zM7.16 
                 14.26l.84-1.68h7.45c.75 
                 0 1.41-.41 1.75-1.03l3.58-6.49A1 
                 1 0 0 0 20 3H5.21l-.94-2H1v2h2l3.6 
                 7.59-1.35 2.44C4.52 13.37 5.48 
                 15 7 15h12v-2H7.42c-.14 0-.25-.11-.26-.24z"/>
    </svg>
</span>

                                        </div>
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 ps-0">
                                            <div class="mb-2">@lang('dashboard.orders')</div>
                                            <div class="text-muted mb-1 fs-12">
                                                <span class="text-dark fw-semibold fs-20 lh-1 vertical-bottom">
                                                    {{ $ordersCount }}
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>


                </div>
            </div>

        </div>
        <!--End::row-1 -->

        <!-- Start:: row-2 -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <div class="card-title">
                           @lang('dashboard.latest_orders')
                        </div>
                        {{-- <div class="d-flex">
                            <div class="me-3">
                                <input class="form-control form-control-sm" type="text" placeholder="Search"
                                    aria-label=".form-control-sm example">
                            </div>
                            <div class="dropdown">
                                <a href="javascript:void(0);"
                                    class="btn btn-primary btn-sm btn-wave waves-effect waves-light"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Sort By<i class="ri-arrow-down-s-line align-middle ms-1 d-inline-block"></i>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="dropdown-item" href="javascript:void(0);">New</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Popular</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0);">Relevant</a></li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">@lang('dashboard.order_id')</th>
                                        <th scope="col">@lang('dashboard.provider_name')</th>
                                         <th scope="col">@lang('dashboard.user_name')</th>
                                           <th scope="col">@lang('dashboard.status')</th>
                                        <th scope="col">@lang('dashboard.total_price') </th>
                                        <th>@lang('dashboard.Operations')</th>
                                    </tr>
                                </thead>
                                <tbody>
                            @forelse($orders as $order)
                                    
                                    <tr>
                                        <td>
                                           <span class="fw-semibold">{{ $order->order_num }}</span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold">{{ $order?->provider?->name }}</span>
                                        </td>
                                        <td>
                                            <span class="fw-semibold">{{ $order?->user?->name }}</span>
                                        </td>
                                      
                                        <td>
                                            <span class="badge bg-success-transparent">{{ $order->order_status }}</span>
                                        </td>
                                          <td>
                                    {{ $order->grand_total  }}                                    
                                    </td>
                                       
                                    <td>
                                    <div class="hstack gap-2 fs-15">

                                        <x-buttons.show-button :route="route('orders.show', $order->id)" :tooltip-title="__('dashboard.order_details')" />
                                    </div>
                                </td>
                                    </tr>
                                    @empty
                            @include('dashboard.core.includes.no-entries', ['columns' => 5])
                        @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        {{$orders->links()}}
                    </div>
                </div>
            </div>
        </div>
        <!-- End:: row-2 -->

    </div>
@endsection
