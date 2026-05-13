<?php

use App\Models\User;
use App\Notifications\Auth\Invite;
use Illuminate\Notifications\AnonymousNotifiable;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Convidar Usuário')] class extends Component
{
    public string $name  = '';
    public string $email = '';
    public bool   $sent  = false;

    protected function rules(): array
    {
        return [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        ];
    }

    protected $messages = [
        'name.required'  => 'O nome é obrigatório.',
        'email.required' => 'O e-mail é obrigatório.',
        'email.email'    => 'Informe um e-mail válido.',
        'email.unique'   => 'Este e-mail já possui uma conta cadastrada.',
    ];

    public function send(): void
    {
        $this->validate();

        (new AnonymousNotifiable)
            ->route('mail', $this->email)
            ->notify(new Invite($this->name, $this->email));

        $this->sent = true;
    }

    public function sendAnother(): void
    {
        $this->reset('name', 'email', 'sent');
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
            <x-ui.breadcrumb-item :active="true">Convidar</x-ui.breadcrumb-item>
        </x-ui.breadcrumb>
    </x-slot>

    <x-slot name="toolbarActions">
        <x-ui.button tag="a" :href="route('settings.users.index')" ghost="secondary" size="sm" icon="arrow-left" wire:navigate>
            Voltar
        </x-ui.button>
    </x-slot>

    <div class="py-6">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-mono">Convidar Usuário</h1>
            <p class="text-sm text-secondary-foreground mt-1">
                Envie um convite por e-mail. A conta só será criada quando o usuário aceitar.
            </p>
        </div>

        <div>
            @if ($sent)
                <div class="kt-card">
                    <div class="kt-card-content flex flex-col items-center gap-4 py-10 text-center">
                        <div class="size-16 rounded-full bg-success/10 flex items-center justify-center">
                            @svg('lucide-mail-check', ['class' => 'size-8 text-success'])
                        </div>
                        <div>
                            <h2 class="text-base font-semibold text-mono">Convite enviado!</h2>
                            <p class="text-sm text-secondary-foreground mt-1">
                                Um e-mail foi enviado para <strong>{{ $email }}</strong>.<br>
                                A conta será criada quando o convite for aceito.
                            </p>
                        </div>
                        <div class="flex gap-2 mt-2">
                            <x-ui.button ghost="secondary" wire:click="cancel">Ver usuários</x-ui.button>
                            <x-ui.button variant="primary" icon="mail-plus" wire:click="sendAnother">Convidar outro</x-ui.button>
                        </div>
                    </div>
                </div>
            @else
                <x-ui.card-section icon="lucide-mail" title="Dados do convite">
                    <form wire:submit="send" class="flex flex-col gap-4">

                        <x-ui.form-field label="Nome do usuário" name="name" :required="true">
                            <x-ui.input id="name" icon="user" wire:model="name" placeholder="Ex.: João da Silva" />
                        </x-ui.form-field>

                        <x-ui.form-field label="E-mail" name="email" :required="true">
                            <x-ui.input id="email" type="email" icon="mail" wire:model="email" placeholder="usuario@empresa.com" />
                        </x-ui.form-field>

                        <x-ui.divider />

                        <x-ui.alert variant="info" appearance="light" icon="info">
                            O convidado receberá um link válido por <strong>7 dias</strong> para criar sua conta.
                            Nenhuma conta é criada antes da aceitação.
                        </x-ui.alert>

                        <div class="flex items-center justify-end gap-2">
                            <x-ui.button type="button" ghost="secondary" wire:click="cancel">Cancelar</x-ui.button>
                            <x-ui.button type="submit" variant="primary" icon="send" wire:loading.attr="disabled" wire:target="send">
                                <span wire:loading.remove wire:target="send">Enviar convite</span>
                                <span wire:loading wire:target="send">Enviando…</span>
                            </x-ui.button>
                        </div>

                    </form>
                </x-ui.card-section>
            @endif
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
