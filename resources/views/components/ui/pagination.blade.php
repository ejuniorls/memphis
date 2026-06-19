@props([
    'pages'      => [],          // array de páginas: [['label' => '1', 'href' => '#', 'active' => false], ...]
    'prevHref'   => '#',         // string — href do botão anterior
    'nextHref'   => '#',         // string — href do botão próximo
    'prevLabel'  => 'Previous',  // string|null — label do botão anterior (null = icon only)
    'nextLabel'  => 'Next',      // string|null — label do botão próximo (null = icon only)
    'showFirst'  => false,       // bool — exibe botão "primeira página"
    'showLast'   => false,       // bool — exibe botão "última página"
    'firstHref'  => '#',         // string — href da primeira página
    'lastHref'   => '#',         // string — href da última página
    'ellipsis'   => false,       // bool — exibe ellipsis no final da lista de páginas
])

@php
    $prevClass = 'kt-btn kt-btn-ghost' . ($prevLabel ? '' : ' kt-btn-icon');
    $nextClass = 'kt-btn kt-btn-ghost' . ($nextLabel ? '' : ' kt-btn-icon');
@endphp

<ol {{ $attributes->merge(['class' => 'kt-pagination']) }}>

    {{-- Primeira página --}}
    @if ($showFirst)
        <li class="kt-pagination-item">
            <a href="{{ $firstHref }}" class="kt-btn kt-btn-icon kt-btn-ghost">
                @svg('lucide-chevron-first', ['class' => 'rtl:rotate-180', 'aria-hidden' => 'true'])
            </a>
        </li>
    @endif

    {{-- Anterior --}}
    <li class="kt-pagination-item">
        <a href="{{ $prevHref }}" class="{{ $prevClass }}">
            @svg('lucide-chevron-left', ['class' => 'rtl:rotate-180', 'aria-hidden' => 'true'])
            @if ($prevLabel){{ $prevLabel }}@endif
        </a>
    </li>

    {{-- Páginas --}}
    @foreach ($pages as $page)
        @php $pageClass = 'kt-btn kt-btn-icon kt-btn-ghost' . (($page['active'] ?? false) ? ' active' : ''); @endphp
        <li class="kt-pagination-item">
            <a href="{{ $page['href'] ?? '#' }}" class="{{ $pageClass }}">
                {{ $page['label'] }}
            </a>
        </li>
    @endforeach

    {{-- Ellipsis --}}
    @if ($ellipsis)
        <li class="kt-pagination-ellipsis">
            @svg('lucide-ellipsis', ['aria-hidden' => 'true'])
        </li>
    @endif

    {{-- Próximo --}}
    <li class="kt-pagination-item">
        <a href="{{ $nextHref }}" class="{{ $nextClass }}">
            @if ($nextLabel){{ $nextLabel }}@endif
            @svg('lucide-chevron-right', ['class' => 'rtl:rotate-180', 'aria-hidden' => 'true'])
        </a>
    </li>

    {{-- Última página --}}
    @if ($showLast)
        <li class="kt-pagination-item">
            <a href="{{ $lastHref }}" class="kt-btn kt-btn-icon kt-btn-ghost">
                @svg('lucide-chevron-last', ['class' => 'rtl:rotate-180', 'aria-hidden' => 'true'])
            </a>
        </li>
    @endif

    {{-- Slot para itens extras --}}
    {{ $slot }}

</ol>
