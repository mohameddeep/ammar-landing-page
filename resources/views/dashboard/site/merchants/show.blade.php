@extends('dashboard.core.app')
@section('title')
@section('css_addons')
    <link href="{{ asset('assets/libs/apexcharts/apexcharts.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.Profile') }}" :breadcrumbs="[['name' => __('dashboard.User')], ['name' => __('dashboard.Profile')]]" />

        <!-- Page Header Close -->
        <div class="row ">

            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                <x-cards.page-card>
                    <div class="d-sm-flex align-items-top p-4 border-bottom border-block-end-dashed">
                        <div>
                            <span
                                class="avatar avatar-xxl avatar-rounded {{ $merchant->is_active == 1 ? 'online' : 'offline' }} me-3">
                                @if ($merchant->image)
                                    <img src="@image($merchant->image)" alt="img">
                                @else
                                    <img src="{{ asset('img/user2-160x160.jpg') }}" alt="img">
                                @endif
                            </span>
                        </div>

                        <div class="flex-fill main-profile-info ">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="flex-grow-1">
                                    <h4 class="fw-semibold mb-1 text-fixed-dark p-2">{{ $merchant->name }}</h4>
                                </div>

                                <div class="d-flex gap-2">
                                    <x-buttons.edit-button :route="route('users.edit', $merchant->id)" />
                                    <x-buttons.edit-button :route="route('settings.edit', $merchant->id)" icon="bx bx-fingerprint"
                                        class="m-0 btn btn-icon btn-outline-danger" tooltipColor="tooltip-danger"
                                        tooltipTitle="dashboard.Settings" />
                                </div>
                            </div>
                            <p class="fs-30 mb-1 op-5">
                                <span class=" ms-2 badge {{ $merchant->type->color() }}">
                                    <i class="{{ $merchant->type->icon() }}"></i> {{ $merchant->type->t() }}
                                </span>
                            </p>

                        </div>

                    </div>

                    <div class="p-4 border-bottom border-block-end-dashed">
                        <p class="fs-15 mb-2 me-4 fw-semibold">@lang('dashboard.Contact Information') :</p>
                        <div class="text-muted">
                            <p class="mb-2">
                                <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                                    <i class="ri-mail-line align-middle fs-14"></i>
                                </span>
                                {{ $merchant->email ?? '' }}
                            </p>
                            <p class="mb-2">
                                <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                                    <i class="ri-phone-line align-middle fs-14"></i>
                                </span>
                                {{ $merchant->phone ?? '' }}
                            </p>
                            <p class="mb-2">
                                <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                                    <i class="ri-calendar-line align-middle fs-14"></i>
                                </span>
                                @lang('Created at') : @formatDate($merchant->created_at)
                            </p>

                            <p class="mb-2">
                                <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                                    <i class="ri-time-line align-middle fs-14"></i>
                                </span>
                                @lang('Updated at') : @formatDate($merchant->updated_at)
                            </p>


                            {{-- @if ($merchant->default_address)
                                <p class="mb-2">
                                    <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                                        <i class="ri-map-pin-line align-middle fs-14"></i>
                                    </span>

                                    @if ($merchant?->default_address?->street_name)
                                        <span class="text-muted">{{ $merchant?->default_address?->street_name }}</span>,
                                    @endif

                                    @if ($merchant?->default_address?->city)
                                        <span class="text-muted">{{ $merchant?->default_address?->city }}</span>,
                                    @endif

                                    @if ($merchant?->default_address?->building_name)
                                        <span class="text-muted">{{ $merchant?->default_address?->building_name }}</span>,
                                    @endif

                                    @if ($merchant?->default_address?->landmark)
                                        <span class="text-muted">{{ $merchant?->default_address?->landmark }}</span>
                                    @endif

                                </p>
                            @else
                                <span class="avatar avatar-sm avatar-rounded me-2 bg-light text-muted">
                                    <i class="ri-map-pin-line align-middle fs-14"></i>
                                </span>
                                @include('dashboard.core.includes.no-entries', ['columns' => 0])
                            @endif --}}


                        </div>
                    </div>



                </x-cards.page-card>
            </div>

            <div class="col-xxl-7 col-xl-12">

                <x-cards.page-card>
                    <div class="table-responsive">
                        <div
                            class="border-bottom border-block-end-dashed d-flex align-items-center justify-content-between">
                            <div>
                                <ul class="nav nav-tabs mb-0 tab-style-6 justify-content-start" id="myTab"
                                    role="tablist">
                                    <li class="nav-item p-2" role="presentation">
                                        <x-cards.dynamic-nav-tabs.tab-button id="products-tab" target="products-tab-pane"
                                            label="{{ __('dashboard.products') }}" iconClass="bx bx-shopping-bag"
                                            :active="true" />
                                    </li>

                                    <li class="nav-item p-2" role="presentation">
                                        <x-cards.dynamic-nav-tabs.tab-button id="packages-tab" target="packages-tab-pane"
                                            label="{{ __('dashboard.packages') }}" iconClass="ti ti-package" />
                                    </li>


                                </ul>
                            </div>

                        </div>
                        <div class="p-2">

                            <div class="tab-content" id="myTabContent">


                                <x-cards.dynamic-nav-tabs.tab-pane id="products-tab-pane" labelledby="products-tab"
                                    :active="true">
                                    <div class="container-flude">
                                        <div class="px-4 py-2 border-bottom border-block-end-dashed">
                                            <h4>
                                                <span class="text-primary text-start">{{ __('dashboard.products') }}</span>
                                            </h4>
                                        </div>
                                        @foreach ($merchant->products as $product)
                                            <x-cards.lists.list-profile-data :recevedData="$product" :icon="'ti ti-file-invoice'" />
                                        @endforeach
                                    </div>

                                </x-cards.dynamic-nav-tabs.tab-pane>

                                <x-cards.dynamic-nav-tabs.tab-pane id="packages-tab-pane" labelledby="packages-tab">
                                    <div class="container-flude">
                                        {{-- <div class="px-4 py-2 border-bottom border-block-end-dashed">
                                            <h4>
                                                <span class="text-primary text-start">{{ __('dashboard.packages') }}</span>
                                            </h4>
                                        </div> --}}

                                        @foreach ($merchant->packages as $package)
                                            <x-cards.lists.list-profile-data :recevedData="$package" :icon="'ti ti-package'" />
                                        @endforeach
                                    </div>
                                </x-cards.dynamic-nav-tabs.tab-pane>
                            </div>
                        </div>
                    </div>
                </x-cards.page-card>
            </div>

        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.tab-pane').hide();
            $('.tab-pane.active').css('display', 'block');

            $('#myTab button').on('click', function() {
                $('.tab-pane').hide();

                var target = $(this).attr('data-bs-target');

                $('#myTab button').removeClass('active');
                $(this).addClass('active');

                $(target).css('display', 'block');

                console.log('Displayed:', target);
            });
        });
    </script>
@endpush
