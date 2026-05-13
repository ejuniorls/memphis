<!-- Toolbar -->
<div class="pb-5">
    <div class="{{ config('layout.container') }} flex items-center justify-between flex-wrap gap-3">
        <div class="flex items-center flex-wrap gap-1 lg:gap-5">
            <h1 class="font-medium text-base text-mono">
            </h1>
            <div class="flex items-center flex-wrap gap-1 text-sm">
                <a class="text-secondary-foreground hover:text-primary" href="#">
                    Home
                </a>
            </div>
        </div>
        <div class="flex items-center flex-wrap gap-3">
            @include('partials.topbar-search-modal')
            @include('partials.topbar-notification-dropdown')
            <a class="kt-btn kt-btn-outline" href="#">
                <i class="ki-filled ki-exit-down"></i>
                Export
            </a>
        </div>
    </div>
</div>
<!-- End of Toolbar -->
