<?php

use App\Models\Role;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Editar Papel')] class extends Component
{
    use WithPagination;

    public int    $roleId;

    // Dados do papel
    public string $name        = '';
    public string $description = '';
    public bool   $active      = true;

    // Busca de usuários na aba de membros
    #[Url(as: 'q', except: '')]
    public string $userSearch = '';

    // Modal de adicionar usuário
    public bool   $showAddUser    = false;
    public string $addUserSearch  = '';
    public array  $addUserResults = [];

    public function mount(Role $role): void
    {
        $this->roleId      = $role->id;
        $this->name        = $role->name;
        $this->description = $role->description ?? '';
        $this->active      = $role->active;
    }

    #[\Livewire\Attributes\Computed]
    public function role(): Role
    {
        return Role::findOrFail($this->roleId);
    }

    // ---------------------------------------------------------------- Dados

    protected function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:100', \Illuminate\Validation\Rule::unique('roles', 'name')->ignore($this->roleId)],
            'description' => ['nullable', 'string', 'max:255'],
            'active'      => ['boolean'],
        ];
    }

    protected $messages = [
        'name.required' => 'O nome é obrigatório.',
        'name.unique'   => 'Já existe um papel com este nome.',
    ];

    public function updateRole(): void
    {
        $this->validate();

        $this->role->update([
            'name'        => $this->name,
            'description' => $this->description ?: null,
            'active'      => $this->active,
        ]);

        $this->dispatch('toast', variant: 'success', message: 'Papel atualizado.');
    }

    // ---------------------------------------------------------------- Membros

    public function members()
    {
        return $this->role->users()
            ->when($this->userSearch, fn($q) => $q
                ->where('name', 'like', '%' . $this->userSearch . '%')
                ->orWhere('email', 'like', '%' . $this->userSearch . '%'))
            ->orderBy('name')
            ->paginate(10, pageName: 'membersPage');
    }

    public function removeUser(int $userId): void
    {
        $this->role->users()->detach($userId);
        $this->dispatch('toast', variant: 'warning', message: 'Usuário removido do papel.');
    }

    // ---------------------------------------------------------------- Adicionar usuário

    public function updatedAddUserSearch(): void
    {
        if (strlen($this->addUserSearch) < 2) {
            $this->addUserResults = [];
            return;
        }

        $existingIds = $this->role->users()->pluck('users.id');

        $this->addUserResults = User::whereNotIn('id', $existingIds)
            ->where(fn($q) => $q
                ->where('name', 'like', '%' . $this->addUserSearch . '%')
                ->orWhere('email', 'like', '%' . $this->addUserSearch . '%'))
            ->limit(8)
            ->get(['id', 'name', 'email', 'avatar', 'job_title'])
            ->map(fn($u) => [
                'id'        => $u->id,
                'name'      => $u->name,
                'email'     => $u->email,
                'job_title' => $u->job_title,
                'avatar'    => $u->avatarUrl(),
            ])
            ->toArray();
    }

    public function attachUser(int $userId): void
    {
        $this->role->users()->syncWithoutDetaching([$userId]);

        $this->addUserSearch  = '';
        $this->addUserResults = [];
        $this->showAddUser    = false;

        $this->dispatch('toast', variant: 'success', message: 'Usuário adicionado ao papel.');
    }

    public function cancelAddUser(): void
    {
        $this->showAddUser    = false;
        $this->addUserSearch  = '';
        $this->addUserResults = [];
    }

    // ---------------------------------------------------------------- Danger

    public bool $confirmingDelete = false;

    public function deleteRole(): void
    {
        $this->role->users()->detach();
        $this->role->delete();

        session()->flash('toast_success', 'Papel excluído.');
        $this->redirectRoute('settings.roles.index', navigate: true);
    }
}; ?>

