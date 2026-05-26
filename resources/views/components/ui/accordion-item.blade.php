@props([
    'id'        => null,        // string - gerado automaticamente se omitido
    'title'     => '',          // string - título do item
    'open'      => false,       // bool - item aberto por padrão
    'disabled'  => false,       // bool - item desabilitado
    'indicator' => 'chevron',   // 'chevron' | 'plus-minus'
    'icon'      => null,        // string - ícone lucide no título (ex: 'info')
])

@php
    $id        = $id ?? 'accordion_item_' . uniqid();
    $toggleId  = $id . '_toggle';
    $contentId = $id . '_content';

    $itemClasses    = 'kt-accordion-item';
    if ($open)      $itemClasses .= ' active';
    if ($disabled)  $itemClasses .= ' kt-accordion-item-disabled';

    // Conteúdo fechado por padrão; classe 'hidden' é removida pelo KTAccordion ao abrir
    $contentClasses = 'kt-accordion-content';
    if (!$open)     $contentClasses .= ' hidden';

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

        <span aria-hidden="true" class="kt-accordion-indicator">
            @if ($indicator === 'plus-minus')
                @svg('lucide-plus', ['class' => 'lucide kt-accordion-indicator-on'])
                @svg('lucide-minus', ['class' => 'lucide kt-accordion-indicator-off'])
            @else
                @svg('lucide-chevron-down', ['class' => 'lucide kt-accordion-indicator-on'])
                @svg('lucide-chevron-up', ['class' => 'lucide kt-accordion-indicator-off'])
            @endif
        </span>
    </button>

    {{-- Content --}}
    <div id="{{ $contentId }}" class="{{ $contentClasses }}">
        <div class="kt-accordion-body pb-4 pt-0 text-sm text-secondary-foreground leading-relaxed">
            {{ $slot }}
        </div>
    </div>
</div>
