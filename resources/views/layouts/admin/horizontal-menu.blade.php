<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
    <head>
        @include('partials.head')
        @livewireStyles
    </head>
    <body
        class="flex h-full bg-background text-base text-foreground antialiased [--header-height:100px] data-[kt-sticky-header=on]:[--header-height:60px]">
        @include('partials.theme-toggle')

        <!-- Main -->
        <div class="in-data-[kt-sticky-header=on]:pt-(--header-height) flex grow flex-col">
            <!-- Header -->
            @include('layouts.admin.horizontal-menu.header')

            <!-- Navbar -->
            @include('layouts.admin.horizontal-menu.navbar')

            <!-- Toolbar -->
            @include('layouts.admin.horizontal-menu.toolbar')

            <!-- Content -->
            <main class="grow" id="content" role="content">
                {{ $slot }}
            </main>

            <!-- Footer -->
            @include('layouts.admin.horizontal-menu.footer')
        </div>

        @include('partials.scripts')
        @livewireScripts
    </body>
</html>
