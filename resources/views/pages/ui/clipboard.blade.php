<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Clipboard')]
class extends Component {
    //
}; ?>

<div class="kt-page">

    <div class="kt-page-header">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-medium leading-none text-mono">Clipboard</h1>
                <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                    Declarative copy/cut-to-clipboard behavior using data-kt-clipboard* attributes.
                </div>
            </div>
        </div>
    </div>

    <div class="kt-page-content">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 lg:gap-7.5">
            <div class="col-span-2">
                <div class="flex flex-col gap-5 lg:gap-7.5">

                    {{-- 1. Copy value (input) --}}
                    <x-ui.card title="Copy Value (Input)">
                        <div class="kt-card-content">
                            <div class="max-w-md w-full flex flex-col gap-3">
                                <x-ui.input id="clip_input_1" type="text" value="Hello from input" />
                                <p class="text-end">
                                    <x-ui.clipboard-button target="#clip_input_1" label="Copy value" variant="primary" />
                                </p>
                            </div>
                        </div>
                    </x-ui.card>

                    {{-- 2. Copy value (inline) --}}
                    <x-ui.card title="Copy Value (Inline)">
                        <div class="kt-card-content">
                            <div class="inline-flex items-center gap-3">
                                <input
                                    id="clip_input_2"
                                    type="text"
                                    class="kt-input shrink-0"
                                    style="width: 22rem; min-width: 22rem"
                                    value="npm i @keenthemes/ktui"
                                />
                                <x-ui.clipboard-button target="#clip_input_2" label="Copy" />
                            </div>
                        </div>
                    </x-ui.card>

                    {{-- 3. Predefined text (text wins over target) --}}
                    <x-ui.card title="Predefined Text">
                        <div class="kt-card-content">
                            <div class="max-w-md w-full flex flex-col gap-3">
                                <x-ui.alert id="clip_target_3" variant="info">
                                    This target exists, but the predefined text wins.
                                </x-ui.alert>
                                <p class="text-end">
                                    <x-ui.clipboard-button
                                        text="Predefined clipboard text"
                                        target="#clip_target_3"
                                        label="Copy predefined text"
                                        variant="primary"
                                    />
                                </p>
                            </div>
                        </div>
                    </x-ui.card>

                    {{-- 4. Predefined text (icon swap) --}}
                    <x-ui.card title="Icon Swap">
                        <div class="kt-card-content">
                            <div class="flex items-center justify-between gap-3 max-w-md w-full">
                                <div class="text-sm text-foreground">
                                    npm install @keenthemes/ktui
                                </div>
                                <button
                                    id="clip_btn_4"
                                    type="button"
                                    class="kt-btn kt-btn-outline kt-btn-sm inline-flex items-center gap-2"
                                    data-kt-clipboard="true"
                                    data-kt-clipboard-text="npm install @keenthemes/ktui"
                                    data-kt-clipboard-action="copy"
                                >
                                    <span data-role="icon-default" class="inline-flex">
                                        @svg('lucide-clipboard', ['class' => 'size-4'])
                                    </span>
                                    <span data-role="icon-success" class="hidden text-primary inline-flex">
                                        @svg('lucide-check', ['class' => 'size-4'])
                                    </span>
                                    <span data-role="text">Copy</span>
                                </button>
                            </div>
                        </div>
                    </x-ui.card>

                    {{-- 5. Cut value (input/textarea only) --}}
                    <x-ui.card title="Cut Value">
                        <div class="kt-card-content">
                            <div class="max-w-md w-full flex flex-col gap-3">
                                <x-ui.input id="clip_input_5" type="text" value="Cut me" />
                                <p class="text-end">
                                    <x-ui.clipboard-button
                                        target="#clip_input_5"
                                        action="cut"
                                        label="Cut value"
                                        variant="destructive"
                                    />
                                </p>
                            </div>
                        </div>
                    </x-ui.card>

                    {{-- 6. Copy from arbitrary target --}}
                    <x-ui.card title="Copy From Arbitrary Target">
                        <div class="kt-card-content">
                            <div class="max-w-md w-full flex flex-col gap-3">
                                <x-ui.alert id="clip_target_6" style="light">
                                    Copy target text content
                                </x-ui.alert>
                                <p class="text-end">
                                    <x-ui.clipboard-button target="#clip_target_6" label="Copy from target" variant="primary" />
                                </p>
                            </div>
                        </div>
                    </x-ui.card>

                    {{-- 7. Code block --}}
                    <x-ui.card title="Code Block">
                        <div class="kt-card-content">
                            <div class="max-w-xl w-full">
                                <div class="relative">
                                    <pre id="clip_code_7" class="rounded-lg p-4 bg-muted overflow-auto text-sm"><code>// Click to copy this block (plain text)
