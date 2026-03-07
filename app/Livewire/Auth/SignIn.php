<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth.base')]
class SignIn extends Component
{
    public function render()
    {
        return view('livewire.auth.sign-in');
    }
}
