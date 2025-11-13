
@extends('dashboard.core.app')
@section('title', __('dashboard.discover'))
@section('css_addons')

@endsection
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.discover') }}" :breadcrumbs="[['name' => __('dashboard.discover'), 'route' => 'discover.index']]" />
        <!-- Page Header Close -->
        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.discover')
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
                <th>@lang('dashboard.Operations')</th>
            </tr>
        </thead>
        <tbody>
            @forelse($discovers as $discover)
                <tr id="row-{{ $discover->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($discover->image)
                            <img src="@image($discover->image)" alt="discover image" width="60" height="60">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $discover->t('title') }}</td>
                    <td>{!! $discover->t('content') !!}</td>
                    <td>
                        <div class="hstack gap-2 fs-15">
                            <x-buttons.edit-button :route="route('landingPage.edit', $discover->id)" />
                        </div>
                    </td>
                </tr>
            @empty
                @include('dashboard.core.includes.no-entries', ['columns' => 7])
            @endforelse
        </tbody>
    </table>
</div>


        </x-cards.page-card>
    </div>
@endsection