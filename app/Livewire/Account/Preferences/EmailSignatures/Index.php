<?php

namespace App\Livewire\Account\Preferences\EmailSignatures;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.base')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.account.preferences.email-signatures.index');
    }
}
