@extends('dashboard.core.app')
@section('title', __('dashboard.order_items'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.orders') }}" :breadcrumbs="[
            ['name' => __('dashboard.orders'), 'route' => 'orders.index'],
            ['name' => __('dashboard.order_items')],
        ]" />
        <!-- Page Header Close -->
        <div class="row ">
            <div class="col-xl-6">


                <div class="col-xl-12">
                    <x-cards.page-card>
                        <div class="card-header d-flex justify-content-between">
                            <div class="card-title">
                                @lang('dashboard.order_id') - <span class="text-primary">{{ $order->order_num }}</span>
                            </div>
                            <div>
                                <span class="badge bg-primary-transparent">
                                    @lang('dashboard.created_at') : {{ $order->created_at }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="col">@lang('dashboard.item')</th>
                                            <th scope="col">@lang('dashboard.price')</th>
                                            <th scope="col">@lang('dashboard.quantity')</th>
                                            <th scope="col">@lang('dashboard.total_price')</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($order->items as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="me-3">
                                                            <span class="avatar avatar-xxl bg-light">
                                                                <img src="@image($item?->product?->firstImage?->image)" alt="">
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <div class="mb-1 fs-14 fw-semibold">
                                                                <a
                                                                    href="javascript:void(0);">{{ $item?->product?->name }}</a>
                                                            </div>
                                                            {{-- @foreach ($item->productFeatureItem->productFeatureItemitem as $item)
                                                    <div class="mb-1">
                                                        <span class="me-1">{{$item?->productFeaturemitem?->productFeature?->feature?->name }}:</span><span class="text-muted">{{$item->productFeaturemitem->content }}</span>
                                                    </div>
                                                    @endforeach --}}

                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="fs-15 fw-semibold">{{ $item->unit_price }}</span>
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ $item->unit_price * $item->quantity }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">
                                                <div class="fw-semibold">@lang('dashboard.total_items') :</div>
                                            </td>
                                            <td>
                                                {{ $order->items->count() }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">
                                                <div class="fw-semibold">@lang('dashboard.total_discount') :</div>
                                            </td>
                                            <td>
                                                @if ($coupon > 0)
                                                    {{ $order->totalPrice - $order->grand_total }} ({{ (int) $coupon }}%)
                                                @else
                                                    0
                                                @endif

                                            </td>
                                        </tr>

                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">
                                                <div class="fw-semibold">@lang('dashboard.total_price') :</div>
                                            </td>
                                            <td>
                                                <span class="fs-16 fw-semibold">{{ $order->grand_total }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer border-top-0">
                            <div class="btn-list float-end">
                                {{-- <button class="btn btn-primary btn-wave btn-sm mb-3" onclick="javascript:window.print();"><i class="ri-printer-line me-1 align-middle d-inline-block"></i>@lang('dashboard.print')</button>
                            <button class="btn btn-secondary btn-wave btn-sm mb-3"><i class="ri-share-forward-line me-1 align-middle d-inline-block"></i>@lang('dashboard.share')</button> --}}
                            </div>
                        </div>
                    </x-cards.page-card>
                </div>

            </div>
            <div class="col-xl-3">


                <div class="col-xl-12">
                    <x-cards.page-card>

                        <div class="card-header">
                            <div class="card-title">@lang('dashboard.user_items')
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="d-flex align-items-center border-bottom border-block-end-dashed p-3 flex-wrap">
                                <div class="flex-fill">
                                    <p class="mb-0">{{ $order?->user?->name }}</p>
                                    <p class="mb-0 text-muted fs-12">{{ $order?->user?->phone }}</p>
                                </div>
                            </div>
                            <div class="p-3 border-bottom border-block-end-dashed">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="fs-14 fw-semibold">@lang('dashboard.delivery_address') :</span>
                                    {{-- <button class="btn btn-icon btn-wave btn-primary btn-sm">
                                    <i class="ri-pencil-line"></i>
                                </button> --}}
                                </div>
                                <p class="mb-2 text-muted"><span class="fw-semibold text-default">@lang('dashboard.building_name') :
                                    </span>{{ $order?->address?->building_name }}</p>
                                <p class="mb-2 text-muted"><span class="fw-semibold text-default">@lang('dashboard.landmark') :
                                    </span>{{ $order?->address?->landmark }}</p>
                                <p class="mb-2 text-muted"><span class="fw-semibold text-default">@lang('dashboard.street') :
                                    </span>{{ $order?->address?->street_name }}</p>
                                <p class="mb-2 text-muted"><span class="fw-semibold text-default">@lang('dashboard.city') :
                                    </span>{{ $order?->address?->city }}</p>
                                <p class="mb-2 text-muted"><span class="fw-semibold text-default">@lang('dashboard.notes') :
                                    </span>{{ $order?->address?->notes }}</p>
                            </div>
                            <div class="p-3 border-bottom border-block-end-dashed">
                                <div class="mb-3">
                                    <span class="fs-14 fw-semibold">@lang('dashboard.send_updates_to') :</span>
                                </div>
                                <p class="mb-2 text-muted">
                                    <span class="fw-semibold text-default">@lang('dashboard.phone') : </span>
                                    {{ $order?->address?->phone }}
                                </p>
                            </div>
                            <div class="p-3 border-bottom border-block-end-dashed">
                                <div class="mb-3">
                                    <span class="fs-14 fw-semibold">@lang('dashboard.order_summary')</span>
                                </div>
                                <p class="mb-2 text-muted">
                                    <span class="fw-semibold text-default">@lang('dashboard.ordered_date')</span>
                                    {{ $order->created_at->format('Y-m-d') }}
                                </p>
                                <p class="mb-2 text-muted">
                                    <span class="fw-semibold text-default">@lang('dashboard.ordered_time') :</span>
                                    {{ $order->created_at->format('h:i A') }}
                                </p>
                                {{-- <p class="mb-0 text-muted">
                                <span class="fw-semibold text-default">@lang('dashboard.payment_type') :</span>
                                {{ $order->payment_type }}
                            </p> --}}
                            </div>
                        </div>
                        <div class="card-footer">@lang('dashboard.notes') :
                            <span class="text-success">{{ $order->notes }}</span>
                        </div>

                    </x-cards.page-card>
                </div>

            </div>

            <div class="col-xl-3">


                <div class="col-xl-12">
                    <x-cards.page-card>

                        <div class="card-header">
                            <div class="card-title">
{{ __('dashboard.order_tracking') }}                            </div>

                        </div>
                     <div class="card shadow-sm border-0 rounded-3">
    <div class="card-header bg-light d-flex justify-content-between align-items-center">
       
        <button class="btn btn-outline-primary btn-sm d-flex align-items-center"
                data-bs-toggle="modal"
                data-bs-target="#updateStatusModal{{ $order->id }}">
            <i class="fe fe-edit me-1"></i>
            {{ __('dashboard.update_status') }}
        </button>
    </div>

    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <span class="fw-semibold text-secondary fs-6">
                {{ __('dashboard.status') }}:
            </span>
            <span class="badge bg-{{ $order->order_status == 'completed' ? 'success' : ($order->order_status == 'cancelled' ? 'danger' : 'warning') }} fs-6 text-capitalize">
                {{ __('dashboard.statuses.' . $order->order_status) }}
            </span>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="updateStatusModal{{ $order->id }}" tabindex="-1" aria-labelledby="updateStatusLabel{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">{{ __('dashboard.update_order_status') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{route('orders.updateStatus',$order->id)}}" method="POST">
    @csrf
    @method('PUT')

    <div class="modal-body">
        <div class="mb-3">
            <label for="statusSelect{{ $order->id }}" class="form-label fw-semibold">
                {{ __('dashboard.select_status') }}
            </label>
            <select class="form-select" id="statusSelect{{ $order->id }}" name="order_status" required>
                @foreach (['processing', 'shipped', 'delivered', 'cancelled'] as $status)
                    <option value="{{ $status }}" {{ $order->order_status == $status ? 'selected' : '' }}>
                        {{ __('dashboard.statuses.' . $status) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">
            {{ __('dashboard.close') }}
        </button>
        <button type="submit" class="btn btn-primary">
            {{ __('dashboard.save_changes') }}
        </button>
    </div>
</form>

        </div>
    </div>
</div>


                    </x-cards.page-card>
                </div>

            </div>
        </div>

    </div>
    </div>
@endsection
