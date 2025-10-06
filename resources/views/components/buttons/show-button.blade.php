<a href="{{ $route }}" class="{{ $class }}" data-bs-toggle="tooltip"
    data-bs-custom-class="{{ $tooltipColor }}" data-bs-placement="top" title="{{ $tooltipTitle }}">
    @if (!empty($label))
        {{ $label }}
    @else
        <i class="{{ $icon }}"></i>
    @endif
</a>
