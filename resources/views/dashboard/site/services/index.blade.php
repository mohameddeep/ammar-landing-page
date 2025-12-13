@extends('dashboard.core.app')
@section('title', __('dashboard.services'))

@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.services') }}" :breadcrumbs="[['name' => __('dashboard.services'), 'route' => 'services.index']]" />
        <!-- Page Header Close -->
        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.services')
                </div>
                <div class="d-flex">
                    <div class="py-2 d-flex justify-content-end align-items-center">

                        <x-buttons.create-button :route="route('services.create')" />

                    </div>
                </div>
            </x-slot>
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.image')</th>
                            <th>@lang('dashboard.title')</th>
                            <th>@lang('dashboard.content')</th>
                            <th>@lang('dashboard.Activate')</th>
                            <th>@lang('dashboard.Operations')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            <tr id="row-{{ $service->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="@image($service->image)" alt="service image" width="60" height="60">
                                </td>


                                <td>{{ $service->t('title') }}</td>
                                <td>{!! $service->t('content') !!}</td>
                                <td>
                                    <div class="custom-toggle-switch d-flex align-items-center">
                                        <input id="toggle_{{ $service->id }}" name="toggleswitch_{{ $service->id }}"
                                            type="checkbox" {{ $service->is_active == 1 ? 'checked' : '' }}
                                            onclick="toggleserviceStatus({{ $service->id }})">
                                        <label for="toggle_{{ $service->id }}" class="label-secondary"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="hstack gap-2 fs-15">
                                        <x-buttons.edit-button :route="route('services.edit', $service->id)" />

                                        <x-buttons.delete-button :route="route('services.destroy', $service->id)" :itemId="$service->id" />

                                    </div>
                                </td>
                            </tr>
                        @empty
                            @include('dashboard.core.includes.no-entries', ['columns' => 6])
                        @endforelse
                    </tbody>
                </table>
            </div>
            <x-slot name="footer">
                <div class="d-flex justify-content-end align-items-center">
                    {{ $services->links() }}
                </div>
            </x-slot>
        </x-cards.page-card>
    </div>
@endsection
@push('scripts')
    <script>
        function toggleserviceStatus(serviceId) {
            let checkbox = document.getElementById(`toggle_${serviceId}`);
            let isChecked = checkbox.checked ? 1 : 0;

            let routeUrl = `{{ route('services.toggle', ['id' => '__id__']) }}`.replace('__id__', serviceId);

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
    </script>
@endpush
