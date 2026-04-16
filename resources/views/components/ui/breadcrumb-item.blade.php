@props([
    'href'      => null,
    'active'    => false,
    'icon'      => null,
    'separator' => 'chevron-right',
    'first'     => false,
])

@if ($separator !== false && !$first)
    <li class="kt-breadcrumb-separator">
        @if ($separator === 'dot')
            <div class="mx-1 rounded-full size-1 bg-mono/30"></div>
        @else
            @svg('lucide-' . $separator)
        @endif
    </li>
@endif

<li class="kt-breadcrumb-item">
    @if ($active)
        <span class="kt-breadcrumb-page">
            @if ($icon)
                @svg('lucide-' . $icon)
            @else
                {{ $slot }}
            @endif
        </span>
    @elseif ($href)
        <a href="{{ $href }}" class="kt-breadcrumb-link">
            @if ($icon)
                @svg('lucide-' . $icon)
            @else
                {{ $slot }}
            @endif
        </a>
    @else
        {{ $slot }}
    @endif
</li>
