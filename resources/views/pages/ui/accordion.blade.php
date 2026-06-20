<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Accordions')]
class extends Component {
    //
};
?>

@php
    $faqs = [
    ['q' => 'How is pricing determined for each plan?',         'a' => 'KtUI embraces flexible licensing options that empower you to choose the perfect fit for your project\'s needs and budget.'],
    ['q' => 'What payment methods are accepted for subscriptions?', 'a' => 'KtUI embraces flexible licensing options that empower you to choose the perfect fit for your project\'s needs and budget.'],
    ['q' => 'Are there any hidden fees in the pricing?',        'a' => 'KtUI embraces flexible licensing options that empower you to choose the perfect fit for your project\'s needs and budget.'],
    ];
@endphp

<div class="kt-page">
    <!-- Container -->
    <div class="kt-page-header">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-medium leading-none text-mono">
                    Accordion
                </h1>
                <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                    Tailwind Accordion is a collapsible UI element built using Tailwind. It allows users to expand and
                    collapse sections of content by clicking on headers, revealing and hiding information on demand.
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
                    {{-- 1. Basic Usage --}}
                    <x-ui.card title="Basic Usage">
                        <div class="kt-card-content">
                            <x-ui.accordion>
                                @foreach ($faqs as $faq)
                                    <x-ui.accordion-item title="{{ $faq['q'] }}" indicator="plus-minus">
                                        {{ $faq['a'] }}
                                    </x-ui.accordion-item>
                                @endforeach
                            </x-ui.accordion>
                        </div>
                    </x-ui.card>

                    {{-- 2. Default Open --}}
                    <x-ui.card title="Default Open">
                        <div class="kt-card-content">
                            <x-ui.accordion>
                                @foreach ($faqs as $i => $faq)
                                    <x-ui.accordion-item title="{{ $faq['q'] }}" indicator="plus-minus"
                                                         :open="$i === 0">
                                        {{ $faq['a'] }}
                                    </x-ui.accordion-item>
                                @endforeach
                            </x-ui.accordion>
                        </div>
                    </x-ui.card>

                    {{-- 3. Expand All --}}
                    <x-ui.card title="Expand All">
                        <div class="kt-card-content">
                            <x-ui.accordion :expand-all="true">
                                @foreach ($faqs as $i => $faq)
                                    <x-ui.accordion-item title="{{ $faq['q'] }}" indicator="plus-minus"
                                                         :open="$i === 0">
                                        {{ $faq['a'] }}
                                    </x-ui.accordion-item>
                                @endforeach
                            </x-ui.accordion>
                        </div>
                    </x-ui.card>

                    {{-- 4. Outline Style --}}
                    <x-ui.card title="Outline Style">
                        <div class="kt-card-content">
                            <x-ui.accordion :outline="true" :expand-all="true">
                                @foreach ($faqs as $i => $faq)
                                    <x-ui.accordion-item title="{{ $faq['q'] }}" indicator="plus-minus"
                                                         :open="$i === 0">
                                        {{ $faq['a'] }}
                                    </x-ui.accordion-item>
                                @endforeach
                            </x-ui.accordion>
                        </div>
                    </x-ui.card>

                    {{-- 5. Flushed --}}
                    <x-ui.card title="Flushed">
                        <div class="kt-card-content">
                            <x-ui.accordion :flushed="true">
                                @foreach ($faqs as $i => $faq)
                                    <x-ui.accordion-item title="{{ $faq['q'] }}" indicator="plus-minus"
                                                         :open="$i === 0">
                                        {{ $faq['a'] }}
                                    </x-ui.accordion-item>
                                @endforeach
                            </x-ui.accordion>
                        </div>
                    </x-ui.card>

                    {{-- 6. Separated --}}
                    <x-ui.card title="Separated">
                        <div class="kt-card-content">
                            <x-ui.accordion :separated="true">
                                @foreach ($faqs as $i => $faq)
                                    <x-ui.accordion-item title="{{ $faq['q'] }}" indicator="plus-minus"
                                                         :open="$i === 0">
                                        {{ $faq['a'] }}
                                    </x-ui.accordion-item>
                                @endforeach
                            </x-ui.accordion>
                        </div>
                    </x-ui.card>

                    {{-- 7. Icon --}}
                    <x-ui.card title="Icon">
                        <div class="kt-card-content">
                            <x-ui.accordion>
                                <x-ui.accordion-item title="How is pricing determined for each plan?"
                                                     icon="circle-dollar-sign"
                                                     indicator="plus-minus">
                                    KtUI embraces flexible licensing options that empower you to choose the perfect fit
                                    for your
                                    project's needs and budget.
                                </x-ui.accordion-item>
                                <x-ui.accordion-item title="What payment methods are accepted for subscriptions?"
                                                     icon="credit-card"
                                                     indicator="plus-minus">
                                    KtUI embraces flexible licensing options that empower you to choose the perfect fit
                                    for your
                                    project's needs and budget.
                                </x-ui.accordion-item>
                                <x-ui.accordion-item title="Are there any hidden fees in the pricing?"
                                                     icon="shield-check"
                                                     indicator="plus-minus">
                                    KtUI embraces flexible licensing options that empower you to choose the perfect fit
                                    for your
                                    project's needs and budget.
                                </x-ui.accordion-item>
                            </x-ui.accordion>
                        </div>
                    </x-ui.card>

                    {{-- 8. Chevron Indicator --}}
                    <x-ui.card title="Chevron Indicator">
                        <div class="kt-card-content">
                            <x-ui.accordion>
                                @foreach ($faqs as $faq)
                                    <x-ui.accordion-item title="{{ $faq['q'] }}" indicator="chevron">
                                        {{ $faq['a'] }}
                                    </x-ui.accordion-item>
                                @endforeach
                            </x-ui.accordion>
                        </div>
                    </x-ui.card>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Container -->
</div>
