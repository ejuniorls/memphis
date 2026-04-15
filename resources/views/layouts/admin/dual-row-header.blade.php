<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
    <head>
        @include('partials.head')
        @livewireStyles
    </head>
    <body
        class="antialiased flex h-full text-base text-foreground bg-background [--header-height:54px] [--sidebar-width:200px]">
        @include('partials.theme-toggle')

        <!-- Page -->
        <!-- Main -->
        <div class="flex grow flex-col in-data-kt-[sticky-header=on]:pt-(--header-height)">
            @include('layouts.admin.dual-row-header.header')

            @include('layouts.admin.dual-row-header.navbar')

            <!-- Wrapper Container -->
            <div class="container-fixed w-full flex px-0 lg:ps-4">
                @include('layouts.admin.dual-row-header.sidebar')

                <!-- Content -->
                <main class="flex flex-col grow" id="content" role="content">
                    @include('layouts.admin.dual-row-header.toolbar')

                    {{ $slot }}

                    @include('layouts.admin.dual-row-header.footer')
                </main>
                <!-- End of Content -->
            </div>
            <!-- End of Wrapper Container -->
        </div>
        <!-- End of Main -->

        @include('partials.scripts')
        @livewireScripts
    </body>
</html>
