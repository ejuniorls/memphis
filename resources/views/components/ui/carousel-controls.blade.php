@props([
    'size' => 'sm', // 'sm' | null
])

<div {{ $attributes->merge(['class' => 'flex justify-center gap-2']) }}>
    <button type="button" class="kt-btn kt-btn-outline {{ $size ? 'kt-btn-' . $size : '' }}" data-kt-carousel-prev="true">
        Previous
    </button>
    <button type="button" class="kt-btn kt-btn-outline {{ $size ? 'kt-btn-' . $size : '' }}" data-kt-carousel-next="true">
        Next
    </button>
</div>
