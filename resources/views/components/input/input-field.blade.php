<div class="{{ $wrapperClass ?? 'col-md-6 mb-3' }}">
    @if ($label)
        <label class="form-label" for="{{ $id }}">{{ $label }}</label>
    @endif

    @if ($type === 'checkbox')
        <div class="form-check">
            <input type="checkbox" name="{{ $name }}" class="form-check-input {{ $class }}"
                id="{{ $id }}" {{ old($name, $value) ? 'checked' : '' }} {{ $required ? 'required' : '' }}>
            <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
        </div>
    @elseif ($type === 'select')
        <select name="{{ $name }}" class="form-select {{ $class }}" id="{{ $id }}"
            {{ $required ? 'required' : '' }}>
            <option value="" disabled {{ old($name, $value) ? '' : 'selected' }}>
                {{ __('dashboard.select option') }}
            </option>

            @foreach ($options as $optionLabel)
                @if (is_object($optionLabel))
                    <option value="{{ $optionLabel->id }}"
                        {{ old($name, $value) == $optionLabel->id ? 'selected' : '' }}>
                        {{ $optionLabel->$showName }}
                    </option>
                @else
                    <option value="{{ $optionLabel }}" {{ old($name, $value) == $optionLabel ? 'selected' : '' }}>
                        {{ $optionLabel }}
                    </option>
                @endif
            @endforeach
        </select>
    @else
        <input type="{{ $type }}" name="{{ $name }}" class="form-control {{ $class }}"
            id="{{ $id }}" placeholder="{{ $placeholder }}" value="{{ old($name, $value) }}"
            {{ $required ? 'required' : '' }} {{ $readonly ? 'readonly' : '' }} {{ $disabled ? 'disabled' : '' }}>

    @endif

    @error($name)
        <div class="text-danger p-2">{{ $message }}</div>
    @enderror

</div>
