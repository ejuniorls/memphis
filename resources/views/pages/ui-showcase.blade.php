<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('UI Components')]
class extends Component {
    //
}; ?>

<div class="kt-container-fluid py-8">

    <div class="flex flex-col gap-1 mb-8">
        <h1 class="text-2xl font-bold text-mono">UI Components</h1>
        <p class="text-sm text-secondary-foreground">Biblioteca de componentes Blade reutilizáveis do projeto Memphis.</p>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">

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
            ['label' => 'Select',     'route' => 'pages::ui.select',     'icon' => 'chevron-down-square'],
            ['label' => 'Toast',      'route' => 'pages::ui.toast',      'icon' => 'bell'],
        ] as $component)
            <a
                href="{{ route($component['route']) }}"
                wire:navigate
                class="kt-card flex flex-col items-center justify-center gap-3 p-6 text-center hover:border-primary/50 hover:shadow-sm transition-all group"
            >
                <div class="size-10 rounded-lg bg-primary/10 flex items-center justify-center group-hover:bg-primary/20 transition-colors">
                    @svg('lucide-' . $component['icon'], ['class' => 'size-5 text-primary'])
                </div>
                <span class="text-sm font-medium text-foreground group-hover:text-primary transition-colors">
                    {{ $component['label'] }}
                </span>
            </a>
        @endforeach

    </div>

</div>
