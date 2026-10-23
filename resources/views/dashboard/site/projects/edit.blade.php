@extends('dashboard.core.app')
@section('title', __('dashboard.projects'))

@section('content')
    <div class="container-fluid px-5 py-3">
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.projects') }}" :breadcrumbs="[
            ['name' => __('dashboard.projects'), 'route' => 'projects.index'],
            ['name' => __('dashboard.Edit')],
        ]" />

        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">@lang('dashboard.Edit'): {{ $project->t('title') }}</div>
                @if ($project->is_active)
                    <a href="{{ route('website.projects.show', $project->slug) }}"
                        target="_blank" rel="noopener" class="btn btn-sm btn-outline-primary">
                        <i class="ri-external-link-line"></i> {{ $project->slug }}
                    </a>
                @endif
            </x-slot>
            <x-form.form-component :route="route('projects.update', $project->id)" method="PUT">
                @include('dashboard.site.projects.partials.form', ['project' => $project])
            </x-form.form-component>
        </x-cards.page-card>
    </div>
@endsection
