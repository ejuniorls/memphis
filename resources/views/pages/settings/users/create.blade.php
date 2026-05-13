<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Novo Usuário')]
class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $job_title = '';
    public string $company = '';
    public string $location = '';
    public bool $send_welcome = true;

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'job_title' => ['nullable', 'string', 'max:100'],
            'company' => ['nullable', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:100'],
        ];
    }

    protected $messages = [
        'name.required' => 'O nome é obrigatório.',
        'email.required' => 'O e-mail é obrigatório.',
        'email.email' => 'Informe um e-mail válido.',
        'email.unique' => 'Este e-mail já está em uso.',
        'password.required' => 'A senha é obrigatória.',
        'password.confirmed' => 'As senhas não coincidem.',
    ];

    public function save(): void
    {
        $validated = $this->validate();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'job_title' => $validated['job_title'] ?? null,
            'company' => $validated['company'] ?? null,
            'location' => $validated['location'] ?? null,
        ]);

        if ($this->send_welcome) {
            $user->notify(new \App\Notifications\Auth\Welcome());
        }

        session()->flash('toast_success', 'Usuário criado com sucesso.');
        $this->redirectRoute('settings.users.index', navigate: true);
    }

    public function cancel(): void
    {
        $this->redirectRoute('settings.users.index', navigate: true);
    }
}; ?>

<div>

    <x-slot name="toolbar">
        <x-ui.breadcrumb>
            <x-ui.breadcrumb-item :first="true" href="{{ route('dashboard') }}">Home</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item>Configurações</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item href="{{ route('settings.users.index') }}">Usuários</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item :active="true">Novo Usuário</x-ui.breadcrumb-item>
        </x-ui.breadcrumb>
    </x-slot>

    <x-slot name="toolbarActions">
        <x-ui.button tag="a" :href="route('settings.users.index')" ghost="secondary" size="sm" icon="arrow-left"
                     wire:navigate>
            Voltar
        </x-ui.button>
    </x-slot>

    <div class="py-6">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-mono">Novo Usuário</h1>
            <p class="text-sm text-secondary-foreground mt-1">Crie um novo usuário e defina seu acesso ao sistema.</p>
        </div>

        <form wire:submit="save" class="flex flex-col gap-6">

            <x-ui.card-section icon="lucide-user" title="Dados pessoais">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-ui.form-field label="Nome completo" name="name" :required="true">
                        <x-ui.input id="name" icon="user" wire:model="name" placeholder="Ex.: Maria Silva"
                                    autocomplete="name"/>
                    </x-ui.form-field>

                    <x-ui.form-field label="E-mail" name="email" :required="true">
                        <x-ui.input id="email" type="email" icon="mail" wire:model="email"
                                    placeholder="usuario@empresa.com" autocomplete="off"/>
                    </x-ui.form-field>

                    <x-ui.form-field label="Cargo" name="job_title">
                        <x-ui.input id="job_title" icon="briefcase" wire:model="job_title"
                                    placeholder="Ex.: Analista de TI"/>
                    </x-ui.form-field>

                    <x-ui.form-field label="Empresa" name="company">
                        <x-ui.input id="company" icon="building-2" wire:model="company" placeholder="Ex.: Acme Ltda."/>
                    </x-ui.form-field>

                    <x-ui.form-field label="Localização" name="location" class="sm:col-span-2">
                        <x-ui.input id="location" icon="map-pin" wire:model="location"
                                    placeholder="Ex.: São Paulo, SP"/>
                    </x-ui.form-field>
                </div>
            </x-ui.card-section>

            <x-ui.card-section icon="lucide-lock" title="Credenciais de acesso">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-ui.form-field label="Senha" name="password" :required="true">
                        <x-ui.password-input id="password" wire:model="password" placeholder="Mínimo 8 caracteres"
                                             autocomplete="new-password"/>
                    </x-ui.form-field>

                    <x-ui.form-field label="Confirmar senha" name="password_confirmation" :required="true">
                        <x-ui.password-input id="password_confirmation" wire:model="password_confirmation"
                                             placeholder="Repita a senha" autocomplete="new-password"/>
                    </x-ui.form-field>
                </div>

                <x-ui.divider/>

                <label class="flex items-start gap-3 cursor-pointer">
                    <input type="checkbox" class="kt-checkbox mt-0.5" wire:model="send_welcome"/>
                    <div class="flex flex-col gap-0.5">
                        <span class="text-sm font-medium text-foreground">Enviar e-mail de boas-vindas</span>
                        <span class="text-xs text-secondary-foreground">
                            O usuário receberá um e-mail com as instruções de acesso e um link para definir sua própria
                            senha.
                        </span>
                    </div>
                </label>
            </x-ui.card-section>

            <div class="flex items-center justify-end gap-2">
                <x-ui.button type="button" ghost="secondary" wire:click="cancel">Cancelar</x-ui.button>
                <x-ui.button type="submit" variant="primary" icon="user-plus" wire:loading.attr="disabled"
                             wire:target="save">
                    <span wire:loading.remove wire:target="save">Criar Usuário</span>
                    <span wire:loading wire:target="save">Criando…</span>
                </x-ui.button>
            </div>

        </form>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('toast', ({variant, message}) => {
                KTToast.show({message, variant});
            });
        });
    </script>

</div>
