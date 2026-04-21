@php
    $hasChildren = $item->children->isNotEmpty();
    $isActive    = $item->isActive();
    // isOpen: true se este item ou algum descendente está ativo
    $isOpen      = $isActive || $item->hasActiveChild();

    $paddingLink = match ($depth) {
        0       => 'ps-2.5',
        1       => 'ps-5',
        default => 'ps-8',
    };
@endphp

@if ($hasChildren)
    {{--
        Accordion pai.
        kt-menu-item-show  → accordion expandido
        kt-menu-item-here  → este grupo contém o item ativo (destaca o título)
    --}}
    <div
        class="kt-menu-item
               {{ $isOpen ? 'kt-menu-item-show' : '' }}
               {{ $isOpen ? 'kt-menu-item-here' : '' }}"
        data-kt-menu-item-toggle="accordion"
        data-kt-menu-item-trigger="click"
    >
        <div class="kt-menu-link py-2 {{ $paddingLink }} pe-2.5 rounded-md border border-transparent
                    {{ $isOpen ? 'border-border bg-background' : '' }}">
            <span class="kt-menu-title text-sm
                         {{ $isOpen ? 'text-mono font-medium' : 'text-foreground' }}
                         kt-menu-item-here:text-mono kt-menu-item-show:text-mono kt-menu-link-hover:text-mono">
                {{ $item->label }}
            </span>
            <span class="kt-menu-arrow text-muted-foreground">
                <span class="inline-flex kt-menu-item-show:hidden">
                    <i class="ki-filled ki-down text-xs"></i>
                </span>
                <span class="hidden kt-menu-item-show:inline-flex">
                    <i class="ki-filled ki-up text-xs"></i>
                </span>
            </span>
        </div>

        <div class="kt-menu-accordion gap-px">
            @foreach ($item->children as $child)
                @include('layouts.admin.two-column-sidebar.partials.sidebar-secondary-item', [
                    'item'  => $child,
                    'depth' => $depth + 1,
                ])
            @endforeach
        </div>
    </div>

@else
    {{-- Link simples --}}
    <div class="kt-menu-item {{ $isActive ? 'kt-menu-item-active' : '' }}">
        <a
            class="kt-menu-link py-2 {{ $paddingLink }} pe-2.5 rounded-md border border-transparent
                   kt-menu-item-active:border-border kt-menu-item-active:bg-background
                   kt-menu-link-hover:bg-background kt-menu-link-hover:border-border
                   {{ $isActive ? 'border-border bg-background' : '' }}"
            href="{{ $item->url() }}"
            @if (! $item->is_route && str_starts_with($item->route ?? '', 'http'))
                target="_blank"
            @endif
        >
            @if ($depth >= 2)
                <span class="kt-menu-bullet">
                    <span class="bullet bullet-dot {{ $isActive ? 'bg-primary' : '' }}"></span>
                </span>
            @endif
            <span class="kt-menu-title text-sm
                         {{ $isActive ? 'font-medium text-primary' : 'text-foreground' }}
                         kt-menu-item-active:font-medium kt-menu-item-active:text-primary
                         kt-menu-link-hover:text-primary">
                {{ $item->label }}
            </span>
        </a>
    </div>
@endif
