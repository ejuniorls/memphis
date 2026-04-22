<!-- Navbar -->
<div class="flex items-stretch lg:fixed z-5 top-(--header-height) start-(--sidebar-width) end-5 h-(--navbar-height) mx-5 lg:mx-0 bg-muted" id="navbar">
    <div class="rounded-t-xl border border-input border-b-input bg-background flex items-stretch grow">
        <!-- Container -->
        <div class="kt-container-fluid flex justify-between items-stretch gap-5">
            <div class="grid items-stretch">
                <div class="kt-scrollable-x-auto flex items-stretch">
                    @include('layouts.admin.compact-sidebar.partials.navbar-menu')
                </div>
            </div>

            {{-- Seletor de período (estático, não faz parte do menu dinâmico) --}}
            <div class="kt-menu kt-menu-default" data-kt-menu="true">
                <div class="flex items-center">
                    <div
                        class="kt-menu-item"
                        data-kt-menu-item-offset="0, 0"
                        data-kt-menu-item-placement="bottom-end"
                        data-kt-menu-item-toggle="dropdown"
                        data-kt-menu-item-trigger="hover"
                    >
                        <button class="kt-menu-toggle kt-btn kt-btn-outline flex-nowrap">
                            <span class="flex items-center me-1">
                                <i class="ki-filled ki-calendar text-base!"></i>
                            </span>
                            <span class="hidden md:inline text-nowrap">
                                September, 2025
                            </span>
                            <span class="inline md:hidden text-nowrap">
                                Sep, 2025
                            </span>
                            <span class="flex items-center lg:ms-4">
                                <i class="ki-filled ki-down text-xs!"></i>
                            </span>
                        </button>
                        <div class="kt-menu-dropdown w-48 py-2 kt-scrollable-y max-h-[250px]">
                            @foreach (['January','February','March','April','May','June','July','August','September','October','November','December'] as $month)
                                <div class="kt-menu-item {{ $month === 'September' ? 'active' : '' }}">
                                    <a class="kt-menu-link" href="#">
                                        <span class="kt-menu-title">{{ $month }}, 2024</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Container -->
    </div>
</div>
<!-- End of Navbar -->
