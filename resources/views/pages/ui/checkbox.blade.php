<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Checkbox')]
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
                    Checkbox
                </h1>
                <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                    A control that allows the user to toggle between checked and not checked.
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
    <div class="kt-page-content">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 lg:gap-7.5">
            <div class="col-span-2">
                <div class="flex flex-col gap-5 lg:gap-7.5">
                    {{-- 1. Basic --}}
                    <x-ui.card title="Basic">
                        <div class="kt-card-content">
                            <x-ui.checkbox name="basic" label="Accept terms and conditions" />
                        </div>
                    </x-ui.card>

                    {{-- 2. Checked --}}
                    <x-ui.card title="Checked">
                        <div class="kt-card-content">
                            <x-ui.checkbox name="checked" label="Accept terms and conditions" :checked="true" />
                        </div>
                    </x-ui.card>

                    {{-- 3. Disabled --}}
                    <x-ui.card title="Disabled">
                        <div class="kt-card-content flex flex-col gap-3">
                            <x-ui.checkbox name="disabled_unchecked" label="Accept terms and conditions" :disabled="true" />
                            <x-ui.checkbox name="disabled_checked"   label="Accept terms and conditions" :disabled="true" :checked="true" />
                        </div>
                    </x-ui.card>

                    {{-- 4. Indeterminate (via JS) --}}
                    <x-ui.card title="Indeterminate">
                        <div class="kt-card-content">
                            <x-ui.checkbox name="indeterminate" label="Accept terms and conditions" x-ref="indeterminate" />
                        </div>
                        <x-slot:footer>
                            <p class="text-xs text-muted-foreground">O estado indeterminate é definido via JavaScript: <code>checkbox.indeterminate = true</code></p>
                        </x-slot:footer>
                    </x-ui.card>

                    {{-- 5. Mono --}}
                    <x-ui.card title="Mono">
                        <div class="kt-card-content">
                            {{-- NOTE: o componente não tem prop 'mono' — passamos a classe extra via atributo --}}
                            <label class="kt-label">
                                <input type="checkbox" class="kt-checkbox kt-checkbox-mono kt-checkbox-sm" checked value="1" />
                                <span class="kt-checkbox-label">Accept terms and conditions</span>
                            </label>
                        </div>
                    </x-ui.card>

                    {{-- 6. Size --}}
                    <x-ui.card title="Size">
                        <div class="kt-card-content space-y-4">
                            <x-ui.checkbox name="size_sm"      label="Small"   size="sm"  :checked="true" />
                            <x-ui.checkbox name="size_default"  label="Default" size="md"  :checked="true" />
                            <x-ui.checkbox name="size_lg"       label="Large"   size="lg"  :checked="true" />
                        </div>
                    </x-ui.card>

                    {{-- 7. Form --}}
                    <x-ui.card title="Form">
                        <div class="kt-card-content">
                            <form class="kt-form">
                                <div class="kt-form-item">
                                    <div class="kt-form-control kt-form-control-inline">
                                        <x-ui.checkbox name="form_check" label="Accept terms and conditions" />
                                    </div>
                                    <div class="kt-form-description">Please accept the terms and conditions.</div>
                                    <div class="kt-form-message">You need to accept the terms and conditions.</div>
                                </div>
                                <div class="kt-form-actions justify-start">
                                    <x-ui.button type="reset" :outline="true">Reset</x-ui.button>
                                    <x-ui.button type="submit">Submit</x-ui.button>
                                </div>
                            </form>
                        </div>
                    </x-ui.card>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Container -->
</div>
