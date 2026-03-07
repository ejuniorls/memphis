<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth.base')]
class SignUp extends Component
{
    public function render()
    {
        return view('livewire.auth.sign-up');
    }
}
