@props([
    'icon',
    'bg'     => 'bg-primary/10',
    'color'  => 'text-primary',
    'size'   => 'md',   // sm | md | lg | xl
    'radius' => 'lg',   // sm | md | lg | full
])

@php
    $sizeMap = [
        'sm' => ['box' => 'size-8',  'icon' => 'size-3.5'],
        'md' => ['box' => 'size-9',  'icon' => 'size-4'],
        'lg' => ['box' => 'size-10', 'icon' => 'size-5'],
        'xl' => ['box' => 'size-12', 'icon' => 'size-6'],
    ];

    $radiusMap = [
        'sm'   => 'rounded',
        'md'   => 'rounded-md',
        'lg'   => 'rounded-lg',
        'full' => 'rounded-full',
    ];

    $boxSize  = $sizeMap[$size]['box']   ?? $sizeMap['md']['box'];
    $iconSize = $sizeMap[$size]['icon']  ?? $sizeMap['md']['icon'];
    $rounded  = $radiusMap[$radius]      ?? $radiusMap['lg'];
@endphp

<div {{ $attributes->class([
    'flex items-center justify-center shrink-0',
    $boxSize,
    $rounded,
    $bg,
    $color,
]) }}>
    <x-dynamic-component :component="'lucide-' . $icon" :class="$iconSize"/>
</div>
