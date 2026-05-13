<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
    <head>
        @include('partials.head')
        @livewireStyles
    </head>
    <body class="antialiased flex h-full text-base text-foreground bg-background bg-muted! lg:overflow-hidden">
        @include('partials.scripts')

        <!-- Page -->
        <div class="flex grow h-full">

            @include('layouts.admin.top-sidebar.sidebar')

            <div class="flex flex-col grow min-w-0"
                 id="top_sidebar_main"
                 style="margin-left: 278px; transition: margin-left 0.3s;">

                @include('layouts.admin.top-sidebar.header')

                <div class="flex flex-col grow min-h-0" style="padding-top: 58px;">
                    <div class="flex grow m-5 rounded-xl bg-background border border-input overflow-hidden">
                        <div class="flex flex-col grow kt-scrollable-y-auto lg:[--kt-scrollbar-width:auto] pt-5"
                             id="scrollable_content">
                            <main class="grow" role="content">
                                @include('layouts.admin.top-sidebar.toolbar')
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

        @include('partials.scripts')
        @livewireScripts

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var STORAGE  = 'top_sidebar_collapsed';
                var panel    = document.getElementById('top_sidebar_panel');
                var sidebar  = document.getElementById('top_sidebar');
                var main     = document.getElementById('top_sidebar_main');
                var header   = document.getElementById('top_sidebar_header');
                var btn      = document.getElementById('top_sidebar_toggle_btn');

                function applyState(collapsed, animate) {
                    var els = [panel, sidebar, main, header];

                    if (!animate) {
                        els.forEach(function(el) { if (el) el.style.transition = 'none'; });
                    }

                    if (panel)   panel.style.width      = collapsed ? '0px'   : '220px';
                    if (sidebar) sidebar.style.width     = collapsed ? '58px'  : '278px';
                    if (main)    main.style.marginLeft   = collapsed ? '58px'  : '278px';
                    if (header)  header.style.left       = collapsed ? '58px'  : '278px';

                    if (!animate) {
                        requestAnimationFrame(function () {
                            els.forEach(function(el) { if (el) el.style.transition = ''; });
                        });
                    }
                }

                // Aplica estado salvo sem animação
                var collapsed = localStorage.getItem(STORAGE) === '1';
                applyState(collapsed, false);

                // Bind do botão
                if (btn) {
                    btn.addEventListener('click', function () {
                        var isCollapsed = panel && panel.style.width === '0px';
                        localStorage.setItem(STORAGE, isCollapsed ? '0' : '1');
                        applyState(isCollapsed, true);
                    });
                }
            });
        </script>

    </body>
</html>
