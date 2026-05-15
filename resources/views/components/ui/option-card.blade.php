@props([
    'value',
    'wireModel',
    'current',
    'label'   => null,
    'hint'    => null,
    'icon'    => null,
    'size'    => 'md',
])

@php
    $selected = (string) $current === (string) $value;
    $padding  = $size === 'sm' ? 'p-3' : 'p-4';
    $gap      = $size === 'sm' ? 'gap-2' : 'gap-3';
    $iconSize = $size === 'sm' ? 'size-4' : 'size-5';
@endphp

<label class="flex flex-col items-center {{ $padding }} {{ $gap }} rounded-xl cursor-pointer select-none transition-colors border
    {{ $selected
        ? 'border-primary bg-primary/5'
        : 'border-input bg-background hover:border-primary/40 hover:bg-muted/50'
    }}">

    <input type="radio" class="sr-only" wire:model.live="{{ $wireModel }}" value="{{ $value }}" />

    @if ($slot->isNotEmpty())
        {{ $slot }}
    @endif

    @if ($icon)
        @svg($icon, ['class' => $iconSize . ' ' . ($selected ? 'text-primary' : 'text-muted-foreground')])
    @endif

    @if ($label || $hint)
        <div class="flex items-center justify-between gap-2 w-full mt-auto">
            <div class="flex flex-col gap-0.5">
                @if ($label)
                    <span class="text-sm font-semibold text-foreground leading-tight">{{ $label }}</span>
                @endif
                @if ($hint)
                    <span class="text-xs text-secondary-foreground leading-tight">{{ $hint }}</span>
                @endif
            </div>
            @if ($selected)
                <span class="size-5 rounded-full bg-primary flex items-center justify-center shrink-0">
                    @svg('lucide-check', ['class' => 'size-3 text-primary-foreground'])
                </span>
            @endif
        </div>
    @endif
</label>
