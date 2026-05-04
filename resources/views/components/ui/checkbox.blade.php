@props([
    'label'    => null,
    'name'     => null,
    'value'    => '1',
    'checked'  => false,
    'required' => false,
    'disabled' => false,
    'size'     => 'sm',
])

<label class="kt-label">
    <input
        type="checkbox"
        class="kt-checkbox kt-checkbox-{{ $size }}"
        @if ($name)     name="{{ $name }}"   @endif
        @if ($value)    value="{{ $value }}" @endif
        @if ($checked)  checked              @endif
        @if ($required) required             @endif
        @if ($disabled) disabled             @endif
    />
    <span class="kt-checkbox-label">
        @if ($slot->isNotEmpty())
            {{ $slot }}
        @else
            {{ $label }}
        @endif
    </span>
</label>
