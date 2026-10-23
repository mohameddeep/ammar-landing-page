{{-- One draggable service row. $service, $position, $isChild --}}
<div class="svc-row {{ $isChild ? 'svc-row--child' : '' }}" id="row-{{ $service->id }}" data-id="{{ $service->id }}" draggable="true">
    <span class="svc-handle" title="@lang('dashboard.drag_to_reorder')" aria-hidden="true"><i class="ri-drag-move-2-line"></i></span>
    <span class="svc-pos" data-position>{{ $position }}</span>

    <img src="{{ \App\Support\WebsiteImage::url($service->image, 'service', $service->title_en ?: $service->title_ar) }}"
        alt="" class="svc-thumb" loading="lazy">

    <div class="svc-info">
        <div class="svc-title">{{ $service->title_ar }}</div>
        @if ($service->title_en)
            <div class="svc-sub" dir="ltr">{{ $service->title_en }}</div>
        @endif
    </div>

    <div class="svc-meta">
        @if (! $isChild)
            <span class="badge {{ $service->children->isNotEmpty() ? 'bg-primary-transparent' : 'bg-light text-muted' }}">
                {{ trans_choice('dashboard.sub_services_count', $service->children->count(), ['count' => $service->children->count()]) }}
            </span>
        @endif
        <span class="badge {{ $service->is_active ? 'bg-success-transparent' : 'bg-danger-transparent' }}" data-status-badge>
            {{ $service->is_active ? __('dashboard.status_visible') : __('dashboard.status_hidden') }}
        </span>
    </div>

    <div class="svc-actions">
        <div class="custom-toggle-switch d-flex align-items-center" title="@lang('dashboard.Activate')">
            <input id="toggle_{{ $service->id }}" type="checkbox" @checked($service->is_active)
                onclick="toggleserviceStatus({{ $service->id }})">
            <label for="toggle_{{ $service->id }}" class="label-secondary"></label>
        </div>
        <button type="button" class="btn btn-icon btn-sm btn-light" data-move="up" title="@lang('dashboard.move_up')"><i class="ri-arrow-up-line"></i></button>
        <button type="button" class="btn btn-icon btn-sm btn-light" data-move="down" title="@lang('dashboard.move_down')"><i class="ri-arrow-down-line"></i></button>
        @if (! $isChild)
            <a href="{{ route('services.create', ['parent' => $service->id]) }}" class="btn btn-sm btn-outline-primary" title="@lang('dashboard.add_sub_service')">
                <i class="ri-add-line"></i> <span class="d-none d-xl-inline">@lang('dashboard.add_sub_service')</span>
            </a>
        @endif
        <x-buttons.edit-button :route="route('services.edit', $service->id)" />
        <x-buttons.delete-button :route="route('services.destroy', $service->id)" :itemId="$service->id" />
    </div>
</div>
