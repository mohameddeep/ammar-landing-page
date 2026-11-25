@extends('dashboard.core.app')
@section('title', __('dashboard.pricing_requests'))

@section('content')
    <div class="container-fluid px-5 py-3">
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.pricing_requests') }}" :breadcrumbs="[['name' => __('dashboard.pricing_requests'), 'route' => 'pricing-requests.index'], ['name' => '#' . $pricingRequest->id]]" />

        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">{{ $pricingRequest->name }}</div>
                <span class="badge {{ $pricingRequest->status->badge() }}">{{ $pricingRequest->status->label() }}</span>
            </x-slot>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th style="width: 220px">@lang('dashboard.email')</th>
                            <td><a href="mailto:{{ $pricingRequest->email }}">{{ $pricingRequest->email }}</a></td>
                        </tr>
                        <tr>
                            <th>@lang('dashboard.phone')</th>
                            <td><a href="tel:{{ $pricingRequest->phone }}" dir="ltr">{{ $pricingRequest->phone }}</a></td>
                        </tr>
                        <tr>
                            <th>@lang('dashboard.project_types')</th>
                            <td>{{ $pricingRequest->projectTypes->map(fn ($type) => $type->t('name'))->implode(' - ') }}</td>
                        </tr>
                        <tr>
                            <th>@lang('dashboard.project_space')</th>
                            <td>{{ $pricingRequest->project_space }}</td>
                        </tr>
                        <tr>
                            <th>@lang('dashboard.city')</th>
                            <td>{{ $pricingRequest->city }}</td>
                        </tr>
                        <tr>
                            <th>@lang('dashboard.notes')</th>
                            <td style="white-space: pre-line">{{ $pricingRequest->notes ?: '-' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('dashboard.attachment')</th>
                            <td>
                                @if ($pricingRequest->attachment)
                                    <a href="{{ route('pricing-requests.attachment', $pricingRequest->id) }}"
                                        class="btn btn-sm btn-primary">@lang('dashboard.download')</a>
                                @else
                                    -
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('dashboard.date')</th>
                            <td><span dir="ltr">{{ $pricingRequest->created_at->format('Y-m-d H:i') }}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <x-form.form-component :route="route('pricing-requests.update', $pricingRequest->id)" method="PUT">
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="status">@lang('dashboard.status')</label>
                    <select name="status" id="status" class="form-select">
                        @foreach (\App\Enums\PricingRequestStatus::cases() as $case)
                            <option value="{{ $case->value }}" @selected(old('status', $pricingRequest->status->value) === $case->value)>
                                {{ $case->label() }}</option>
                        @endforeach
                    </select>
                    @error('status')
                        <div class="text-danger p-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 mb-3">
                    <label class="form-label" for="admin_notes">@lang('dashboard.admin_notes')</label>
                    <textarea name="admin_notes" id="admin_notes" rows="4" class="form-control">{{ old('admin_notes', $pricingRequest->admin_notes) }}</textarea>
                    @error('admin_notes')
                        <div class="text-danger p-2">{{ $message }}</div>
                    @enderror
                </div>
            </x-form.form-component>
        </x-cards.page-card>
    </div>
@endsection
