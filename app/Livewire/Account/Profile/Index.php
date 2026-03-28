<?php

namespace App\Livewire\Account\Profile;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.base')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.account.profile.index');
    }
}
