@extends('dashboard.core.app')
@section('title', __('dashboard.contacts'))
@section('css_addons')

@endsection
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.contacts') }}" :breadcrumbs="[['name' => __('dashboard.contacts'), 'route' => 'contacts.index']]" />
        <!-- Page Header Close -->
        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.contacts')
                </div>
               
            </x-slot>
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.Name')</th>
                            <th>@lang('dashboard.phone')</th>
                            <th>@lang('dashboard.message')</th>
                            <th>@lang('dashboard.Operations')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                            <tr id="row-{{ $contact->id }}">
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->message }}</td>
                            

                                <td>
                                    <div class="hstack gap-2 fs-15">
                                        <x-buttons.delete-button :route="route('contacts.destroy', $contact->id)" :itemId="$contact->id" />
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
                    {{ $contacts->links() }}
                </div>
            </x-slot>
        </x-cards.page-card>
    </div>
@endsection
@push('scripts')

@endpush
