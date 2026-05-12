<?php

use App\Models\Role;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Novo Papel')] class extends Component
{
    public string $name        = '';
    public string $description = '';
    public bool   $active      = true;

    protected function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:100', 'unique:roles,name'],
            'description' => ['nullable', 'string', 'max:255'],
            'active'      => ['boolean'],
        ];
    }

    protected $messages = [
        'name.required' => 'O nome é obrigatório.',
        'name.unique'   => 'Já existe um papel com este nome.',
        'name.max'      => 'O nome pode ter no máximo 100 caracteres.',
    ];

    public function save(): void
    {
        $this->validate();

        Role::create([
            'name'        => $this->name,
            'description' => $this->description ?: null,
            'active'      => $this->active,
        ]);

        session()->flash('toast_success', 'Papel criado com sucesso.');
        $this->redirectRoute('settings.roles.index', navigate: true);
    }

    public function cancel(): void
    {
        $this->redirectRoute('settings.roles.index', navigate: true);
    }
}; ?>

<div class="{{ config('layout.container') }}">
    <div class="grid gap-5 lg:gap-7.5 max-w-xl">

        {{-- ── Breadcrumb ───────────────────────────────────────────────── --}}
        <x-ui.breadcrumb>
            <x-ui.breadcrumb-item :href="route('dashboard')">Home</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item>Configurações</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item :href="route('settings.roles.index')">Papéis & Permissões</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item active>Novo Papel</x-ui.breadcrumb-item>
        </x-ui.breadcrumb>

        {{-- ── Header ──────────────────────────────────────────────────── --}}
        <div class="flex items-center gap-3">
            <x-ui.button
                tag="a"
                :href="route('settings.roles.index')"
                ghost="secondary"
                size="sm"
                icon-only
                icon="arrow-left"
                wire:navigate
            />
            <div>
                <h1 class="text-xl font-semibold text-mono">Novo Papel</h1>
                <p class="text-sm text-secondary-foreground mt-0.5">
                    Crie um papel para organizar e categorizar os usuários do sistema.
                </p>
            </div>
        </div>

        <form wire:submit="save" class="grid gap-5 lg:gap-7.5">

            <x-ui.card-section icon="lucide-shield" title="Dados do papel">

                <div class="flex flex-col gap-4">

                    <x-ui.form-field label="Nome" name="name" :required="true"
                                     hint="Use um nome curto e descritivo. Ex.: Administrador, Financeiro, Suporte.">
                        <x-ui.input
                            id="name"
                            icon="shield"
                            wire:model="name"
                            placeholder="Ex.: Administrador"
                        />
                    </x-ui.form-field>

                    <x-ui.form-field label="Descrição" name="description"
                                     hint="Explique brevemente o que este papel representa.">
                        <textarea
                            id="description"
                            class="kt-input resize-none"
                            rows="3"
                            placeholder="Ex.: Acesso total ao painel administrativo."
                            wire:model="description"
                            maxlength="255"
                        ></textarea>
                    </x-ui.form-field>

                    <x-ui.divider />

                    <label class="flex items-start gap-3 cursor-pointer">
                        <input
                            type="checkbox"
                            class="kt-checkbox kt-checkbox-sm mt-0.5"
                            wire:model="active"
                        />
                        <div class="flex flex-col gap-0.5">
                            <span class="text-sm font-medium text-foreground">Papel ativo</span>
                            <span class="text-xs text-secondary-foreground">
                                Papéis inativos não aparecem para seleção ao gerenciar usuários.
                            </span>
                        </div>
                    </label>

                </div>

            </x-ui.card-section>

            <div class="flex items-center justify-end gap-2">
                <x-ui.button type="button" ghost="secondary" wire:click="cancel">
                    Cancelar
                </x-ui.button>
                <x-ui.button
                    type="submit"
                    variant="primary"
                    icon="shield-plus"
                    wire:loading.attr="disabled"
                    wire:target="save"
                >
                    <span wire:loading.remove wire:target="save">Criar Papel</span>
                    <span wire:loading wire:target="save">Criando…</span>
                </x-ui.button>
            </div>

        </form>
    </div>
</div>
