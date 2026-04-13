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
            @include('layouts.admin.workspace.header')

            <!-- Wrapper -->
            <div class="flex flex-col lg:flex-row grow pt-(--header-height) lg:pt-0">
                @include('layouts.admin.workspace.sidebar')

                <!-- Main -->
                <div
                    class="flex grow rounded-xl bg-background border border-input lg:ms-(--sidebar-width) mt-0 lg:mt-5 m-5">
                    <div class="flex flex-col grow kt-scrollable-y-auto lg:[--kt-scrollbar-width:auto] pt-5"
                         id="scrollable_content">
                        <main class="grow" role="content">
                            @include('layouts.admin.workspace.toolbar')

                            <!-- Content -->
                            <main class="grow" id="content" role="content">
                                {{ $slot }}
                            </main>
                            <!-- End of Content -->

                            @include('layouts.admin.workspace.footer')
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
