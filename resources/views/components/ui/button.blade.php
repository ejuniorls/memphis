@props([
    'variant'    => null,     // null (primary) | 'secondary' | 'destructive' | 'mono' | 'outline' | 'ghost'
    'ghost'      => null,     // null | '' (sem cor) | 'primary' | 'destructive' — kt-btn-ghost kt-btn-{color}
    'size'       => null,     // null | 'xs' | 'sm' | 'lg'
    'iconOnly'   => false,    // bool — botão somente ícone (kt-btn-icon)
    'circle'     => false,    // bool — adiciona rounded-full
    'dim'        => false,    // bool — variante dim (usado em icon-only)
    'type'       => 'button', // 'button' | 'submit' | 'reset'
    'tag'        => 'button', // 'button' | 'a' — renderiza como <a> quando necessário
    'href'       => null,     // string — usado quando tag='a'
    'disabled'   => false,    // bool
    'icon'       => null,     // string — ícone lucide antes do texto
    'iconEnd'    => null,     // string — ícone lucide após o texto
])

@php
    $classes = 'kt-btn';

    if ($iconOnly)           $classes .= ' kt-btn-icon';
    if ($dim)                $classes .= ' kt-btn-dim';
    elseif ($ghost !== null) $classes .= ' kt-btn-ghost' . ($ghost ? ' kt-btn-' . $ghost : '');
    elseif ($variant)        $classes .= ' kt-btn-' . $variant;

    if ($size)               $classes .= ' kt-btn-' . $size;
    if ($circle)             $classes .= ' rounded-full';

    $iconSize = match($size) {
        'xs'    => 'size-3',
        'sm'    => 'size-3.5',
        'lg'    => 'size-5',
        default => 'size-4',
    };
@endphp

@if ($tag === 'a')
    <a
        href="{{ $href ?? '#' }}"
        {{ $attributes->merge(['class' => $classes]) }}
        @if($disabled)
            aria-disabled="true" tabindex="-1"
        @endif
    >
        @if ($icon)
            @svg('lucide-' . $icon, ['class' => $iconSize . ' shrink-0'])
        @endif
        {{ $slot }}
        @if ($iconEnd)
            @svg('lucide-' . $iconEnd, ['class' => $iconSize . ' shrink-0'])
        @endif
    </a>
@else
    <button
        type="{{ $type }}"
        {{ $attributes->merge(['class' => $classes]) }}
        @disabled($disabled)
    >
        @if ($icon)
            @svg('lucide-' . $icon, ['class' => $iconSize . ' shrink-0'])
        @endif
        {{ $slot }}
        @if ($iconEnd)
            @svg('lucide-' . $iconEnd, ['class' => $iconSize . ' shrink-0'])
        @endif
    </button>
@endif
