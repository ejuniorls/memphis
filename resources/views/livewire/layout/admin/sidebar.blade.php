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
                tooltip="Dashboard"
                class="size-10 border border-transparent text-secondary-foreground hover:bg-background hover:[&_i]:text-primary hover:border-input [.active&]:bg-background [.active&]:[&_i]:text-primary [.active&]:border-input"
            />

            <x-ui.button
                tag="a"
                ghost=""
                iconOnly
                circle
                route="demo3.index"
                kiIcon="calendar-tick"
                tooltip="Demandas"
                class="size-10 border border-transparent text-secondary-foreground hover:bg-background hover:[&_i]:text-primary hover:border-input [.active&]:bg-background [.active&]:[&_i]:text-primary [.active&]:border-input"
            />

            <x-ui.button
                tag="a"
                ghost=""
                iconOnly
                circle
                route="demo4.index"
                kiIcon="profile-circle"
                tooltip="Profile"
                class="size-10 border border-transparent text-secondary-foreground hover:bg-background hover:[&_i]:text-primary hover:border-input [.active&]:bg-background [.active&]:[&_i]:text-primary [.active&]:border-input"
            />

            <x-ui.button
                tag="a"
                ghost=""
                iconOnly
                circle
                route="demo4.index"
                kiIcon="setting-2"
                tooltip="Account"
                class="size-10 border border-transparent text-secondary-foreground hover:bg-background hover:[&_i]:text-primary hover:border-input [.active&]:bg-background [.active&]:[&_i]:text-primary [.active&]:border-input"
            />

            <x-ui.button
                tag="a"
                ghost=""
                iconOnly
                circle
                route="demo5.index"
                kiIcon="users"
                tooltip="Network"
                class="size-10 border border-transparent text-secondary-foreground hover:bg-background hover:[&_i]:text-primary hover:border-input [.active&]:bg-background [.active&]:[&_i]:text-primary [.active&]:border-input"
            />

            <x-ui.button
                tag="a"
                ghost=""
                iconOnly
                circle
                route="demo6.index"
                kiIcon="security-user"
                tooltip="Plans"
                class="size-10 border border-transparent text-secondary-foreground hover:bg-background hover:[&_i]:text-primary hover:border-input [.active&]:bg-background [.active&]:[&_i]:text-primary [.active&]:border-input"
            />

            <x-ui.button
                tag="a"
                ghost=""
                iconOnly
                circle
                route="demo7.index"
                kiIcon="messages"
                tooltip="Security Logs"
                class="size-10 border border-transparent text-secondary-foreground hover:bg-background hover:[&_i]:text-primary hover:border-input [.active&]:bg-background [.active&]:[&_i]:text-primary [.active&]:border-input"
            />

            <x-ui.button
                tag="a"
                ghost=""
                iconOnly
                circle
                route="demo8.index"
                kiIcon="shop"
                tooltip="Notifications"
                class="size-10 border border-transparent text-secondary-foreground hover:bg-background hover:[&_i]:text-primary hover:border-input [.active&]:bg-background [.active&]:[&_i]:text-primary [.active&]:border-input"
            />

            <x-ui.button
                tag="a"
                ghost=""
                iconOnly
                circle
                route="demo9.index"
                kiIcon="cheque"
                tooltip="ACL"
                class="size-10 border border-transparent text-secondary-foreground hover:bg-background hover:[&_i]:text-primary hover:border-input [.active&]:bg-background [.active&]:[&_i]:text-primary [.active&]:border-input"
            />

            <x-ui.button
                tag="a"
                ghost=""
                iconOnly
                circle
                route=""
                kiIcon="code"
                tooltip="API Keys"
                class="size-10 border border-transparent text-secondary-foreground hover:bg-background hover:[&_i]:text-primary hover:border-input [.active&]:bg-background [.active&]:[&_i]:text-primary [.active&]:border-input"
            />

            <x-ui.button
                tag="a"
                ghost=""
                iconOnly
                circle
                route="ui-docs.index"
                kiIcon="question"
                tooltip="Docs"
                class="size-10 border border-transparent text-secondary-foreground hover:bg-background hover:[&_i]:text-primary hover:border-input [.active&]:bg-background [.active&]:[&_i]:text-primary [.active&]:border-input"
            />
        </div>
    </div>
</div>
<!-- End of Sidebar -->
