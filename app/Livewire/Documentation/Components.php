<?php

namespace App\Livewire\Documentation;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

#[Layout('layouts.admin.base')]
class Components extends Component
{
    #[Url(as: 'c')]
    public string $active = 'overview';

    public function mount(string $component = 'overview'): void
    {
        $valid = collect($this->getComponentsList())->flatMap(fn($g) => $g)->keys();
        $this->active = ($component === 'overview' || $valid->contains($component))
            ? $component
            : 'overview';
    }

    public function setActive(string $component): void
    {
        $valid = collect($this->getComponentsList())->flatMap(fn($g) => $g)->keys();
        $this->active = ($component === 'overview' || $valid->contains($component))
            ? $component
            : 'overview';
    }

    public function getComponentsList(): array
    {
        return [
            'General' => [
                'button' => ['label' => 'Button',     'icon' => 'lucide-mouse-pointer-2'],
                'badge'  => ['label' => 'Badge',      'icon' => 'lucide-tag'],
            ],
            'Feedback' => [
                'alert'  => ['label' => 'Alert',      'icon' => 'lucide-info'],
            ],
            'Layout' => [
                'card'      => ['label' => 'Card',      'icon' => 'lucide-square'],
                'accordion' => ['label' => 'Accordion', 'icon' => 'lucide-chevrons-up-down'],
            ],
            'Overlay' => [
                'modal' => ['label' => 'Modal', 'icon' => 'lucide-maximize-2'],
            ],
            'Data' => [
                'table' => ['label' => 'Table', 'icon' => 'lucide-table'],
            ],
            'Forms' => [
                'form-input' => ['label' => 'Form Input', 'icon' => 'lucide-text-cursor-input'],
                'select'     => ['label' => 'Select',     'icon' => 'lucide-chevrons-up-down'],
            ],
            'Navigation' => [
                'breadcrumb' => ['label' => 'Breadcrumb', 'icon' => 'lucide-chevrons-down'],
                'link' => ['label' => 'Link', 'icon' => 'lucide-link'],
            ]
        ];
    }

    public function render()
    {
        $components = $this->getComponentsList();
        $all = collect($components)->flatMap(fn($g) => $g);

        $currentComponent = $this->active === 'overview'
            ? ['label' => 'Introdução']
            : $all->get($this->active, ['label' => $this->active]);

        return view('livewire.documentation.components', [
            'components' => $components,
            'currentComponent' => $currentComponent,
        ])->title($currentComponent['label'] . ' — UI Docs');
    }
}
