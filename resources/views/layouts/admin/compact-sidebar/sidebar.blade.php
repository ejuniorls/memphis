@php
    $navItems = $menuTree->where('is_section_header', false)->values();
@endphp

    <!-- Sidebar -->
<div
    class="fixed w-(--sidebar-width) lg:top-(--header-height) top-0 bottom-0 z-20 hidden lg:flex flex-col items-stretch shrink-0 group py-3 lg:py-0 [--kt-drawer-enable:true] lg:[--kt-drawer-enable:false]"
    data-kt-drawer="true"
    data-kt-drawer-class="kt-drawer kt-drawer-start top-0 bottom-0"
    id="sidebar"
>
    <div class="flex grow shrink-0" id="sidebar_content">
        <div class="kt-scrollable-y-auto grow gap-2.5 shrink-0 flex items-center flex-col max-h-[calc(100dvh-10px))] lg:max-h-[calc(100dvh-70px))]">

            @foreach ($navItems as $item)
                @if (! $item->icon)
                    @continue
                @endif

                @php $isActive = $item->isActive() || $item->hasActiveChild(); @endphp

                <a
                    class="kt-btn kt-btn-ghost kt-btn-icon rounded-full size-10 border border-transparent
                           text-secondary-foreground
                           hover:bg-background hover:[&_i]:text-primary hover:border-input
                           [.active&]:bg-background [.active&]:[&_i]:text-primary [.active&]:border-input
                           {{ $isActive ? 'active' : '' }}"
                    href="{{ $item->url() }}"
                    data-kt-tooltip=""
                    data-kt-tooltip-placement="right"
                >
                    <span class="kt-menu-icon">
                        <i class="{{ $item->icon }} text-lg"></i>
                    </span>
                    <span class="kt-tooltip" data-kt-tooltip-content="true">
                        {{ $item->label }}
                    </span>
                </a>
            @endforeach

        </div>
    </div>
</div>
<!-- End of Sidebar -->
