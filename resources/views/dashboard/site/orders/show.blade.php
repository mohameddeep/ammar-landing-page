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
            <div class="col-xl-4">


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

            {{-- <div class="col-xl-3">


            <div class="col-xl-12">
                <x-cards.page-card>

                    <div class="card-header">
                        <div class="card-title">
                            Order Tracking
                        </div>
                        <div class="ms-auto text-success">#SPK1218153635</div>
                    </div>
                    <div class="card-body">
                        <div class="order-track">
                            <div class="accordion" id="basicAccordion">
                                <div class="accordion-item border-0 bg-transparent">
                                    <div class="accordion-header" id="headingOne">
                                        <a class="px-0 pt-0" href="javascript:void(0)" role="button" data-bs-toggle="collapse" data-bs-target="#basicOne" aria-expanded="true" aria-controls="basicOne">
                                            <div class="d-flex mb-0">
                                                <div class="me-2">
                                                    <span class="avatar avatar-md avatar-rounded">
                                                        <img src="../assets/images/ecommerce/png/32.png" alt="">
                                                    </span>
                                                </div>
                                                <div class="flex-fill">
                                                    <p class="fw-semibold mb-0 fs-14">Order Placed</p>
                                                    <span class="fs-11 text-success">Nov 03, 2022</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div id="basicOne" class="accordion-collapse collapse show border-top-0" aria-labelledby="headingOne" data-bs-parent="#basicAccordion">
                                        <div class="accordion-body pt-0 ps-5">
                                            <div class="fs-11">
                                                <p class="mb-0">Order placed successfully by <a href="javascript:void(0);" class="font-weight-semibold text-primary">Sansa Taylor</a></p>
                                                <span class="text-muted op-5">Nov 03, 2022, 15:36</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion" id="basicAccordion1">
                                <div class="accordion-item border-0 bg-transparent">
                                    <div class="accordion-header" id="headingTwo">
                                        <a class="px-0 pt-0" href="javascript:void(0)" role="button" data-bs-toggle="collapse" data-bs-target="#basicTwo" aria-expanded="true" aria-controls="basicTwo">
                                            <div class="d-flex mb-0">
                                                <div class="me-2">
                                                    <span class="avatar avatar-md avatar-rounded">
                                                        <img src="../assets/images/ecommerce/png/33.png" alt="">
                                                    </span>
                                                </div>
                                                <div class="flex-fill">
                                                    <p class="fw-semibold mb-0 fs-14">Picked</p>
                                                    <span class="fs-12">Nov 03, 15:10</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div id="basicTwo" class="accordion-collapse show collapse border-top-0" aria-labelledby="headingTwo" data-bs-parent="#basicAccordion1">
                                        <div class="accordion-body pt-0 ps-5">
                                            <div class="fs-11">
                                                <p class="mb-0">Your order has been picked up by <span class="font-weight-semibold">Smart Good Services</span></p>
                                                <span class="text-muted op-5">Nov 03, 2022, 15:36</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion" id="basicAccordion2">
                                <div class="accordion-item border-0 bg-transparent">
                                    <div class="accordion-header" id="headingThree">
                                        <a class="px-0 pt-0" href="javascript:void(0)" role="button" data-bs-toggle="collapse" data-bs-target="#basicThree" aria-expanded="true" aria-controls="basicThree">
                                            <div class="d-flex mb-0">
                                                <div class="me-2">
                                                    <span class="avatar avatar-md avatar-rounded">
                                                        <img src="../assets/images/ecommerce/png/34.png" alt="">
                                                    </span>
                                                </div>
                                                <div class="flex-fill">
                                                    <p class="fw-semibold mb-0 fs-14">Shipping</p>
                                                    <span class="fs-12">Nov 03, 15:10</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div id="basicThree" class="accordion-collapse show collapse border-top-0" aria-labelledby="headingThree" data-bs-parent="#basicAccordion2">
                                        <div class="accordion-body pt-0 ps-5">
                                            <div class="fs-11 mb-3">
                                                <p class="mb-0">Arrived USA <span class="font-weight-semibold">SGS
                                                        Warehouse</span></p>
                                                <span class="text-muted op-5">Nov 03, 2022, 15:36</span>
                                            </div>
                                            <div class="fs-11 mb-3">
                                                <p class="mb-0">picked up by <span class="font-weight-semibold">SGS
                                                        Agent</span> and on the way to Hyderabad</p>
                                                <span class="text-muted op-5">Nov 03, 2022, 15:36</span>
                                            </div>
                                            <div class="fs-11">
                                                <p class="mb-0">Arrived in Hyderabad and expected Delivery is <span class="font-weight-semibold">Apr 16, 2022</span> </p>
                                                <span class="text-muted op-5">Nov 03, 2022, 15:36</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion" id="basicAccordion3">
                                <div class="accordion-item border-0 bg-transparent next-step">
                                    <div class="accordion-header" id="headingFour">
                                        <a class="collapsed px-0 pt-0" href="javascript:void(0)" role="button" data-bs-toggle="collapse" data-bs-target="#basicFour" aria-expanded="true" aria-controls="basicFour">
                                            <div class="d-flex mb-2">
                                                <div class="me-2">
                                                    <span class="avatar avatar-md avatar-rounded bg-primary-transparent text-primary border"><i class="fe fe-package fs-12"></i></span>
                                                </div>
                                                <div class="flex-fill">
                                                    <p class="fw-semibold mb-0 fs-14">Out For Delivery</p>
                                                    <span class="text-muted fs-12">Nov 03, 15:10 (expected)</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div id="basicFour" class="accordion-collapse collapse border-top-0" aria-labelledby="headingFour" data-bs-parent="#basicAccordion3">
                                        <div class="accordion-body pt-0 ps-5">
                                            <div class="fs-11">
                                                <p class="mb-0">Your order is out for devlivery</p>
                                                <span class="text-muted op-5">Nov 03, 2022, 15:36 (expected)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion" id="basicAccordion4">
                                <div class="accordion-item border-0 bg-transparent next-step">
                                    <div class="accordion-header" id="headingFive">
                                        <a class="collapsed px-0 pt-0" href="javascript:void(0)" role="button" data-bs-toggle="collapse" aria-expanded="true">
                                            <div class="d-flex mb-2">
                                                <div class="me-2">
                                                    <span class="avatar avatar-md avatar-rounded bg-primary-transparent text-primary border"><i class="fe fe-package fs-12"></i></span>
                                                </div>
                                                <div class="flex-fill">
                                                    <p class="fw-semibold mb-0 fs-14">Delivered</p>
                                                    <span class="fs-12 text-muted">Nov 03, 18:42</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </x-cards.page-card>
            </div>

        </div> --}}
        </div>

    </div>
    </div>
@endsection
