<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Stepper')]
class extends Component {
    //
};
?>

@php
    $circle = 'shrink-0 rounded-full size-8 flex items-center justify-center text-sm font-semibold bg-muted text-muted-foreground kt-stepper-item-active:bg-primary kt-stepper-item-active:text-primary-foreground kt-stepper-item-completed:bg-green-500 kt-stepper-item-completed:text-white';
    $circleIcon = 'shrink-0 rounded-full size-8 flex items-center justify-center bg-muted text-muted-foreground kt-stepper-item-active:bg-primary kt-stepper-item-active:text-primary-foreground kt-stepper-item-completed:bg-green-500 kt-stepper-item-completed:text-white';
@endphp

<div class="kt-page">
    <!-- Container -->
    <div class="kt-page-header">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-medium leading-none text-mono">Stepper</h1>
                <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                    Visually guide users through multi-step processes or forms.
                </div>
            </div>
        </div>
    </div>
    <!-- End of Container -->

    <!-- Container -->
    <div class="kt-page-content">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 lg:gap-7.5">
            <div class="col-span-2">
                <div class="flex flex-col gap-5 lg:gap-7.5">

                    {{-- 1. Basic Usage --}}
                    <x-ui.card title="Basic Usage">
                        <div class="kt-card-content p-0" wire:ignore>
                            <form action="#" method="post">
                                <div data-kt-stepper="true">
                                    <div class="kt-card rounded-none border-0 border-t border-border shadow-none">
                                        <div class="kt-card-header w-full h-auto px-10 py-5">
                                            <div data-kt-stepper-item="#s1_1" class="active flex gap-2.5 items-center">
                                                <div class="{{ $circle }}">
                                                    <span data-kt-stepper-number="true" class="kt-stepper-item-completed:hidden">1</span>
                                                    @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-completed:inline'])
                                                </div>
                                                <div class="flex flex-col gap-0.5">
                                                    <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Step 1</h4>
                                                    <span class="text-sm text-muted-foreground kt-stepper-item-completed:opacity-70">Description</span>
                                                </div>
                                            </div>
                                            <div data-kt-stepper-item="#s1_2" class="flex gap-2.5 items-center">
                                                <div class="{{ $circle }}">
                                                    <span data-kt-stepper-number="true" class="kt-stepper-item-completed:hidden">2</span>
                                                    @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-completed:inline'])
                                                </div>
                                                <div class="flex flex-col gap-0.5">
                                                    <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Step 2</h4>
                                                    <span class="text-sm text-muted-foreground kt-stepper-item-completed:opacity-70">Description</span>
                                                </div>
                                            </div>
                                            <div data-kt-stepper-item="#s1_3" class="flex gap-2.5 items-center">
                                                <div class="{{ $circle }}">
                                                    <span data-kt-stepper-number="true" class="kt-stepper-item-completed:hidden">3</span>
                                                    @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-completed:inline'])
                                                </div>
                                                <div class="flex flex-col gap-0.5">
                                                    <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Step 3</h4>
                                                    <span class="text-sm text-muted-foreground kt-stepper-item-completed:opacity-70">Description</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-card-content px-5 py-20">
                                            <div id="s1_1"><div class="flex items-center justify-center text-lg font-semibold text-mono">Step 1</div></div>
                                            <div id="s1_2" class="hidden"><div class="flex items-center justify-center text-lg font-semibold text-mono">Step 2</div></div>
                                            <div id="s1_3" class="hidden"><div class="flex items-center justify-center text-lg font-semibold text-mono">Step 3</div></div>
                                        </div>
                                        <div class="kt-card-footer justify-between p-5">
                                            <div><button type="button" class="kt-btn kt-btn-secondary kt-stepper-first:hidden" data-kt-stepper-back="true">@svg('lucide-arrow-left') Back</button></div>
                                            <div>
                                                <button type="button" class="kt-btn kt-btn-secondary kt-stepper-last:hidden" data-kt-stepper-next="true">Next @svg('lucide-arrow-right')</button>
                                                <button type="submit" class="kt-btn hidden kt-stepper-last:inline-flex">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </x-ui.card>

                    {{-- 2. Vertical --}}
                    <x-ui.card title="Vertical">
                        <div class="kt-card-content p-0" wire:ignore>
                            <form action="#" method="post">
                                <div data-kt-stepper="true">
                                    <div class="kt-card rounded-none border-0 border-t border-border shadow-none">
                                        <div class="flex">
                                            <div class="flex w-44 shrink-0 flex-col gap-4 border-e border-border px-4 py-6">
                                                <div data-kt-stepper-item="#s2_1" class="active flex gap-2.5 items-start">
                                                    <div class="{{ $circle }}">
                                                        <span data-kt-stepper-number="true" class="kt-stepper-item-completed:hidden">1</span>
                                                        @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-completed:inline'])
                                                    </div>
                                                    <div class="flex min-w-0 flex-col gap-0.5">
                                                        <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Account</h4>
                                                        <span class="text-xs leading-snug text-muted-foreground kt-stepper-item-completed:opacity-70">Your personal details</span>
                                                    </div>
                                                </div>
                                                <div data-kt-stepper-item="#s2_2" class="flex gap-2.5 items-start">
                                                    <div class="{{ $circle }}">
                                                        <span data-kt-stepper-number="true" class="kt-stepper-item-completed:hidden">2</span>
                                                        @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-completed:inline'])
                                                    </div>
                                                    <div class="flex min-w-0 flex-col gap-0.5">
                                                        <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Billing</h4>
                                                        <span class="text-xs leading-snug text-muted-foreground kt-stepper-item-completed:opacity-70">Payment information</span>
                                                    </div>
                                                </div>
                                                <div data-kt-stepper-item="#s2_3" class="flex gap-2.5 items-start">
                                                    <div class="{{ $circle }}">
                                                        <span data-kt-stepper-number="true" class="kt-stepper-item-completed:hidden">3</span>
                                                        @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-completed:inline'])
                                                    </div>
                                                    <div class="flex min-w-0 flex-col gap-0.5">
                                                        <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Review</h4>
                                                        <span class="text-xs leading-snug text-muted-foreground kt-stepper-item-completed:opacity-70">Confirm and submit</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex min-w-0 flex-1 flex-col">
                                                <div class="kt-card-content flex flex-1 flex-col justify-center px-6 py-12">
                                                    <div id="s2_1"><div class="space-y-2 text-center"><div class="text-lg font-semibold text-mono">Account</div><p class="text-sm text-muted-foreground">Your personal details</p></div></div>
                                                    <div id="s2_2" class="hidden"><div class="space-y-2 text-center"><div class="text-lg font-semibold text-mono">Billing</div><p class="text-sm text-muted-foreground">Payment information</p></div></div>
                                                    <div id="s2_3" class="hidden"><div class="space-y-2 text-center"><div class="text-lg font-semibold text-mono">Review</div><p class="text-sm text-muted-foreground">Confirm and submit</p></div></div>
                                                </div>
                                                <div class="kt-card-footer justify-between p-5">
                                                    <div><button type="button" class="kt-btn kt-btn-secondary kt-stepper-first:hidden" data-kt-stepper-back="true">@svg('lucide-arrow-left') Back</button></div>
                                                    <div>
                                                        <button type="button" class="kt-btn kt-btn-secondary kt-stepper-last:hidden" data-kt-stepper-next="true">Next @svg('lucide-arrow-right')</button>
                                                        <button type="submit" class="kt-btn hidden kt-stepper-last:inline-flex">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </x-ui.card>

                    {{-- 3. With Icons --}}
                    <x-ui.card title="With Icons">
                        <div class="kt-card-content p-0" wire:ignore>
                            <form action="#" method="post">
                                <div data-kt-stepper="true">
                                    <div class="kt-card rounded-none border-0 border-t border-border shadow-none">
                                        <div class="kt-card-header w-full h-auto px-10 py-5">
                                            <div data-kt-stepper-item="#s3_1" class="active flex gap-2.5 items-center">
                                                <div class="{{ $circleIcon }}">
                                                    @svg('lucide-user', ['class' => 'size-4 hidden kt-stepper-item-active:inline kt-stepper-item-completed:inline'])
                                                    <span data-kt-stepper-number="true" class="text-sm font-semibold kt-stepper-item-active:hidden kt-stepper-item-completed:hidden">1</span>
                                                </div>
                                                <div class="flex flex-col gap-0.5">
                                                    <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Profile</h4>
                                                    <span class="text-sm text-muted-foreground kt-stepper-item-completed:opacity-70">Basic information</span>
                                                </div>
                                            </div>
                                            <div data-kt-stepper-item="#s3_2" class="flex gap-2.5 items-center">
                                                <div class="{{ $circleIcon }}">
                                                    @svg('lucide-credit-card', ['class' => 'size-4 hidden kt-stepper-item-active:inline kt-stepper-item-completed:inline'])
                                                    <span data-kt-stepper-number="true" class="text-sm font-semibold kt-stepper-item-active:hidden kt-stepper-item-completed:hidden">2</span>
                                                </div>
                                                <div class="flex flex-col gap-0.5">
                                                    <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Payment</h4>
                                                    <span class="text-sm text-muted-foreground kt-stepper-item-completed:opacity-70">Card details</span>
                                                </div>
                                            </div>
                                            <div data-kt-stepper-item="#s3_3" class="flex gap-2.5 items-center">
                                                <div class="{{ $circleIcon }}">
                                                    @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-active:inline kt-stepper-item-completed:inline'])
                                                    <span data-kt-stepper-number="true" class="text-sm font-semibold kt-stepper-item-active:hidden kt-stepper-item-completed:hidden">3</span>
                                                </div>
                                                <div class="flex flex-col gap-0.5">
                                                    <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Done</h4>
                                                    <span class="text-sm text-muted-foreground kt-stepper-item-completed:opacity-70">All set</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-card-content px-5 py-20">
                                            <div id="s3_1"><div class="flex items-center justify-center text-lg font-semibold text-mono">Profile</div></div>
                                            <div id="s3_2" class="hidden"><div class="flex items-center justify-center text-lg font-semibold text-mono">Payment</div></div>
                                            <div id="s3_3" class="hidden"><div class="flex items-center justify-center text-lg font-semibold text-mono">Done</div></div>
                                        </div>
                                        <div class="kt-card-footer justify-between p-5">
                                            <div><button type="button" class="kt-btn kt-btn-secondary kt-stepper-first:hidden" data-kt-stepper-back="true">@svg('lucide-arrow-left') Back</button></div>
                                            <div>
                                                <button type="button" class="kt-btn kt-btn-secondary kt-stepper-last:hidden" data-kt-stepper-next="true">Next @svg('lucide-arrow-right')</button>
                                                <button type="submit" class="kt-btn hidden kt-stepper-last:inline-flex">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </x-ui.card>

                    {{-- 4. On Modal --}}
                    <x-ui.card title="On Modal">
                        <div class="kt-card-content">
                            <x-ui.button data-kt-modal-toggle="#stepper-modal">Open wizard</x-ui.button>
                            <x-ui.modal id="stepper-modal" title="Setup wizard" top="5%" width="max-w-[500px]">
                                <div wire:ignore>
                                    <form action="#" method="post">
                                        <div data-kt-stepper="true">
                                            <div class="kt-card-header w-full h-auto px-2 py-4">
                                                <div data-kt-stepper-item="#s4_1" class="active flex gap-2.5 items-center">
                                                    <div class="{{ $circle }}">
                                                        <span data-kt-stepper-number="true" class="kt-stepper-item-completed:hidden">1</span>
                                                        @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-completed:inline'])
                                                    </div>
                                                    <div class="flex flex-col gap-0.5">
                                                        <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Step 1</h4>
                                                        <span class="text-xs text-muted-foreground kt-stepper-item-completed:opacity-70">Account setup</span>
                                                    </div>
                                                </div>
                                                <div data-kt-stepper-item="#s4_2" class="flex gap-2.5 items-center">
                                                    <div class="{{ $circle }}">
                                                        <span data-kt-stepper-number="true" class="kt-stepper-item-completed:hidden">2</span>
                                                        @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-completed:inline'])
                                                    </div>
                                                    <div class="flex flex-col gap-0.5">
                                                        <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Step 2</h4>
                                                        <span class="text-xs text-muted-foreground kt-stepper-item-completed:opacity-70">Preferences</span>
                                                    </div>
                                                </div>
                                                <div data-kt-stepper-item="#s4_3" class="flex gap-2.5 items-center">
                                                    <div class="{{ $circle }}">
                                                        <span data-kt-stepper-number="true" class="kt-stepper-item-completed:hidden">3</span>
                                                        @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-completed:inline'])
                                                    </div>
                                                    <div class="flex flex-col gap-0.5">
                                                        <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Step 3</h4>
                                                        <span class="text-xs text-muted-foreground kt-stepper-item-completed:opacity-70">Confirmation</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="px-2 py-10">
                                                <div id="s4_1"><div class="flex items-center justify-center text-base font-semibold text-mono">Step 1</div></div>
                                                <div id="s4_2" class="hidden"><div class="flex items-center justify-center text-base font-semibold text-mono">Step 2</div></div>
                                                <div id="s4_3" class="hidden"><div class="flex items-center justify-center text-base font-semibold text-mono">Step 3</div></div>
                                            </div>
                                            <div class="flex items-center justify-between pt-4 border-t border-border">
                                                <div><button type="button" class="kt-btn kt-btn-secondary kt-stepper-first:hidden" data-kt-stepper-back="true">@svg('lucide-arrow-left') Back</button></div>
                                                <div>
                                                    <button type="button" class="kt-btn kt-btn-secondary kt-stepper-last:hidden" data-kt-stepper-next="true">Next @svg('lucide-arrow-right')</button>
                                                    <button type="submit" class="kt-btn hidden kt-stepper-last:inline-flex">Finish</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </x-ui.modal>
                        </div>
                    </x-ui.card>

                    {{-- 5. Programmatic --}}
                    <x-ui.card title="Programmatic">
                        <div class="kt-card-content p-0" wire:ignore>
                            <form action="#" method="post">
                                <div id="stepper-programmatic" data-kt-stepper="true">
                                    <div class="kt-card rounded-none border-0 border-t border-border shadow-none">
                                        <div class="kt-card-header w-full h-auto px-10 py-5">
                                            <div data-kt-stepper-item="#s5_1" class="active flex gap-2.5 items-center">
                                                <button type="button" data-stepper-go="1" class="{{ $circle }} cursor-pointer">
                                                    <span data-kt-stepper-number="true" class="kt-stepper-item-completed:hidden">1</span>
                                                    @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-completed:inline'])
                                                </button>
                                                <div class="flex flex-col gap-0.5">
                                                    <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Step 1</h4>
                                                    <span class="text-sm text-muted-foreground kt-stepper-item-completed:opacity-70">Start here</span>
                                                </div>
                                            </div>
                                            <div data-kt-stepper-item="#s5_2" class="flex gap-2.5 items-center">
                                                <button type="button" data-stepper-go="2" class="{{ $circle }} cursor-pointer">
                                                    <span data-kt-stepper-number="true" class="kt-stepper-item-completed:hidden">2</span>
                                                    @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-completed:inline'])
                                                </button>
                                                <div class="flex flex-col gap-0.5">
                                                    <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Step 2</h4>
                                                    <span class="text-sm text-muted-foreground kt-stepper-item-completed:opacity-70">Continue</span>
                                                </div>
                                            </div>
                                            <div data-kt-stepper-item="#s5_3" class="flex gap-2.5 items-center">
                                                <button type="button" data-stepper-go="3" class="{{ $circle }} cursor-pointer">
                                                    <span data-kt-stepper-number="true" class="kt-stepper-item-completed:hidden">3</span>
                                                    @svg('lucide-check', ['class' => 'size-4 hidden kt-stepper-item-completed:inline'])
                                                </button>
                                                <div class="flex flex-col gap-0.5">
                                                    <h4 class="text-sm font-medium text-mono kt-stepper-item-completed:opacity-70">Step 3</h4>
                                                    <span class="text-sm text-muted-foreground kt-stepper-item-completed:opacity-70">Finish up</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-card-content px-5 py-20">
                                            <div id="s5_1"><div class="flex items-center justify-center text-lg font-semibold text-mono">Step 1</div></div>
                                            <div id="s5_2" class="hidden"><div class="flex items-center justify-center text-lg font-semibold text-mono">Step 2</div></div>
                                            <div id="s5_3" class="hidden"><div class="flex items-center justify-center text-lg font-semibold text-mono">Step 3</div></div>
                                        </div>
                                        <div class="kt-card-footer justify-between p-5">
                                            <div><button type="button" class="kt-btn kt-btn-secondary kt-stepper-first:hidden" data-kt-stepper-back="true">@svg('lucide-arrow-left') Back</button></div>
                                            <div>
                                                <button type="button" class="kt-btn kt-btn-secondary kt-stepper-last:hidden" data-kt-stepper-next="true">Next @svg('lucide-arrow-right')</button>
                                                <button type="submit" class="kt-btn hidden kt-stepper-last:inline-flex">Submit</button>
                                            </div>
                                        </div>
                                    </div>
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
