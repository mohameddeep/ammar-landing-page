@extends('dashboard.core.app')
@section('content')
    <div class="container-fluid px-5 py-3">
        <!-- Page Header -->
        <x-breadcrumb.breadcrumb title="{{ __('dashboard.privacy_policy') }}" :breadcrumbs="[['name' => __('dashboard.privacy_policy'), 'route' => 'policy.index']]" />
        <!-- Page Header Close -->
        <x-cards.page-card>
            <x-slot name="about">
                <div class="card-title">
                    {{ __('dashboard.privacy_policy') }}
                </div>
            </x-slot>

            <x-form.form-component :route="route('policy.store')" method="POST" enctype="multipart/form-data">

                {{-- section 1 --}}
                <h3 class="text-muted">@lang('dashboard.privacy_policy')</h3>

                {{-- <x-input.input-field name="ar[title]" label="{{ __('dashboard.title_ar') }}"
                                     placeholder="{{ __('dashboard.title') }}"
                                     :value="old('ar.title') ?? ($content['ar']['title'] ?? '')"/>

                <x-input.input-field name="en[title]" label="{{ __('dashboard.title_en') }}"
                                     placeholder="{{ __('dashboard.title') }}"
                                     :value="old('en.title') ?? ($content['en']['title'] ?? '')"/> --}}

                <hr class="my-3 text-muted" />

                {{-- section 2 --}}

                <x-editor.summernote id="ar_content" label="{{ __('dashboard.content_ar') }}" name="ar[content]"
                    :value="old('ar.content') ?? ($content['ar']['content'] ?? '')" />

                <x-editor.summernote id="en_content" label="{{ __('dashboard.content_en') }}" name="en[content]"
                    :value="old('en.content') ?? ($content['en']['content'] ?? '')" />


                <hr class="my-3 text-muted" />


            </x-form.form-component>

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
@endpush
