<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
    <head>
        @include('partials.head')
        @livewireStyles
    </head>

    <body class="antialiased flex h-full text-base text-foreground bg-background">
        <!-- Theme Mode -->
        @include('partials.theme-toggle')
        <!-- End of Theme Mode -->

        <!-- Page -->
        <style>
            .page-bg {
                background-image: url('assets/media/images/2600x1200/bg-10.png');
            }

            .dark .page-bg {
                background-image: url('assets/media/images/2600x1200/bg-10-dark.png');
            }
        </style>

        <div class="flex items-center justify-center grow bg-center bg-no-repeat page-bg">
            {{ $slot }}
        </div>
        <!-- End of Page -->

        <!-- Scripts -->
        @include('partials.scripts')
        @livewireScripts
        <!-- End of Scripts -->
    </body>
</html>
