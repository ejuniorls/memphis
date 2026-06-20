@props([
    'src'      => null,        // string  — URL da imagem (se omitido, usa fallback)
    'alt'      => 'avatar',    // string  — texto alternativo da imagem
    'fallback' => null,        // string  — iniciais ou texto exibido quando não há imagem (ex: "B.A")
    'icon'     => null,        // string  — ícone lucide exibido como fallback (substitui $fallback)
    'size'     => null,        // null | 'xs' | 'sm' | 'lg' | 'xl' | custom via class (ex: size-14)
    'variant'  => null,        // null | 'primary' | 'destructive' | 'success' | 'warning' | 'info' — cor do fallback
    'status'   => null,        // null | 'online' | 'offline' | 'busy' | 'away' — bolinha de status
    'badge'    => null,        // string|int — número/texto exibido como badge (ex: contagem de notificações)
    'badgeVariant' => 'primary', // string — variante do badge
    'indicatorPosition' => 'top-end', // 'top-end' | 'bottom-end' — posição do indicador (status/badge)
    'bordered' => false,       // bool — adiciona borda branca (útil em grupos sobrepostos)
])

@php
    $sizeClasses = match ($size) {
        'xs'    => 'size-6',
        'sm'    => 'size-8',
        'lg'    => 'size-14',
        'xl'    => 'size-20',
        default => null, // usa o padrão do kt-avatar (size-10) ou classes customizadas via $attributes
    };

    $classes = 'kt-avatar';
    if ($sizeClasses) $classes .= ' ' . $sizeClasses;

    $fallbackClasses = 'kt-avatar-fallback';
    $fallbackClasses .= match ($variant) {
        'primary'     => ' text-primary bg-primary/10',
        'destructive' => ' text-destructive bg-destructive/10',
        'success'     => ' text-green-600 bg-green-500/10',
        'warning'     => ' text-yellow-600 bg-yellow-500/10',
        'info'        => ' text-violet-600 bg-violet-500/10',
        default       => '',
    };

    $imageClasses = $bordered ? 'border-2 border-background hover:z-10' : '';

    $indicatorPos = match ($indicatorPosition) {
        'bottom-end' => '-end-1 -bottom-1',
        default      => '-end-1 -top-1',
    };

    $hasIndicator = $status || $badge;
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>

    @if ($src)
        <div class="kt-avatar-image {{ $imageClasses }}">
            <img src="{{ $src }}" alt="{{ $alt }}" />
        </div>
    @elseif ($icon)
        <div class="{{ $fallbackClasses }}">
            @svg('lucide-' . $icon, ['class' => 'size-4'])
        </div>
    @else
        <div class="{{ $fallbackClasses }}">
            {{ $fallback ?? $slot }}
        </div>
    @endif

    @if ($hasIndicator)
        <div class="kt-avatar-indicator {{ $indicatorPos }}">
            @if ($status)
                <div class="kt-avatar-status kt-avatar-status-{{ $status }} size-2.5"></div>
            @elseif ($badge !== null)
                <span class="kt-badge kt-badge-xs kt-badge-{{ $badgeVariant }} rounded-full border border-background">
                    {{ $badge }}
                </span>
            @endif
        </div>
    @endif

</div>
