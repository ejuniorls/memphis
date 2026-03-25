@props([
    'variant'    => null,
    'ghost'      => null,
    'size'       => null,
    'iconOnly'   => false,
    'circle'     => false,
    'dim'        => false,
    'type'       => 'button',
    'tag'        => 'button',
    'href'       => null,
    'disabled'   => false,
    'icon'       => null,           // string — ícone lucide antes do texto
    'iconEnd'    => null,           // string — ícone lucide após o texto
    'kiIcon'     => null,           // string — ícone ki-* (ex: 'chart-line-star')
    'kiStyle'    => 'filled',       // 'filled' | 'outline' | 'duotone'
    'kiSize'     => 'text-lg',      // string — classe de tamanho do ícone ki
    'tooltip'    => null,           // string — texto do tooltip
    'tooltipPlacement' => 'right',  // string — posição do tooltip
    'route'      => null,           // string — nome da rota para active state
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

    $isActive = $route && request()->routeIs($route);
@endphp

@if ($tag === 'a')

    <a href="{{ $href ?? ($route ? route($route) : '#') }}"
       {{ $attributes->merge(['class' => $classes . ($isActive ? ' active' : '')]) }}
       @if ($disabled) aria-disabled="true" tabindex="-1" @endif
       @if ($tooltip) data-kt-tooltip="" data-kt-tooltip-placement="{{ $tooltipPlacement }}" @endif
    >
        @if ($kiIcon)
            <span class="kt-menu-icon">
                <i class="ki-{{ $kiStyle }} ki-{{ $kiIcon }} {{ $kiSize }}"></i>
            </span>
        @endif
        @if ($icon)
            @svg('lucide-' . $icon, ['class' => $iconSize . ' shrink-0'])
        @endif
        {{ $slot }}
        @if ($iconEnd)
            @svg('lucide-' . $iconEnd, ['class' => $iconSize . ' shrink-0'])
        @endif
        @if ($tooltip)
            <span class="kt-tooltip" data-kt-tooltip-content="true">{{ $tooltip }}</span>
        @endif
    </a>
@else
    <button
        type="{{ $type }}"
        {{ $attributes->merge(['class' => $classes]) }}
        @disabled($disabled)
        @if ($tooltip) data-kt-tooltip="" data-kt-tooltip-placement="{{ $tooltipPlacement }}" @endif
    >
        @if ($kiIcon)
            <span class="kt-menu-icon">
                <i class="ki-{{ $kiStyle }} ki-{{ $kiIcon }} {{ $kiSize }}"></i>
            </span>
        @endif
        @if ($icon)
            @svg('lucide-' . $icon, ['class' => $iconSize . ' shrink-0'])
        @endif
        {{ $slot }}
        @if ($iconEnd)
            @svg('lucide-' . $iconEnd, ['class' => $iconSize . ' shrink-0'])
        @endif
        @if ($tooltip)
            <span class="kt-tooltip" data-kt-tooltip-content="true">{{ $tooltip }}</span>
        @endif
    </button>
@endif
