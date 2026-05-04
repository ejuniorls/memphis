@props([
    'label'   => null,     // string|null — texto central (ex: 'Or', 'Continue com')
    'variant' => 'line',   // 'line' | 'menu' | 'dropdown'
])

@if ($variant === 'menu')
    <div {{ $attributes->merge(['class' => 'kt-menu-separator']) }}></div>

@elseif ($variant === 'dropdown')
    <div {{ $attributes->merge(['class' => 'kt-dropdown-menu-separator']) }}></div>

@else
    {{-- line: separador horizontal com label opcional --}}
    <div {{ $attributes->merge(['class' => 'flex items-center gap-2']) }}>
        <span class="border-t border-border w-full"></span>
        @if ($label)
            <span class="text-xs text-muted-foreground font-medium uppercase whitespace-nowrap">
                {{ $label }}
            </span>
            <span class="border-t border-border w-full"></span>
        @endif
    </div>
@endif
