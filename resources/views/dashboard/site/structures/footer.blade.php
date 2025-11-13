@extends('dashboard.core.app')
@section('content')
<div class="container-fluid px-5 py-3">
    <!-- Page Header -->
    <x-breadcrumb.breadcrumb title="{{ __('dashboard.footer') }}" 
                            :breadcrumbs="[['name' => __('dashboard.footer'), 'route' => 'footer.index']]" />
    <!-- Page Header Close -->

    <x-cards.page-card>
        <x-slot name="header">
            <div class="card-title">{{ __('dashboard.footer') }}</div>
        </x-slot>

        <x-form.form-component :route="route('footer.store')" method="POST" enctype="multipart/form-data">

            {{-- Non-language fields: wrap in all[] so StructureController can merge --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <x-input.input-field name="all[email]" label="{{ __('dashboard.email') }}" 
                                         placeholder="{{ __('dashboard.email') }}" 
                                         :value="$content['all']['email'] ?? ''" />
                </div>
                <div class="col-md-6">
                    <x-input.input-field name="all[phone]" label="{{ __('dashboard.phone') }}" 
                                         placeholder="{{ __('dashboard.phone') }}" 
                                         :value="$content['all']['phone'] ?? ''" />
                </div>
                <div class="col-md-6">
                    <x-input.input-field name="all[whatsapp]" label="{{ __('dashboard.whatsapp') }}" 
                                         placeholder="{{ __('dashboard.whatsapp') }}" 
                                         :value="$content['all']['whatsapp'] ?? ''" />
                </div>
                <div class="col-md-6">
                    <x-input.input-field name="all[facebook_link]" label="{{ __('dashboard.facebook_link') }}" 
                                         placeholder="{{ __('dashboard.facebook_link') }}" 
                                         :value="$content['all']['facebook_link'] ?? ''" />
                </div>
                <div class="col-md-6">
                    <x-input.input-field name="all[instagram_link]" label="{{ __('dashboard.instagram_link') }}" 
                                         placeholder="{{ __('dashboard.instagram_link') }}" 
                                         :value="$content['all']['instagram_link'] ?? ''" />
                </div>
                <div class="col-md-6">
                    <x-input.input-field name="all[twitter_link]" label="{{ __('dashboard.twitter_link') }}" 
                                         placeholder="{{ __('dashboard.twitter_link') }}" 
                                         :value="$content['all']['twitter_link'] ?? ''" />
                </div>
                <div class="col-md-6">
                    <x-input.input-field name="all[linkedin_link]" label="{{ __('dashboard.linkedin_link') }}" 
                                         placeholder="{{ __('dashboard.linkedin_link') }}" 
                                         :value="$content['all']['linkedin_link'] ?? ''" />
                </div>

                {{-- Image Upload --}}
                <div class="col-md-6">
                    <x-input.input-field name="image" type="file" label="{{ __('dashboard.Image') }}" />
                    @if(!empty($content['image']))
                        <div class="mt-2">
                            <img src="{{ $content['image'] }}" alt="Footer Image" width="120">
                            <input type="hidden" name="old_file[0]" value="{{ $content['image'] }}">
                            <input type="hidden" name="file[0]" value="file_0">
                        </div>
                    @else
                        <input type="hidden" name="old_file[0]" value="">
                        <input type="hidden" name="file[0]" value="file_0">
                    @endif
                </div>
            </div>

            <hr class="my-3" />

            {{-- Multilingual content --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <x-editor.summernote id="content_ar" label="{{ __('dashboard.content_ar') }}" 
                                         name="content[ar]" :value="$content['content']['ar'] ?? ''" />
                </div>
                <div class="col-md-6">
                    <x-editor.summernote id="content_en" label="{{ __('dashboard.content_en') }}" 
                                         name="content[en]" :value="$content['content']['en'] ?? ''" />
                </div>
            </div>

            <hr class="my-3" />

            {{-- Multilingual copyright --}}
            <div class="row mb-3">
                <div class="col-md-6">
                    <x-editor.summernote id="copyright_ar" label="{{ __('dashboard.copyright_ar') }}" 
                                         name="copyright[ar]" :value="$content['copyright']['ar'] ?? ''" />
                </div>
                <div class="col-md-6">
                    <x-editor.summernote id="copyright_en" label="{{ __('dashboard.copyright_en') }}" 
                                         name="copyright[en]" :value="$content['copyright']['en'] ?? ''" />
                </div>
            </div>

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
