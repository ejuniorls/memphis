@props([
    'size'         => null,
    'invalid'      => false,
    'id'           => null,
    'name'         => null,
    'placeholder'  => null,
    'autocomplete' => null,
    'required'     => false,
    'disabled'     => false,
])

@php
    $wrapperClass = 'kt-input flex items-center';
    if ($size)    $wrapperClass .= ' kt-input-' . $size;
    if ($invalid) $wrapperClass .= ' border-red-500';
@endphp

<div class="{{ $wrapperClass }}" data-kt-toggle-password="true">
    <input
        type="password"
        class="w-full bg-transparent border-none focus:ring-0"
        @if ($id)           id="{{ $id }}"                   @endif
        @if ($name)         name="{{ $name }}"               @endif
        @if ($placeholder)  placeholder="{{ $placeholder }}"  @endif
        @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
        @if ($required)     required                          @endif
        @if ($disabled)     disabled                          @endif
        @if ($invalid)      aria-invalid="true"               @endif
    />
    <button
        class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost bg-transparent! -me-1.5"
        data-kt-toggle-password-trigger="true"
        type="button"
        aria-label="{{ __('Toggle password visibility') }}"
    >
        <span class="kt-toggle-password-active:hidden">
            <i class="ki-filled ki-eye text-muted-foreground"></i>
        </span>
        <span class="hidden kt-toggle-password-active:block">
            <i class="ki-filled ki-eye-slash text-muted-foreground"></i>
        </span>
    </button>
</div>
