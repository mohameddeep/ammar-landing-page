@extends('dashboard.core.app')
@section('title', __('dashboard.order_returns'))
@section('content')
<div class="container-fluid px-5 py-3">
    <!-- Page Header -->
    <x-breadcrumb.breadcrumb title="{{ __('dashboard.order_returns') }}" :breadcrumbs="[['name' => __('dashboard.order_returns'), 'route' => 'order-returns.index'], ['name' => __('dashboard.order_items')]]" />
    <!-- Page Header Close -->
    <div class="row ">
        <div class="col-xl-6">


            <div class="col-xl-12">
                <x-cards.page-card>
                    <div class="card-header d-flex justify-content-between">
                        <div class="card-title">
                            @lang('dashboard.order_id') - <span class="text-primary">{{ $returnOrder->order?->order_num }}</span>
                        </div>
                        <div>
                            <span class="badge bg-primary-transparent">
                                @lang('dashboard.created_at') : {{ $returnOrder->order?->created_at }}
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

                                    @foreach ($returnOrder->order?->items as $item)

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
                                                        <a href="javascript:void(0);">{{ $item?->product?->name}}</a>
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
                                            {{ $returnOrder->order?->items->count() }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">
                                            <div class="fw-semibold">@lang('dashboard.total_price') :</div>
                                        </td>
                                        <td>
                                            <span class="fs-16 fw-semibold">{{ $returnOrder->order?->grand_total  }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer border-top-0">
                            <h5 class="text-muted fw-bold">@lang('dashboard.order_reason')</h5>
                            <p class="text-success">{{ $returnOrder->reason }}</p>
                    </div>
                </x-cards.page-card>
            </div>

        </div>
        <div class="col-xl-6">


            <div class="col-xl-12">
                <x-cards.page-card>

                    <div class="card-header">
                        <div class="card-title">@lang('dashboard.user_items')
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center border-bottom border-block-end-dashed p-3 flex-wrap">
                            <div class="flex-fill">
                                <p class="mb-0">{{ $returnOrder?->user?->name }}</p>
                                <p class="mb-0 text-muted fs-12">{{ $returnOrder?->user?->phone }}</p>
                            </div>
                        </div>
                        <div class="p-3 border-bottom border-block-end-dashed">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="fs-14 fw-semibold">@lang('dashboard.delivery_address') :</span>
                                {{-- <button class="btn btn-icon btn-wave btn-primary btn-sm">
                                    <i class="ri-pencil-line"></i>
                                </button> --}}
                            </div>
                            <p class="mb-2 text-muted"><span class="fw-semibold text-default">@lang('dashboard.building_name') : </span>{{ $returnOrder?->address?->building_name }}</p>
                            <p class="mb-2 text-muted"><span class="fw-semibold text-default">@lang('dashboard.landmark') : </span>{{ $returnOrder?->address?->landmark }}</p>
                            <p class="mb-2 text-muted"><span class="fw-semibold text-default">@lang('dashboard.street') : </span>{{ $returnOrder?->address?->street_name }}</p>
                            <p class="mb-2 text-muted"><span class="fw-semibold text-default">@lang('dashboard.city') : </span>{{ $returnOrder?->address?->city }}</p>
                            <p class="mb-2 text-muted"><span class="fw-semibold text-default">@lang('dashboard.notes') : </span>{{ $returnOrder?->address?->notes }}</p>
                        </div>
                        <div class="p-3 border-bottom border-block-end-dashed">
                            <div class="mb-3">
                                <span class="fs-14 fw-semibold">@lang('dashboard.send_updates_to') :</span>
                            </div>
                            <p class="mb-2 text-muted">
                                <span class="fw-semibold text-default">@lang('dashboard.phone') : </span>
                                {{ $returnOrder?->address?->phone }}
                            </p>
                        </div>
                        <div class="p-3 border-bottom border-block-end-dashed">
                            <div class="mb-3">
                                <span class="fs-14 fw-semibold">@lang('dashboard.order_summary')</span>
                            </div>
                            <p class="mb-2 text-muted">
                                <span class="fw-semibold text-default">@lang('dashboard.ordered_date')</span>
                                {{$returnOrder->created_at->format('Y-m-d')}}
                            </p>
                            <p class="mb-2 text-muted">
                                <span class="fw-semibold text-default">@lang('dashboard.ordered_time') :</span>
                                {{ $returnOrder->created_at->format('h:i A') }}
                            </p>
                        </div>
                    </div>


                </x-cards.page-card>
            </div>

        </div>

        <div class="col-xl-3">

        </div>
    </div>

</div>
</div>
@endsection
