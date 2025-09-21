@extends('dashboard.core.app')
@section('title', __('dashboard.providers'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.providers') }}" :breadcrumbs="[['name' => __('dashboard.providers'), 'route' => 'providers.index'], ['name' => __('dashboard.details')]]" />

        <!-- Page Card -->
        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.details')
                </div>
            </x-slot>
            <div class=" d-sm-flex align-items-top p-4 border-bottom border-block-end-dashed">
                <div>
                    <span class="avatar avatar-xxl avatar-rounded online me-3">
                        <img src="../assets/images/faces/9.jpg" alt="">
                    </span>
                </div>
                <div class="flex-fill main-profile-info">
                    <div class="d-flex align-items-center justify-content-between">
                        <h3 class="fw-semibold mb-1 text-fixed-dark p-2">{{ $provider->name }}</h3>
                        <x-buttons.edit-button :route="route('providers.edit', $provider->id)" />

                    </div>
                </div>
            </div>
            <div class="p-4 border-bottom border-block-end-dashed">
                <p class="fs-15 mb-3 me-4 fw-semibold text-primary">
                    @lang('dashboard.Contact Information :')
                </p>
                <div class="text-muted">
                   

                   

                    @isset($provider->phone)
                        <p class="mb-2">
                            <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted shadow-sm">
                                <i class="ri-phone-line align-middle fs-14 "></i>
                            </span>
                            <strong>@lang('dashboard.phone'):</strong> {{ $provider->phone }}
                        </p>
                    @endisset

                    @isset($provider->brand_name)
                        <p class="mb-2">
                            <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted shadow-sm">
                                <i class="ri-provider-star-line align-middle fs-14"></i>
                            </span>
                            <strong>@lang('dashboard.brand_name'):</strong> {{ $provider->brand_name }}
                        </p>
                    @endisset

                  
                </div>
            </div>

          

        </x-cards.page-card>
        <!-- Page Card -->




    </div>



@endsection
@section('js_addons')

@endsection
