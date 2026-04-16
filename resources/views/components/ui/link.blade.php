@props([
    'href'       => '#',        // string
    'underline'  => false,      // bool — sublinhado no hover
    'underlined' => false,      // bool — sempre sublinhado
    'dashed'     => false,      // bool — sublinhado tracejado (requer underlined)
    'inverse'    => false,      // bool — versão clara para fundos escuros
    'mono'       => false,      // bool — cor mono
    'disabled'   => false,      // bool
    'size'       => null,       // null | 'sm' | 'lg'
    'icon'       => null,       // string — ícone lucide antes do texto
    'iconEnd'    => null,       // string — ícone lucide após o texto
])

@php
    $classes = 'kt-link';
    if ($underline)  $classes .= ' kt-link-underline';
    if ($underlined) $classes .= ' kt-link-underlined';
    if ($dashed)     $classes .= ' kt-link-dashed';
    if ($inverse)    $classes .= ' kt-link-inverse';
    if ($mono)       $classes .= ' kt-link-mono';
    if ($disabled)   $classes .= ' kt-link-disabled';
    if ($size)       $classes .= ' kt-link-' . $size;
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    @if ($icon)
        @svg('lucide-' . $icon)
    @endif
    {{ $slot }}
    @if ($iconEnd)
        @svg('lucide-' . $iconEnd)
    @endif
</a>
