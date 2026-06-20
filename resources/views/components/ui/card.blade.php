@props([
    'accent'      => false,   // bool    — adiciona kt-card-accent (borda colorida no topo)
    'title'       => null,    // string  — título do cabeçalho (atalho para kt-card-title)
    'description' => null,    // string  — subtítulo abaixo do título
    'overflow'    => false,   // bool    — adiciona overflow-hidden (ex: cards com imagem)
    'tag'         => 'div',   // 'div' | 'a' | 'button' — elemento raiz do card
    'href'        => null,    // string  — usado quando tag='a'
])

@php
    $classes = 'kt-card';
    if ($accent)    $classes .= ' kt-card-accent';
    if ($overflow)  $classes .= ' overflow-hidden';

    $hasHeader  = $title || (isset($header) && trim((string) $header) !== '');
    $hasFooter  = isset($footer) && trim((string) $footer) !== '';
    $hasToolbar = isset($toolbar) && trim((string) $toolbar) !== '';
@endphp

@if ($tag === 'a')
    <a href="{{ $href ?? '#' }}" {{ $attributes->merge(['class' => $classes]) }}>

        @if ($hasHeader)
            <div class="kt-card-header">
                <div class="kt-card-heading">
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
                @if ($hasToolbar)
                    <div class="kt-card-toolbar">
                        {{ $toolbar }}
                    </div>
                @endif
            </div>
        @endif

        {{ $slot }}

        @if ($hasFooter)
            <div class="kt-card-footer">
                {{ $footer }}
            </div>
        @endif

    </a>
@elseif ($tag === 'button')
    <button type="button" {{ $attributes->merge(['class' => $classes]) }}>

        @if ($hasHeader)
            <div class="kt-card-header">
                <div class="kt-card-heading">
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
                @if ($hasToolbar)
                    <div class="kt-card-toolbar">
                        {{ $toolbar }}
                    </div>
                @endif
            </div>
        @endif

        {{ $slot }}

        @if ($hasFooter)
            <div class="kt-card-footer">
                {{ $footer }}
            </div>
        @endif

    </button>
@else
    <div {{ $attributes->merge(['class' => $classes]) }}>

        @if ($hasHeader)
            <div class="kt-card-header">
                <div class="kt-card-heading">
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
                @if ($hasToolbar)
                    <div class="kt-card-toolbar">
                        {{ $toolbar }}
                    </div>
                @endif
            </div>
        @endif

        {{ $slot }}

        @if ($hasFooter)
            <div class="kt-card-footer">
                {{ $footer }}
            </div>
        @endif

    </div>
@endif
