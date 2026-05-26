@props([
    'id'         => null,           // string — gerado automaticamente se omitido
    'expandAll'  => false,          // bool — permite múltiplos itens abertos simultaneamente
    'bordered'   => false,          // bool — estilo com bordas (kt-accordion-bordered)
    'flushed'    => false,          // bool — estilo sem bordas laterais/externas (kt-accordion-flushed)
    'separated'  => false,          // bool — itens com espaçamento entre si (kt-accordion-separated)
])

@php
    $id = $id ?? 'accordion_' . uniqid();

    $classes = 'kt-accordion';
    if ($bordered)  $classes .= ' kt-accordion-bordered';
    if ($flushed)   $classes .= ' kt-accordion-flushed';
    if ($separated) $classes .= ' kt-accordion-separated';

    $extraAttrs = $expandAll ? 'data-kt-accordion-expand-all="true"' : '';
@endphp

<div
    id="{{ $id }}"
    data-kt-accordion="true"
    {!! $extraAttrs !!}
    {{ $attributes->merge(['class' => $classes]) }}
>
    {{ $slot }}
</div>
