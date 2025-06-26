@extends('dashboard.core.app')
@section('title', __('dashboard.commissions'))
@section('css_addons')

@endsection
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.categories') }}" :breadcrumbs="[['name' => __('dashboard.categories'), 'route' => 'categories.index']]" />
        <!-- Page Header Close -->
        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.categories')
                </div>
                <div class="d-flex">
                    <div class="py-2 d-flex justify-content-end align-items-center">
                        <button class="btn btn-outline-primary btn-wave waves-effect waves-light me-1" data-bs-toggle="modal"
                            data-bs-target="#c">
                            <i class="ti ti-search"></i>
                        </button>
                        <x-buttons.create-button :route="route('categories.create')" />

                    </div>
                </div>
            </x-slot>
            <div class="table-responsive">
                <table class="table text-nowrap">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>@lang('dashboard.images')</th>
                            <th>@lang('dashboard.Name')</th>
                            <th>@lang('dashboard.Products_Count')</th>
                            <th>@lang('dashboard.Activate')</th>
                            <th>@lang('dashboard.Operations')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr id="row-{{ $category->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="@image($category->image)" alt="category image" width="60" height="60">
                                </td>


                                <td>{{ $category->t('name') }}</td>
                                <td>{{ $category->products_count }}</td>
                                <td>
                                    <div class="custom-toggle-switch d-flex align-items-center">
                                        <input id="toggle_{{ $category->id }}" name="toggleswitch_{{ $category->id }}"
                                            type="checkbox" {{ $category->is_active == 1 ? 'checked' : '' }}
                                            onclick="toggleCategoryStatus({{ $category->id }})">
                                        <label for="toggle_{{ $category->id }}" class="label-secondary"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="hstack gap-2 fs-15">
                                        <x-buttons.edit-button :route="route('categories.edit', $category->id)" />

                                        <x-buttons.delete-button :route="route('categories.destroy', $category->id)" :itemId="$category->id" />

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
                    {{ $categories->links() }}
                </div>
            </x-slot>
        </x-cards.page-card>
    </div>
@endsection
@push('scripts')
    <script>
        function toggleCategoryStatus(categoryId) {
            let checkbox = document.getElementById(`toggle_${categoryId}`);
            let isChecked = checkbox.checked ? 1 : 0;

            let routeUrl = `{{ route('categories.toggle', ['id' => '__id__']) }}`.replace('__id__', categoryId);

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
