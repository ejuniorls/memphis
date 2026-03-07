<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth.base')]
class EnterEmail extends Component
{
    public function render()
    {
        return view('livewire.auth.enter-email');
    }
}
