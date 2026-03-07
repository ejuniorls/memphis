<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout('layouts.admin.base')]
class Main extends Component
{
    public function render()
    {
        return view('livewire.dashboard.main');
    }
}
