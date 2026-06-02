@props([
    'id'        => null,        // string — gerado automaticamente se omitido
    'title'     => '',          // string — texto exibido no cabeçalho do item
    'open'      => false,       // bool — expande o item na carga inicial
    'disabled'  => false,       // bool — bloqueia interação com o item
    'indicator' => 'chevron',   // 'chevron' | 'plus-minus' — ícone do indicador de estado
    'icon'      => null,        // string — nome do ícone Lucide exibido antes do título (ex: 'shield')
])

@php
    $id        = $id ?? 'accordion_item_' . uniqid();
    $toggleId  = $id . '_toggle';
    $contentId = $id . '_content';

    $itemClasses = 'kt-accordion-item';
    if ($open)     $itemClasses .= ' active';
    if ($disabled) $itemClasses .= ' kt-accordion-item-disabled';

    /*
     * O KTAccordion detecta o estado inicial pelo par active (no item) + hidden (no content).
     * Itens fechados precisam de 'hidden' no content para que o primeiro clique abra
     * corretamente em vez de fechar.
     */
    $contentClasses = 'kt-accordion-content';
    if (!$open)    $contentClasses .= ' hidden';

    // NOTE: {!! !!} é necessário — @if dentro de atributos HTML não funciona com Blade/Livewire
    $disabledAttr = $disabled ? 'disabled' : '';
@endphp

<div
    id="{{ $id }}"
    data-kt-accordion-item="true"
    class="{{ $itemClasses }}"
>
    {{-- Toggle --}}
    <button
        id="{{ $toggleId }}"
        data-kt-accordion-toggle="true"
        aria-controls="{{ $contentId }}"
        aria-expanded="{{ $open ? 'true' : 'false' }}"
        class="kt-accordion-toggle"
        {!! $disabledAttr !!}
    >
        @if ($icon)
            @svg('lucide-' . $icon, ['class' => 'kt-accordion-icon size-4 shrink-0'])
        @endif

        <span class="kt-accordion-title">{{ $title }}</span>

        {{-- Indicador de estado aberto/fechado --}}
        <span aria-hidden="true" class="kt-accordion-indicator">
            @if ($indicator === 'plus-minus')
                @svg('lucide-plus',  ['class' => 'lucide kt-accordion-indicator-on'])
                @svg('lucide-minus', ['class' => 'lucide kt-accordion-indicator-off'])
            @else
                @svg('lucide-chevron-down', ['class' => 'lucide kt-accordion-indicator-on'])
                @svg('lucide-chevron-up',   ['class' => 'lucide kt-accordion-indicator-off'])
            @endif
        </span>
    </button>

    {{-- Conteúdo colapsável --}}
    <div id="{{ $contentId }}" class="{{ $contentClasses }}">
        <div class="kt-accordion-body pb-4 pt-0 text-sm text-secondary-foreground leading-relaxed">
            {{ $slot }}
        </div>
    </div>
</div>
