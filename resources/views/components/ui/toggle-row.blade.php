@props([
    'wireModel',        // string — nome da propriedade Livewire (obrigatório)
    'label',            // string — texto principal (obrigatório)
    'hint'    => null,  // string — texto secundário
    'icon'    => null,  // string — ícone lucide
    'iconBg'  => 'bg-primary/10',    // string — classe de background do ícone
    'iconColor' => 'text-primary',   // string — classe de cor do ícone
    'disabled' => false,
])
@php
    $iconBgClass    = $iconBg;
    $iconColorClass = $iconColor;
@endphp

<div class="flex items-center justify-between gap-4 py-4 px-1">
    <div class="flex items-center gap-3">

        @if ($icon)
            <div class="size-9 rounded-full {{ $iconBgClass }} flex items-center justify-center shrink-0">
                @svg($icon, ['class' => 'size-4 ' . $iconColorClass])
            </div>
        @endif

        <div class="flex flex-col gap-0.5">
            <span class="text-sm font-medium text-foreground">{{ $label }}</span>
            @if ($hint)
                <span class="text-xs text-secondary-foreground">{{ $hint }}</span>
            @endif
        </div>

    </div>

    <input
        type="checkbox"
        class="kt-switch shrink-0"
        wire:model="{{ $wireModel }}"
        @disabled($disabled)
    />
</div>
