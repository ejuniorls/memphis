<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Link')]
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
                    Link
                </h1>
                <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                    Renders a clickable label or button styled as a huperlink.
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
                            <x-ui.link>Example link</x-ui.link>
                        </div>
                    </x-ui.card>

                    {{-- 2. Underline (aparece no hover) --}}
                    <x-ui.card title="Underline">
                        <div class="kt-card-content flex flex-wrap gap-4">
                            <x-ui.link :underline="true">Example underline link</x-ui.link>
                        </div>
                    </x-ui.card>

                    {{-- 3. Underlined (sempre sublinhado) --}}
                    <x-ui.card title="Underlined">
                        <div class="kt-card-content flex flex-wrap gap-4">
                            <x-ui.link :underlined="true">Example underlined link</x-ui.link>
                        </div>
                    </x-ui.card>

                    {{-- 4. Dashed --}}
                    <x-ui.card title="Dashed">
                        <div class="kt-card-content flex flex-wrap gap-4">
                            <x-ui.link :underlined="true" :dashed="true">Example dashed link</x-ui.link>
                        </div>
                    </x-ui.card>

                    {{-- 5. Inverse --}}
                    <x-ui.card title="Inverse">
                        <div class="kt-card-content">
                            <div class="flex flex-wrap gap-4 bg-mono rounded-md">
                                <div class="p-5">
                                    <x-ui.link :underlined="true" :inverse="true">Example inverse link</x-ui.link>
                                </div>
                            </div>
                        </div>
                    </x-ui.card>

                    {{-- 6. Mono --}}
                    <x-ui.card title="Mono">
                        <div class="kt-card-content flex flex-wrap gap-4">
                            <x-ui.link :underlined="true" :mono="true">Example mono link</x-ui.link>
                        </div>
                    </x-ui.card>

                    {{-- 7. Disabled --}}
                    <x-ui.card title="Disabled">
                        <div class="kt-card-content flex flex-wrap gap-4">
                            <x-ui.link :underlined="true" :disabled="true">Example disabled link</x-ui.link>
                        </div>
                    </x-ui.card>

                    {{-- 8. Size --}}
                    <x-ui.card title="Size">
                        <div class="kt-card-content inline-flex flex-col items-start gap-4">
                            <x-ui.link :underlined="true" size="sm">Small link</x-ui.link>
                            <x-ui.link :underlined="true">Default link</x-ui.link>
                            <x-ui.link :underlined="true" size="lg">Large link</x-ui.link>
                        </div>
                    </x-ui.card>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Container -->
</div>
