@extends('dashboard.core.app')
@section('title', __('dashboard.pricing_requests'))

@section('content')
    <div class="container-fluid px-5 py-3">
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.pricing_requests') }}" :breadcrumbs="[['name' => __('dashboard.pricing_requests'), 'route' => 'pricing-requests.index']]" />

        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">@lang('dashboard.pricing_requests')</div>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ route('pricing-requests.index') }}"
                        class="btn btn-sm {{ $status ? 'btn-outline-primary' : 'btn-primary' }}">@lang('dashboard.all')</a>
                    @foreach (\App\Enums\PricingRequestStatus::cases() as $case)
                        <a href="{{ route('pricing-requests.index', ['status' => $case->value]) }}"
                            class="btn btn-sm {{ $status === $case->value ? 'btn-primary' : 'btn-outline-primary' }}">{{ $case->label() }}</a>
                    @endforeach
                </div>
            </x-slot>
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.Name')</th>
                            <th>@lang('dashboard.phone')</th>
                            <th>@lang('dashboard.project_types')</th>
                            <th>@lang('dashboard.city')</th>
                            <th>@lang('dashboard.status')</th>
                            <th>@lang('dashboard.date')</th>
                            <th>@lang('dashboard.Operations')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pricingRequests as $item)
                            <tr id="row-{{ $item->id }}">
                                <td>{{ $pricingRequests->firstItem() + $loop->index }}</td>
                                <td>{{ $item->name }}</td>
                                <td dir="ltr">{{ $item->phone }}</td>
                                <td class="text-wrap">{{ $item->projectTypes->map(fn ($type) => $type->t('name'))->implode(' - ') }}</td>
                                <td class="text-wrap">{{ \Illuminate\Support\Str::limit($item->city, 40) }}</td>
                                <td><span class="badge {{ $item->status->badge() }}">{{ $item->status->label() }}</span></td>
                                <td dir="ltr">{{ $item->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <div class="hstack gap-2 fs-15">
                                        <x-buttons.show-button :route="route('pricing-requests.show', $item->id)" />
                                        <x-buttons.delete-button :route="route('pricing-requests.destroy', $item->id)" :itemId="$item->id" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            @include('dashboard.core.includes.no-entries', ['columns' => 8])
                        @endforelse
                    </tbody>
                </table>
            </div>
            <x-slot name="footer">
                <div class="d-flex justify-content-end align-items-center">
                    {{ $pricingRequests->links() }}
                </div>
            </x-slot>
        </x-cards.page-card>
    </div>
@endsection
