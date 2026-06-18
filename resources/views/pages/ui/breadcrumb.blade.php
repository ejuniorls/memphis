<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Breadcrumbs')]
class extends Component {
    //
}; ?>

<div class="flex flex-col gap-6 p-6">

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
