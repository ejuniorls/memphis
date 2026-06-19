@props([
    'id'     => null,   // string — id do painel (deve bater com o target do stepper-item)
    'active' => false,  // bool — visível inicialmente (sem class 'hidden')
])

<div id="{{ $id }}" class="{{ $active ? '' : 'hidden' }}" {{ $attributes }}>
    {{ $slot }}
</div>
