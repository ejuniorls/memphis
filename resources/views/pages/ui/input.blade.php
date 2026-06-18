<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Input')]
class extends Component {
    //
}; ?>

<div class="flex flex-col gap-6 p-6">

    {{-- 1. Basic Usage --}}
    <x-ui.card title="Basic Usage">
        <div class="kt-card-content">
            <x-ui.input placeholder="Example input" />
        </div>
    </x-ui.card>

    {{-- 2. Disabled --}}
    <x-ui.card title="Disabled">
        <div class="kt-card-content">
            <x-ui.input placeholder="Example input" disabled />
        </div>
    </x-ui.card>

    {{-- 3. Readonly --}}
    <x-ui.card title="Readonly">
        <div class="kt-card-content">
            <x-ui.input placeholder="Example input" readonly />
        </div>
    </x-ui.card>

    {{-- 4. File --}}
    <x-ui.card title="File">
        <div class="kt-card-content">
            <x-ui.input type="file" />
        </div>
    </x-ui.card>

    {{-- 5. Icon --}}
    <x-ui.card title="Icon">
        <div class="kt-card-content space-y-6">

            {{-- Ícone à esquerda --}}
            <x-ui.input icon="mail" placeholder="Email address" />

            {{-- Ícone à direita --}}
            <x-ui.input icon-end="paperclip" placeholder="File name" />

            {{-- Botão ícone à esquerda --}}
            <x-ui.input :wrapper="true" placeholder="Clickable icon button">
                <x-ui.button size="xs" :icon-only="true" ghost="" class="-ms-0.5 size-6">
                    @svg('lucide-user', ['class' => 'size-4'])
                </x-ui.button>
                <input type="text" class="kt-input" placeholder="Clickable icon button" />
            </x-ui.input>

            {{-- Botão ícone à direita --}}
            <x-ui.input :wrapper="true">
                <input type="text" class="kt-input" placeholder="Clickable icon button" />
                <x-ui.button size="xs" :icon-only="true" ghost="" class="-me-1.5 size-6">
                    @svg('lucide-download', ['class' => 'size-4'])
                </x-ui.button>
            </x-ui.input>

        </div>
    </x-ui.card>

    {{-- 6. Group --}}
    <x-ui.card title="Group">
        <div class="kt-card-content space-y-6">

            {{-- Addon texto início --}}
            <div class="kt-input-group">
                <span class="kt-input-addon">Addon</span>
                <input class="kt-input" type="email" placeholder="Start addon" />
            </div>

            {{-- Addon texto fim --}}
            <div class="kt-input-group">
                <input class="kt-input" type="email" placeholder="End addon" />
                <span class="kt-input-addon">Addon</span>
            </div>

            {{-- Addon ícone início --}}
            <div class="kt-input-group">
                <span class="kt-input-addon kt-input-addon-icon">
                    @svg('lucide-euro')
                </span>
                <input class="kt-input" type="email" placeholder="Start icon addon" />
            </div>

            {{-- Addon ícone fim --}}
            <div class="kt-input-group">
                <input class="kt-input" type="email" placeholder="End icon addon" />
                <span class="kt-input-addon kt-input-addon-icon">
                    @svg('lucide-ticket-percent')
                </span>
            </div>

            {{-- Addon ícone início + botão fim --}}
            <div class="kt-input-group">
                <div class="kt-input-addon kt-input-addon-icon">
                    @svg('lucide-mail')
                </div>
                <input type="text" class="kt-input" placeholder="Email address" />
                <x-ui.button :outline="true">Button</x-ui.button>
            </div>

        </div>
    </x-ui.card>

    {{-- 7. Error --}}
    <x-ui.card title="Error">
        <div class="kt-card-content">
            <x-ui.input placeholder="Example input" :invalid="true" />
        </div>
    </x-ui.card>

    {{-- 8. Size --}}
    <x-ui.card title="Size">
        <div class="kt-card-content space-y-5">
            <x-ui.input size="sm" placeholder="Small" />
            <x-ui.input placeholder="Default" />
            <x-ui.input size="lg" placeholder="Large" />
        </div>
    </x-ui.card>

    {{-- 9. Form --}}
    <x-ui.card title="Form">
        <div class="kt-card-content">
            <form class="kt-form">
                <div class="kt-form-item">
                    <label class="kt-form-label">Email address:</label>
                    <div class="kt-form-control">
                        <x-ui.input type="text" placeholder="Email address" />
                    </div>
                    <div class="kt-form-description">Enter your email to proceed.</div>
                    <div class="kt-form-message">Please enter a valid email address.</div>
                </div>
                <div class="kt-form-item">
                    <label class="kt-form-label">Password:</label>
                    <div class="kt-form-control">
                        <x-ui.input type="password" placeholder="Password" :invalid="true" />
                    </div>
                    <div class="kt-form-description">Enter your password to proceed.</div>
                    <div class="kt-form-message">Please enter a valid password.</div>
                </div>
                <div class="kt-form-actions">
                    <x-ui.button type="reset" :outline="true">Reset</x-ui.button>
                    <x-ui.button type="submit">Submit</x-ui.button>
                </div>
            </form>
        </div>
    </x-ui.card>

</div>
