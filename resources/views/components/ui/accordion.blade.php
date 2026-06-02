@props([
    'id'        => null,    // string — gerado automaticamente se omitido
    'expandAll' => false,   // bool — permite múltiplos itens abertos simultaneamente
    'outline'   => false,   // bool — adiciona bordas em cada item (kt-accordion-outline)
    'flushed'   => false,   // bool — remove bordas laterais, alinha ao container (kt-accordion-flushed)
    'separated' => false,   // bool — adiciona espaçamento entre os itens (kt-accordion-separated)
])

@php
    $id = $id ?? 'accordion_' . uniqid();

    $classes = 'kt-accordion';
    if ($outline)   $classes .= ' kt-accordion-outline';
    if ($flushed)   $classes .= ' kt-accordion-flushed';
    if ($separated) $classes .= ' kt-accordion-separated';

    // NOTE: {!! !!} é necessário pois o atributo condicional dentro de tags HTML
    // não é suportado pelo Blade/Livewire via @if/@endif
    $expandAllAttr = $expandAll ? 'data-kt-accordion-expand-all="true"' : '';
@endphp

<div
    id="{{ $id }}"
    data-kt-accordion="true"
    {!! $expandAllAttr !!}
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</div>
