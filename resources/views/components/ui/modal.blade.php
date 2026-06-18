@props([
    'id'              => null,          // string — id do modal (obrigatório para data-kt-modal-toggle)
    'title'           => null,          // string — título do header
    'size'            => null,          // null | 'sm' | 'lg' | 'xl' | 'full' — largura predefinida
    'width'           => null,          // string — classe Tailwind de largura arbitrária (ex: 'max-w-[300px]')
    'center'          => false,         // bool — centraliza verticalmente (kt-modal-center)
    'fit'             => false,         // bool — modal sem padding lateral (kt-modal-fit)
    'overlay'         => false,         // bool — modal fullscreen (kt-modal-content h-full)
    'scrollable'      => false,         // bool — body com scroll interno (kt-scrollable-y)
    'maxBodyHeight'   => null,          // string — max-height do body quando scrollable (ex: '200px')
    'backdrop'        => true,          // bool — exibe backdrop (false = sem fundo escuro)
    'backdropStatic'  => false,         // bool — backdrop estático (não fecha ao clicar fora)
    'persistent'      => false,         // bool — não fecha ao clicar fora
    'disableScroll'   => true,          // bool — bloqueia scroll da página ao abrir
    'dismissible'     => true,          // bool — exibe botão X no header
    'top'             => null,          // string — posição top do content (ex: '10%') — ignorado se center=true
    'footerAlign'     => 'end',         // 'start' | 'end' | 'between' — alinhamento do footer
    'footerClass'     => null,          // string — classes extras no footer (ex: 'gap-2.5')
])

@php
    $id = $id ?? 'modal_' . uniqid();

    // Largura do .kt-modal-content — width sobrescreve size
    $sizeClasses = $width ?? match ($size) {
        'sm'   => 'max-w-sm',
        'lg'   => 'max-w-2xl',
        'xl'   => 'max-w-4xl',
        'full' => 'max-w-full mx-4',
        default => 'max-w-[400px]',
    };

    // Overlay = ocupa toda a altura disponível
    if ($overlay) $sizeClasses .= ' h-full';

    // Classes do wrapper .kt-modal
    $modalClasses = 'kt-modal';
    if ($center) $modalClasses .= ' kt-modal-center';
    if ($fit)    $modalClasses .= ' kt-modal-fit';

    // Posicionamento top (só aplicado quando não é center nem overlay)
    $topStyle = (!$center && !$overlay && $top) ? "top: {$top};" : '';

    // Alinhamento do footer
    $footerJustify = match ($footerAlign) {
        'start'   => 'justify-start',
        'between' => 'justify-between',
        default   => 'justify-end',
    };

    // Slots presentes
    $hasHeader = $title || $dismissible || (isset($header) && trim((string) $header) !== '');
    $hasFooter = isset($footer) && trim((string) $footer) !== '';
@endphp

<div
    class="{{ $modalClasses }}"
    data-kt-modal="true"
    id="{{ $id }}"
    @if (!$backdrop)      data-kt-modal-backdrop="false" @endif
    @if ($backdropStatic) data-kt-modal-backdrop-static="true" @endif
    @if ($persistent)     data-kt-modal-persistent="true" @endif
    @if (!$disableScroll) data-kt-modal-disable-scroll="false" @endif
    {{ $attributes->except(['class']) }}
>
    <div
        class="kt-modal-content {{ $sizeClasses }}"
        @if ($topStyle) style="{{ $topStyle }}" @endif
    >

        {{-- Header --}}
        @if ($hasHeader)
            <div class="kt-modal-header">

                @if (isset($header) && trim((string) $header) !== '')
                    {{ $header }}
                @elseif ($title)
                    <h3 class="kt-modal-title">{{ $title }}</h3>
                @endif

                @if ($dismissible)
                    <button
                        type="button"
                        class="kt-modal-close"
                        aria-label="Fechar modal"
                        data-kt-modal-dismiss="#{{ $id }}"
                    >
                        @svg('lucide-x')
                    </button>
                @endif

            </div>
        @endif

        {{-- Body --}}
        <div
            class="kt-modal-body {{ $scrollable ? 'kt-scrollable-y' : '' }}"
            @if ($scrollable && $maxBodyHeight) style="max-height: {{ $maxBodyHeight }};" @endif
        >
            {{ $slot }}
        </div>

        {{-- Footer --}}
        @if ($hasFooter)
            <div class="kt-modal-footer {{ $footerJustify }}{{ $footerClass ? ' ' . $footerClass : '' }}">
                {{ $footer }}
            </div>
        @endif

    </div>
</div>
