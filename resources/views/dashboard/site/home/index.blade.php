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
                    <div class="col-lg-4 col-sm-6 col-md-6 col-xl-4">
                        <a href="{{ route('services.index') }}" class="text-decoration-none">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-center ecommerce-icon primary px-0">
                                            <span class="rounded p-3 bg-primary-transparent">
                                                <i class="ti ti-briefcase fs-24 text-primary"></i>
                                            </span>
                                        </div>
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 ps-0">
                                            <div class="mb-2">@lang('dashboard.services')</div>
                                            <div class="text-muted mb-1 fs-12">
                                                <span class="text-dark fw-semibold fs-20 lh-1 vertical-bottom">
                                                    {{ $statistics['services_count'] ?? 0 }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-md-6 col-xl-4">
                        <a href="{{ route('sliders.index') }}" class="text-decoration-none">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-center ecommerce-icon success px-0">
                                            <span class="rounded p-3 bg-success-transparent">
                                                <i class="ti ti-slideshow fs-24 text-success"></i>
                                            </span>
                                        </div>
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 ps-0">
                                            <div class="mb-2">@lang('dashboard.sliders')</div>
                                            <div class="text-muted mb-1 fs-12">
                                                <span class="text-dark fw-semibold fs-20 lh-1 vertical-bottom">
                                                    {{ $statistics['sliders_count'] ?? 0 }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-lg-4 col-sm-6 col-md-6 col-xl-4">
                        <a href="{{ route('contacts.index') }}" class="text-decoration-none">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div
                                            class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 d-flex align-items-center justify-content-center ecommerce-icon warning px-0">
                                            <span class="rounded p-3 bg-warning-transparent">
                                                <i class="ti ti-phone fs-24 text-warning"></i>
                                            </span>
                                        </div>
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8 ps-0">
                                            <div class="mb-2">@lang('dashboard.contacts')</div>
                                            <div class="text-muted mb-1 fs-12">
                                                <span class="text-dark fw-semibold fs-20 lh-1 vertical-bottom">
                                                    {{ $statistics['contacts_count'] ?? 0 }}
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



    </div>
@endsection
