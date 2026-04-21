{{--
    Partial: sidebar-primary (two-column-sidebar)
    Renderiza os itens raiz como botões de ícone com tooltip na coluna estreita (70px).
    Variável injetada pelo SidebarMenuComposer: $menuTree
    Apenas itens de nível 0 com ícone definido são exibidos aqui.
--}}

@php
    // Apenas itens navegáveis com ícone (não headers de seção)
    $rootItems = $menuTree->where('is_section_header', false)->values();
@endphp

@foreach ($rootItems as $item)
    @if (! $item->icon)
        @continue
    @endif

    @php
        $isActive = $item->isActive() || $item->hasActiveChild();
    @endphp

    <a
        class="kt-btn kt-btn-icon kt-btn-ghost rounded-md size-9 border border-transparent
               hover:bg-background hover:[&_i]:text-primary hover:border-border
               [.active&]:bg-background [.active&]:[&_i]:text-primary [.active&]:border-border
               {{ $isActive ? 'active' : '' }}"
        data-kt-tooltip=""
        data-kt-tooltip-placement="right"
        href="{{ $item->url() }}"
    >
        <span class="kt-menu-icon">
            <i class="{{ $item->icon }} text-lg"></i>
        </span>
        <span class="kt-tooltip" data-kt-tooltip-content="true">
            {{ $item->label }}
        </span>
    </a>
@endforeach
