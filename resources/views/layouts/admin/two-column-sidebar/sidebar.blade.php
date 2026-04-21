@php
    $navItems = $menuTree->where('is_section_header', false)->values();

    $activePrimaryId = null;
    $activePrimary   = null;
    foreach ($navItems as $item) {
        if ($item->isActive() || $item->hasActiveChild()) {
            $activePrimaryId = $item->id;
            $activePrimary   = $item;
            break;
        }
    }
@endphp

    <!-- Sidebar -->
<div
    class="fixed top-0 bottom-0 z-20 hidden lg:flex items-stretch shrink-0 w-(--sidebar-width) bg-muted [--kt-drawer-enable:true] lg:[--kt-drawer-enable:false]"
    data-kt-drawer="true"
    data-kt-drawer-class="kt-drawer kt-drawer-start flex flex-row top-0 bottom-0"
    id="sidebar"
>
    <!-- Sidebar Primary (coluna de ícones) -->
    <div class="flex flex-col items-stretch shrink-0 gap-5 py-5 w-[70px] border-e border-input" id="sidebar_primary">

        <div class="hidden lg:flex items-center justify-center shrink-0" id="sidebar_primary_header">
            <a href="{{ route('dashboard') }}">
                <img class="dark:hidden min-h-[30px]" src="{{ asset('assets/media/app/mini-logo-gray.svg') }}"/>
                <img class="hidden dark:block min-h-[30px]" src="{{ asset('assets/media/app/mini-logo-gray-dark.svg') }}"/>
            </a>
        </div>

        <div class="flex grow shrink-0" id="sidebar_primary_content">
            <div
                class="kt-scrollable-y-hover grow gap-2.5 shrink-0 flex ps-4 flex-col"
                data-kt-scrollable="true"
                data-kt-scrollable-dependencies="#sidebar_primary_header,#sidebar_primary_footer"
                data-kt-scrollable-height="auto"
                data-kt-scrollable-offset="80px"
                data-kt-scrollable-wrappers="#sidebar_primary_content"
            >
                @foreach ($navItems as $item)
                    @if (! $item->icon)
                        @continue
                    @endif

                    <a
                        class="kt-btn kt-btn-icon kt-btn-ghost rounded-md size-9 border border-transparent
                               hover:bg-background hover:[&_i]:text-primary hover:border-border
                               [.active&]:bg-background [.active&]:[&_i]:text-primary [.active&]:border-border
                               {{ $item->id === $activePrimaryId ? 'active' : '' }}"
                        href="{{ $item->url() }}"
                        data-kt-tooltip=""
                        data-kt-tooltip-placement="right"
                    >
                        <span class="kt-menu-icon">
                            <i class="{{ $item->icon }} text-lg"></i>
                        </span>
                        <span class="kt-tooltip" data-kt-tooltip-content="true">
                            {{ $item->label }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="flex flex-col gap-5 items-center shrink-0" id="sidebar_primary_footer">
            <div class="flex flex-col gap-1.5">
                @include('partials.topbar-chat')
                @include('partials.topbar-apps')
            </div>
            @include('partials.topbar-user-dropdown')
        </div>
    </div>
    <!-- End of Sidebar Primary -->

    <!-- Sidebar Secondary (submenus do item ativo) -->
    <div class="flex items-stretch grow shrink-0 justify-center ps-1.5 my-5 me-1.5" id="sidebar_secondary">
        <div
            class="kt-scrollable-y-auto grow"
            data-kt-scrollable="true"
            data-kt-scrollable-height="auto"
            data-kt-scrollable-offset="0px"
            data-kt-scrollable-wrappers="#sidebar_secondary"
        >
            @if ($activePrimary && $activePrimary->children->isNotEmpty())

                {{-- Header do painel: mostra o nome do módulo ativo --}}
                <div class="flex items-center gap-2 px-4 pt-4 pb-2 mb-1">
                    <i class="{{ $activePrimary->icon }} text-base text-primary"></i>
                    <span class="text-xs font-semibold text-mono uppercase tracking-wider">
                        {{ $activePrimary->label }}
                    </span>
                </div>
                <div class="border-b border-border mx-2.5 mb-2"></div>

                <div
                    class="kt-menu flex flex-col w-full gap-px px-2.5"
                    data-kt-menu="true"
                    data-kt-menu-accordion-expand-all="false"
                    id="sidebar_menu"
                >
                    @foreach ($activePrimary->children as $child)
                        @include('layouts.admin.two-column-sidebar.partials.sidebar-secondary-item', [
                            'item'  => $child,
                            'depth' => 0,
                        ])
                    @endforeach
                </div>

            @endif
        </div>
    </div>
    <!-- End of Sidebar Secondary -->
</div>
<!-- End of Sidebar -->