<div class="{{ config('layout.container') }}">
    <div class="grid gap-5 lg:gap-7.5">

        {{-- ── Breadcrumb ───────────────────────────────────────────────── --}}
        <x-ui.breadcrumb>
            <x-ui.breadcrumb-item :href="route('dashboard')">Home</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item>Configurações</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item :href="route('settings.roles.index')">Papéis & Permissões</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item active>{{ $this->role->name }}</x-ui.breadcrumb-item>
        </x-ui.breadcrumb>

        {{-- ── Header ──────────────────────────────────────────────────── --}}
        <div class="flex items-center justify-between flex-wrap gap-3">
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
                    <div class="flex items-center gap-2">
                        <h1 class="text-xl font-semibold text-mono">{{ $this->role->name }}</h1>
                        @if ($this->role->active)
                            <x-ui.badge variant="success" style="light" dot>Ativo</x-ui.badge>
                        @else
                            <x-ui.badge variant="secondary" style="outline" dot>Inativo</x-ui.badge>
                        @endif
                    </div>
                    @if ($this->role->description)
                        <p class="text-sm text-secondary-foreground mt-0.5">{{ $this->role->description }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 lg:gap-7.5">

            {{-- ══════════════════════════════════ Coluna principal --}}
            <div class="lg:col-span-2 flex flex-col gap-5 lg:gap-7.5">

                {{-- ── Dados do papel ─────────────────────────────── --}}
                <x-ui.card-section icon="lucide-shield" title="Dados do papel">
                    <x-slot:actions>
                        <x-ui.button
                            type="button"
                            variant="primary"
                            size="sm"
                            icon="save"
                            wire:click="updateRole"
                            wire:loading.attr="disabled"
                            wire:target="updateRole"
                        >
                            <span wire:loading.remove wire:target="updateRole">Salvar</span>
                            <span wire:loading wire:target="updateRole">Salvando…</span>
                        </x-ui.button>
                    </x-slot:actions>

                    <div class="flex flex-col gap-4">
                        <x-ui.form-field label="Nome" name="name" :required="true"
                                         hint="Use um nome curto e descritivo.">
                            <x-ui.input
                                id="name"
                                icon="shield"
                                wire:model="name"
                                placeholder="Ex.: Administrador"
                            />
                        </x-ui.form-field>

                        <x-ui.form-field label="Descrição" name="description">
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

                {{-- ── Membros ─────────────────────────────────────── --}}
                <x-ui.card-section icon="lucide-users" title="Membros">
                    <x-slot:badge>{{ $this->role->users()->count() }}</x-slot:badge>

                    <x-slot:actions>
                        <x-ui.button
                            type="button"
                            variant="primary"
                            size="sm"
                            icon="user-plus"
                            wire:click="$set('showAddUser', true)"
                        >
                            Adicionar
                        </x-ui.button>
                    </x-slot:actions>

                    {{-- Busca de membros --}}
                    <label class="kt-input kt-input-sm">
                        <i class="ki-filled ki-magnifier"></i>
                        <input
                            type="text"
                            placeholder="Buscar membro…"
                            wire:model.live.debounce.300ms="userSearch"
                        />
                    </label>

                    {{-- Lista de membros --}}
                    @forelse ($this->members() as $user)
                        <div class="flex items-center justify-between gap-3 py-2 border-b border-border last:border-0">
                            <div class="flex items-center gap-3">
                                <img
                                    src="{{ $user->avatarUrl() }}"
                                    alt="{{ $user->name }}"
                                    class="rounded-full size-8 object-cover shrink-0"
                                />
                                <div class="flex flex-col">
                                    <a
                                        href="{{ route('settings.users.edit', $user) }}"
                                        wire:navigate
                                        class="text-sm font-medium text-mono hover:text-primary"
                                    >
                                        {{ $user->name }}
                                    </a>
                                    <span class="text-xs text-secondary-foreground">{{ $user->email }}</span>
                                </div>
                            </div>
                            <x-ui.button
                                ghost="secondary"
                                size="sm"
                                icon-only
                                icon="x"
                                wire:click="removeUser({{ $user->id }})"
                                wire:confirm="Remover {{ $user->name }} deste papel?"
                            />
                        </div>
                    @empty
                        <div class="flex flex-col items-center gap-2 py-8 text-secondary-foreground">
                            @svg('lucide-users', ['class' => 'size-7 opacity-30'])
                            <span class="text-sm">
                                {{ $userSearch ? 'Nenhum membro encontrado.' : 'Nenhum usuário neste papel ainda.' }}
                            </span>
                        </div>
                    @endforelse

                    @if ($this->members()->hasPages())
                        <div class="pt-2">
                            {{ $this->members()->links() }}
                        </div>
                    @endif

                </x-ui.card-section>

            </div>

            {{-- ══════════════════════════════════ Coluna lateral --}}
            <div class="flex flex-col gap-5 lg:gap-7.5">

                {{-- ── Resumo ──────────────────────────────────────── --}}
                <div class="kt-card">
                    <div class="kt-card-header">
                        <h3 class="kt-card-title flex items-center gap-2">
                            @svg('lucide-info', ['class' => 'size-4 text-primary'])
                            Informações
                        </h3>
                    </div>
                    <div class="kt-card-content flex flex-col gap-3 py-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-secondary-foreground">ID</span>
                            <span class="font-mono text-foreground">#{{ $this->role->id }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-secondary-foreground">Criado em</span>
                            <span class="text-foreground">{{ $this->role->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-secondary-foreground">Atualizado</span>
                            <span class="text-foreground">{{ $this->role->updated_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-secondary-foreground">Total de membros</span>
                            <span class="text-foreground font-medium">{{ $this->role->users()->count() }}</span>
                        </div>
                    </div>
                </div>

                {{-- ── Zona de perigo ──────────────────────────────── --}}
                <x-ui.card-section icon="lucide-triangle-alert" title="Zona de perigo" danger>
                    <p class="text-sm text-secondary-foreground">
                        O papel será removido de todos os usuários que o possuem.
                    </p>
                    <x-ui.button
                        variant="destructive"
                        icon="trash-2"
                        class="w-full justify-center"
                        wire:click="$set('confirmingDelete', true)"
                    >
                        Excluir papel
                    </x-ui.button>
                </x-ui.card-section>

            </div>
        </div>
    </div>

    {{-- ── Modal: adicionar usuário ─────────────────────────────────────── --}}
    <x-ui.modal
        id="modal_add_user"
        title="Adicionar usuário"
        size="sm"
        center
        :backdropStatic="true"
        x-data
        x-show="$wire.showAddUser"
    >
        <x-slot:header>
            <div class="flex items-center gap-2">
                @svg('lucide-user-plus', ['class' => 'size-4 text-primary'])
                <h3 class="kt-modal-title">Adicionar usuário ao papel</h3>
            </div>
            <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" wire:click="cancelAddUser">
                <i class="ki-filled ki-cross text-sm"></i>
            </button>
        </x-slot:header>

        <div class="flex flex-col gap-3">
            <label class="kt-input">
                <i class="ki-filled ki-magnifier"></i>
                <input
                    type="text"
                    placeholder="Buscar por nome ou e-mail…"
                    wire:model.live.debounce.300ms="addUserSearch"
                    autofocus
                />
            </label>

            @if (strlen($addUserSearch) >= 2)
                @if (count($addUserResults) > 0)
                    <div class="flex flex-col divide-y divide-border">
                        @foreach ($addUserResults as $result)
                            <button
                                type="button"
                                class="flex items-center gap-3 py-2.5 hover:bg-muted/50 rounded-lg px-2 text-left transition-colors"
                                wire:click="attachUser({{ $result['id'] }})"
                            >
                                <img
                                    src="{{ $result['avatar'] }}"
                                    alt="{{ $result['name'] }}"
                                    class="rounded-full size-8 object-cover shrink-0"
                                />
                                <div class="flex flex-col min-w-0">
                                    <span class="text-sm font-medium text-mono truncate">{{ $result['name'] }}</span>
                                    <span class="text-xs text-secondary-foreground truncate">{{ $result['email'] }}</span>
                                </div>
                                @svg('lucide-plus', ['class' => 'size-4 text-primary ml-auto shrink-0'])
                            </button>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center gap-2 py-6 text-secondary-foreground">
                        @svg('lucide-search-x', ['class' => 'size-6 opacity-30'])
                        <span class="text-sm">Nenhum usuário encontrado.</span>
                    </div>
                @endif
            @else
                <p class="text-xs text-secondary-foreground text-center py-4">
                    Digite ao menos 2 caracteres para buscar.
                </p>
            @endif
        </div>

        <x-slot:footer>
            <x-ui.button ghost="secondary" wire:click="cancelAddUser">Fechar</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>

    {{-- ── Modal: confirmar exclusão ────────────────────────────────────── --}}
    <x-ui.modal
        id="modal_delete_role"
        size="sm"
        center
        :backdropStatic="true"
        x-data
        x-show="$wire.confirmingDelete"
    >
        <x-slot:header>
            <div class="flex items-center gap-2 text-destructive">
                @svg('lucide-triangle-alert', ['class' => 'size-4'])
                <h3 class="kt-modal-title">Excluir papel</h3>
            </div>
            <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" wire:click="$set('confirmingDelete', false)">
                <i class="ki-filled ki-cross text-sm"></i>
            </button>
        </x-slot:header>

        <p class="text-sm text-foreground">
            O papel <strong class="text-destructive">{{ $this->role->name }}</strong> será excluído e
            removido de todos os <strong>{{ $this->role->users()->count() }}</strong> usuário(s) que o possuem.
            Esta ação não pode ser desfeita.
        </p>

        <x-slot:footer>
            <x-ui.button ghost="secondary" wire:click="$set('confirmingDelete', false)">Cancelar</x-ui.button>
            <x-ui.button variant="destructive" icon="trash-2" wire:click="deleteRole">Excluir</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>

    {{-- Toasts --}}
    <div x-data x-on:toast.window="const e=$event.detail[0]??$event.detail;$dispatch('kt-toast',{variant:e.variant,message:e.message})"></div>

</div>
