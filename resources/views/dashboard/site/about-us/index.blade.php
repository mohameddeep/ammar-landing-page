@extends('dashboard.core.app')
@section('title', __('dashboard.about_us'))
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.about_us') }}" :breadcrumbs="[['name' => __('dashboard.about_us'), 'route' => 'abouts.index']]" />
        <!-- Page Header Close -->
        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.about_us')
                </div>
                <div class="d-flex">
                    <div class="py-2 d-flex justify-content-end align-items-center">

                        <x-buttons.create-button :route="route('abouts.create')" />

                    </div>
                </div>
            </x-slot>
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.image')</th>
                            <th>@lang('dashboard.title_ar')</th>
                            <th>@lang('dashboard.title_en')</th>
                            <th>@lang('dashboard.status')</th>
                            <th>@lang('dashboard.Operations')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($abouts as $about)
                            <tr id="row-{{ $about->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="@image($about->image)" alt="about image" width="60" height="60">
                                </td>
                                <td>{{ $about->title_ar }}</td>
                                <td>{{ $about->title_en }}</td>
                                <td>
                                    <div class="custom-toggle-switch d-flex align-items-center">
                                        <input id="toggle_{{ $about->id }}" name="toggleswitch_{{ $about->id }}"
                                            type="checkbox" {{ $about->is_active == 1 ? 'checked' : '' }}
                                            onclick="toggleAboutStatus({{ $about->id }})">
                                        <label for="toggle_{{ $about->id }}" class="label-secondary"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="hstack gap-2 fs-15">

                                        <x-buttons.edit-button :route="route('abouts.edit', $about->id)" />
                                        <x-buttons.show-button :route="route('abouts.children.index', $about->id)" :tooltip-title="__('dashboard.children')"/> 

                                        <x-buttons.delete-button :route="route('abouts.destroy', $about->id)" :itemId="$about->id" />

                                    </div>
                                </td>
                            </tr>
                        @empty
                            @include('dashboard.core.includes.no-entries', ['columns' => 6])
                        @endforelse
                    </tbody>
                </table>
            </div>
            <x-slot name="footer">
                <div class="d-flex justify-content-end align-items-center">
                    {{ $abouts->links() }}
                </div>
            </x-slot>
        </x-cards.page-card>
    </div>
@endsection
@push('scripts')
    <script>
        function toggleAboutStatus(aboutId) {
            let checkbox = document.getElementById(`toggle_${aboutId}`);
            let isChecked = checkbox.checked ? 1 : 0;

            let routeUrl = `{{ route('abouts.toggle', ['id' => '__id__']) }}`.replace('__id__', aboutId);

            $.ajax({
                url: routeUrl,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    is_active: isChecked
                },
                success: function(response) {
                    if (response.data && response.data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                        });
                    }
                },
                error: function(xhr, status, error) {
                    alert('An error occurred: ' + (xhr.responseJSON?.message || status));
                    checkbox.checked = !isChecked;
                }
            });
        }
    </script>
@endpush
