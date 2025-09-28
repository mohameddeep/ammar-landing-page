@extends('dashboard.core.app')
@section('title', __('dashboard.subscriptions'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.subscriptions') }}" :breadcrumbs="[['name' => __('dashboard.subscriptions'), 'route' => 'subscriptions.index']]" />
        <!-- Page Header Close -->
        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.subscriptions')
                </div>
            
            </x-slot>
            <div class="table-responsive">
               <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.package')</th>
                            <th>@lang('dashboard.username')</th>
                            <th>@lang('dashboard.price')</th>
                            <th>@lang('dashboard.start_date')</th>
                            <th>@lang('dashboard.end_date')</th>
                            <th>@lang('dashboard.Products_Count')</th>
                            <th>@lang('dashboard.Activate')</th>
                            <th>@lang('dashboard.Operations')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subscriptions as $subscription)
                            <tr id="row-{{ $subscription->id }}">
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $subscription?->package->t('name') }}
                                </td>
                                <td>
                                    {{ $subscription?->user->name }}
                                </td>
                                <td>{{ $subscription->price }}</td>
                                <td>{{ $subscription->start_date }}</td>
                                <td>{{ $subscription->end_date }}</td>
                                <td>{{ $subscription->dress_count }}</td>
                                <td>
                                    <div class="custom-toggle-switch d-flex align-items-center">
                                        <input id="toggle_{{ $subscription->id }}" name="toggleswitch_{{ $subscription->id }}"
                                            type="checkbox" {{ $subscription->is_active == 1 ? 'checked' : '' }}
                                            onclick="toggleSubscriptionStatus({{ $subscription->id }})">
                                        <label for="toggle_{{ $subscription->id }}" class="label-secondary"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="hstack gap-2 fs-15">

                                        <x-buttons.delete-button :route="route('subscriptions.destroy', $subscription->id)" :itemId="$subscription->id" />

                                    </div>
                                </td>
                            </tr>
                        @empty
                            @include('dashboard.core.includes.no-entries', ['columns' => 5])
                        @endforelse
                    </tbody>
                </table>
            </div>
            <x-slot name="footer">
                <div class="d-flex justify-content-end align-items-center">
                    {{ $subscriptions->links() }}
                </div>

            </x-slot>
        </x-cards.page-card>
    </div>
@endsection


@push('scripts')
    <script>
        function toggleSubscriptionStatus(subscriptionId) {
            let checkbox = document.getElementById(`toggle_${subscriptionId}`);
            let isChecked = checkbox.checked ? 1 : 0;

            let routeUrl = `{{ route('subscriptions.toggle', ['id' => '__id__']) }}`.replace('__id__', subscriptionId);

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
