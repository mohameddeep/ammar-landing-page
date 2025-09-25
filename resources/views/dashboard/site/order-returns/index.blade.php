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
                            <th>@lang('dashboard.order_number')</th>
                            <th>@lang('dashboard.username')</th>
                            <th>@lang('dashboard.status')</th>
                            <th>@lang('dashboard.return_reason')</th>
                            <th>@lang('dashboard.Operations')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($returnOrders as $order)
                            <tr id="row-{{ $order->id }}">
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $order->order?->order_num }}
                                </td>
                                <td>
                                    {{ $order->user?->name }}
                                </td>
                                <td>{{ $order->status }}</td>
                                <td>{{ substr($order->reason, 0, 100) }} ...</td>
                                <td>
                                    <div class="hstack gap-2 fs-15">
                                        <x-buttons.show-button :route="route('order-returns.show', $order->id)"/>
{{--                                        <x-buttons.delete-button :route="route('return_orders.destroy', $order->id)" :itemId="$order->id" />--}}

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
                    {{ $returnOrders->links() }}
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
