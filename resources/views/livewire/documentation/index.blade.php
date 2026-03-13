<!-- Container -->
<div class="kt-container-fluid">
    <div class="grid gap-5 lg:gap-7.5">
        <!-- begin: grid -->
        <div class="grid lg:grid-cols-1 gap-5 lg:gap-7.5 items-stretch">
            <div class="lg:col-span-2">
                <div class="kt-card h-full">
                    <div class="kt-card-content flex flex-col place-content-center gap-5">
                        <h1>Buttons</h1>

                        <h2>Basic Usage</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.button>Botão</x-ui.button>
                            <x-ui.button variant="secondary">Botão</x-ui.button>
                            <x-ui.button variant="destructive">Botão</x-ui.button>
                            <x-ui.button variant="mono">Botão</x-ui.button>
                            <x-ui.button variant="outline">Botão</x-ui.button>
                            <x-ui.button variant="ghost">Botão</x-ui.button>
                        </div>

                        <h2>Circle</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.button circle>Botão</x-ui.button>
                            <x-ui.button circle variant="secondary">Botão</x-ui.button>
                            <x-ui.button circle variant="destructive">Botão</x-ui.button>
                            <x-ui.button circle variant="mono">Botão</x-ui.button>
                            <x-ui.button circle variant="outline">Botão</x-ui.button>
                            <x-ui.button circle variant="ghost">Botão</x-ui.button>
                        </div>

                        <h2>Ghost</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.button ghost>Default</x-ui.button>
                            <x-ui.button ghost variant="primary">Primary</x-ui.button>
                            <x-ui.button ghost variant="destructive">Destructive</x-ui.button>
                        </div>

                        <h2>With Icon</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.button icon="ki-outline ki-setting-2">Primary</x-ui.button>
                            <x-ui.button icon="ki-outline ki-setting-2" variant="secondary">Secondary</x-ui.button>
                            <x-ui.button icon="ki-outline ki-setting-2" variant="destructive">Destructive</x-ui.button>
                            <x-ui.button icon="ki-outline ki-setting-2" variant="mono">Mono</x-ui.button>
                            <x-ui.button icon="ki-outline ki-setting-2" variant="outline">Outline</x-ui.button>
                            <x-ui.button icon="ki-outline ki-setting-2" variant="ghost">Ghost</x-ui.button>
                        </div>

                        <h2>Icon Only</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.button iconOnly icon="ki-outline ki-setting-2"></x-ui.button>
                            <x-ui.button iconOnly icon="ki-outline ki-setting-2" variant="secondary"></x-ui.button>
                            <x-ui.button iconOnly icon="ki-outline ki-setting-2" variant="destructive"></x-ui.button>
                            <x-ui.button iconOnly icon="ki-outline ki-setting-2" variant="mono"></x-ui.button>
                            <x-ui.button iconOnly icon="ki-outline ki-setting-2" variant="outline"></x-ui.button>
                        </div>

                        <h2>Size</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.button size="sm">Small</x-ui.button>
                            <x-ui.button>Default</x-ui.button>
                            <x-ui.button size="lg">Large</x-ui.button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-1">
                <div class="kt-card h-full">
                    <div class="kt-card-header">
                        <h3 class="kt-card-title">
                            Highlights
                        </h3>
                        <div class="kt-menu" data-kt-menu="true">
                            <div class="kt-menu-item kt-menu-item-dropdown" data-kt-menu-item-offset="0, 10px"
                                 data-kt-menu-item-placement="bottom-start" data-kt-menu-item-toggle="dropdown"
                                 data-kt-menu-item-trigger="click">
                                <button class="kt-menu-toggle kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost">
                                    <i class="ki-filled ki-dots-vertical text-lg">
                                    </i>
                                </button>
                                <div class="kt-menu-dropdown kt-menu-default w-full max-w-[200px]"
                                     data-kt-menu-dismiss="true">
                                    <div class="kt-menu-item">
                                        <a class="kt-menu-link" href="html/demo3/account/activity.html">
                                            <span class="kt-menu-icon">
                                                <i class="ki-filled ki-cloud-change">
                                                </i>
                                            </span>
                                            <span class="kt-menu-title">
                                                Activity
                                            </span>
                                        </a>
                                    </div>
                                    <div class="kt-menu-item">
                                        <a class="kt-menu-link" data-kt-modal-toggle="#share_profile_modal" href="#">
                                            <span class="kt-menu-icon">
                                                <i class="ki-filled ki-share">
                                                </i>
                                            </span>
                                            <span class="kt-menu-title">
                                                Share
                                            </span>
                                        </a>
                                    </div>
                                    <div class="kt-menu-item kt-menu-item-dropdown" data-kt-menu-item-offset="-15px, 0"
                                         data-kt-menu-item-placement="right-start" data-kt-menu-item-toggle="dropdown"
                                         data-kt-menu-item-trigger="click|lg:hover">
                                        <div class="kt-menu-link">
                                            <span class="kt-menu-icon">
                                                <i class="ki-filled ki-notification-status">
                                                </i>
                                            </span>
                                            <span class="kt-menu-title">
                                                Notifications
                                            </span>
                                            <span class="kt-menu-arrow">
                                                <i class="ki-filled ki-right text-xs rtl:transform rtl:rotate-180">
                                                </i>
                                            </span>
                                        </div>
                                        <div class="kt-menu-dropdown kt-menu-default w-full max-w-[175px]">
                                            <div class="kt-menu-item">
                                                <a class="kt-menu-link"
                                                   href="html/demo3/account/home/settings-sidebar.html">
                                                    <span class="kt-menu-icon">
                                                        <i class="ki-filled ki-sms">
                                                        </i>
                                                    </span>
                                                    <span class="kt-menu-title">
                                                        Email
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="kt-menu-item">
                                                <a class="kt-menu-link"
                                                   href="html/demo3/account/home/settings-sidebar.html">
                                                    <span class="kt-menu-icon">
                                                        <i class="ki-filled ki-message-notify">
                                                        </i>
                                                    </span>
                                                    <span class="kt-menu-title">
                                                        SMS
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="kt-menu-item">
                                                <a class="kt-menu-link"
                                                   href="html/demo3/account/home/settings-sidebar.html">
                                                    <span class="kt-menu-icon">
                                                        <i class="ki-filled ki-notification-status">
                                                        </i>
                                                    </span>
                                                    <span class="kt-menu-title">
                                                        Push
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-menu-item">
                                        <a class="kt-menu-link" data-kt-modal-toggle="#report_user_modal" href="#">
                                            <span class="kt-menu-icon">
                                                <i class="ki-filled ki-dislike">
                                                </i>
                                            </span>
                                            <span class="kt-menu-title">
                                                Report
                                            </span>
                                        </a>
                                    </div>
                                    <div class="kt-menu-separator">
                                    </div>
                                    <div class="kt-menu-item">
                                        <a class="kt-menu-link" href="html/demo3/account/home/settings-enterprise.html">
                                            <span class="kt-menu-icon">
                                                <i class="ki-filled ki-setting-3">
                                                </i>
                                            </span>
                                            <span class="kt-menu-title">
                                                Settings
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-card-content flex flex-col gap-4 p-5 lg:p-7.5 lg:pt-4">
                        <div class="flex flex-col gap-0.5">
                            <span class="text-sm font-normal text-secondary-foreground">
                                All time sales
                            </span>
                            <div class="flex items-center gap-2.5">
                                <span class="text-3xl font-semibold text-mono">
                                    $295.7k
                                </span>
                                <span class="kt-badge kt-badge-outline kt-badge-success kt-badge-sm">
                                    +2.7%
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center gap-1 mb-1.5">
                            <div class="bg-green-500 h-2 w-full max-w-[60%] rounded-xs">
                            </div>
                            <div class="bg-destructive h-2 w-full max-w-[25%] rounded-xs">
                            </div>
                            <div class="bg-violet-500 h-2 w-full max-w-[15%] rounded-xs">
                            </div>
                        </div>
                        <div class="flex items-center flex-wrap gap-4 mb-1">
                            <div class="flex items-center gap-1.5">
                                <span class="rounded-full size-2 rounded-full kt-badge-success">
                                </span>
                                <span class="text-sm font-normal text-foreground">
                                    Metronic
                                </span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="rounded-full size-2 rounded-full kt-badge-destructive">
                                </span>
                                <span class="text-sm font-normal text-foreground">
                                    Bundle
                                </span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <span class="rounded-full size-2 rounded-full kt-badge-info">
                                </span>
                                <span class="text-sm font-normal text-foreground">
                                    MetronicNest
                                </span>
                            </div>
                        </div>
                        <div class="border-b border-input">
                        </div>
                        <div class="grid gap-3">
                            <div class="flex items-center justify-between flex-wrap gap-2">
                                <div class="flex items-center gap-1.5">
                                    <i class="ki-filled ki-shop text-base text-muted-foreground">
                                    </i>
                                    <span class="text-sm font-normal text-mono">
                                        Online Store
                                    </span>
                                </div>
                                <div class="flex items-center text-sm font-medium text-foreground gap-6">
                                    <span class="lg:text-right">
                                        $172k
                                    </span>
                                    <span class="lg:text-right">
                                        <i class="ki-filled ki-arrow-up text-green-500">
                                        </i>
                                        3.9%
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between flex-wrap gap-2">
                                <div class="flex items-center gap-1.5">
                                    <i class="ki-filled ki-facebook text-base text-muted-foreground">
                                    </i>
                                    <span class="text-sm font-normal text-mono">
                                        Facebook
                                    </span>
                                </div>
                                <div class="flex items-center text-sm font-medium text-foreground gap-6">
                                    <span class="lg:text-right">
                                        $85k
                                    </span>
                                    <span class="lg:text-right">
                                        <i class="ki-filled ki-arrow-down text-destructive">
                                        </i>
                                        0.7%
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between flex-wrap gap-2">
                                <div class="flex items-center gap-1.5">
                                    <i class="ki-filled ki-instagram text-base text-muted-foreground">
                                    </i>
                                    <span class="text-sm font-normal text-mono">
                                        Instagram
                                    </span>
                                </div>
                                <div class="flex items-center text-sm font-medium text-foreground gap-6">
                                    <span class="lg:text-right">
                                        $36k
                                    </span>
                                    <span class="lg:text-right">
                                        <i class="ki-filled ki-arrow-up text-green-500">
                                        </i>
                                        8.2%
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between flex-wrap gap-2">
                                <div class="flex items-center gap-1.5">
                                    <i class="ki-filled ki-google text-base text-muted-foreground">
                                    </i>
                                    <span class="text-sm font-normal text-mono">
                                        Google
                                    </span>
                                </div>
                                <div class="flex items-center text-sm font-medium text-foreground gap-6">
                                    <span class="lg:text-right">
                                        $26k
                                    </span>
                                    <span class="lg:text-right">
                                        <i class="ki-filled ki-arrow-up text-green-500">
                                        </i>
                                        8.2%
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between flex-wrap gap-2">
                                <div class="flex items-center gap-1.5">
                                    <i class="ki-filled ki-shop text-base text-muted-foreground">
                                    </i>
                                    <span class="text-sm font-normal text-mono">
                                        Retail
                                    </span>
                                </div>
                                <div class="flex items-center text-sm font-medium text-foreground gap-6">
                                    <span class="lg:text-right">
                                        $7k
                                    </span>
                                    <span class="lg:text-right">
                                        <i class="ki-filled ki-arrow-down text-destructive">
                                        </i>
                                        0.7%
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end: grid -->
    </div>
</div>
<!-- End of Container -->
