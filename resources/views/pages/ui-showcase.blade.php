<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('UI Components')]
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
                    UI Components
                </h1>
                <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                    Build stunning Tailwind-based interfaces with ease using KtUI's open-source collection of
                    ultra-customizable UI components.
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
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-6">
            @foreach ([
                ['label' => 'Accordion',  'route' => 'pages::ui.accordion',  'icon' => 'chevrons-up-down'],
                ['label' => 'Alert',      'route' => 'pages::ui.alert',      'icon' => 'triangle-alert'],
                ['label' => 'Badge',      'route' => 'pages::ui.badge',      'icon' => 'tag'],
                ['label' => 'Breadcrumb', 'route' => 'pages::ui.breadcrumb', 'icon' => 'ellipsis'],
                ['label' => 'Button',     'route' => 'pages::ui.button',     'icon' => 'square-mouse-pointer'],
                ['label' => 'Card',       'route' => 'pages::ui.card',       'icon' => 'layout-panel-top'],
                ['label' => 'Checkbox',   'route' => 'pages::ui.checkbox',   'icon' => 'square-check'],
                ['label' => 'Input',      'route' => 'pages::ui.input',      'icon' => 'text-cursor-input'],
                ['label' => 'Link',       'route' => 'pages::ui.link',       'icon' => 'link'],
                ['label' => 'Modal',      'route' => 'pages::ui.modal',      'icon' => 'app-window'],
                ['label' => 'Pagination', 'route' => 'pages::ui.pagination', 'icon' => 'gallery-horizontal-end'],
                ['label' => 'Select',     'route' => 'pages::ui.select',     'icon' => 'chevron-down-square'],
                ['label' => 'Stepper',    'route' => 'pages::ui.stepper',    'icon' => 'list-ordered'],
                ['label' => 'Toast',      'route' => 'pages::ui.toast',      'icon' => 'bell'],
            ] as $item)
                <x-ui.card
                    tag="a"
                    :href="route($item['route'])"
                    class="flex flex-col items-center justify-center gap-3 p-6 text-center hover:border-primary/50 hover:shadow-sm transition-all group"
                >
                    <div class="size-10 rounded-lg bg-primary/10 flex items-center justify-center group-hover:bg-primary/20 transition-colors">
                        @svg('lucide-' . $item['icon'], ['class' => 'size-5 text-primary'])
                    </div>
                    <span class="text-sm font-medium text-foreground group-hover:text-primary transition-colors">
                        {{ $item['label'] }}
                    </span>
                </x-ui.card>
            @endforeach
        </div>
    </div>
    <!-- End of Container -->
</div>
