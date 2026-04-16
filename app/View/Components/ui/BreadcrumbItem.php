<?php

namespace App\View\Components\UI;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BreadcrumbItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string     $href = null,
        public bool        $active = false,
        public ?string     $icon = null,
        public string|bool $separator = 'chevron-right',
        public bool        $first = false,
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.breadcrumb-item');
    }
}
