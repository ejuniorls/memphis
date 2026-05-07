@props([
    'title',                                      // string  — título do card (obrigatório)
    'icon'         => null,                       // string  — ícone lucide, ex: 'lucide-lock'
    'badge'        => null,                       // string  — texto do badge no header
    'badgeVariant' => 'secondary',                // string  — variante do badge
    'danger'       => false,                      // bool    — estilo zona de perigo
    'contentClass' => 'flex flex-col gap-5 py-5', // string  — classes do kt-card-content
])

@php
    $cardClass    = 'kt-card' . ($danger ? ' border-destructive/30' : '');
    $headerClass  = 'kt-card-header';
    $titleClass   = 'kt-card-title';

    if ($danger) {
        $headerClass .= ' border-destructive/20 bg-destructive/5';
        $titleClass  .= ' flex items-center gap-2 text-destructive';
    } elseif ($icon) {
        $titleClass  .= ' flex items-center gap-2';
    }
@endphp

<div {{ $attributes->merge(['class' => $cardClass]) }}>

    <div class="{{ $headerClass }}">
        <h3 class="{{ $titleClass }}">
            @if ($icon)
                @svg($icon, ['class' => 'size-4' . ($danger ? '' : ' text-primary')])
            @endif
            {{ $title }}
        </h3>

        @if ($badge)
            <x-ui.badge variant="{{ $badgeVariant }}" style="outline" size="sm">
                {{ $badge }}
            </x-ui.badge>
        @endif

        @if (isset($actions) && $actions->isNotEmpty())
            {{ $actions }}
        @endif
    </div>

    @if (isset($subtitle) && $subtitle->isNotEmpty())
        <div class="px-5 pt-3 text-xs text-secondary-foreground">
            {{ $subtitle }}
        </div>
    @endif

    <div class="kt-card-content {{ $contentClass }}">
        {{ $slot }}
    </div>

</div>
