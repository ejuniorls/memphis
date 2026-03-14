@props([
    'variant'     => null,        // null | 'primary' | 'success' | 'info' | 'destructive' | 'warning' | 'mono'
    'style'       => null,        // null | 'mono' | 'outline' | 'light'
    'size'        => null,        // null | 'sm' | 'lg'
    'title'       => null,        // string
    'description' => null,        // string
    'icon'        => null,        // string nome do ícone lucide (ex: 'info', 'triangle-alert') | false (oculta)
    'dismissible' => false,       // bool — mostra o botão de fechar (X)
    'id'          => null,        // string — gerado automaticamente se omitido
    'actionLabel' => null,        // string — atalho para uma única ação simples
    'actionHref'  => '#',         // string — href da ação simples
])

@php
    $id = $id ?? 'alert_' . uniqid();

    // Monta as classes do container
    $classes = 'kt-alert';
    if ($style)   $classes .= ' kt-alert-' . $style;
    if ($variant) $classes .= ' kt-alert-' . $variant;
    if ($size)    $classes .= ' kt-alert-' . $size;

    // Ícone padrão por variante
    $defaultIcons = [
        'success'     => 'circle-check',
        'destructive' => 'circle-x',
        'warning'     => 'triangle-alert',
        'info'        => 'info',
        'primary'     => 'info',
        'mono'        => 'info',
    ];

    // Resolve o nome do ícone lucide a renderizar
    $resolvedIcon = null;
    if ($icon !== false) {
        if ($icon) {
            $resolvedIcon = $icon;
        } elseif ($variant && isset($defaultIcons[$variant])) {
            $resolvedIcon = $defaultIcons[$variant];
        } else {
            $resolvedIcon = 'info';
        }
    }

    // Classe do link de ação varia conforme style/variant
    $actionLinkClass = match(true) {
        $style === 'light'                    => 'kt-link kt-link-xs kt-link-underlined text-mono',
        in_array($style, ['mono', 'outline']) => 'kt-link kt-link-xs kt-link-underlined text-mono-foreground',
        $variant !== null && $style === null  => 'kt-link kt-link-xs kt-link-underlined kt-link-inverse',
        default                               => 'kt-link kt-link-xs kt-link-underlined',
    };

    // Slots e ações
    $hasDescription = $description || $slot->isNotEmpty();
    $hasActionsSlot = isset($actions) && $actions->isNotEmpty();
    $hasActionLabel = !empty($actionLabel);
    $hasAnyAction   = $hasActionsSlot || $hasActionLabel;
    $hasToolbar     = $hasAnyAction || $dismissible;
@endphp

<div {{ $attributes->merge(['class' => $classes, 'id' => $id]) }}>

    {{-- Ícone --}}
    @if ($resolvedIcon !== null)
        <div class="kt-alert-icon">
            @svg('lucide-' . $resolvedIcon)
        </div>
    @endif

    {{-- Layout COM descrição → usa kt-alert-content --}}
    @if ($hasDescription)
        <div class="kt-alert-content">

            @if ($title)
                <h3 class="kt-alert-title">{{ $title }}</h3>
            @endif

            <p class="kt-alert-description">
                {{ $description ?? $slot }}
            </p>

            @if ($hasAnyAction)
                <div class="kt-alert-toolbar">
                    <div class="kt-alert-actions">
                        @if ($hasActionLabel)
                            <a href="{{ $actionHref }}" class="{{ $actionLinkClass }}">{{ $actionLabel }}</a>
                        @endif
                        {{ $actions ?? '' }}
                    </div>
                </div>
            @endif

        </div>

        {{-- Botão fechar FORA do content (padrão KTUI com descrição) --}}
        @if ($dismissible)
            <button class="kt-alert-close" data-kt-dismiss="#{{ $id }}" aria-label="Fechar">
                @svg('lucide-x')
            </button>
        @endif

        {{-- Layout SIMPLES → título + toolbar na mesma linha --}}
    @else

        @if ($title)
            <div class="kt-alert-title">{{ $title }}</div>
        @endif

        @if ($hasToolbar)
            <div class="kt-alert-toolbar">
                <div class="kt-alert-actions">
                    @if ($hasActionLabel)
                        <a href="{{ $actionHref }}" class="{{ $actionLinkClass }}">{{ $actionLabel }}</a>
                    @endif

                    {{ $actions ?? '' }}

                    @if ($dismissible)
                        <button class="kt-alert-close" data-kt-dismiss="#{{ $id }}" aria-label="Fechar">
                            @svg('lucide-x')
                        </button>
                    @endif
                </div>
            </div>
        @endif

    @endif

</div>
