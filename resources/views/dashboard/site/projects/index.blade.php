@extends('dashboard.core.app')
@section('title', __('dashboard.projects'))

@section('content')
    <div class="container-fluid px-5 py-3">
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.projects') }}" :breadcrumbs="[['name' => __('dashboard.projects'), 'route' => 'projects.index']]" />

        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">@lang('dashboard.projects')</div>
                <div class="d-flex">
                    <div class="py-2 d-flex justify-content-end align-items-center">
                        <x-buttons.create-button :route="route('projects.create')" />
                    </div>
                </div>
            </x-slot>
            <div class="table-responsive">
                <table class="table text-nowrap align-middle">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.image')</th>
                            <th>@lang('dashboard.title')</th>
                            <th>@lang('dashboard.category_ar')</th>
                            <th>@lang('dashboard.images_count')</th>
                            <th>@lang('dashboard.sort_order')</th>
                            <th>@lang('dashboard.Activate')</th>
                            <th>@lang('dashboard.Operations')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $project)
                            <tr id="row-{{ $project->id }}">
                                <td>{{ $projects->firstItem() + $loop->index }}</td>
                                <td>
                                    <img src="{{ \App\Support\WebsiteImage::url($project->image, 'project', $project->id) }}"
                                        alt="" width="80" height="56" class="rounded" style="object-fit: cover;">
                                </td>
                                <td>
                                    <div class="fw-semibold">{{ $project->t('title') }}</div>
                                    <small class="text-muted" dir="ltr">{{ $project->slug }}</small>
                                    @if ($project->is_featured)
                                        <span class="badge bg-warning-transparent ms-1">@lang('dashboard.featured')</span>
                                    @endif
                                </td>
                                <td>{{ $project->t('category') ?: '—' }}</td>
                                <td>{{ $project->images_count }}</td>
                                <td>{{ $project->sort_order }}</td>
                                <td>
                                    <div class="custom-toggle-switch d-flex align-items-center">
                                        <input id="toggle_{{ $project->id }}" type="checkbox" @checked($project->is_active)
                                            onclick="toggleProjectStatus({{ $project->id }})">
                                        <label for="toggle_{{ $project->id }}" class="label-secondary"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="hstack gap-2 fs-15">
                                        <x-buttons.edit-button :route="route('projects.edit', $project->id)" />
                                        <x-buttons.delete-button :route="route('projects.destroy', $project->id)" :itemId="$project->id" />
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
                    {{ $projects->links() }}
                </div>
            </x-slot>
        </x-cards.page-card>
    </div>
@endsection
@push('scripts')
    <script>
        function toggleProjectStatus(projectId) {
            let checkbox = document.getElementById(`toggle_${projectId}`);
            let routeUrl = `{{ route('projects.toggle', ['id' => '__id__']) }}`.replace('__id__', projectId);

            $.ajax({
                url: routeUrl,
                type: 'POST',
                data: { _token: $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.data && response.data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                    }
                },
                error: function(xhr, status) {
                    alert('An error occurred: ' + (xhr.responseJSON?.message || status));
                    checkbox.checked = !checkbox.checked;
                }
            });
        }
    </script>
@endpush
