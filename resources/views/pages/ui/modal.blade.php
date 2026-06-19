<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Modal')]
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
                    Modal
                </h1>
                <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                    Modal allows to add interactive elements, like forms or logins, to a dialog that appears on top of your page content, focusing user attention.
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
                            <x-ui.button data-kt-modal-toggle="#modal_basic">Show Modal</x-ui.button>

                            <x-ui.modal id="modal_basic" title="Modal Title" top="10%">
                                <div class="rounded-lg bg-muted w-full h-[200px]"></div>
                            </x-ui.modal>
                        </div>
                    </x-ui.card>

                    {{-- 2. Footer --}}
                    <x-ui.card title="Footer">
                        <div class="kt-card-content">
                            <x-ui.button data-kt-modal-toggle="#modal_footer">Show Modal</x-ui.button>

                            <x-ui.modal id="modal_footer" title="Modal Title" top="5%">
                                <div class="rounded-lg bg-muted w-full h-[200px]"></div>
                                <x-slot:footer>
                                    <div></div>
                                    <div class="flex gap-4">
                                        <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_footer">Cancel
                                        </x-ui.button>
                                        <x-ui.button>Submit</x-ui.button>
                                    </div>
                                </x-slot:footer>
                            </x-ui.modal>
                        </div>
                    </x-ui.card>

                    {{-- 3. Center --}}
                    <x-ui.card title="Center">
                        <div class="kt-card-content">
                            <x-ui.button data-kt-modal-toggle="#modal_center">Show Modal</x-ui.button>

                            <x-ui.modal id="modal_center" title="Modal Title" :center="true">
                                <div class="rounded-lg bg-muted w-full h-[200px]"></div>
                            </x-ui.modal>
                        </div>
                    </x-ui.card>

                    {{-- 4. Scrollable --}}
                    <x-ui.card title="Scrollable">
                        <div class="kt-card-content">
                            <x-ui.button data-kt-modal-toggle="#modal_scrollable">Show Modal</x-ui.button>

                            <x-ui.modal id="modal_scrollable" title="Modal Title" top="10%" :scrollable="true"
                                        max-body-height="200px" footer-class="gap-2.5">
                                <div class="rounded-lg bg-muted w-full h-[600px]"></div>
                                <x-slot:footer>
                                    <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_scrollable">Cancel
                                    </x-ui.button>
                                    <x-ui.button>Submit</x-ui.button>
                                </x-slot:footer>
                            </x-ui.modal>
                        </div>
                    </x-ui.card>

                    {{-- 5. Long Content --}}
                    <x-ui.card title="Long Content">
                        <div class="kt-card-content">
                            <x-ui.button data-kt-modal-toggle="#modal_long">Show Modal</x-ui.button>

                            <x-ui.modal id="modal_long" title="Modal Title" :center="true" class="max-h-[95%]">
                                <div class="rounded-lg bg-muted w-full h-[600px]"></div>
                                <x-slot:footer>
                                    <div class="flex gap-4">
                                        <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_long">Cancel
                                        </x-ui.button>
                                        <x-ui.button>Submit</x-ui.button>
                                    </div>
                                </x-slot:footer>
                            </x-ui.modal>
                        </div>
                    </x-ui.card>

                    {{-- 6. Static Backdrop --}}
                    <x-ui.card title="Static Backdrop">
                        <div class="kt-card-content">
                            <x-ui.button data-kt-modal-toggle="#modal_static">Show Modal</x-ui.button>

                            <x-ui.modal id="modal_static" title="Modal Title" top="10%" :backdrop-static="true">
                                <div class="rounded-lg bg-muted w-full h-[200px]"></div>
                            </x-ui.modal>
                        </div>
                    </x-ui.card>

                    {{-- 7. No Backdrop --}}
                    <x-ui.card title="No Backdrop">
                        <div class="kt-card-content">
                            <x-ui.button data-kt-modal-toggle="#modal_no_backdrop">Show Modal</x-ui.button>

                            <x-ui.modal id="modal_no_backdrop" title="Modal Title" :center="true" :backdrop="false"
                                        class="border border-border">
                                <div class="rounded-lg bg-muted w-full h-[200px]"></div>
                            </x-ui.modal>
                        </div>
                    </x-ui.card>

                    {{-- 8. Persistent --}}
                    <x-ui.card title="Persistent">
                        <div class="kt-card-content">
                            <x-ui.button data-kt-modal-toggle="#modal_persistent">Show Modal</x-ui.button>

                            <x-ui.modal id="modal_persistent" title="Modal Title" :fit="true" :center="true"
                                        :backdrop="false"
                                        :persistent="true">
                                <div class="rounded-lg bg-muted w-full h-[200px]"></div>
                            </x-ui.modal>
                        </div>
                    </x-ui.card>

                    {{-- 9. Toggle Modals --}}
                    <x-ui.card title="Toggle Modals">
                        <div class="kt-card-content">
                            <x-ui.button data-kt-modal-toggle="#modal_toggle_one">Show Modal</x-ui.button>

                            <x-ui.modal id="modal_toggle_one" title="Modal Title" top="10%" size="sm">
                                <div class="rounded-lg bg-muted w-full h-[250px]"></div>
                                <x-slot:footer>
                                    <x-ui.button data-kt-modal-toggle="#modal_toggle_two">Launch Another Modal
                                    </x-ui.button>
                                </x-slot:footer>
                            </x-ui.modal>

                            <x-ui.modal id="modal_toggle_two" title="Modal Title" top="5%">
                                <div class="rounded-lg bg-muted w-full h-[250px]"></div>
                                <x-slot:footer>
                                    <x-ui.button data-kt-modal-toggle="#modal_toggle_one">Launch Previous Modal
                                    </x-ui.button>
                                </x-slot:footer>
                            </x-ui.modal>
                        </div>
                    </x-ui.card>

                    {{-- 10. Input Auto-focus --}}
                    <x-ui.card title="Input Auto-focus">
                        <div class="kt-card-content">
                            <x-ui.button data-kt-modal-toggle="#modal_autofocus">Show Modal</x-ui.button>

                            <x-ui.modal id="modal_autofocus" title="Modal Title" top="10%">
                                <x-ui.input placeholder="Modal input..." data-kt-modal-input-focus="true"/>
                                <div class="rounded-lg bg-muted w-full mt-5 h-[175px]"></div>
                            </x-ui.modal>
                        </div>
                    </x-ui.card>

                    {{-- 11. Page Scroll --}}
                    <x-ui.card title="Page Scroll">
                        <div class="kt-card-content">
                            <x-ui.button data-kt-modal-toggle="#modal_page_scroll">Show Modal</x-ui.button>

                            <x-ui.modal id="modal_page_scroll" title="Modal Title" top="10%" :disable-scroll="false">
                                <div class="rounded-lg bg-muted w-full h-[250px]"></div>
                            </x-ui.modal>
                        </div>
                    </x-ui.card>

                    {{-- 12. Full Width --}}
                    <x-ui.card title="Full Width">
                        <div class="kt-card-content">
                            <x-ui.button data-kt-modal-toggle="#modal_full_width">Show Modal</x-ui.button>

                            <x-ui.modal id="modal_full_width" title="Modal Title" :center="true" size="full">
                                <div class="rounded-lg bg-muted w-full h-[200px]"></div>
                            </x-ui.modal>
                        </div>
                    </x-ui.card>

                    {{-- 13. Overlay --}}
                    <x-ui.card title="Overlay">
                        <div class="kt-card-content">
                            <x-ui.button data-kt-modal-toggle="#modal_overlay">Show Modal</x-ui.button>

                            <x-ui.modal id="modal_overlay" title="Modal Title" :overlay="true" size="full"
                                        footer-align="end">
                                <div class="rounded-lg bg-muted w-full h-[800px]"></div>
                                <x-slot:footer>
                                    <div class="flex gap-4">
                                        <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_overlay">Cancel
                                        </x-ui.button>
                                        <x-ui.button>Submit</x-ui.button>
                                    </div>
                                </x-slot:footer>
                            </x-ui.modal>
                        </div>
                    </x-ui.card>

                    {{-- 14. Sizes --}}
                    <x-ui.card title="Sizes">
                        <div class="kt-card-content flex gap-4">
                            <x-ui.button data-kt-modal-toggle="#modal_size_sm">Small</x-ui.button>
                            <x-ui.button data-kt-modal-toggle="#modal_size_md">Medium</x-ui.button>
                            <x-ui.button data-kt-modal-toggle="#modal_size_lg">Large</x-ui.button>

                            <x-ui.modal id="modal_size_sm" title="Modal Title" top="10%" width="max-w-[300px]">
                                <div class="rounded-lg bg-muted w-full h-[250px]"></div>
                            </x-ui.modal>

                            <x-ui.modal id="modal_size_md" title="Modal Title" top="10%">
                                <div class="rounded-lg bg-muted w-full h-[250px]"></div>
                            </x-ui.modal>

                            <x-ui.modal id="modal_size_lg" title="Modal Title" top="10%" width="max-w-[500px]">
                                <div class="rounded-lg bg-muted w-full h-[250px]"></div>
                            </x-ui.modal>
                        </div>
                    </x-ui.card>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Container -->
</div>
