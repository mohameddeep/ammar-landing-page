@extends('dashboard.core.app')
@section('title', __('dashboard.commissions'))
@section('css_addons')
    <style>
        .pricing-svg1 i {
            width: 50px;
            height: 50px;
            font-size: 24px;

            color: #ffffff;
            background: linear-gradient(135deg, #f3eeff, #8e44ad);

            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);

            transition: transform 0.3s ease;
        }

        .pricing-svg1 i:hover {
            transform: rotate(-5deg) scale(1.1);
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.commissions') }}"
                                 :breadcrumbs="[['name' => __('dashboard.commissions')]]"/>
        <!-- Page Header Close -->
        <x-cards.page-card>

            <div class="row p-3">
                @foreach ($commissions as $commission)
                    <div
                        class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 border-end border-inline-end-dashed pe-0">
                        <div class="p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="fw-semibold mb-0">{{ $commission->t('name') }}</h6>
                                <x-buttons.edit-button :route="route('commissions.edit', $commission->id)"/>
                            </div>

                            <div class="py-4 d-flex align-items-center justify-content-center">
                                <div class="pricing-svg1">
                                    <i class="{{ $commission->type->icon() }}"></i>
                                </div>
                                <div class="text-end ms-5">
                                    <p class="fs-25 fw-semibold mb-0">
                                        <i class="{{ $commission->value_type->icon() }}"></i>
                                    {{ $commission->value }}</p>
                                    <p class="text-muted op-5 fs-11 fw-semibold mb-0">{{ $commission->type->t() }}</p>
                                </div>
                            </div>

                            <div class="d-grid pt-5">
                                <button
                                    class="btn {{ $commission->is_active ? 'btn-primary-light' : 'btn-secondary' }} btn-wave toggle-commission-btn"
                                    data-id="{{ $commission->id }}" data-active="{{ $commission->is_active }}">
                                    {{ $commission->is_active ? __('Deactivate') : __('Activate') }}
                                </button>
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
        $(document).on('click', '.toggle-commission-btn', function () {
            const $btn = $(this);
            const commissionId = $btn.data('id');
            const currentState = $btn.data('active');
            const newState = currentState ? 0 : 1;

            const routeUrl = `{{ url('/commissions/toggle/__id__') }}`.replace('__id__', commissionId);
            console.log('Route URL:', routeUrl);

            $.ajax({
                url: routeUrl,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    is_active: newState
                },
                success: function (response) {
                    console.log(response.data.success);

                    if (response.data.success) {
                        $btn.data('active', newState);
                        if (newState === 1) {
                            $btn.removeClass('btn-secondary').addClass('btn-primary-light');
                            $btn.text('Deactivate');
                        } else {
                            $btn.removeClass('btn-primary-light').addClass('btn-secondary');
                            $btn.text('Activate');
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
                error: function (xhr, status) {
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
    </script>
@endpush