const answer = 42;
console.log(answer);</code></pre>
                                    <p class="text-end mt-3">
                                        <x-ui.clipboard-button target="#clip_code_7" label="Copy code" variant="primary" />
                                    </p>
                                </div>
                            </div>
                        </div>
                    </x-ui.card>

                    {{-- 8. Tooltip feedback --}}
                    <x-ui.card title="Tooltip Feedback">
                        <div class="kt-card-content">
                            <div class="max-w-md w-full">
                                <div class="flex items-center gap-2">
                                    <input type="hidden" id="clip_input_8" value="npm install @keenthemes/ktui" />
                                    <button
                                        id="clip_btn_8"
                                        type="button"
                                        class="kt-btn kt-btn-primary kt-btn-sm"
                                        data-kt-clipboard="true"
                                        data-kt-clipboard-target="#clip_input_8"
                                        data-kt-clipboard-action="copy"
                                        data-kt-tooltip="true"
                                        data-kt-tooltip-placement="top"
                                    >
                                        <span>Copy command</span>
                                        <span data-role="tooltip" data-kt-tooltip-content="true" class="kt-tooltip">Copy</span>
                                    </button>
                                    <span class="text-sm text-muted-foreground">
                                        <span class="font-mono">npm install @keenthemes/ktui</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </x-ui.card>

                </div>
            </div>
        </div>
    </div>

</div>

@script
<script>
    // Apenas os exemplos 4 (icon swap) e 8 (tooltip) precisam de script aqui —
    // os outros 6 usam o componente de botão de copiar, que já tem seu próprio
    // bloco de script embutido.
    (function () {
        var btn4 = document.getElementById('clip_btn_4');
        if (btn4) {
            var defaultIcon = btn4.querySelector('[data-role="icon-default"]');
            var successIcon = btn4.querySelector('[data-role="icon-success"]');
            var textEl4 = btn4.querySelector('[data-role="text"]');

            var reset4 = function () {
                if (defaultIcon) defaultIcon.classList.remove('hidden');
                if (successIcon) successIcon.classList.add('hidden');
                if (textEl4) textEl4.textContent = 'Copy';
            };

            btn4.addEventListener('click', reset4, { capture: true });

            btn4.addEventListener('kt.clipboard.success', function () {
                if (defaultIcon) defaultIcon.classList.add('hidden');
                if (successIcon) successIcon.classList.remove('hidden');
                if (textEl4) textEl4.textContent = 'Copied';
            });

            btn4.addEventListener('kt.clipboard.error', function () {
                if (textEl4) textEl4.textContent = 'Error';
            });
        }

        var btn8 = document.getElementById('clip_btn_8');
        if (btn8) {
            var tooltip = btn8.querySelector('[data-role="tooltip"]');
            var setTooltipText = function (text) {
                if (!tooltip) return;
                tooltip.textContent = text;
                clearTimeout(setTooltipText._t);
                setTooltipText._t = setTimeout(function () {
                    tooltip.textContent = 'Copy';
                }, 1200);
            };

            btn8.addEventListener('kt.clipboard.success', function () {
                setTooltipText('Copied');
            });
            btn8.addEventListener('kt.clipboard.error', function () {
                setTooltipText('Error');
            });
        }
    })();
</script>
@endscript
