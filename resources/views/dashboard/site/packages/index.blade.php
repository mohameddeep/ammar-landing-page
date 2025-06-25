@extends('dashboard.core.app')
@section('title', __('dashboard.commissions'))
@section('css_addons')

@endsection
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.commissions') }}" :breadcrumbs="[['name' => __('dashboard.commissions')]]" />
        <!-- Page Header Close -->
        <x-cards.page-card>

            <div class="row py-3 px-2">
                @foreach ($packages as $package)
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-12">
                        <div class="">
                            <div class="card-body p-0">
                                <div class="px-1 py-2 bg-success op-3">

                                    <span class="text-white fs-12 ms-1">{{$package->is_hidden}}</span>

                                </div>
                                <div class="p-4">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="fs-18 fw-semibold">{{ $package->t('name') }}</div>
                                        <div>
                                            <span class="badge bg-success-transparent">For Indivudials</span>
                                        </div>
                                    </div>
                                    <div class="fs-25 fw-bold mb-1">
                                        {{ $package->duration }}
                                        <sub class="text-muted fw-semibold fs-11 ms-1">
                                            duration with days
                                        </sub>
                                    </div>
                                    <div class="mb-1 text-muted">{{$package->t('description')}}</div>
                                    {{-- <div class="fs-12 mb-3"><u>Billed Monthly</u></div> --}}
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-flex align-items-center mb-3">
                                            <span class="me-2">
                                                <i class="ri-checkbox-circle-line fs-15 text-success"></i>
                                            </span>
                                            <span>
                                                <strong class="me-1">2 Free</strong>Websites
                                            </span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <span class="me-2">
                                                <i class="ri-checkbox-circle-line fs-15 text-success"></i>
                                            </span>
                                            <span>
                                                <strong class="me-1">1 GB</strong>Hard disk storage
                                            </span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <span class="me-2">
                                                <i class="ri-checkbox-circle-line fs-15 text-muted op-3"></i>
                                            </span>
                                            <span>
                                                <strong class="me-1">1 Year</strong>Email support
                                            </span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <span class="me-2">
                                                <i class="ri-checkbox-circle-line fs-15 text-muted op-3"></i>
                                            </span>
                                            <span>
                                                <strong class="me-1">2</strong>Licenses
                                            </span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <span class="me-2">
                                                <i class="ri-checkbox-circle-line fs-15 text-muted op-3"></i>
                                            </span>
                                            <span>
                                                Custom SEO optimizataion
                                            </span>
                                        </li>
                                        <li class="d-flex align-items-center mb-3">
                                            <span class="me-2">
                                                <i class="ri-checkbox-circle-line fs-15 text-muted op-3"></i>
                                            </span>
                                            <span>
                                                Chat Support
                                            </span>
                                        </li>
                                        <li class="d-grid">
                                            <button class="btn btn-light btn-wave">Choose Plan</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

        </x-cards.page-card>
    </div>
@endsection
