@props([
    'accent'      => false,   // bool    — adiciona kt-card-accent (borda colorida no topo)
    'title'       => null,    // string  — título do cabeçalho (atalho para kt-card-title)
    'description' => null,    // string  — subtítulo abaixo do título
    'overflow'    => false,   // bool    — adiciona overflow-hidden (ex: cards com imagem)
])

@php
    $classes = 'kt-card';
    if ($accent)    $classes .= ' kt-card-accent';
    if ($overflow)  $classes .= ' overflow-hidden';

    $hasHeader  = $title || (isset($header) && trim((string) $header) !== '');
    $hasFooter  = isset($footer) && trim((string) $footer) !== '';
    $hasToolbar = isset($toolbar) && trim((string) $toolbar) !== '';
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>

    {{-- Cabeçalho opcional --}}
    @if ($hasHeader)
        <div class="kt-card-header">
            <div class="kt-card-heading">

                {{-- Slot customizado de cabeçalho ou atalho title/description --}}
                @if (isset($header) && trim((string) $header) !== '')
                    {{ $header }}
                @else
                    @if ($title)
                        <h3 class="kt-card-title">{{ $title }}</h3>
                    @endif

                    @if ($description)
                        <p class="kt-card-description">{{ $description }}</p>
                    @endif
                @endif

            </div>

            {{-- Slot de ações no canto direito do cabeçalho --}}
            @if ($hasToolbar)
                <div class="kt-card-toolbar">
                    {{ $toolbar }}
                </div>
            @endif
        </div>
    @endif

    {{-- Conteúdo principal --}}
    {{ $slot }}

    {{-- Rodapé opcional --}}
    @if ($hasFooter)
        <div class="kt-card-footer">
            {{ $footer }}
        </div>
    @endif

</div>
