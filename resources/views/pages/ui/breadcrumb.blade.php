<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Breadcrumbs')]
class extends Component {
    //
};
?>

<div class="kt-page">
    <!-- Container -->
    <div class="kt-page-header">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-medium leading-none text-mono">
                    Breadcrumb
                </h1>
                <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                    Displays a hierarchy of links to the current page or resource in an application.
                </div>
            </div>
            <div class="flex items-center gap-2.5">
                <a class="kt-btn kt-btn-outline" href="#">
                    Upload CSV
                </a>
                <a class="kt-btn kt-btn-primary" href="#">
                    Add User
                </a>
            </div>
        </div>
    </div>
    <!-- End of Container -->

    <!-- Container -->
    <div class="kt-apce-content">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 lg:gap-7.5">
            <div class="col-span-2">
                <div class="flex flex-col gap-5 lg:gap-7.5">
                    {{-- 1. Basic Usage --}}
                    <x-ui.card title="Basic Usage">
                        <div class="kt-card-content">
                            <x-ui.breadcrumb>
                                <x-ui.breadcrumb-item href="#" :first="true">Home</x-ui.breadcrumb-item>
                                <x-ui.breadcrumb-item href="#">Components</x-ui.breadcrumb-item>
                                <x-ui.breadcrumb-item :active="true">Breadcrumb</x-ui.breadcrumb-item>
                            </x-ui.breadcrumb>
                        </div>
                    </x-ui.card>

                    {{-- 2. Icon --}}
                    <x-ui.card title="Icon">
                        <div class="kt-card-content">
                            <x-ui.breadcrumb>
                                <x-ui.breadcrumb-item href="#" icon="house" :first="true"/>
                                <x-ui.breadcrumb-item href="#">Components</x-ui.breadcrumb-item>
                                <x-ui.breadcrumb-item :active="true">Breadcrumb</x-ui.breadcrumb-item>
                            </x-ui.breadcrumb>
                        </div>
                    </x-ui.card>

                    {{-- 3. Separator (dot) --}}
                    <x-ui.card title="Separator">
                        <div class="kt-card-content">
                            <x-ui.breadcrumb>
                                <x-ui.breadcrumb-item href="#" icon="house" :first="true" separator="dot"/>
                                <x-ui.breadcrumb-item href="#" separator="dot">Components</x-ui.breadcrumb-item>
                                <x-ui.breadcrumb-item :active="true" separator="dot">Breadcrumb</x-ui.breadcrumb-item>
                            </x-ui.breadcrumb>
                        </div>
                    </x-ui.card>

                    {{-- 4. Dropdown --}}
                    <x-ui.card title="Dropdown">
                        <div class="kt-card-content">
                            <x-ui.breadcrumb>
                                <x-ui.breadcrumb-item href="#" icon="house" :first="true"/>

                                {{-- item com dropdown inline —  o componente não tem prop para dropdown,
                                     então usamos o slot cru do breadcrumb-item --}}
                                <li class="kt-breadcrumb-separator">@svg('lucide-chevron-right')</li>
                                <li class="kt-breadcrumb-item">
                                    <div data-kt-dropdown="true" data-kt-dropdown-trigger="click">
                                        <button class="kt-btn kt-btn-icon kt-btn-dim" data-kt-dropdown-toggle="true">
                                            @svg('lucide-ellipsis')
                                        </button>
                                        <div class="kt-dropdown-menu w-40" data-kt-dropdown-menu="true">
                                            <ul class="kt-dropdown-menu-sub">
                                                <li><a href="#" class="kt-dropdown-menu-link">Documentation</a></li>
                                                <li><a href="#" class="kt-dropdown-menu-link">Themes</a></li>
                                                <li><a href="#" class="kt-dropdown-menu-link">Github</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <x-ui.breadcrumb-item href="#">Components</x-ui.breadcrumb-item>
                                <x-ui.breadcrumb-item :active="true">Breadcrumb</x-ui.breadcrumb-item>
                            </x-ui.breadcrumb>
                        </div>
                    </x-ui.card>

                    {{-- 5. Card --}}
                    <x-ui.card title="Card">
                        <div class="kt-card-content">
                            <div class="flex">
                                <x-ui.card>
                                    <div class="kt-card-content px-3.5 py-2">
                                        <x-ui.breadcrumb>
                                            <x-ui.breadcrumb-item href="#" icon="house" :first="true"/>
                                            <x-ui.breadcrumb-item href="#">Components</x-ui.breadcrumb-item>
                                            <x-ui.breadcrumb-item :active="true">Breadcrumb</x-ui.breadcrumb-item>
                                        </x-ui.breadcrumb>
                                    </div>
                                </x-ui.card>
                            </div>
                        </div>
                    </x-ui.card>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Container -->
</div>
