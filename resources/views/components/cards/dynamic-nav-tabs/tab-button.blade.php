<button class="nav-link {{ $active ? 'active' : '' }} {{ $class }}" id="{{ $id }}" data-bs-toggle="tab"
    data-bs-target="#{{ $target }}" type="button" role="tab" aria-controls="{{ $target }}"
    aria-selected="{{ $active ? 'true' : 'false' }}">
    @if ($iconClass)
        <i class="{{ $iconClass }} me-1 align-middle d-inline-block"></i>
    @endif
    {{ $label }}
</button>
