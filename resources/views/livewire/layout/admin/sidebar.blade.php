<!-- Sidebar -->
<div
    class="fixed w-(--sidebar-width) lg:top-(--header-height) top-0 bottom-0 z-20 hidden lg:flex flex-col items-stretch shrink-0 group py-3 lg:py-0 [--kt-drawer-enable:true] lg:[--kt-drawer-enable:false]"
    data-kt-drawer="true" data-kt-drawer-class="kt-drawer kt-drawer-start top-0 bottom-0" id="sidebar">
    <div class="flex grow shrink-0" id="sidebar_content">
        <div
            class="kt-scrollable-y-auto grow gap-2.5 shrink-0 flex items-center flex-col max-h-[calc(100dvh-10px))] lg:max-h-[calc(100dvh-70px))]">

            <x-ui.button
                tag="a"
                ghost=""
                iconOnly
                circle
                route="dashboard.main"
                kiIcon="chart-line-star"
                tooltip="{{ __('sidebar.dashboard') }}"
                class="size-10 border border-transparent text-secondary-foreground hover:bg-background hover:[&_i]:text-primary hover:border-input [.active&]:bg-background [.active&]:[&_i]:text-primary [.active&]:border-input"
            />

            <x-ui.button
                tag="a"
                ghost=""
                iconOnly
                circle
                route="account.index"
                kiIcon="profile-circle"
                tooltip="{{ __('sidebar.account') }}"
                class="size-10 border border-transparent text-secondary-foreground hover:bg-background hover:[&_i]:text-primary hover:border-input [.active&]:bg-background [.active&]:[&_i]:text-primary [.active&]:border-input"
            />

            <x-ui.button
                tag="a"
                ghost=""
                iconOnly
                circle
                route="documentation.index"
                kiIcon="question"
                tooltip="{{ __('sidebar.documentation') }}"
                class="size-10 border border-transparent text-secondary-foreground hover:bg-background hover:[&_i]:text-primary hover:border-input [.active&]:bg-background [.active&]:[&_i]:text-primary [.active&]:border-input"
            />
        </div>
    </div>
</div>
<!-- End of Sidebar -->
