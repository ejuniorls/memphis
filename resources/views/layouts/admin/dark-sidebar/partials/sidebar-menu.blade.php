{{--
    Partial: sidebar-menu (dark-sidebar)
    Variável injetada pelo SidebarMenuComposer: $menuTree (Collection de Menu)
    Suporta até 3 níveis: seção > pai > filho > neto
--}}

@php
    // Agrupa os itens raiz pela coluna `section` para montar os blocos de seção.
    // Itens com is_section_header=true são usados como título do grupo.
    $sections = $menuTree->groupBy('section');
@endphp

<div
    class="kt-scrollable-y-auto grow"
    data-kt-scrollable="true"
    data-kt-scrollable-dependencies="#sidebar_header, #sidebar_footer"
    data-kt-scrollable-height="auto"
    data-kt-scrollable-offset="0px"
    data-kt-scrollable-wrappers="#sidebar_menu"
>
    @foreach ($sections as $sectionName => $items)
        @php
            // Filtra apenas os itens navegáveis (não headers de seção)
            $navItems = $items->where('is_section_header', false);
        @endphp

        @if ($navItems->isEmpty())
            @continue
        @endif

        <div class="mb-5">
            @if ($sectionName)
                <h3 class="text-sm text-muted-foreground uppercase ps-5 inline-block mb-3">
                    {{ $sectionName }}
                </h3>
            @endif

            <div
                class="kt-menu flex flex-col w-full gap-1.5 px-3.5"
                data-kt-menu="true"
                data-kt-menu-accordion-expand-all="false"
            >
                @foreach ($navItems as $item)
                    @include('layouts.admin.dark-sidebar.partials.sidebar-menu-item', [
                        'item'  => $item,
                        'depth' => 0,
                    ])
                @endforeach
            </div>
        </div>
    @endforeach
</div>
