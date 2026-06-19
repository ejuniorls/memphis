<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Buttons')]
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
                    Button
                </h1>
                <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                    Renders a clickable button or an element styled as a button.
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
                        <div class="kt-card-content flex flex-wrap gap-4">
                            <x-ui.button>Primary</x-ui.button>
                            <x-ui.button variant="secondary">Secondary</x-ui.button>
                            <x-ui.button variant="info">info</x-ui.button>
                            <x-ui.button variant="destructive">Destructive</x-ui.button>
                            <x-ui.button variant="mono">Mono</x-ui.button>
                            <x-ui.button :outline="true">Outline</x-ui.button>
                            <x-ui.button ghost="">Ghost</x-ui.button>
                        </div>
                    </x-ui.card>

                    {{-- 2. Circle --}}
                    <x-ui.card title="Circle">
                        <div class="kt-card-content flex flex-wrap gap-4">
                            <x-ui.button :circle="true">Primary</x-ui.button>
                            <x-ui.button variant="secondary" :circle="true">Secondary</x-ui.button>
                            <x-ui.button variant="destructive" :circle="true">Destructive</x-ui.button>
                            <x-ui.button variant="mono" :circle="true">Mono</x-ui.button>
                            <x-ui.button :outline="true" :circle="true">Outline</x-ui.button>
                            <x-ui.button ghost="" :circle="true">Ghost</x-ui.button>
                        </div>
                    </x-ui.card>

                    {{-- 3. Ghost --}}
                    <x-ui.card title="Ghost">
                        <div class="kt-card-content flex flex-wrap gap-4">
                            <x-ui.button ghost="">Default</x-ui.button>
                            <x-ui.button ghost="primary">Primary</x-ui.button>
                            <x-ui.button ghost="destructive">Destructive</x-ui.button>
                        </div>
                    </x-ui.card>

                    {{-- 4. With Icon --}}
                    <x-ui.card title="With Icon">
                        <div class="kt-card-content flex flex-wrap gap-4">
                            <x-ui.button icon="settings">Primary</x-ui.button>
                            <x-ui.button variant="secondary" icon="settings">Secondary</x-ui.button>
                            <x-ui.button variant="destructive" icon="settings">Destructive</x-ui.button>
                            <x-ui.button variant="mono" icon="settings">Mono</x-ui.button>
                            <x-ui.button :outline="true" icon="settings">Outline</x-ui.button>
                            <x-ui.button ghost="" icon="settings">Ghost</x-ui.button>
                        </div>
                    </x-ui.card>

                    {{-- 5. Icon Only --}}
                    <x-ui.card title="Icon Only">
                        <div class="kt-card-content flex flex-wrap gap-4">
                            <x-ui.button :icon-only="true" icon="user-plus"/>
                            <x-ui.button variant="secondary" :icon-only="true" icon="user-plus"/>
                            <x-ui.button variant="destructive" :icon-only="true" icon="user-plus"/>
                            <x-ui.button variant="mono" :icon-only="true" icon="user-plus"/>
                            <x-ui.button :outline="true" :icon-only="true" icon="user-plus"/>
                            <x-ui.button ghost="" :icon-only="true" icon="user-plus"/>
                            <x-ui.button :dim="true" :icon-only="true" icon="user-plus"/>
                        </div>
                    </x-ui.card>

                    {{-- 6. Size --}}
                    <x-ui.card title="Size">
                        <div class="kt-card-content flex flex-wrap items-start gap-4">
                            <x-ui.button size="xs" icon="calendar-days">Extra Small</x-ui.button>
                            <x-ui.button size="sm" icon="calendar-days">Small</x-ui.button>
                            <x-ui.button icon="calendar-days">Default</x-ui.button>
                            <x-ui.button size="lg" icon="calendar-days">Large</x-ui.button>
                        </div>
                    </x-ui.card>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Container -->
</div>
