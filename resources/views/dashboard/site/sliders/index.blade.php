@extends('dashboard.core.app')
@section('title', __('dashboard.sliders'))

@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.sliders') }}" :breadcrumbs="[['name' => __('dashboard.sliders'), 'route' => 'sliders.index']]" />
        <!-- Page Header Close -->
        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.sliders')
                </div>
                <div class="d-flex">
                    <div class="py-2 d-flex justify-content-end align-items-center">

                        <x-buttons.create-button :route="route('sliders.create')" />

                    </div>
                </div>
            </x-slot>
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.image')</th>
                            <th>@lang('dashboard.title_one')</th>
                            <th>@lang('dashboard.title_two')</th>
                            <th>@lang('dashboard.title_three')</th>
                            <th>@lang('dashboard.content')</th>
                            <th>@lang('dashboard.Activate')</th>
                            <th>@lang('dashboard.Operations')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sliders as $slider)
                            <tr id="row-{{ $slider->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="@image($slider->image)" alt="slider image" width="60" height="60">
                                </td>


                                <td>{{ $slider->t('title_one') }}</td>
                                <td>{{ $slider->t('title_two') }}</td>
                                <td>{{ $slider->t('title_three') }}</td>
                                <td>{{ $slider->t('content') }}</td>
                                <td>
                                    <div class="custom-toggle-switch d-flex align-items-center">
                                        <input id="toggle_{{ $slider->id }}" name="toggleswitch_{{ $slider->id }}"
                                            type="checkbox" {{ $slider->is_active == 1 ? 'checked' : '' }}
                                            onclick="togglesliderStatus({{ $slider->id }})">
                                        <label for="toggle_{{ $slider->id }}" class="label-secondary"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="hstack gap-2 fs-15">
                                        <x-buttons.edit-button :route="route('sliders.edit', $slider->id)" />

                                        <x-buttons.delete-button :route="route('sliders.destroy', $slider->id)" :itemId="$slider->id" />

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
                    {{ $sliders->links() }}
                </div>
            </x-slot>
        </x-cards.page-card>
    </div>
@endsection
@push('scripts')
    <script>
        function togglesliderStatus(sliderId) {
            let checkbox = document.getElementById(`toggle_${sliderId}`);
            let isChecked = checkbox.checked ? 1 : 0;

            let routeUrl = `{{ route('sliders.toggle', ['id' => '__id__']) }}`.replace('__id__', sliderId);

            $.ajax({
                url: routeUrl,
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    is_active: isChecked
                },
                success: function(response) {
                    console.log(response.message);

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
