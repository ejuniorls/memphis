<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
    <head>
        @include('partials.head')
        @livewireStyles
    </head>
    <body
        class="demo1 kt-sidebar-fixed kt-header-fixed flex h-full bg-background text-base text-foreground antialiased">
        @include('partials.theme-toggle')

        <!-- Page -->
        <!-- Main -->
        <div class="flex grow">
            @include('layouts.admin.default.sidebar')

            <!-- Wrapper -->
            <div class="kt-wrapper flex grow flex-col">
                @persist('mega-menu')
                @include('layouts.admin.default.header')
                @endpersist

                <!-- Content -->
                <main class="grow pt-5" id="content" role="content">
                    {{ $slot }}
                </main>
                <!-- End of Content -->

                @include('layouts.admin.default.footer')
            </div>
            <!-- End of Wrapper -->
        </div>
        <!-- End of Main -->
        <!-- End of Page -->

        @include('partials.scripts')
        @livewireScripts
    </body>
</html>
