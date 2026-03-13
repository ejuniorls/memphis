@props([
    'variant' => null,
    'size' => null,
    'icon' => null,
    'href' => null,
    'circle' => false,
    'iconOnly' => false
])

@php
    $tag = $href ? 'a' : 'button';

    $variants = [
        'primary' => 'kt-btn-primary',
        'secondary' => 'kt-btn-secondary',
        'destructive' => 'kt-btn-destructive',
        'mono' => 'kt-btn-mono',
        'outline' => 'kt-btn-outline',
        'ghost' => 'kt-btn-ghost',
        'dim' => 'kt-btn-dim',
    ];

    $sizes = [
        'sm' => 'kt-btn-sm',
        'lg' => 'kt-btn-lg'
    ];
@endphp

<{{ $tag }}
{{ $attributes->merge([
    'href' => $href,
    'class' => \Illuminate\Support\Arr::toCssClasses([
        'kt-btn',
        $variants[$variant] ?? null,
        $sizes[$size] ?? null,
        'kt-btn-icon' => $iconOnly,
        'rounded-full' => $circle,
    ])
]) }}
>

@if($icon)
    <i class="{{ $icon }}"></i>
@endif

@if(!$iconOnly)
    {{ $slot }}
@endif

</{{ $tag }}>
