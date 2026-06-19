@props([
    'id' => null,  // string — id do elemento raiz (útil para uso programático)
])

@php
    $rootId = $id ?? 'stepper_' . uniqid();
@endphp

<div id="{{ $rootId }}" data-kt-stepper="true" {{ $attributes }}>
    {{ $slot }}
</div>
