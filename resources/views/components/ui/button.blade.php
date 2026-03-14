@props([
    'variant'  => null,       // null (primary) | 'secondary' | 'destructive' | 'mono' | 'outline' | 'ghost'
    'ghost'    => null,       // null | 'primary' | 'destructive' — ghost com cor (kt-btn-ghost kt-btn-{color})
    'size'     => null,       // null | 'sm' | 'lg'
    'iconOnly' => false,      // bool — botão somente ícone (kt-btn-icon)
    'circle'   => false,      // bool — adiciona rounded-full
    'dim'      => false,      // bool — variante dim (usado em icon-only)
    'type'     => 'button',   // 'button' | 'submit' | 'reset'
    'tag'      => 'button',   // 'button' | 'a' — renderiza como <a> quando necessário
    'href'     => null,       // string — usado quando tag='a'
    'disabled' => false,      // bool
    'icon'     => null,       // string — nome do ícone lucide (ex: 'search', 'plus') para ícone antes do texto
    'iconEnd'  => null,       // string — ícone lucide após o texto
])

@php
    $classes = 'kt-btn';

    if ($iconOnly)              $classes .= ' kt-btn-icon';
    if ($dim)                   $classes .= ' kt-btn-dim';
    elseif ($ghost !== null)    $classes .= ' kt-btn-ghost kt-btn-' . $ghost;
    elseif ($variant)           $classes .= ' kt-btn-' . $variant;

    if ($size)                  $classes .= ' kt-btn-' . $size;
    if ($circle)                $classes .= ' rounded-full';
@endphp

@if ($tag === 'a')
    <a
        href="{{ $href ?? '#' }}"
        {{ $attributes->merge(['class' => $classes]) }}
        @if($disabled) aria-disabled="true" tabindex="-1" @endif
    >
        @if ($icon)
            @svg('lucide-' . $icon)
        @endif
        {{ $slot }}
        @if ($iconEnd)
            @svg('lucide-' . $iconEnd)
        @endif
    </a>
@else
    <button
        type="{{ $type }}"
        {{ $attributes->merge(['class' => $classes]) }}
        @disabled($disabled)
    >
        @if ($icon)
            @svg('lucide-' . $icon)
        @endif
        {{ $slot }}
        @if ($iconEnd)
            @svg('lucide-' . $iconEnd)
        @endif
    </button>
@endif
