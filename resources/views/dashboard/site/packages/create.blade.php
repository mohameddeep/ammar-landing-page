@extends('dashboard.core.app')
@section('title', __('dashboard.packages'))
@section('css_addons')

@endsection
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.packages') }}" :breadcrumbs="[['name' => __('dashboard.packages')], ['name' => __('dashboard.Edit')]]" />


        <x-cards.page-card>

            <x-slot name="header">
                <div class="card-title">
                    @lang('dashboard.Create')
                </div>
            </x-slot>

            <x-form.form-component :route="route('packages.store')">
                <x-input.input-field name="name_ar" type="text" label="{{ __('dashboard.name_ar') }}"
                    placeholder="{{ __('dashboard.name_ar') }}" :value="old('name_ar')" />


                <x-input.input-field name="name_en" type="text" label="{{ __('dashboard.name_en') }}"
                    placeholder="{{ __('dashboard.name_en') }}" :value="old('name_en')" />


{{--                <x-input.input-field name="type" type="select" label="{{ __('dashboard.type') }}" :options="$types"--}}
{{--                    :value="old('type')" />--}}

                <x-input.input-field name="product_count" type="text" label="{{ __('dashboard.product_count') }}"
                    placeholder="{{ __('dashboard.product_count') }}" :value="old('product_count')" />

                <x-input.input-field name="free_product_count" type="text"
                    label="{{ __('dashboard.free_product_count') }}"
                    placeholder="{{ __('dashboard.free_product_count') }}" :value="old('free_product_count')" />

                <x-input.input-field name="price" type="text" label="{{ __('dashboard.price') }}"
                    placeholder="{{ __('dashboard.price') }}" :value="old('price')" />

                <x-input.input-field name="duration" type="text" label="{{ __('dashboard.duration') }}"
                    placeholder="{{ __('dashboard.duration') }}" :value="old('duration')" />


                <div class="table-responsive mb-4">
                    <table class="table nowrap text-nowrap border mt-3" id="featuresTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('dashboard.feature_ar')</th>
                                <th>@lang('dashboard.feature_en')</th>
                                <th>@lang('dashboard.status')</th>
                                <th>@lang('dashboard.actions')</th>
                            </tr>
                        </thead>
                        @php
                            $oldFeatures = old('features', [[]]); // لو مفيش old يرجع واحد فاضي
                        @endphp

                        <tbody>
                            @foreach ($oldFeatures as $index => $feature)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <input name="features[{{ $index }}][feature_ar]" type="text"
                                            class="form-control" placeholder="مثلاً: توصيل مجاني"
                                            value="{{ old("features.$index.feature_ar", $feature['feature_ar'] ?? '') }}">
                                    </td>
                                    <td>
                                        <input name="features[{{ $index }}][feature_en]" type="text"
                                            class="form-control" placeholder="e.g. Free shipping"
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
        $(document).ready(function() {

            function updateFeatureIndexes() {
                $('#featuresTable tbody tr').each(function(index) {
                    $(this).find('td:first').text(index + 1);

                    $(this).find('input[name^="features"]').each(function() {
                        const field = $(this).attr('name').match(/\[(.*?)\]$/)[1];
                        $(this).attr('name', `features[${index}][${field}]`);
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

            $(document).on('click', '.remove-feature', function() {
                $(this).closest('tr').remove();
                updateFeatureIndexes();
            });
        });
    </script>
@endpush
