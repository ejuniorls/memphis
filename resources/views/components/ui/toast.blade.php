@props([
    'message'       => null,
    'title'         => null,
    'variant'       => null,
    'appearance'    => null,
    'size'          => null,
    'position'      => 'top-end',
    'icon'          => null,
    'dismissible'   => true,
    'duration'      => 4000,
    'progress'      => false,
    'pauseOnHover'  => true,
    'important'     => false,
    'action'        => null,
    'cancel'        => null,
    'id'            => null,
])

@php
    $id = $id ?? 'toast_' . uniqid();

    $classes = 'kt-toast';
    if ($appearance) $classes .= ' kt-toast-' . $appearance;
    if ($variant)    $classes .= ' kt-toast-' . $variant;
    if ($size)       $classes .= ' kt-toast-' . $size;

    $containerClasses = 'kt-toast-container kt-toast-' . $position;

    $defaultIcons = [
        'success'     => 'circle-check',
        'destructive' => 'circle-x',
        'warning'     => 'triangle-alert',
        'info'        => 'info',
        'primary'     => 'bell',
        'mono'        => 'bell',
        'secondary'   => 'bell',
    ];

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

    $hasMessage = $message || trim((string) $slot) !== '';
    $hasAction  = !empty($action);
    $hasCancel  = !empty($cancel);
    $hasFooter  = $hasAction || $hasCancel;

    // Monta atributos do toast como array para evitar @if dentro de tags HTML
    $toastAttrs = array_filter([
        'id'                            => $id,
        'class'                         => $classes,
        'role'                          => 'status',
        'aria-atomic'                   => 'true',
        'data-kt-toast'                 => '',
        'data-kt-toast-duration'        => $duration > 0 ? $duration : null,
        'data-kt-toast-pause-on-hover'  => !$pauseOnHover ? 'false' : null,
        'data-kt-toast-important'       => $important ? 'true' : null,
    ], fn($v) => $v !== null);
@endphp

<div {{ $attributes->merge(['class' => $containerClasses]) }} role="region" aria-live="polite">
    <div
    @foreach ($toastAttrs as $attr => $val)
        {{ $attr }}="{{ $val }}"
    @endforeach
    >
    @if ($resolvedIcon !== null)
        <div class="kt-toast-icon">
            @svg('lucide-' . $resolvedIcon)
        </div>
    @endif

    <div class="kt-toast-content">
        @if ($title)
            <div class="kt-toast-title">{{ $title }}</div>
        @endif

        @if ($hasMessage)
            <div class="kt-toast-description">{{ $message ?? $slot }}</div>
        @endif

        @if ($hasFooter)
            <div class="kt-toast-actions">
                @if ($hasAction)
                    <a href="{{ $action['href'] ?? '#' }}" class="kt-toast-action-btn" data-kt-toast-action="true">{{ $action['label'] }}</a>
                @endif
                @if ($hasCancel)
                    <a href="{{ $cancel['href'] ?? '#' }}" class="kt-toast-cancel-btn" data-kt-toast-cancel="true">{{ $cancel['label'] }}</a>
                @endif
            </div>
        @endif
    </div>

    @if ($dismissible)
        <button class="kt-toast-dismiss-btn" data-kt-toast-dismiss="true" aria-label="Fechar notificação">
            @svg('lucide-x')
        </button>
    @endif

    @if ($progress && $duration > 0)
        <div class="kt-toast-progress" style="animation-duration: {{ $duration }}ms;"></div>
    @endif
</div>
</div>
