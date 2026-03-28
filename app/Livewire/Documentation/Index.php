<?php

namespace App\Livewire\Documentation;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin.base')]
#[Title('Components - Docs')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.documentation.index');
    }
}
