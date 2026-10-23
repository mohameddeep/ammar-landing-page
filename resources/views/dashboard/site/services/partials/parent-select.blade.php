{{-- Parent service select. "None" keeps the service top-level. --}}
@php
    $selectedParent = old('parent_id', $selected ?? null);
    $locked = $locked ?? false;
@endphp
<div class="col-md-6 mb-3">
    <label class="form-label" for="parent_id">{{ __('dashboard.parent_service') }}</label>
    <select name="parent_id" id="parent_id" class="form-select" @disabled($locked)>
        <option value="">{{ __('dashboard.no_parent_service') }}</option>
        @foreach ($parentOptions as $parentOption)
            <option value="{{ $parentOption->id }}" @selected((string) $selectedParent === (string) $parentOption->id)>
                {{ $parentOption->t('title') }}
            </option>
        @endforeach
    </select>
    <div class="form-text">
        {{ $locked ? __('dashboard.parent_service_has_children') : __('dashboard.parent_service_hint') }}
    </div>
    @error('parent_id')
        <div class="text-danger p-2">{{ $message }}</div>
    @enderror
</div>
