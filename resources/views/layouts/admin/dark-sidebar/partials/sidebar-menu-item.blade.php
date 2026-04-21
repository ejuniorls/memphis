{{--
    Partial recursivo: sidebar-menu-item
    Variáveis:
        $item  – instância de App\Models\Menu
        $depth – nível de profundidade (0 = raiz, 1 = filho, 2 = neto)
--}}

@php
    $hasChildren = $item->children->isNotEmpty();
    $isActive    = $item->isActive();
    $isOpen      = $isActive || $item->hasActiveChild();

    // Padding esquerdo progressivo para subníveis
    $accordionPadding = match ($depth) {
        0 => 'ps-7',
        default => 'ps-2.5',
    };
@endphp

@if ($hasChildren)
    {{-- Item com submenu (accordion) --}}
    <div
        class="kt-menu-item {{ $isOpen ? 'kt-menu-item-show' : '' }}"
        data-kt-menu-item-toggle="accordion"
        data-kt-menu-item-trigger="click"
    >
        <div class="kt-menu-link gap-2.5 py-2 px-2.5 rounded-md kt-menu-item-hover:bg-transparent kt-menu-item-here:bg-transparent">
            @if ($item->icon && $depth === 0)
                <span class="kt-menu-icon items-start text-muted-foreground text-lg kt-menu-item-here:text-mono kt-menu-item-show:text-mono kt-menu-link-hover:text-mono">
                    <i class="{{ $item->icon }}"></i>
                </span>
            @endif

            <span class="kt-menu-title font-medium text-sm text-secondary-foreground kt-menu-item-here:text-mono kt-menu-item-show:text-mono kt-menu-link-hover:text-mono">
                {{ $item->label }}
            </span>

            <span class="kt-menu-arrow text-muted-foreground kt-menu-item-here:text-muted-foreground kt-menu-item-show:text-foreground kt-menu-link-hover:text-foreground">
                <span class="inline-flex kt-menu-item-show:hidden">
                    <i class="ki-filled ki-down text-xs"></i>
                </span>
                <span class="hidden kt-menu-item-show:inline-flex">
                    <i class="ki-filled ki-up text-xs"></i>
                </span>
            </span>
        </div>

        <div class="kt-menu-accordion gap-px {{ $accordionPadding }}">
            @foreach ($item->children as $child)
                @include('layouts.admin.dark-sidebar.partials.sidebar-menu-item', [
                    'item'  => $child,
                    'depth' => $depth + 1,
                ])
            @endforeach
        </div>
    </div>

@else
    {{-- Item simples (link) --}}
    <div class="kt-menu-item {{ $isActive ? 'kt-menu-item-active' : '' }}">
        <a
            class="kt-menu-link py-2 px-2.5 rounded-md
                   {{ $depth === 0
                       ? 'gap-2.5 kt-menu-item-active:bg-accent/60 kt-menu-link-hover:bg-accent/60 !menu-item-here:bg-transparent'
                       : 'kt-menu-item-active:bg-secondary kt-menu-link-hover:bg-secondary' }}"
            href="{{ $item->url() }}"
            @if (! $item->is_route && str_starts_with($item->route ?? '', 'http'))
                target="_blank"
            @endif
        >
            @if ($item->icon && $depth === 0)
                <span class="kt-menu-icon items-start text-lg text-secondary-foreground kt-menu-item-active:text-mono kt-menu-item-here:text-mono">
                    <i class="{{ $item->icon }}"></i>
                </span>
            @endif

            <span class="kt-menu-title text-sm
                         {{ $depth === 0
                             ? 'text-foreground font-medium kt-menu-item-here:text-mono kt-menu-item-active:text-mono kt-menu-link-hover:text-mono'
                             : 'text-foreground kt-menu-item-active:font-medium kt-menu-item-active:text-mono kt-menu-link-hover:text-mono' }}">
                {{ $item->label }}
            </span>
        </a>
    </div>
@endif
