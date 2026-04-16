@props([
    'variant'   => null,      // null | 'primary' | 'secondary' | 'destructive' | 'warning' | 'success' | 'info' | 'mono'
    'style'     => null,      // null (solid) | 'outline' | 'light' | 'ghost'
    'size'      => null,      // null | 'xs' | 'sm' | 'lg'
    'circle'    => false,     // bool — adiciona rounded-full
    'stroke'    => false,     // bool — variante stroke do default (kt-badge-stroke)
    'dot'       => false,     // bool — adiciona kt-badge-dot antes do texto
    'icon'      => null,      // string — nome do ícone lucide antes do texto
    'iconEnd'   => null,      // string — nome do ícone lucide após o texto
    'removable' => false,     // bool — exibe botão X (kt-badge-btn)
    'tag'       => 'span',    // 'span' | 'a' | 'button'
    'href'      => null,      // string — usado quando tag='a'
])

@php
    $classes = 'kt-badge';

    if ($stroke)          $classes .= ' kt-badge-stroke';
    if ($style)           $classes .= ' kt-badge-' . $style;
    if ($variant)         $classes .= ' kt-badge-' . $variant;
    if ($size)            $classes .= ' kt-badge-' . $size;
    if ($circle)          $classes .= ' rounded-full';
@endphp

@if ($tag === 'a')
    <a href="{{ $href ?? '#' }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($dot)
            <span class="kt-badge-dot"></span>
        @endif
        @if ($icon)
            @svg('lucide-' . $icon)
        @endif
        {{ $slot }}
        @if ($iconEnd)
            @svg('lucide-' . $iconEnd)
        @endif
        @if ($removable)
            <button class="kt-badge-btn" aria-label="Remover">
                @svg('lucide-x')
            </button>
        @endif
    </a>
@elseif ($tag === 'button')
    <button {{ $attributes->merge(['class' => $classes]) }}>
        @if ($dot)
            <span class="kt-badge-dot"></span>
        @endif
        @if ($icon)
            @svg('lucide-' . $icon)
        @endif
        {{ $slot }}
        @if ($iconEnd)
            @svg('lucide-' . $iconEnd)
        @endif
        @if ($removable)
            <button class="kt-badge-btn" aria-label="Remover">
                @svg('lucide-x')
            </button>
        @endif
    </button>
@else
    <span {{ $attributes->merge(['class' => $classes]) }}>
        @if ($dot)
            <span class="kt-badge-dot"></span>
        @endif
        @if ($icon)
            @svg('lucide-' . $icon)
        @endif
        {{ $slot }}
        @if ($iconEnd)
            @svg('lucide-' . $iconEnd)
        @endif
        @if ($removable)
            <button class="kt-badge-btn" aria-label="Remover">
                @svg('lucide-x')
            </button>
        @endif
    </span>
@endif
