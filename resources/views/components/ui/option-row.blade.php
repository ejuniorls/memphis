@props([
    'value',
    'wireModel',
    'current',
    'label',
    'hint'  => null,
    'icon'  => null,
])

@php
    $selected = (string) $current === (string) $value;
@endphp

<label class="flex items-center gap-3 p-3 rounded-lg cursor-pointer select-none transition-colors border
    {{ $selected
        ? 'border-primary bg-primary/5'
        : 'border-input bg-background hover:border-primary/40 hover:bg-muted/50'
    }}">

    <input type="radio" class="sr-only" wire:model.live="{{ $wireModel }}" value="{{ $value }}" />

    @if ($icon)
        <div class="size-7 rounded-md bg-muted flex items-center justify-center shrink-0">
            @svg($icon, ['class' => 'size-3.5 ' . ($selected ? 'text-primary' : 'text-muted-foreground')])
        </div>
    @endif

    <div class="flex flex-col gap-0.5 flex-1">
        <span class="text-sm font-medium text-foreground">{{ $label }}</span>
        @if ($hint)
            <span class="text-xs text-secondary-foreground">{{ $hint }}</span>
        @endif
    </div>

    @if ($selected)
        <span class="size-4 rounded-full bg-primary flex items-center justify-center shrink-0">
            @svg('lucide-check', ['class' => 'size-2.5 text-primary-foreground'])
        </span>
    @endif
</label>
