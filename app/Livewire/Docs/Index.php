<?php

namespace App\Livewire\Docs;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.admin.base')]
#[Title('Components - Docs')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.docs.index');
    }
}
