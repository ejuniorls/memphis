<?php

namespace App\Livewire\Account\Profile\Education;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin.base')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.account.profile.education.index');
    }
}
