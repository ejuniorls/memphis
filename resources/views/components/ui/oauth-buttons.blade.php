@props([
    'providers' => ['google', 'apple'],  // array — provedores a exibir, na ordem desejada
    'label'     => null,                 // string|null — texto do separador (null = sem separador)
    'columns'   => null,                 // int|null — força número de colunas (padrão: qtd de providers)
])

@php
    $catalog = [
        'google' => [
            'label' => 'Google',
            'route' => 'auth.google',
            'logo'  => [
                'src'  => 'assets/media/brand-logos/google.svg',
                'dark' => null,
            ],
        ],
        'apple' => [
            'label' => 'Apple',
            'route' => 'auth.apple',
            'logo'  => [
                'src'  => 'assets/media/brand-logos/apple-black.svg',
                'dark' => 'assets/media/brand-logos/apple-white.svg',
            ],
        ],
        'microsoft' => [
            'label' => 'Microsoft',
            'route' => 'auth.microsoft',
            'logo'  => [
                'src'  => 'assets/media/brand-logos/microsoft-5.svg',
                'dark' => null,
            ],
        ],
        'facebook' => [
            'label' => 'Facebook',
            'route' => 'auth.facebook',
            'logo'  => [
                'src'  => 'assets/media/brand-logos/facebook.svg',
                'dark' => null,
            ],
        ],
    ];

    $cols = $columns ?? count($providers);
@endphp

<div class="flex flex-col gap-3">

    {{-- Botões --}}
    <div class="grid gap-2.5" style="grid-template-columns: repeat({{ $cols }}, minmax(0, 1fr))">
        @foreach ($providers as $key)
            @php $p = $catalog[$key] ?? null @endphp
            @if ($p)
                @php
                    $href = Route::has($p['route']) ? route($p['route']) : '#';
                @endphp
                <x-ui.button tag="a" :outline="true" :href="$href" class="justify-center">
                    @if ($p['logo']['dark'])
                        <img alt="{{ $p['label'] }}" class="size-3.5 shrink-0 dark:hidden"
                             src="{{ $p['logo']['src'] }}"/>
                        <img alt="{{ $p['label'] }}" class="size-3.5 shrink-0 hidden dark:block"
                             src="{{ $p['logo']['dark'] }}"/>
                    @else
                        <img alt="{{ $p['label'] }}" class="size-3.5 shrink-0" src="{{ $p['logo']['src'] }}"/>
                    @endif
                    {{ $p['label'] }}
                </x-ui.button>
            @endif
        @endforeach
    </div>

    {{-- Separador opcional --}}
    @if ($label !== null)
        <x-ui.divider :label="$label"/>
    @endif

</div>
