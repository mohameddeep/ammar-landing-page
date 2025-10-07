@extends('dashboard.core.app')
@section('title', __('dashboard.complaints'))
@section('css_addons')

@endsection
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.complaints') }}" :breadcrumbs="[['name' => __('dashboard.complaints'), 'route' => 'complaints.index']]" />
        <!-- Page Header Close -->
        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.complaints')
                </div>
               
            </x-slot>
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.Name')</th>
                            <th>@lang('dashboard.phone')</th>
                            <th>@lang('dashboard.complaint')</th>
                            <th>@lang('dashboard.Operations')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($complaints as $complaint)
                            <tr id="row-{{ $complaint->id }}">
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $complaint->name }}</td>
                                <td>{{ $complaint->phone }}</td>
                                <td>{{ $complaint->complaint }}</td>
                            

                                <td>
                                    <div class="hstack gap-2 fs-15">
                                        <x-buttons.delete-button :route="route('complaints.destroy', $complaint->id)" :itemId="$complaint->id" />
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
                    {{ $complaints->links() }}
                </div>
            </x-slot>
        </x-cards.page-card>
    </div>
@endsection
@push('scripts')

@endpush
