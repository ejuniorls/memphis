<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">

    <head>
        @include('partials.head')
        @livewireStyles
    </head>

    <body class="antialiased flex h-full text-base text-foreground bg-background [--header-height:78px]">
        @include('partials.theme-toggle')

        <!-- Page -->
        <!-- Main -->
        <div class="flex grow flex-col in-data-kt-[sticky-header=on]:pt-(--header-height)">
            @include('layouts.admin.extended-header.header')

            @include('layouts.admin.extended-header.navbar')

            <!-- Wrapper Container -->
            <div class="container-fixed w-full flex px-0">
                <!-- Content -->
                <main class="flex flex-col grow" id="content" role="content">
                    <!-- Toolbar -->
                    @include('layouts.admin.extended-header.toolbar')
                    <!-- End of Toolbar -->
                    <!-- Container -->
                    <div class="kt-container-fixed">
                        {{ $slot }}
                    </div>
                    <!-- End of Container -->
                    <!-- Footer -->
                    @include('layouts.admin.extended-header.footer')
                    <!-- End of Footer -->
                </main>
                <!-- End of Content -->

            </div>
            <!-- End of Page -->

        @include('partials.scripts')
        @livewireScripts
    </body>

</html>
