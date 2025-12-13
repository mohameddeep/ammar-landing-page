@extends('dashboard.core.app')
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.about') }}" :breadcrumbs="[['name' => __('dashboard.about'), 'route' => 'about.index']]" />
        <!-- Page Header Close -->
        <x-cards.page-card>
            <x-slot name="about">
                <div class="card-title">
                    {{ __('dashboard.about') }}
                </div>
                {{-- <div class="d-flex">
                    <div class="py-2 d-flex justify-content-end align-items-center">

                        <x-buttons.create-button :route="route('about.create')" />
                    </div>
                </div> --}}
            </x-slot>

            <x-form.form-component :route="route('about.store')" method="POST" enctype="multipart/form-data">

                {{-- section 1 --}}
                <h3 class="text-muted">@lang('dashboard.about')</h3>
                <x-input.input-field name="ar[title]" label="{{ __('dashboard.title_ar') }}"
                    placeholder="{{ __('dashboard.title') }}" :value="old('ar.title') ?? ($content['ar']['title'] ?? '')" />

                <x-input.input-field name="en[title]" label="{{ __('dashboard.title_en') }}"
                    placeholder="{{ __('dashboard.title') }}" :value="old('en.title') ?? ($content['en']['title'] ?? '')" />
                <hr class="my-3 text-muted" />

                {{-- section 2 --}}
                {{-- Title AR --}}

                <x-editor.summernote id="ar_desc1" label="{{ __('dashboard.description_ar') }}" name="ar[desc]"
                    :value="old('ar.desc') ?? ($content['ar']['desc'] ?? '')" />

                <x-editor.summernote id="en_desc1" label="{{ __('dashboard.description_en') }}" name="en[desc]"
                    :value="old('en.desc') ?? ($content['en']['desc'] ?? '')" />


                <hr class="my-3 text-muted" />


            </x-form.form-component>


            <x-slot name="footer">

            </x-slot>
        </x-cards.page-card>
    </div>
@endsection
@push('scripts')
    <script>
        @if ($errors && count($errors) > 0)
            $(document).ready(function() {
                @foreach ($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            });
        @endif
    </script>
    <script>
        $(function() {
            let statIndex = {{ count(old('all.statistics', data_get($content, 'en.statistics', []))) }};

            // Add statistic
            $('#add_statistic').on('click', function() {
                const row = `
        <div class="row statistic-row gy-3 align-items-end" data-index="${statIndex}">
    <!-- Image Upload -->
    <div class="col-12 col-md-2">
        <label class="form-label fw-semibold">@lang('dashboard.image')</label>
        <input type="file" name="file[${500 + statIndex}]" accept="image/*" class="form-control">
        <input name="en[statistics][${statIndex}][icon]" type="hidden" value="file_${500 + statIndex}">
        <input name="ar[statistics][${statIndex}][icon]" type="hidden" value="file_${500 + statIndex}">
        <input name="old_file[${500 + statIndex}]" type="hidden" value="">
    </div>

 <!-- Name AR -->
    <div class="col-12 col-md-4">
        <label class="form-label fw-semibold">@lang('dashboard.stat_name') (AR)</label>
        <input name="ar[statistics][${statIndex}][name]" class="form-control" type="text" placeholder="ادخل الاسم بالعربية">
    </div>

    <!-- Name EN -->
    <div class="col-12 col-md-4">
        <label class="form-label fw-semibold">@lang('dashboard.stat_name') (EN)</label>
        <input name="en[statistics][${statIndex}][name]" class="form-control" type="text" placeholder="Enter name in English">
    </div>



    <!-- Value -->
    <div class="col-12 col-md-1">
        <label class="form-label fw-semibold">@lang('dashboard.stat_value')</label>
        <input name="all[statistics][${statIndex}][value]" class="form-control" type="number" placeholder="0">
    </div>

    <!-- Remove Button -->
    <div class="w-fit" style="width:fit-content;">
        <button type="button"
                class="btn btn-outline-danger w-100 remove-statistic d-flex align-items-center justify-content-center gap-2">
            <i class="ti ti-trash fs-5"></i>

        </button>
    </div>
</div>
`;
                $('#statistics-container').append(row);
                statIndex++;
            });

            $(document).on('click', '.remove-statistic', function() {
                $(this).closest('.statistic-row').remove();
            });


        });
    </script>
@endpush
