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
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.Create Pcackage')
                </div>
                <div class="d-flex">
                    <div class="py-2 d-flex justify-content-end align-items-center">
                        <x-buttons.create-button :route="route('packages.create')" />
                    </div>
                </div>
            </x-slot>
            <div class="row py-3 px-2">
                @foreach ($packages as $package)
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-12 mb-4" id="row-{{ $package->id }}">
                        <div class="card h-100 d-flex flex-column">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <button
                                        class="me-2 btn w-100 toggle-package-btn {{ $package->is_active ? 'btn-secondary' : 'btn-success' }}"
                                        data-id="{{ $package->id }}" data-active="{{ $package->is_active }}">
                                        {{ $package->is_active ? __('Dectivate') : __('Activate') }}

                                    </button>
                                    <button
                                        class="btn w-100 toggle-package-btn-hidden {{ $package->is_hidden ? 'btn-warning' : 'btn-primary' }}"
                                        data-id="{{ $package->id }}" data-active="{{ $package->is_hidden }}">
                                        {{ $package->is_hidden ? __('Hide') : __('Visible') }}

                                    </button>
                                </div>
                                <div class="p-1 flex-grow-1 d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="fw-bold mb-0">{{ $package->t('name') }}</h5>
                                        <span
                                            class="badge {{ $package->type->color() }} text-capitalize d-flex align-items-center ms-2 gap-1">
                                            <i class="{{ $package->type->icon() }}"></i>
                                            {{ $package->type->t() }}
                                        </span>
                                    </div>

                                    <div class="card p-3 rounded-3 mb-2">
                                        <div class="row text-center mb-3">
                                            <div class="col">
                                                <div class="fs-20 fw-bold">{{ $package->duration }}</div>
                                                <div class="text-muted fs-12">Days Duration</div>
                                            </div>
                                            <div class="col">
                                                <div class="fs-20 fw-bold">{{ $package->price }}</div>
                                                <div class="text-muted fs-12">USD</div>
                                            </div>
                                            <div class="col">
                                                <div class="fs-20 fw-bold">{{ $package->product_number }}</div>
                                                <div class="text-muted fs-12">Products Allowed</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-muted small">{{ $package->t('description') }}</div>

                                    {{-- <ul class="list-unstyled mb-0 flex-grow-1">
                                        @forelse ($package->features as $feature)
                                            <li class="d-flex align-items-center mb-2">
                                                <span class="me-2">
                                                    <i class="ri-checkbox-circle-line fs-15 toggle-feature-icon {{ $feature->is_active ? 'text-success' : 'text-muted' }}"
                                                        data-id="{{ $feature->id }}"
                                                        data-active="{{ $feature->is_active ? 1 : 0 }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        data-bs-custom-class="{{ $feature->is_active ? 'tooltip-success' : 'tooltip-muted' }}"
                                                        title="{{ $feature->is_active ? 'اضغط لإلغاء التفعيل' : 'اضغط للتفعيل' }}"
                                                        role="button" style="cursor: pointer;">
                                                    </i>
                                                </span>
                                                <span>
                                                    <strong class="me-1">2 Free</strong>
                                                    {{ $feature->t('feature') }}
                                                </span>
                                            </li>
                                        @empty
                                            <li class="text-muted">No features available</li>
                                        @endforelse
                                    </ul> --}}
                                    <div class="mt-auto pt-3 d-flex justify-content-between align-items-center">
                                        <x-buttons.show-button tooltipTitle="show details" :route="route('packages.show.details', $package->id)" />
                                        <x-buttons.edit-button :route="route('packages.edit', $package->id)" />
                                        <x-buttons.delete-button :route="route('packages.destroy', $package->id)" :itemId="$package->id" />
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach



            </div>

        </x-cards.page-card>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).on('click', '.toggle-package-btn-hidden', function() {
            const $btn = $(this);
            const packageId = $btn.data('id');
            const currentState = $btn.data('active');
            const newState = currentState ? 0 : 1;

            const routeUrl = `{{ url('/packages/toggle_hidden/__id__') }}`.replace('__id__', packageId);

            $.ajax({
                url: routeUrl,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    is_hidden: newState
                },
                success: function(response) {
                    if (response.data.success) {
                        $btn.data('active', newState);

                        if (newState === 1) {
                            $btn
                                .removeClass('btn-primary')
                                .addClass('btn-warning')
                                .text('Hide');
                        } else {
                            $btn
                                .removeClass('btn-warning')
                                .addClass('btn-primary')
                                .text('Visible');
                        }

                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                        });
                    }
                },
                error: function(xhr, status) {
                    Swal.fire({
                        icon: 'error',
                        title: xhr.responseJSON?.message || 'Something went wrong',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                    });
                }
            });
        });



        $(document).on('click', '.toggle-package-btn', function() {
            const $btn = $(this);
            const packageId = $btn.data('id');
            const currentState = $btn.data('active');
            const newState = currentState ? 0 : 1;

            const routeUrl = `{{ url('/packages/toggle/__id__') }}`.replace('__id__', packageId);

            $.ajax({
                url: routeUrl,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    is_active: newState
                },
                success: function(response) {
                    if (response.data.success) {
                        $btn.data('active', newState);

                        if (newState === 1) {
                            $btn
                                .removeClass('btn-success')
                                .addClass('btn-secondary')
                                .text('Dectivate');
                        } else {
                            $btn
                                .removeClass('btn-secondary')
                                .addClass('btn-success')
                                .text('Activate');
                        }

                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                        });
                    }
                },
                error: function(xhr, status) {
                    Swal.fire({
                        icon: 'error',
                        title: xhr.responseJSON?.message || 'Something went wrong',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                    });
                }
            });
        });


        $(document).on('click', '.toggle-feature-icon', function() {
            const $icon = $(this);
            const featureId = $icon.data('id');
            const currentState = $icon.data('active');
            const newState = currentState ? 0 : 1;

            const routeUrl = `{{ url('/packages/feature/toggle/__id__') }}`.replace('__id__', featureId);

            $.ajax({
                url: routeUrl,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    is_active: newState
                },
                success: function(response) {
                    if (response.data.success) {
                        $icon.data('active', newState);

                        if (newState === 1) {
                            $icon
                                .removeClass('text-muted')
                                .addClass('text-success')
                                .attr('title', 'اضغط لإلغاء التفعيل')
                                .tooltip('dispose')
                                .tooltip();
                        } else {
                            $icon
                                .removeClass('text-success')
                                .addClass('text-muted')
                                .attr('title', 'اضغط للتفعيل')
                                .tooltip('dispose')
                                .tooltip();
                        }

                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: xhr.responseJSON?.message || 'حدث خطأ ما',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 5000
                    });
                }
            });
        });
    </script>
@endpush
