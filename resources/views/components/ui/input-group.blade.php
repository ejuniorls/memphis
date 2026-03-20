@props([
    'addon'        => null,   // string — texto do addon
    'addonEnd'     => null,   // string — texto do addon no final
    'addonIcon'    => null,   // string — ícone lucide no addon inicial
    'addonIconEnd' => null,   // string — ícone lucide no addon final
])

<div {{ $attributes->merge(['class' => 'kt-input-group']) }}>

    @if ($addonIcon)
        <span class="kt-input-addon kt-input-addon-icon">
            @svg('lucide-' . $addonIcon)
        </span>
    @elseif ($addon)
        <span class="kt-input-addon">{{ $addon }}</span>
    @endif

    {{ $slot }}

    @if ($addonIconEnd)
        <span class="kt-input-addon kt-input-addon-icon">
            @svg('lucide-' . $addonIconEnd)
        </span>
    @elseif ($addonEnd)
        <span class="kt-input-addon">{{ $addonEnd }}</span>
    @endif

</div>
