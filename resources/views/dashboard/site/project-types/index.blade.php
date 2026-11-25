@extends('dashboard.core.app')
@section('title', __('dashboard.project_types'))

@section('content')
    <div class="container-fluid px-5 py-3">
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.project_types') }}" :breadcrumbs="[['name' => __('dashboard.project_types'), 'route' => 'project-types.index']]" />

        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">@lang('dashboard.project_types')</div>
                <div class="d-flex">
                    <div class="py-2 d-flex justify-content-end align-items-center">
                        <x-buttons.create-button :route="route('project-types.create')" />
                    </div>
                </div>
            </x-slot>
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.name_ar')</th>
                            <th>@lang('dashboard.name_en')</th>
                            <th>@lang('dashboard.sort_order')</th>
                            <th>@lang('dashboard.pricing_requests')</th>
                            <th>@lang('dashboard.Activate')</th>
                            <th>@lang('dashboard.Operations')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projectTypes as $projectType)
                            <tr id="row-{{ $projectType->id }}">
                                <td>{{ $projectTypes->firstItem() + $loop->index }}</td>
                                <td>{{ $projectType->name_ar }}</td>
                                <td>{{ $projectType->name_en }}</td>
                                <td>{{ $projectType->sort_order }}</td>
                                <td>{{ $projectType->pricing_requests_count }}</td>
                                <td>
                                    <div class="custom-toggle-switch d-flex align-items-center">
                                        <input id="toggle_{{ $projectType->id }}" type="checkbox"
                                            @checked($projectType->is_active)
                                            onclick="toggleProjectType({{ $projectType->id }})">
                                        <label for="toggle_{{ $projectType->id }}" class="label-secondary"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="hstack gap-2 fs-15">
                                        <x-buttons.edit-button :route="route('project-types.edit', $projectType->id)" />
                                        <x-buttons.delete-button :route="route('project-types.destroy', $projectType->id)" :itemId="$projectType->id" />
                                    </div>
                                </td>
                            </tr>
                        @empty
                            @include('dashboard.core.includes.no-entries', ['columns' => 7])
                        @endforelse
                    </tbody>
                </table>
            </div>
            <x-slot name="footer">
                <div class="d-flex justify-content-end align-items-center">
                    {{ $projectTypes->links() }}
                </div>
            </x-slot>
        </x-cards.page-card>
    </div>
@endsection
@push('scripts')
    <script>
        function toggleProjectType(id) {
            const checkbox = document.getElementById(`toggle_${id}`);
            const url = `{{ route('project-types.toggle', ['id' => '__id__']) }}`.replace('__id__', id);

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: response.message,
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                    });
                },
                error: function(xhr, status) {
                    alert(xhr.responseJSON?.message || status);
                    checkbox.checked = !checkbox.checked;
                }
            });
        }
    </script>
@endpush
