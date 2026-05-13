<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Notifications')]
class extends Component {
    //
}; ?>

<div class="py-6">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-mono">{{ __('Notificações') }}</h1>
            <p class="text-sm text-secondary-foreground mt-1">{{ __('Gerencie suas notificações') }}</p>
        </div>
    </div>
</div>
