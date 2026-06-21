@props([])

<div data-kt-carousel-item="true" {{ $attributes->merge(['class' => 'bg-muted flex min-w-full shrink-0 items-center justify-center rounded-lg py-16 text-sm font-medium']) }}>
    {{ $slot }}
</div>
