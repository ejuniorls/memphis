<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth.base')]
class PasswordChanged extends Component
{
    public function render()
    {
        return view('livewire.auth.password-changed');
    }
}
