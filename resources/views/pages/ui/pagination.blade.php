<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Pagination')]
class extends Component {
    //
};
?>

@php
    $pages = [
        ['label' => '1', 'href' => '#', 'active' => false],
        ['label' => '2', 'href' => '#', 'active' => true],
        ['label' => '3', 'href' => '#', 'active' => false],
    ];
@endphp

<div class="kt-page">
    <!-- Container -->
    <div class="kt-page-header">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-medium leading-none text-mono">Pagination</h1>
                <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                    Displays a list of pages or content items with navigation controls.
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
                        <div class="kt-card-content">
                            <x-ui.pagination
                                :pages="$pages"
                                :ellipsis="true"
                                prev-label="Previous"
                                next-label="Next"
                            />
                        </div>
                    </x-ui.card>

                    {{-- 2. Icon --}}
                    <x-ui.card title="Icon">
                        <div class="kt-card-content">
                            <x-ui.pagination
                                :pages="$pages"
                                :ellipsis="true"
                                :show-first="true"
                                :show-last="true"
                                :prev-label="null"
                                :next-label="null"
                            />
                        </div>
                    </x-ui.card>

                    {{-- 3. Card --}}
                    <x-ui.card title="Card">
                        <div class="kt-card-content">
                            <div class="flex">
                                <x-ui.card>
                                    <div class="kt-card-content p-1">
                                        <x-ui.pagination
                                            :pages="$pages"
                                            :ellipsis="true"
                                            :show-first="true"
                                            :show-last="true"
                                            :prev-label="null"
                                            :next-label="null"
                                        />
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
