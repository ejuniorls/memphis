@props([
    'variant'     => null,
    'style'       => null,
    'size'        => null,
    'title'       => null,
    'description' => null,
    'icon'        => null,
    'dismissible' => false,
    'id'          => null,
    'actionLabel' => null,
    'actionHref'  => '#',
])

@php
    $id = $id ?? 'alert_' . uniqid();

    $classes = 'kt-alert';
    if ($style)   $classes .= ' kt-alert-' . $style;
    if ($variant) $classes .= ' kt-alert-' . $variant;
    if ($size)    $classes .= ' kt-alert-' . $size;

    $defaultIcons = [
        'success'     => 'circle-check',
        'destructive' => 'circle-x',
        'warning'     => 'triangle-alert',
        'info'        => 'info',
        'primary'     => 'info',
        'mono'        => 'info',
    ];

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

    $actionLinkClass = match(true) {
        $style === 'light'                    => 'kt-link kt-link-xs kt-link-underlined text-mono',
        in_array($style, ['mono', 'outline']) => 'kt-link kt-link-xs kt-link-underlined text-mono-foreground',
        $variant !== null && $style === null  => 'kt-link kt-link-xs kt-link-underlined kt-link-inverse',
        default                               => 'kt-link kt-link-xs kt-link-underlined',
    };

    $hasDescription = $description || $slot->isNotEmpty();
    $hasActionsSlot = isset($actions) && $actions->isNotEmpty();
    $hasActionLabel = !empty($actionLabel);
    $hasAnyAction   = $hasActionsSlot || $hasActionLabel;
    $hasToolbar     = $hasAnyAction || $dismissible;

    $iconStyle = '';
    if ($style === 'light' && $variant) {
        $iconStyle = match($variant) {
            'primary'     => 'color: var(--primary-500)',
            'success'     => 'color: var(--success-500)',
            'info'        => 'color: var(--info-500)',
            'warning'     => 'color: var(--warning-500)',
            'destructive' => 'color: var(--destructive-500)',
            default       => '',
        };
    }
@endphp

<div {{ $attributes->merge(['class' => $classes, 'id' => $id]) }}>

    @if ($resolvedIcon !== null)
        <div class="kt-alert-icon" @if($iconStyle) style="{{ $iconStyle }}" @endif>
            @svg('lucide-' . $resolvedIcon)
        </div>
    @endif

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

        @if ($dismissible)
            <button class="kt-alert-close" data-kt-dismiss="#{{ $id }}" aria-label="Fechar">
                @svg('lucide-x')
            </button>
        @endif

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
