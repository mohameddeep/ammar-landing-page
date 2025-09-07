@php
    $activeState = $isActive ? 1 : 0;
    $toggleClass = $isActive ? $onClass : $offClass;
    $toggleText = $isActive ? $onText : $offText;
@endphp

@if ($type === 'button')
    <button class="btn w-100 toggle-btn {{ $toggleClass }}" data-id="{{ $id }}"
        data-active="{{ $activeState }}" data-url="{{ $url }}">
        {{ $toggleText }}
    </button>
@else
    <span class="me-2">
        <i class="fs-15 toggle-btn {{ $toggleClass }}" data-id="{{ $id }}" data-active="{{ $activeState }}"
            data-url="{{ $url }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $toggleText }}"
            role="button" style="cursor: pointer;">
        </i>
    </span>
@endif
