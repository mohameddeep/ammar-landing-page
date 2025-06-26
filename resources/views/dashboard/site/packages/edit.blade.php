@extends('dashboard.core.app')
@section('title', __('dashboard.edit_package'))

@section('content')
    <div class="container-fluid px-5 py-3">
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.Edit') }}" :breadcrumbs="[['name' => __('dashboard.Packages')], ['name' => __('dashboard.Edit')]]" />

        <x-cards.page-card>
            <x-slot name="header">
                <div class="card-title">@lang('dashboard.Edit')</div>
            </x-slot>

            <x-form.form-component :route="route('packages.update', $package->id)" method="PUT">
                <x-input.input-field name="name_ar" type="text" label="{{ __('dashboard.name_ar') }}" :value="old('name_ar', $package->name_ar)" />

                <x-input.input-field name="name_en" type="text" label="{{ __('dashboard.name_en') }}" :value="old('name_en', $package->name_en)" />

                <x-input.input-field name="description_ar" type="text" label="{{ __('dashboard.description_ar') }}"
                    :value="old('description_ar', $package->description_ar)" />

                <x-input.input-field name="description_en" type="text" label="{{ __('dashboard.description_en') }}"
                    :value="old('description_en', $package->description_en)" />

                <x-input.input-field name="type" type="select" label="{{ __('dashboard.type') }}" :options="$types"
                    :value="old('type', $package->type)" />

                <x-input.input-field name="product_number" type="text" label="{{ __('dashboard.product_number') }}"
                    :value="old('product_number', $package->product_number)" />

                <x-input.input-field name="price" type="text" label="{{ __('dashboard.price') }}" :value="old('price', $package->price)" />

                <x-input.input-field name="duration" type="text" label="{{ __('dashboard.duration') }}"
                    :value="old('duration', $package->duration)" />

                <div class="table-responsive mb-4">
                    <table class="table nowrap text-nowrap border mt-3" id="featuresTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('feature_ar')</th>
                                <th>@lang('feature_en')</th>
                                <th>@lang('dashboard.status')</th>
                                <th>@lang('dashboard.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (old('features', $package->features->map(fn($f) => $f->toArray())->toArray()) as $index => $feature)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <input name="features[{{ $index }}][feature_ar]" type="text"
                                            class="form-control"
                                            value="{{ old("features.$index.feature_ar", $feature['feature_ar'] ?? '') }}">
                                    </td>
                                    <td>
                                        <input name="features[{{ $index }}][feature_en]" type="text"
                                            class="form-control"
                                            value="{{ old("features.$index.feature_en", $feature['feature_en'] ?? '') }}">
                                    </td>
                                    <td class="text-center">
                                        <input name="features[{{ $index }}][is_active]" type="checkbox"
                                            value="1" class="form-check-input"
                                            {{ old("features.$index.is_active", $feature['is_active'] ?? false) ? 'checked' : '' }}>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger remove-feature">
                                            <i class="ri-delete-bin-5-line"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="border-bottom-0">
                                    <button type="button" class="btn btn-light add-feature">
                                        <i class="bi bi-plus-lg"></i> @lang('dashboard.create')
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-form.form-component>
        </x-cards.page-card>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).on('click', '.remove-feature', function() {
            const button = $(this);
            Swal.fire({
                title: "@lang('dashboard.Are you sure?')",
                text: "@lang('dashboard.This action cannot be undone!')",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "@lang('dashboard.Yes, delete it!')",
                cancelButtonText: "@lang('dashboard.Cancel')"
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('tr').remove();
                    updateFeatureIndexes();

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
            });
        });

        $(document).ready(function() {
            function updateFeatureIndexes() {
                $('#featuresTable tbody tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);
                    $(this).find('input').each(function() {
                        const name = $(this).attr('name');
                        if (name) {
                            const field = name.match(/\[\d+\]\[(.*?)\]/)[1];
                            $(this).attr('name', `features[${index}][${field}]`);
                        }
                    });
                });
            }

            $('.add-feature').on('click', function() {
                const rowIndex = $('#featuresTable tbody tr').length;
                const newRow = `
                    <tr>
                        <td>${rowIndex + 1}</td>
                        <td>
                            <input name="features[${rowIndex}][feature_ar]" type="text" class="form-control" placeholder="مثلاً: توصيل مجاني">
                        </td>
                        <td>
                            <input name="features[${rowIndex}][feature_en]" type="text" class="form-control" placeholder="e.g. Free shipping">
                        </td>
                        <td class="text-center">
                            <input name="features[${rowIndex}][is_active]" type="checkbox" value="1" class="form-check-input" checked>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger remove-feature">
                                <i class="ri-delete-bin-5-line"></i>
                            </button>
                        </td>
                    </tr>
                `;
                $('#featuresTable tbody').append(newRow);
            });
        });
    </script>
@endpush
