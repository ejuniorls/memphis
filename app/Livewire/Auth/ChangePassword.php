<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth.base')]
class ChangePassword extends Component
{
    public function render()
    {
        return view('livewire.auth.change-password');
    }
}
