@extends('dashboard.core.app')
@section('title', __('dashboard.terms_and_conditions'))

@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.terms_and_conditions') }}" :breadcrumbs="[['name' => __('dashboard.terms_and_conditions'), 'route' => 'terms_and_conditions.index']]" />
        <!-- Page Header Close -->
        <x-cards.page-card>
            <x-slot name="terms_and_conditions">
                <div class="card-title">
                    {{ __('dashboard.terms_and_conditions') }}
                </div>
                {{-- <div class="d-flex">
                    <div class="py-2 d-flex justify-content-end align-items-center">

                        <x-buttons.create-button :route="route('terms_and_conditions.create')" />
                    </div>
                </div> --}}
            </x-slot>

            <x-form.form-component :route="route('terms_and_conditions.store')" method="POST" enctype="multipart/form-data">

                {{-- section 1 --}}
                <h3 class="text-muted">@lang('dashboard.terms_and_conditions')</h3>

               
                <x-editor.summernote id="ar_desc" label="{{ __('dashboard.description_ar') }}" name="ar[desc]"
                                     :value="old('ar.desc') ?? ($content['ar']['desc'] ?? '')"/>
                <x-editor.summernote id="en_desc" label="{{ __('dashboard.description_en') }}" name="en[desc]"
                                     :value="old('en.desc') ?? ($content['en']['desc'] ?? '')"/>

                {{-- end section 1 --}}

               

              

            </x-form.form-component>




            <x-slot name="footer">
                {{-- <div class="d-flex justify-content-end align-items-center">
                    {{ $terms_and_conditions->links() }}
                </div> --}}
            </x-slot>
        </x-cards.page-card>
    </div>
@endsection
@push('scripts')
    <script>
        @if (
            $errors && count($errors) > 0
        )
        $(document).ready(function() {
            @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
            @endforeach
        });
        @endif
    </script>
    <script>
        let blockIndex = {{ count($content['ar']['blocks'] ?? []) }};

        document.addEventListener('DOMContentLoaded', function () {
            const addButton = document.getElementById('add-block-btn');

            addButton.addEventListener('click', function () {
                const blockWrapper = document.createElement('div');
                blockWrapper.classList.add('row', 'mb-4', 'border', 'p-3', 'rounded',
                    'block-item');

                blockWrapper.innerHTML = `
            <div class="text-end mb-2">
                <button type="button" class="btn btn-danger btn-sm remove-block">
                    حذف البلوك
                </button>
            </div>

            <div class="col-md-6">
                <label>العنوان بالعربي</label>
                <input type="text" name="ar[blocks][${blockIndex}][title]" class="form-control" placeholder="اكتب العنوان">
            </div>
<div class="col-md-6">
                <label>Title in English</label>
                <input type="text" name="en[blocks][${blockIndex}][title]" class="form-control" placeholder="Enter title">
            </div>
            <div class="col-12 mb-3">
                <label>الوصف بالعربي</label>
                <textarea class="form-control summernote" name="ar[blocks][${blockIndex}][desc]"></textarea>
            </div>


            <div class="col-12">
                <label>Description in English</label>
                <textarea class="form-control summernote" name="en[blocks][${blockIndex}][desc]"></textarea>
            </div>
        `;

                document.getElementById('blocks-wrapper').appendChild(blockWrapper);

                $(blockWrapper).find('.summernote').summernote({
                    height: 100,
                    lang: 'ar-AR'
                });

                blockIndex++;
            });

            // Initialize summernote for existing blocks
            $('.summernote').summernote({
                height: 100,
                lang: 'ar-AR'
            });

            // Listen to all remove buttons
            document.addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-block')) {
                    const blockItem = e.target.closest('.block-item');
                    blockItem.remove();
                }

            });
        });
    </script>
@endpush
