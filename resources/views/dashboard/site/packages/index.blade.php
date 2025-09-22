@extends('dashboard.core.app')
@section('title', __('dashboard.packages'))
@section('css_addons')
    <style>
        .card-container-css {
            position: relative;
        }

        .card-actions-sidebar {
            position: absolute;
            top: 1rem;
            right: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            padding: 0.5rem;
            border-radius: 1rem;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(6px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: opacity 0.3s ease, transform 0.3s ease;
            opacity: 0;
            transform: translateY(-10px);
            z-index: 10;
        }

        .card-container-css:hover .card-actions-sidebar {
            opacity: 1;
            transform: translateY(0);
        }

        .card-actions-sidebar .btn-icon {
            width: 36px;
            height: 36px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            border-radius: 50%;
        }

        .tooltip-primary,
        .tooltip-secondary,
        .tooltip-warning,
        .tooltip-success {
            font-size: 12px;
            padding: 4px 8px;
        }

        /* RTL Support */
        [dir="rtl"] .card-actions-sidebar {
            right: auto;
            left: 1rem;
        }
    </style>



@endsection
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.packages') }}" :breadcrumbs="[['name' => __('dashboard.packages')]]" />
        <!-- Page Header Close -->
        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.Create') @lang('dashboard.packages')
                </div>
                <div class="d-flex">
                    <div class="py-2 d-flex justify-content-end align-items-center">
                        <x-buttons.create-button :route="route('packages.create')" />
                    </div>
                </div>
            </x-slot>
            <div class="row py-3 px-2">
                @foreach ($packages as $package)
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-4" id="row-{{ $package->id }}">
                        <div class="card h-100 d-flex flex-column card-container-css">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                                    <div class="d-flex align-items-center flex-grow-1 gap-3">
                                        @if (isset($package->image) && $package->image)
                                            <span data-status-indicator data-package-id="{{ $package->id }}"
                                                class="avatar avatar-lg avatar-rounded {{ $package->is_active ? 'online' : 'offline' }} overflow-hidden"
                                                >
                                                <img src="@image($package->image)" alt="img" class="img-fluid">
                                            </span>
                                        @else
                                            <div data-status-indicator data-package-id="{{ $package->id }}"
                                                class="avatar avatar-lg avatar-rounded {{ $package->is_active ? 'online' : 'offline' }} d-flex align-items-center justify-content-center bg-light text-primary"
                                                data-status-indicator data-package-id="{{ $package->id }}">
{{--                                                <img src="{{ $package->type->icon() }}" alt="Icon" class="img-fluid"--}}
{{--                                                    style="width: 24px;">--}}
                                            </div>
                                        @endif

                                        <div class="d-flex flex-column">
                                            <p class="fw-bold mb-1 text-dark d-flex align-items-center gap-2">
                                                {{ $package->t('name') }}
{{--                                                <span class="badge {{ $package->type->color() }}">--}}
{{--                                                    {{ $package->type->t() }}--}}
{{--                                                </span>--}}
                                            </p>
                                            <div class="text-muted fw-semibold d-flex align-items-center">
                                                {{ $package->price }}
                                                <img src="{{ asset('icons/Saudi_Riyal_Symbol.svg') }}" alt="SAR"
                                                    class="mx-1" style="width: 16px;">
                                                / {{ $package->duration }} @lang('dashboard.day')
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-actions-sidebar">
                                        <button type="button"
                                            class="btn btn-icon {{ $package->is_active ? 'btn-outline-secondary' : 'btn-outline-success' }} toggle-package-btn"
                                            data-id="{{ $package->id }}" data-active="{{ $package->is_active }}"
                                            data-bs-toggle="tooltip"
                                            data-bs-custom-class="{{ $package->is_active ? 'tooltip-secondary' : 'tooltip-success' }}"
                                            data-bs-placement="top"
                                            title="{{ $package->is_active ? 'إلغاء التفعيل' : 'تفعيل الباقة' }}">
                                            <i
                                                class="{{ $package->is_active ? 'ri-close-circle-line' : 'ri-checkbox-circle-line' }}"></i>
                                        </button>

                                        <button type="button"
                                            class="btn btn-icon {{ $package->coming_soon ? 'btn-outline-warning' : 'btn-outline-primary' }} toggle-package-btn-hidden"
                                            data-id="{{ $package->id }}" data-active="{{ $package->coming_soon }}"
                                            data-bs-toggle="tooltip"
                                            data-bs-custom-class="{{ $package->coming_soon ? 'tooltip-warning' : 'tooltip-primary' }}"
                                            data-bs-placement="top"
                                            title="{{ $package->coming_soon ? 'إخفاء الباقة' : 'إظهار الباقة' }}">
                                            <i class="{{ $package->coming_soon ? 'ri-eye-off-line' : 'ri-eye-line' }}"></i>
                                        </button>
                                        <x-buttons.edit-button :route="route('packages.edit', $package->id)" />
                                            @if($package->type->value == 'provider')
                                        <x-buttons.delete-button :route="route('packages.destroy', $package->id)" :itemId="$package->id" />
                                         @endif
                                        </div>

                                </div>
                                <div class="mb-3">
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="border rounded-2 p-3 bg-light ">
                                                <div class="d-flex align-items-center mb-1">
                                                    <i class="ri-stack-line text-primary me-2 fs-5"></i>
                                                    <span class="text-muted small">@lang('dashboard.product_count')</span>
                                                </div>
                                                <div class="fw-bold fs-5">{{ $package->product_count }}</div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div class="border rounded-2 p-3 bg-light">
                                                <div class="d-flex align-items-center mb-1">
                                                    <i class="ri-gift-line text-success me-2 fs-5"></i>
                                                    <span class="text-muted small">@lang('dashboard.free_product_count')</span>
                                                </div>
                                                <div class="fw-bold fs-5">{{ $package->free_product_count }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-unstyled mb-0 flex-grow-1 mt-3" style="flex-wrap: wrap;">
                                    @forelse ($package->features as $feature)
                                        <li class="d-flex align-items-center mb-2">
                                            <span class="me-2">
                                                <i class="ri-checkbox-circle-line fs-2 toggle-feature-icon {{ $feature->is_active ? 'text-success' : 'text-muted' }}"
                                                    data-id="{{ $feature->id }}"
                                                    data-active="{{ $feature->is_active ? 1 : 0 }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    data-bs-custom-class="{{ $feature->is_active ? 'tooltip-success' : 'tooltip-muted' }}"
                                                    title="{{ $feature->is_active ? 'اضغط لإلغاء التفعيل' : 'اضغط للتفعيل' }}"
                                                    role="button" style="cursor: pointer;">
                                                </i>
                                            </span>
                                            <span style="word-break: break-word; white-space: normal;">
                                                {{ $feature->t('feature') }}
                                            </span>
                                        </li>
                                    @empty
                                        <li class="text-muted">No features available</li>
                                    @endforelse
                                </ul>
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
        function handleToggleButton({
            btn,
            type = 'active',
            icons = {
                on: '',
                off: ''
            },
            classes = {
                on: '',
                off: ''
            },
            tooltips = {
                on: '',
                off: ''
            },
            routePrefix = '',
            fieldName = ''
        }) {
            const packageId = btn.data('id');
            const currentState = btn.data('active');
            const newState = currentState ? 0 : 1;

            const routeUrl = `{{ url('/packages/${routePrefix}/__id__') }}`.replace('__id__', packageId);

            $.ajax({
                url: routeUrl,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    [fieldName]: newState
                },
                success: function(response) {
                    if (response.data.success) {
                        btn.data('active', newState);

                        const iconClass = newState ? icons.on : icons.off;
                        const btnClassToRemove = `${classes.on} ${classes.off}`;
                        const btnClassToAdd = newState ? classes.on : classes.off;
                        const tooltipText = newState ? tooltips.on : tooltips.off;
                        const tooltipColorClass = btnClassToAdd.replace('btn-outline-', 'tooltip-');

                        const oldTooltip = bootstrap.Tooltip.getInstance(btn[0]);
                        if (oldTooltip) {
                            oldTooltip.dispose();
                        }

                        btn
                            .removeClass(btnClassToRemove)
                            .addClass(btnClassToAdd)
                            .attr('title', tooltipText)
                            .attr('data-bs-original-title', tooltipText)
                            .attr('data-bs-custom-class', tooltipColorClass)
                            .find('i')
                            .attr('class', iconClass);

                        new bootstrap.Tooltip(btn[0]);
                        const avatar = $(`[data-status-indicator][data-package-id="${packageId}"]`);
                        avatar
                            .removeClass('online offline')
                            .addClass(newState ? 'online' : 'offline')
                            .data('active', newState);

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
        }

        $(document).on('click', '.toggle-package-btn', function() {
            handleToggleButton({
                btn: $(this),
                type: 'active',
                icons: {
                    on: 'ri-close-circle-line',
                    off: 'ri-checkbox-circle-line'
                },
                classes: {
                    on: 'btn-outline-secondary',
                    off: 'btn-outline-success'
                },
                tooltips: {
                    on: 'إلغاء التفعيل',
                    off: 'تفعيل الباقة'
                },
                routePrefix: 'toggle',
                fieldName: 'is_active'
            });
        });

        $(document).on('click', '.toggle-package-btn-hidden', function() {
            handleToggleButton({
                btn: $(this),
                type: 'hidden',
                icons: {
                    on: 'ri-eye-off-line',
                    off: 'ri-eye-line'
                },
                classes: {
                    on: 'btn-outline-warning',
                    off: 'btn-outline-primary'
                },
                tooltips: {
                    on: 'إخفاء الباقة',
                    off: 'إظهار الباقة'
                },
                routePrefix: 'toggle_hidden',
                fieldName: 'coming_soon'
            });
        });

        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
            new bootstrap.Tooltip(el);
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
