<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Appearance')]
class extends Component {
    //
}; ?>

{{-- Div raiz obrigatória do Livewire --}}
<div>

    {{-- ------------------------------------------------------------------ --}}
    {{-- Toolbar: breadcrumb à esquerda, ações à direita                    --}}
    {{-- ------------------------------------------------------------------ --}}
    <x-slot name="toolbar">
        <x-ui.breadcrumb>
            <x-ui.breadcrumb-item :first="true" href="{{ route('dashboard') }}">
                {{ __('Home') }}
            </x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item :active="true">
                {{ __('pages.account.profile.page_heading') }}
            </x-ui.breadcrumb-item>
        </x-ui.breadcrumb>
    </x-slot>

    <x-slot name="toolbarActions">
        <x-ui.button tag="a" href="#" :outline="true" size="sm" icon="download">
            {{ __('Export') }}
        </x-ui.button>
    </x-slot>

    {{-- ------------------------------------------------------------------ --}}
    {{-- Conteúdo                                                            --}}
    {{-- ------------------------------------------------------------------ --}}
    <div class="py-6">

        {{-- Título da página --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-mono">{{ __('pages.account.profile.page_heading') }}</h1>
            <p class="text-sm text-secondary-foreground mt-1">{{ __('pages.account.profile.page_subheading') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        </div>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('toast', ({ variant, message }) => {
                KTToast.show({ message, variant });
            });
        });
    </script>

</div>
