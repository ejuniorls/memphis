<!DOCTYPE html>
<html class="h-full" data-kt-theme="true" data-kt-theme-mode="light" dir="ltr" lang="en">
    <head>
        @include('layouts.partials.head')
        @livewireStyles
    </head>
    <body class="antialiased flex h-full text-base text-foreground bg-background">
        <!-- Theme Mode -->
        <livewire:shared.theme-toggle/>
        <!-- End of Theme Mode -->

        <!-- Page -->
        <style>
            .branded-bg {
                background-image: url('assets/media/images/2600x1600/1.png');
            }

            .dark .branded-bg {
                background-image: url('assets/media/images/2600x1600/1-dark.png');
            }
        </style>
        <div class="grid lg:grid-cols-2 grow">
            <div class="flex justify-center items-center p-8 lg:p-10 order-2 lg:order-1">
                {{ $slot }}
            </div>

            <div
                class="lg:rounded-xl lg:border lg:border-border lg:m-5 order-1 lg:order-2 bg-top xxl:bg-center xl:bg-cover bg-no-repeat branded-bg">
                <div class="flex flex-col p-8 lg:p-16 gap-4">
                    <a href="html/demo1.html">
                        <img class="h-[28px] max-w-none" src="assets/media/app/mini-logo.svg"/>
                    </a>
                    <div class="flex flex-col gap-3">
                        <h3 class="text-2xl font-semibold text-mono">
                            Secure Access Portal
                        </h3>
                        <div class="text-base font-medium text-secondary-foreground">
                            A robust authentication gateway ensuring
                            <br/>
                            secure
                            <span class="text-mono font-semibold">
                                efficient user access
                            </span>
                            to the Metronic
                            <br/>
                            Dashboard interface.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Page -->

        @include('layouts.partials.scripts')
        @livewireScripts
    </body>
</html>
