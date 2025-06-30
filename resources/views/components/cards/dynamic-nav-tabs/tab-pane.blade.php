<div class="tab-pane fade p-0 border-0 {{ $active ? 'show active' : '' }}" id="{{ $id }}" role="tabpanel"
    aria-labelledby="{{ $labelledby }}" tabindex="{{ $tabindex }}">
    <div class="mb-3">
        {{ $slot }}
    </div>
</div>
