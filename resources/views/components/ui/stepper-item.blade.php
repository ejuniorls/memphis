@props([
    'target'   => null,   // string — seletor do painel de conteúdo, ex: '#step_1'
    'active'   => false,  // bool — step ativo inicialmente
    'title'    => '',     // string — título do step
    'subtitle' => null,   // string — descrição abaixo do título
    'number'   => null,   // string|int — número exibido no círculo (calculado automaticamente se null)
    'icon'     => null,   // string — ícone lucide exibido quando active/completed (substitui o número)
    'clickable'=> false,  // bool — torna o círculo um botão clicável (para uso programático)
    'goTo'     => null,   // int — índice destino quando clickable=true
    'align'    => 'center', // 'center' | 'start' — alinhamento vertical (usar 'start' no vertical)
])

@php
    $itemClass  = 'flex gap-2.5 items-' . $align . ($active ? ' active' : '');
    $circleBase = 'shrink-0 rounded-full size-8 flex items-center justify-center text-sm font-semibold bg-muted text-muted-foreground kt-stepper-item-active:bg-primary kt-stepper-item-active:text-primary-foreground kt-stepper-item-completed:bg-green-500 kt-stepper-item-completed:text-white';
@endphp

<div
    @if ($target) data-kt-stepper-item="{{ $target }}" @endif
class="{{ $itemClass }}"
>
    {{-- Círculo — clicável ou estático --}}
    @if ($clickable)
        <button
            type="button"
            class="{{ $circleBase }} cursor-pointer"
            @if ($goTo) data-stepper-go="{{ $goTo }}" @endif
        >
            <span data-kt-stepper-number="true" class="kt-stepper-item-completed:hidden">{{ $number }}</span>
            @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-completed:inline', 'aria-hidden' => 'true'])
        </button>
    @elseif ($icon)
        <div class="{{ $circleBase }}">
            @svg('lucide-' . $icon, ['class' => 'size-4 hidden kt-stepper-item-active:inline kt-stepper-item-completed:inline', 'aria-hidden' => 'true'])
            <span data-kt-stepper-number="true" class="text-sm font-semibold kt-stepper-item-active:hidden kt-stepper-item-completed:hidden">{{ $number }}</span>
        </div>
    @else
        <div class="{{ $circleBase }}">
            <span data-kt-stepper-number="true" class="kt-stepper-item-completed:hidden">{{ $number }}</span>
            @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-completed:inline', 'aria-hidden' => 'true'])
        </div>
    @endif

    {{-- Texto --}}
    <div class="flex flex-col gap-0.5">
        <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">{{ $title }}</h4>
        @if ($subtitle)
            <span class="text-sm text-muted-foreground kt-stepper-item-completed:opacity-70">{{ $subtitle }}</span>
        @endif
    </div>
</div>
