<?php

namespace App\View\Components\UI;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StepperStep extends Component
{
    public function render(): View|Closure|string
    {
        return view('components.ui.stepper-step');
    }
}
