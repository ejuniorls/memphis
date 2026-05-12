<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
    <head>
        @include('partials.head')
        @livewireStyles
    </head>
    <body
        class="antialiased flex h-full text-base text-foreground bg-background [--header-height:60px] [--sidebar-width:290px] bg-muted! lg:overflow-hidden">
        @include('partials.scripts')

        <!-- Page -->
        <!-- Base -->
        <div class="flex grow">
            @include('layouts.admin.two-column-sidebar.header')

            <!-- Wrapper -->
            <div class="flex flex-col lg:flex-row grow pt-(--header-height) lg:pt-0">
                @include('layouts.admin.two-column-sidebar.sidebar')

                <!-- Main -->
                <div
                    class="flex grow rounded-xl bg-background border border-input lg:ms-(--sidebar-width) mt-0 lg:mt-5 m-5">
                    <div class="flex flex-col grow kt-scrollable-y-auto lg:[--kt-scrollbar-width:auto] pt-5"
                         id="scrollable_content">
                        <main class="grow" role="content">
                            @include('layouts.admin.two-column-sidebar.toolbar')

                            <!-- Content -->
                            <main class="grow" id="content" role="content">
                                <div class="{{ config('layout.container') }}">
                                    {{ $slot }}
                                </div>
                            </main>
                            <!-- End of Content -->

                            @include('layouts.admin.two-column-sidebar.footer')
                        </main>
                    </div>
                </div>
                <!-- End of Main -->
            </div>
            <!-- End of Wrapper -->
        </div>
        <!-- End of Base -->
        <!-- End of Page -->

        @include('partials.scripts')
        @livewireScripts
    </body>
</html>
