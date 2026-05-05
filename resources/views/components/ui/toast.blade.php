@props([
    'message'       => null,        // string — mensagem principal (alternativa ao slot)
    'title'         => null,        // string — título opcional acima da mensagem
    'variant'       => null,        // null | 'primary' | 'success' | 'warning' | 'destructive' | 'info' | 'mono' | 'secondary'
    'appearance'    => null,        // null (solid) | 'outline' | 'light'
    'size'          => null,        // null | 'sm' | 'lg'
    'position'      => 'top-end',   // 'top-end' | 'top-center' | 'top-start' | 'bottom-end' | 'bottom-center' | 'bottom-start'
    'icon'          => null,        // string — nome do ícone lucide | false (oculta)
    'dismissible'   => true,        // bool — exibe botão X
    'duration'      => 4000,        // int — duração em ms (0 = permanente)
    'progress'      => false,       // bool — barra de progresso
    'pauseOnHover'  => true,        // bool — pausa no hover
    'important'     => false,       // bool — persiste mesmo ao mudar de página
    'action'        => null,        // array ['label' => '', 'href' => '#'] | null
    'cancel'        => null,        // array ['label' => '', 'href' => '#'] | null
    'id'            => null,        // string — gerado automaticamente se omitido
])

@php
    $id = $id ?? 'toast_' . uniqid();

    // Classes do toast
    $classes = 'kt-toast';
    if ($appearance) $classes .= ' kt-toast-' . $appearance;
    if ($variant)    $classes .= ' kt-toast-' . $variant;
    if ($size)       $classes .= ' kt-toast-' . $size;

    // Classes do container de posição
    $containerClasses = 'kt-toast-container kt-toast-' . $position;

    // Ícone padrão por variante
    $defaultIcons = [
        'success'     => 'circle-check',
        'destructive' => 'circle-x',
        'warning'     => 'triangle-alert',
        'info'        => 'info',
        'primary'     => 'bell',
        'mono'        => 'bell',
        'secondary'   => 'bell',
    ];

    // Resolve ícone
    $resolvedIcon = null;
    if ($icon !== false) {
        if ($icon) {
            $resolvedIcon = $icon;
        } elseif ($variant && isset($defaultIcons[$variant])) {
            $resolvedIcon = $defaultIcons[$variant];
        } else {
            $resolvedIcon = 'bell';
        }
    }

    $hasMessage = $message || $slot->isNotEmpty();
    $hasAction  = !empty($action);
    $hasCancel  = !empty($cancel);
    $hasFooter  = $hasAction || $hasCancel;
@endphp

{{--
    Componente Toast — wrapper estático (renderizado em Blade).
    Para uso programático via JS, utilize o helper global window.toast() ou KTToast.show().
    Este componente pode ser usado diretamente para renderizar toasts estáticos no HTML.
--}}
<div
    {{ $attributes->merge(['class' => $containerClasses]) }}
    role="region"
    aria-live="polite"
>
    <div
        id="{{ $id }}"
        class="{{ $classes }}"
        role="status"
        aria-atomic="true"
        data-kt-toast=""
        @if ($duration > 0) data-kt-toast-duration="{{ $duration }}" @endif
        @if (!$pauseOnHover) data-kt-toast-pause-on-hover="false" @endif
        @if ($important) data-kt-toast-important="true" @endif
    >
        {{-- Ícone --}}
        @if ($resolvedIcon !== null)
            <div class="kt-toast-icon">
                @svg('lucide-' . $resolvedIcon)
            </div>
        @endif

        {{-- Conteúdo --}}
        <div class="kt-toast-content">

            @if ($title)
                <div class="kt-toast-title">{{ $title }}</div>
            @endif

            @if ($hasMessage)
                <div class="kt-toast-description">
                    {{ $message ?? $slot }}
                </div>
            @endif

            @if ($hasFooter)
                <div class="kt-toast-actions">
                    @if ($hasAction)
                        <a
                            href="{{ $action['href'] ?? '#' }}"
                            class="kt-toast-action-btn"
                            data-kt-toast-action="true"
                        >{{ $action['label'] }}</a>
                    @endif
                    @if ($hasCancel)
                        <a
                            href="{{ $cancel['href'] ?? '#' }}"
                            class="kt-toast-cancel-btn"
                            data-kt-toast-cancel="true"
                        >{{ $cancel['label'] }}</a>
                    @endif
                </div>
            @endif

        </div>

        {{-- Botão fechar --}}
        @if ($dismissible)
            <button
                class="kt-toast-dismiss-btn"
                data-kt-toast-dismiss="true"
                aria-label="Fechar notificação"
            >
                @svg('lucide-x')
            </button>
        @endif

        {{-- Barra de progresso --}}
        @if ($progress && $duration > 0)
            <div class="kt-toast-progress" style="animation-duration: {{ $duration }}ms;"></div>
        @endif

    </div>
</div>
