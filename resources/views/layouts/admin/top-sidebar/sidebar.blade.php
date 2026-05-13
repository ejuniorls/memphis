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

    <!-- Sidebar: fixed full height, flex-row (ícones + painel) -->
<div class="fixed top-0 bottom-0 left-0 z-20 flex flex-row transition-[width] duration-300"
     id="top_sidebar"
     style="width: 278px;">

    <!-- Coluna de ícones: sempre visível, 58px -->
    <div class="flex flex-col items-center bg-muted border-e border-input shrink-0"
         style="width: 58px;">

        <!-- Logo -->
        <div class="flex items-center justify-center shrink-0 border-b border-input w-full"
             style="height: 58px;">
            <a href="{{ route('dashboard') }}">
                <img class="dark:hidden" style="height:24px;"
                     src="{{ asset('assets/media/app/mini-logo-primary.svg') }}"
                     alt="{{ config('app.name') }}"/>
                <img class="hidden dark:block" style="height:24px;"
                     src="{{ asset('assets/media/app/mini-logo-primary-dark.svg') }}"
                     alt="{{ config('app.name') }}"/>
            </a>
        </div>

        <!-- Ícones de navegação -->
        <div class="flex flex-col items-center gap-1 py-3 grow overflow-y-auto w-full">
            @foreach ($navItems as $item)
                @if (! $item->icon) @continue @endif
                @php $isActive = $item->id === $activePrimaryId; @endphp
                <a class="flex items-center justify-center rounded-lg border border-transparent
                           text-muted-foreground transition-colors duration-150
                           hover:bg-background hover:text-primary hover:border-border
                           {{ $isActive ? 'bg-background text-primary border-border' : '' }}"
                   style="width:36px; height:36px;"
                   href="{{ $item->url() }}"
                   data-kt-tooltip=""
                   data-kt-tooltip-placement="right">
                    <i class="{{ $item->icon }} text-lg leading-none"></i>
                    <span class="kt-tooltip" data-kt-tooltip-content="true">{{ $item->label }}</span>
                </a>
            @endforeach
        </div>
    </div>
    <!-- End Coluna de ícones -->

    <!-- Painel secundário: colapsável, 220px -->
    <div class="flex flex-col bg-muted border-e border-input overflow-hidden transition-[width] duration-300"
         style="width: 220px;"
         id="top_sidebar_panel">

        <!-- Cabeçalho: nome da seção ativa -->
        <div class="flex items-center gap-2.5 px-4 shrink-0 border-b border-input"
             style="height: 58px;">
            @if ($activePrimary)
                <i class="{{ $activePrimary->icon }} text-sm text-primary shrink-0"></i>
                <span class="text-xs font-semibold uppercase tracking-wider text-mono truncate">
                    {{ $activePrimary->label }}
                </span>
            @else
                <span class="text-xs font-semibold uppercase tracking-wider text-muted-foreground">
                    {{ config('app.name') }}
                </span>
            @endif
        </div>

        <!-- Itens do menu -->
        <div class="flex flex-col grow overflow-y-auto py-3">
            @if ($activePrimary && $activePrimary->children->isNotEmpty())
                <div class="kt-menu flex flex-col w-full gap-px px-2.5"
                     data-kt-menu="true"
                     data-kt-menu-accordion-expand-all="false"
                     id="sidebar_menu">
                    @foreach ($activePrimary->children as $child)
                        @include('layouts.admin.top-sidebar.partials.sidebar-secondary-item', [
                            'item'  => $child,
                            'depth' => 0,
                        ])
                    @endforeach
                </div>
            @elseif ($activePrimary)
                <div class="flex flex-col items-center justify-center grow gap-2 text-center px-4">
                    <i class="{{ $activePrimary->icon }} text-3xl text-muted-foreground/40"></i>
                    <span class="text-xs text-muted-foreground">{{ $activePrimary->label }}</span>
                </div>
            @else
                <div class="flex flex-col items-center justify-center grow gap-2 text-center px-4">
                    <i class="ki-filled ki-abstract-26 text-3xl text-muted-foreground/30"></i>
                    <span class="text-xs text-muted-foreground">{{ __('Select a section') }}</span>
                </div>
            @endif
        </div>

    </div>
    <!-- End Painel secundário -->

</div>
<!-- End Sidebar -->
