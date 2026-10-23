{{-- Shared create/edit fields. $project is null on create. --}}
@php
    $project = $project ?? null;
@endphp

<h6 class="fw-semibold mb-3">@lang('dashboard.title')</h6>

<x-input.input-field name="title_ar" label="{{ __('dashboard.title_ar') }}" id="title_ar"
    :value="$project?->title_ar" required="true" />

<x-input.input-field name="title_en" label="{{ __('dashboard.title_en') }}" id="title_en"
    :value="$project?->title_en" />

<div class="col-md-6 mb-3">
    <label class="form-label" for="slug">@lang('dashboard.project_slug')</label>
    <input type="text" name="slug" id="slug" class="form-control" dir="ltr"
        value="{{ old('slug', $project?->slug) }}" placeholder="villa-al-riyadh">
    <div class="form-text">@lang('dashboard.project_slug_hint')</div>
    @error('slug')
        <div class="text-danger p-2">{{ $message }}</div>
    @enderror
</div>

<x-input.input-field name="sort_order" type="number" label="{{ __('dashboard.sort_order') }}" id="sort_order"
    :value="$project?->sort_order ?? 0" />

<x-input.input-field name="category_ar" label="{{ __('dashboard.category_ar') }}" id="category_ar"
    :value="$project?->category_ar" />

<x-input.input-field name="category_en" label="{{ __('dashboard.category_en') }}" id="category_en"
    :value="$project?->category_en" />

<x-input.input-field name="city_ar" label="{{ __('dashboard.city_ar') }}" id="city_ar"
    :value="$project?->city_ar" />

<x-input.input-field name="city_en" label="{{ __('dashboard.city_en') }}" id="city_en"
    :value="$project?->city_en" />

<x-input.input-field name="client_ar" label="{{ __('dashboard.client_ar') }}" id="client_ar"
    :value="$project?->client_ar" />

<x-input.input-field name="client_en" label="{{ __('dashboard.client_en') }}" id="client_en"
    :value="$project?->client_en" />

<x-input.input-field name="area" label="{{ __('dashboard.project_area') }}" id="area"
    :value="$project?->area" placeholder="1,200 m²" />

<x-input.input-field name="year" type="number" label="{{ __('dashboard.project_year') }}" id="year"
    :value="$project?->year" placeholder="{{ now()->year }}" />

<div class="col-md-6 mb-3">
    <div class="form-check form-switch mt-2">
        <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active"
            @checked(old('is_active', $project?->is_active ?? true))>
        <label class="form-check-label" for="is_active">@lang('dashboard.Activate')</label>
    </div>
</div>

<div class="col-md-6 mb-3">
    <div class="form-check form-switch mt-2">
        <input type="checkbox" name="is_featured" value="1" class="form-check-input" id="is_featured"
            @checked(old('is_featured', $project?->is_featured ?? false))>
        <label class="form-check-label" for="is_featured">@lang('dashboard.is_featured')</label>
    </div>
</div>

<hr class="my-3">

{{-- Images --}}
<div class="col-md-6 mb-3">
    <label class="form-label" for="image">@lang('dashboard.main_image') @if (!$project)<span class="text-danger">*</span>@endif</label>
    <input type="file" name="image" id="image" class="form-control" accept="image/jpeg,image/png,image/webp"
        @required(!$project)>
    @error('image')
        <div class="text-danger p-2">{{ $message }}</div>
    @enderror
    @if ($project?->image)
        <img src="{{ \App\Support\WebsiteImage::url($project->image, 'project', $project->id) }}" alt=""
            class="mt-2 rounded border" style="width: 160px; height: 110px; object-fit: cover;">
    @endif
</div>

<div class="col-md-6 mb-3">
    <label class="form-label" for="gallery">@lang('dashboard.gallery_images')</label>
    <input type="file" name="gallery[]" id="gallery" class="form-control" multiple
        accept="image/jpeg,image/png,image/webp">
    <div class="form-text">@lang('dashboard.gallery_images_hint')</div>
    @error('gallery')
        <div class="text-danger p-2">{{ $message }}</div>
    @enderror
    @foreach ($errors->get('gallery.*') as $messages)
        <div class="text-danger p-2">{{ $messages[0] }}</div>
    @endforeach
</div>

@if ($project)
    <div class="col-12 mb-3">
        <label class="form-label">@lang('dashboard.current_gallery')</label>
        @if ($project->images->isEmpty())
            <p class="text-muted mb-0">@lang('dashboard.no_gallery_images')</p>
        @else
            <div class="d-flex flex-wrap gap-3">
                @foreach ($project->images as $galleryImage)
                    <div class="deletable-item position-relative" style="width: 140px;">
                        <img src="{{ \App\Support\WebsiteImage::url($galleryImage->image, 'project', $project->id) }}"
                            alt="" class="rounded border w-100" style="height: 100px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-1">
                            <x-buttons.delete-button :route="route('projects.images.destroy', $galleryImage->id)"
                                :itemId="'img-'.$galleryImage->id" />
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endif

<hr class="my-3">

{{-- Texts --}}
<div class="col-md-6 mb-3">
    <label class="form-label" for="summary_ar">@lang('dashboard.summary_ar')</label>
    <textarea name="summary_ar" id="summary_ar" rows="3" class="form-control" maxlength="1000">{{ old('summary_ar', $project?->summary_ar) }}</textarea>
    @error('summary_ar')
        <div class="text-danger p-2">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-6 mb-3">
    <label class="form-label" for="summary_en">@lang('dashboard.summary_en')</label>
    <textarea name="summary_en" id="summary_en" rows="3" class="form-control" maxlength="1000" dir="ltr">{{ old('summary_en', $project?->summary_en) }}</textarea>
    @error('summary_en')
        <div class="text-danger p-2">{{ $message }}</div>
    @enderror
</div>

<x-editor.summernote id="content_ar" label="{{ __('dashboard.content_ar') }}" name="content_ar"
    :value="old('content_ar', $project?->content_ar)" />

<x-editor.summernote id="content_en" label="{{ __('dashboard.content_en') }}" name="content_en"
    :value="old('content_en', $project?->content_en)" />
