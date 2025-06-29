@extends('dashboard.core.app')
@section('title', __('dashboard.merchants'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.merchants') }}" :breadcrumbs="[['name' => __('dashboard.merchants'), 'route' => 'merchants.index']]" />
        <!-- Page Header Close -->
        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.User List')
                </div>
                <div class="d-flex">
                    <div class="py-2 d-flex justify-content-end align-items-center">

                        <x-buttons.create-button :route="route('merchants.create')" />
                    </div>
                </div>
            </x-slot>
            <div class="table-responsive">
                <table class="table text-nowrap align-middle" id="merchants_table">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.Name')</th>
                            <th>@lang('dashboard.Phone')</th>
                            <th>@lang('dashboard.Type')</th>
                            <th>@lang('dashboard.Active')</th>
                            <th>@lang('dashboard.Featured')</th>
                            <th>@lang('dashboard.Operations')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($merchants as $merchant)
                            <tr id="row-{{ $merchant->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-2 avatar-rounded">
                                            @if ($merchant->image)
                                                <img src="@image($merchant?->image)" alt="img">
                                            @else
                                                <img src="{{ asset('img/user2-160x160.jpg') }} alt="img">
                                            @endif
                                        </div>
                                        <div>
                                            <div class="lh-1">
                                                <span>{{ $merchant->name }}</span>
                                            </div>
                                            <div class="lh-1">
                                                <span class="fs-11 text-muted">{{ $merchant->email }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>{{ $merchant->phone ?? '-' }}</td>
                                <td class="text-center">

                                    <span class=" ms-2 badge {{ $merchant->type->color() }}">
                                        <i class="{{ $merchant->type->icon() }}"></i> {{ $merchant->type->t() }}
                                    </span>

                                </td>
                                <td>
                                    <div class="custom-toggle-switch d-flex align-items-center">
                                        <input id="toggle_activate_{{ $merchant->id }}"
                                            name="toggle_ativate_switch_{{ $merchant->id }}" type="checkbox"
                                            {{ $merchant->is_active == 1 ? 'checked' : '' }}
                                            onclick="toggleMerchantActive({{ $merchant->id }})">
                                        <label for="toggle_activate_{{ $merchant->id }}" class="label-secondary"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="custom-toggle-switch d-flex align-items-center">
                                        <input id="toggle_feature_{{ $merchant->id }}"
                                            name="toggle_feature_switch_{{ $merchant->id }}" type="checkbox"
                                            {{ $merchant->is_featured == 1 ? 'checked' : '' }}
                                            onclick="toggleMerchantFeature({{ $merchant->id }})">
                                        <label for="toggle_feature_{{ $merchant->id }}" class="label-secondary"></label>
                                    </div>
                                </td>

                                <td>
                                    <div class="hstack gap-2 fs-15">
                                        <x-buttons.show-button :route="route('merchants.show', $merchant->id)" />
                                        <x-buttons.edit-button :route="route('merchants.edit', $merchant->id)" />
                                        <x-buttons.delete-button :route="route('merchants.destroy', $merchant->id)" :itemId="$merchant->id" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            @include('dashboard.core.includes.no-entries', ['columns' => 9])
                        @endforelse
                    </tbody>
                </table>

            </div>
            <x-slot name="footer">
                <div class="d-flex justify-content-end align-items-center">
                    {{ $merchants->links() }}
                </div>

            </x-slot>
        </x-cards.page-card>
    </div>
@endsection
@push('scripts')
    <script>
        function toggleMerchantActive(merchantId) {
            let checkbox = document.getElementById(`toggle_activate_${merchantId}`);
            let isChecked = checkbox.checked ? 1 : 0;

            let routeUrl = `{{ route('merchants.toggle.activate', ['id' => '__id__']) }}`.replace('__id__', merchantId);

            $.ajax({
                url: routeUrl,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    is_active: isChecked
                },
                success: function(response) {
                    console.log(response.message);

                    if (response.data && response.data.success) {
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

                error: function(xhr, status, error) {
                    alert('An error occurred: ' + (xhr.responseJSON?.message || status));
                    checkbox.checked = !isChecked;
                }
            });
        }

        function toggleMerchantFeature(merchantId) {
            let checkbox_feature = document.getElementById(`toggle_feature_${merchantId}`);
            console.log(checkbox_feature)
            let isChecked = checkbox_feature.checked ? 1 : 0;

            let routeUrl = `{{ route('merchants.toggle.feature', ['id' => '__id__']) }}`.replace('__id__', merchantId);

            $.ajax({
                url: routeUrl,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    is_active: isChecked
                },
                success: function(response) {
                    console.log(response.message);

                    if (response.data && response.data.success) {
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

                error: function(xhr, status, error) {
                    alert('An error occurred: ' + (xhr.responseJSON?.message || status));
                    checkbox_feature.checked = !isChecked;
                }
            });
        }
    </script>
@endpush
