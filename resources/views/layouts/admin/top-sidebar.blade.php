<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
    <head>
        @include('partials.head')
        @livewireStyles
    </head>
    <body class="antialiased flex h-full text-base text-foreground bg-background bg-muted! lg:overflow-hidden">
        @include('partials.scripts')

        <!-- Esconde sidebar no mobile antes do JS rodar, evita flash de layout -->
        <style>
            @media (max-width: 1023px) {
                #top_sidebar {
                    margin-left: -278px;
                }

                #top_sidebar_main {
                    margin-left: 0 !important;
                }

                #top_sidebar_header {
                    left: 0 !important;
                }
            }
        </style>

        <!-- Overlay mobile (fecha ao clicar fora do sidebar) -->
        <div id="top_sidebar_overlay"
             class="fixed inset-0 z-10 bg-black/40 hidden"
             aria-hidden="true"></div>

        <!-- Page -->
        <div class="flex grow h-full">

            @include('layouts.admin.top-sidebar.sidebar')

            <div class="flex flex-col grow min-w-0"
                 id="top_sidebar_main"
                 style="margin-left: 0;">

                @include('layouts.admin.top-sidebar.header')

                <div class="flex flex-col grow min-h-0" style="padding-top: 58px;">
                    <div
                        class="flex grow bg-background border-t border-input overflow-hidden lg:m-5 lg:rounded-xl lg:border">
                        <div class="flex flex-col grow kt-scrollable-y-auto lg:[--kt-scrollbar-width:auto]"
                             id="scrollable_content">
                            <main class="grow" role="content">
                                {{-- Toolbar: sempre renderiza, altura fixa. --}}
                                {{-- A div de ações existe sempre (flex justify-between),  --}}
                                {{-- mas só mostra conteúdo se a página injetar toolbarActions. --}}
                                <div class="border-input flex items-center" style="height: 44px;">
                                    <div
                                        class="{{ config('layout.container') }} flex items-center justify-between gap-3 py-0 h-full">
                                        <div class="flex items-center gap-1 lg:gap-3">
                                            {{ $toolbar ?? '' }}
                                        </div>
                                        <div class="flex items-center gap-2 shrink-0">
                                            {{ $toolbarActions ?? '' }}
                                        </div>
                                    </div>
                                </div>
                                <main class="grow" id="content" role="content">
                                    <div class="{{ config('layout.container') }}">
                                        {{ $slot }}
                                    </div>
                                </main>
                                @include('layouts.admin.top-sidebar.footer')
                            </main>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        @livewireScripts

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var STORAGE = 'top_sidebar_collapsed';
                var panel = document.getElementById('top_sidebar_panel');
                var sidebar = document.getElementById('top_sidebar');
                var main = document.getElementById('top_sidebar_main');
                var header = document.getElementById('top_sidebar_header');
                var btnD = document.getElementById('top_sidebar_toggle_btn');
                var btnM = document.getElementById('top_sidebar_mobile_btn');
                var overlay = document.getElementById('top_sidebar_overlay');

                var EASE = '0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                var LG = 1024;
                var isCollapsed = localStorage.getItem(STORAGE) === '1';
                var mobileOpen = false;

                function isDesktop() {
                    return window.innerWidth >= LG;
                }

                // ── Desktop: anima width do sidebar e margin-left do conteúdo ──
                function applyDesktop(collapsed, animate) {
                    if (animate) {
                        if (panel) panel.style.transition = 'width ' + EASE;
                        if (sidebar) sidebar.style.transition = 'width ' + EASE;
                        if (main) main.style.transition = 'margin-left ' + EASE;
                        if (header) header.style.transition = 'left ' + EASE;
                    }

                    if (panel) panel.style.width = collapsed ? '0px' : '220px';
                    if (sidebar) sidebar.style.width = collapsed ? '58px' : '278px';
                    if (main) main.style.marginLeft = collapsed ? '58px' : '278px';
                    if (header) header.style.left = collapsed ? '58px' : '278px';
                }

                // ── Mobile: desliza o sidebar com margin-left negativo ─────────
                function setMobile(open, animate) {
                    // em mobile o conteúdo sempre ocupa 100% (sem margem)
                    if (main) main.style.marginLeft = '0';
                    if (header) header.style.left = '0';
                    // garante largura completa do sidebar em mobile
                    if (panel) panel.style.width = '220px';
                    if (sidebar) sidebar.style.width = '278px';

                    if (sidebar) {
                        sidebar.style.transition = animate ? ('margin-left ' + EASE) : 'none';
                        sidebar.style.marginLeft = open ? '0px' : '-278px';
                    }
                    if (overlay) overlay.classList.toggle('hidden', !open);
                }

                // ── Inicializa sem animação conforme o modo atual ──────────────
                function init() {
                    if (isDesktop()) {
                        // Limpa estados mobile
                        if (sidebar) sidebar.style.marginLeft = '';
                        if (sidebar) sidebar.style.transition = '';
                        if (overlay) overlay.classList.add('hidden');
                        mobileOpen = false;

                        // Aplica estado desktop sem animação
                        if (panel) panel.style.transition = 'none';
                        if (sidebar) sidebar.style.transition = 'none';
                        if (main) main.style.transition = 'none';
                        if (header) header.style.transition = 'none';

                        if (panel) panel.style.width = isCollapsed ? '0px' : '220px';
                        if (sidebar) sidebar.style.width = isCollapsed ? '58px' : '278px';
                        if (main) main.style.marginLeft = isCollapsed ? '58px' : '278px';
                        if (header) header.style.left = isCollapsed ? '58px' : '278px';

                        // Restaura as transitions do CSS inline do HTML após um frame
                        requestAnimationFrame(function () {
                            if (main) main.style.transition = 'margin-left ' + EASE;
                            if (header) header.style.transition = 'left ' + EASE;
                            if (panel) panel.style.transition = '';
                            if (sidebar) sidebar.style.transition = '';
                        });
                    } else {
                        // Limpa estados desktop
                        if (panel) panel.style.transition = '';
                        if (sidebar) sidebar.style.transition = '';
                        if (main) main.style.transition = 'none';
                        if (header) header.style.transition = 'none';

                        setMobile(false, false);
                    }
                }

                init();

                // Ao mudar de tamanho reinicia sem animação
                var resizeTimer;
                window.addEventListener('resize', function () {
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(init, 50);
                });

                // Toggle desktop
                if (btnD) {
                    btnD.addEventListener('click', function () {
                        if (!isDesktop()) return;
                        isCollapsed = !isCollapsed;
                        localStorage.setItem(STORAGE, isCollapsed ? '1' : '0');
                        applyDesktop(isCollapsed, true);
                    });
                }

                // Toggle mobile
                if (btnM) {
                    btnM.addEventListener('click', function () {
                        if (isDesktop()) return;
                        mobileOpen = !mobileOpen;
                        setMobile(mobileOpen, true);
                    });
                }

                // Fecha overlay ao clicar fora
                if (overlay) {
                    overlay.addEventListener('click', function () {
                        mobileOpen = false;
                        setMobile(false, true);
                    });
                }

                // Fecha sidebar mobile ao navegar (wire:navigate / Livewire)
                document.addEventListener('livewire:navigating', function () {
                    if (!isDesktop() && mobileOpen) {
                        mobileOpen = false;
                        setMobile(false, false); // sem animação — página já vai trocar
                    }
                });
            });
        </script>

    </body>
</html>
