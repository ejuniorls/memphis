{{--
    Partial recursivo: navbar-menu-item (horizontal-menu)
    Renderiza itens dentro do dropdown.

    depth 0 = filho direto do item raiz  → dropdown padrão para baixo
    depth 1+ = neto em diante           → sub-dropdown para a direita (right-start)
--}}

@php
    $hasChildren = $item->children->isNotEmpty();
    $isActive    = $item->isActive() || $item->hasActiveChild();
@endphp

@if ($hasChildren)
    <div
        class="kt-menu-item kt-menu-item-dropdown {{ $isActive ? 'kt-menu-item-here' : '' }}"
        data-kt-menu-item-placement="right-start"
        data-kt-menu-item-toggle="dropdown"
        data-kt-menu-item-trigger="click|lg:hover"
    >
        <div class="kt-menu-link grow cursor-pointer">
            <span class="kt-menu-title {{ $isActive ? 'text-primary font-medium' : '' }}
                         kt-menu-item-here:text-primary kt-menu-item-active:text-primary kt-menu-link-hover:text-primary">
                {{ $item->label }}
            </span>
            <span class="kt-menu-arrow">
                <i class="ki-filled ki-right text-xs rtl:translate rtl:rotate-180"></i>
            </span>
        </div>
        <div class="kt-menu-dropdown kt-menu-default min-w-[180px] py-2">
            @foreach ($item->children as $child)
                @include('layouts.admin.horizontal-menu.partials.navbar-menu-item', [
                    'item' => $child,
                ])
            @endforeach
        </div>
    </div>

@else
    <div class="kt-menu-item {{ $isActive ? 'kt-menu-item-active' : '' }}">
        <a
            class="kt-menu-link"
            href="{{ $item->url() }}"
            tabindex="0"
            @if (! $item->is_route && str_starts_with($item->route ?? '', 'http'))
                target="_blank"
            @endif
        >
            <span class="kt-menu-title
                         {{ $isActive ? 'text-primary font-medium' : '' }}
                         kt-menu-item-active:text-primary kt-menu-item-active:font-medium
                         kt-menu-link-hover:text-primary">
                {{ $item->label }}
            </span>
        </a>
    </div>
@endif
