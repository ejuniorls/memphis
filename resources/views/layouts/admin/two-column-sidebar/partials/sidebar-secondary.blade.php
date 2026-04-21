{{--
    Partial: sidebar-secondary (two-column-sidebar)
    Renderiza os menus na coluna larga com accordion e estilo próprio deste layout.
    Variável injetada pelo SidebarMenuComposer: $menuTree
--}}

@php
    $navItems = $menuTree->where('is_section_header', false)->values();
@endphp

<div
    class="kt-menu flex flex-col w-full gap-px px-2.5"
    data-kt-menu="true"
    data-kt-menu-accordion-expand-all="false"
    id="sidebar_menu"
>
    @foreach ($navItems as $item)
        @include('layouts.admin.two-column-sidebar.partials.sidebar-secondary-item', [
            'item'  => $item,
            'depth' => 0,
        ])
    @endforeach
</div>
