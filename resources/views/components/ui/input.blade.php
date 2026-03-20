@props([
    'type'     => 'text',    // 'text' | 'email' | 'password' | 'file' | 'number' | etc.
    'size'     => null,      // null | 'sm' | 'lg'
    'icon'     => null,      // string — ícone lucide antes do input
    'iconEnd'  => null,      // string — ícone lucide após o input
    'invalid'  => false,     // bool — estado de erro (aria-invalid)
    'wrapper'  => false,     // bool — força o wrapper div.kt-input com ícones
])

@php
    $classes = 'kt-input';
    if ($size) $classes .= ' kt-input-' . $size;

    $needsWrapper = $wrapper || $icon || $iconEnd;
@endphp

@if ($needsWrapper)
    <div class="kt-input {{ $size ? 'kt-input-' . $size : '' }} gap-1 {{ $attributes->get('class') }}">
        @if ($icon)
            @svg('lucide-' . $icon)
        @endif

        {{ $slot }}  {{-- ← permite conteúdo livre quando wrapper=true --}}

        @if (!$slot->isNotEmpty())
            <input
                type="{{ $type }}"
                class="kt-input"
                @if ($invalid) aria-invalid="true" @endif
                {{ $attributes->except('class') }}
            />
        @endif

        @if ($iconEnd)
            @svg('lucide-' . $iconEnd)
        @endif
    </div>
@else
    <input
        type="{{ $type }}"
        {{ $attributes->merge(['class' => $classes]) }}
        @if ($invalid) aria-invalid="true" @endif
    />
@endif
