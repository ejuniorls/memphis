<!-- Header -->
<header class="fixed top-0 right-0 z-10 flex items-center bg-muted border-b border-input"
        id="top_sidebar_header"
        style="left: 278px; height: 58px; transition: left 0.3s;">
    <div class="flex items-center justify-between w-full px-4 gap-4">

        <!-- Botão collapse -->
        <div class="flex items-center">
            <button class="kt-btn kt-btn-icon kt-btn-ghost lg:hidden"
                    data-kt-drawer-toggle="#top_sidebar">
                <i class="ki-filled ki-menu text-lg"></i>
            </button>
            <button class="kt-btn kt-btn-icon kt-btn-ghost hidden lg:flex"
                    id="top_sidebar_toggle_btn"
                    title="{{ __('Toggle sidebar') }}">
                <i class="ki-filled ki-menu text-lg"></i>
            </button>
        </div>

        <!-- Topbar: search, chat, apps, notificações, user -->
        <div class="flex items-center gap-1 lg:gap-2">
            @include('partials.topbar-search-modal')
            @include('partials.topbar-chat')
            @include('partials.topbar-apps')
            @include('partials.topbar-notification-dropdown')
            @include('partials.topbar-user-dropdown')
        </div>

    </div>
</header>
<!-- End Header -->
