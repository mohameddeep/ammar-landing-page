
@extends('dashboard.core.app')
@section('title', __('dashboard.landingPage_features'))
@section('css_addons')

@endsection
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.landingPage_features') }}" :breadcrumbs="[['name' => __('dashboard.landingPage_features'), 'route' => 'features.index']]" />
        <!-- Page Header Close -->
        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.landingPage_features')
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
            @forelse($features as $feature)
                <tr id="row-{{ $feature->id }}">
                    <td>{{ $loop->iteration }}</td>
                      <td>
                        @if($feature->image)
                            <img src="@image($feature->image)" alt="feature image" width="60" height="60">
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $feature->t('title') }}</td>
                    <td>{!! $feature->t('content') !!}</td>
                  
                  
                    <td>
                        <div class="hstack gap-2 fs-15">
                            <x-buttons.edit-button :route="route('landingPage.edit', $feature->id)" />
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