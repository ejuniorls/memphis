<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Editar Usuário')] class extends Component
{
    public User $user;

    // Dados pessoais
    public string $name      = '';
    public string $email     = '';
    public string $bio       = '';
    public string $job_title = '';
    public string $company   = '';
    public string $location  = '';
    public string $website   = '';

    // Senha (opcional)
    public string $password              = '';
    public string $password_confirmation = '';

    // Controle
    public bool $confirmingDisable = false;
    public bool $confirmingRestore = false;
    public bool $confirmingDelete  = false;

    // Roles
    public array $selectedRoles = [];

    public function mount(User $user): void
    {
        // Permitir editar usuários soft-deleted
        $this->user = User::withTrashed()->findOrFail($user->id);

        $this->name      = $this->user->name      ?? '';
        $this->email     = $this->user->email     ?? '';
        $this->bio       = $this->user->bio       ?? '';
        $this->job_title = $this->user->job_title ?? '';
        $this->company   = $this->user->company   ?? '';
        $this->location  = $this->user->location  ?? '';
        $this->website   = $this->user->website   ?? '';

        $this->selectedRoles = $this->user->roles()->pluck('roles.id')->map(fn($id) => (string) $id)->toArray();
    }

    protected function profileRules(): array
    {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user->id)],
            'bio'       => ['nullable', 'string', 'max:500'],
            'job_title' => ['nullable', 'string', 'max:100'],
            'company'   => ['nullable', 'string', 'max:100'],
            'location'  => ['nullable', 'string', 'max:100'],
            'website'   => ['nullable', 'url', 'max:255'],
        ];
    }

    protected function passwordRules(): array
    {
        return [
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function updateProfile(): void
    {
        $validated = $this->validate($this->profileRules(), [
            'name.required'  => 'O nome é obrigatório.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.unique'   => 'Este e-mail já está em uso.',
            'website.url'    => 'Informe uma URL válida.',
        ]);

        $this->user->fill($validated);

        if ($this->user->isDirty('email')) {
            $this->user->email_verified_at = null;
        }

        $this->user->save();

        $this->dispatch('toast', variant: 'success', message: 'Perfil atualizado com sucesso.');
    }

    public function updatePassword(): void
    {
        $this->validate($this->passwordRules(), [
            'password.required'  => 'Informe a nova senha.',
            'password.confirmed' => 'As senhas não coincidem.',
        ]);

        $this->user->update(['password' => Hash::make($this->password)]);

        $this->password              = '';
        $this->password_confirmation = '';

        $this->dispatch('toast', variant: 'success', message: 'Senha alterada com sucesso.');
    }

    public function updateRoles(): void
    {
        $this->user->roles()->sync($this->selectedRoles);
        $this->dispatch('toast', variant: 'success', message: 'Papéis atualizados.');
    }

    public function disableUser(): void
    {
        $this->user->delete(); // soft delete
        $this->user->refresh();
        $this->confirmingDisable = false;
        $this->dispatch('toast', variant: 'warning', message: 'Usuário desativado.');
    }

    public function restoreUser(): void
    {
        $this->user->restore();
        $this->user->refresh();
        $this->confirmingRestore = false;
        $this->dispatch('toast', variant: 'success', message: 'Usuário reativado.');
    }

    public function deleteUser(): void
    {
        $this->user->forceDelete();
        session()->flash('toast_success', 'Usuário excluído permanentemente.');
        $this->redirectRoute('settings.users.index', navigate: true);
    }
}; ?>

<div class="{{ config('layout.container') }}">
    <div class="grid gap-5 lg:gap-7.5">

        {{-- ── Breadcrumb ───────────────────────────────────────────────── --}}
        <x-ui.breadcrumb>
            <x-ui.breadcrumb-item :href="route('dashboard')">Home</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item>Configurações</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item :href="route('settings.users.index')">Usuários</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item active>{{ $user->name }}</x-ui.breadcrumb-item>
        </x-ui.breadcrumb>

        {{-- ── Header ──────────────────────────────────────────────────── --}}
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center gap-3">
                <x-ui.button
                    tag="a"
                    :href="route('settings.users.index')"
                    ghost="secondary"
                    size="sm"
                    icon-only
                    icon="arrow-left"
                    wire:navigate
                />
                <div>
                    <div class="flex items-center gap-2">
                        <h1 class="text-xl font-semibold text-mono">{{ $user->name }}</h1>
                        @if ($user->trashed())
                            <x-ui.badge variant="secondary" style="outline" dot>Desativado</x-ui.badge>
                        @else
                            <x-ui.badge variant="success" style="light" dot>Ativo</x-ui.badge>
                        @endif
                    </div>
                    <p class="text-sm text-secondary-foreground mt-0.5">{{ $user->email }}</p>
                </div>
            </div>

            {{-- Avatar --}}
            <img
                src="{{ $user->avatarUrl() }}"
                alt="{{ $user->name }}"
                class="rounded-full size-12 object-cover ring-2 ring-border"
            />
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 lg:gap-7.5">

            {{-- ═══════════════════════════════════════ Coluna principal --}}
            <div class="lg:col-span-2 flex flex-col gap-5 lg:gap-7.5">

                {{-- ── Dados pessoais ────────────────────────────────── --}}
                <x-ui.card-section icon="lucide-user" title="Dados pessoais">

                    <x-slot:actions>
                        <x-ui.button
                            type="button"
                            variant="primary"
                            size="sm"
                            icon="save"
                            wire:click="updateProfile"
                            wire:loading.attr="disabled"
                            wire:target="updateProfile"
                        >
                            <span wire:loading.remove wire:target="updateProfile">Salvar</span>
                            <span wire:loading wire:target="updateProfile">Salvando…</span>
                        </x-ui.button>
                    </x-slot:actions>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-ui.form-field label="Nome completo" name="name" :required="true">
                            <x-ui.input
                                id="name"
                                icon="user"
                                wire:model="name"
                                placeholder="Nome completo"
                            />
                        </x-ui.form-field>

                        <x-ui.form-field label="E-mail" name="email" :required="true">
                            <x-ui.input
                                id="email"
                                type="email"
                                icon="mail"
                                wire:model="email"
                                placeholder="email@empresa.com"
                            />
                            @if (! $user->email_verified_at)
                                <p class="text-xs text-warning flex items-center gap-1 mt-1">
                                    @svg('lucide-triangle-alert', ['class' => 'size-3 shrink-0'])
                                    E-mail não verificado
                                </p>
                            @endif
                        </x-ui.form-field>

                        <x-ui.form-field label="Cargo" name="job_title">
                            <x-ui.input
                                id="job_title"
                                icon="briefcase"
                                wire:model="job_title"
                                placeholder="Ex.: Desenvolvedor"
                            />
                        </x-ui.form-field>

                        <x-ui.form-field label="Empresa" name="company">
                            <x-ui.input
                                id="company"
                                icon="building-2"
                                wire:model="company"
                                placeholder="Ex.: Acme Ltda."
                            />
                        </x-ui.form-field>

                        <x-ui.form-field label="Localização" name="location">
                            <x-ui.input
                                id="location"
                                icon="map-pin"
                                wire:model="location"
                                placeholder="Ex.: São Paulo, SP"
                            />
                        </x-ui.form-field>

                        <x-ui.form-field label="Site / Portfólio" name="website">
                            <x-ui.input
                                id="website"
                                icon="globe"
                                wire:model="website"
                                placeholder="https://exemplo.com"
                                type="url"
                            />
                        </x-ui.form-field>

                        <x-ui.form-field label="Bio" name="bio" class="sm:col-span-2">
                            <textarea
                                id="bio"
                                class="kt-input resize-none"
                                rows="3"
                                placeholder="Pequena descrição sobre o usuário…"
                                wire:model="bio"
                                maxlength="500"
                            ></textarea>
                        </x-ui.form-field>
                    </div>

                </x-ui.card-section>

                {{-- ── Alterar senha ──────────────────────────────────── --}}
                <x-ui.card-section icon="lucide-lock" title="Alterar senha">

                    <x-slot:subtitle>
                        Deixe em branco para manter a senha atual.
                    </x-slot:subtitle>

                    <x-slot:actions>
                        <x-ui.button
                            type="button"
                            variant="primary"
                            size="sm"
                            icon="key-round"
                            wire:click="updatePassword"
                            wire:loading.attr="disabled"
                            wire:target="updatePassword"
                            :disabled="!$password"
                        >
                            <span wire:loading.remove wire:target="updatePassword">Alterar Senha</span>
                            <span wire:loading wire:target="updatePassword">Salvando…</span>
                        </x-ui.button>
                    </x-slot:actions>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-ui.form-field label="Nova senha" name="password">
                            <x-ui.password-input
                                id="password"
                                wire:model="password"
                                placeholder="Mínimo 8 caracteres"
                                autocomplete="new-password"
                            />
                        </x-ui.form-field>

                        <x-ui.form-field label="Confirmar senha" name="password_confirmation">
                            <x-ui.password-input
                                id="password_confirmation"
                                wire:model="password_confirmation"
                                placeholder="Repita a nova senha"
                                autocomplete="new-password"
                            />
                        </x-ui.form-field>
                    </div>

                </x-ui.card-section>

                {{-- ── Papéis ──────────────────────────────────────────── --}}
                <x-ui.card-section icon="lucide-shield" title="Papéis & Permissões">

                    <x-slot:actions>
                        <x-ui.button
                            type="button"
                            variant="primary"
                            size="sm"
                            icon="save"
                            wire:click="updateRoles"
                            wire:loading.attr="disabled"
                            wire:target="updateRoles"
                        >
                            <span wire:loading.remove wire:target="updateRoles">Salvar</span>
                            <span wire:loading wire:target="updateRoles">Salvando…</span>
                        </x-ui.button>
                    </x-slot:actions>

                    @php $roles = \App\Models\Role::active()->orderBy('name')->get(); @endphp

                    @if ($roles->isEmpty())
                        <p class="text-sm text-secondary-foreground">
                            Nenhum papel ativo cadastrado.
                            <a href="{{ route('settings.roles.create') }}" wire:navigate class="text-primary underline">Criar papel</a>
                        </p>
                    @else
                        <div class="flex flex-col gap-2">
                            @foreach ($roles as $role)
                                <label class="flex items-start gap-3 cursor-pointer py-1">
                                    <input
                                        type="checkbox"
                                        class="kt-checkbox kt-checkbox-sm mt-0.5"
                                        wire:model="selectedRoles"
                                        value="{{ $role->id }}"
                                    />
                                    <div class="flex flex-col gap-0.5">
                                        <span class="text-sm font-medium text-foreground">{{ $role->name }}</span>
                                        @if ($role->description)
                                            <span class="text-xs text-secondary-foreground">{{ $role->description }}</span>
                                        @endif
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    @endif

                </x-ui.card-section>

            </div>

            {{-- ═════════════════════════════════════════ Coluna lateral --}}
            <div class="flex flex-col gap-5 lg:gap-7.5">

                {{-- ── Resumo ─────────────────────────────────────────── --}}
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
                            <span class="font-mono text-foreground">#{{ $user->id }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-secondary-foreground">Criado em</span>
                            <span class="text-foreground">{{ $user->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-secondary-foreground">Último acesso</span>
                            <span class="text-foreground">
                                {{ $user->updated_at->diffForHumans() }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-secondary-foreground">E-mail verificado</span>
                            @if ($user->email_verified_at)
                                <x-ui.badge variant="success" style="light" size="xs">Sim</x-ui.badge>
                            @else
                                <x-ui.badge variant="warning" style="light" size="xs">Não</x-ui.badge>
                            @endif
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-secondary-foreground">2FA</span>
                            @if ($user->two_factor_confirmed_at)
                                <x-ui.badge variant="success" style="light" size="xs">Ativo</x-ui.badge>
                            @else
                                <x-ui.badge variant="secondary" style="outline" size="xs">Inativo</x-ui.badge>
                            @endif
                        </div>
                        @if ($user->trashed())
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-secondary-foreground">Desativado em</span>
                                <span class="text-destructive">{{ $user->deleted_at->format('d/m/Y') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- ── Ações de conta ─────────────────────────────────── --}}
                <x-ui.card-section
                    icon="lucide-shield"
                    title="Status da conta"
                    :danger="$user->trashed()"
                >
                    @if ($user->trashed())
                        <p class="text-sm text-secondary-foreground">
                            Este usuário está <strong class="text-destructive">desativado</strong> e não pode acessar o sistema.
                        </p>
                        <x-ui.button
                            variant="success"
                            icon="user-check"
                            class="w-full justify-center"
                            wire:click="$set('confirmingRestore', true)"
                        >
                            Reativar usuário
                        </x-ui.button>
                    @else
                        <p class="text-sm text-secondary-foreground">
                            O usuário está <strong class="text-success">ativo</strong>. Você pode desativá-lo para bloquear o acesso temporariamente.
                        </p>
                        <x-ui.button
                            outline
                            variant="warning"
                            icon="user-x"
                            class="w-full justify-center"
                            wire:click="$set('confirmingDisable', true)"
                        >
                            Desativar usuário
                        </x-ui.button>
                    @endif
                </x-ui.card-section>

                {{-- ── Zona de perigo ──────────────────────────────────── --}}
                <x-ui.card-section
                    icon="lucide-triangle-alert"
                    title="Zona de perigo"
                    danger
                >
                    <p class="text-sm text-secondary-foreground">
                        A exclusão é <strong>permanente</strong> e remove todos os dados associados a este usuário.
                    </p>
                    <x-ui.button
                        variant="destructive"
                        icon="trash-2"
                        class="w-full justify-center"
                        wire:click="$set('confirmingDelete', true)"
                    >
                        Excluir permanentemente
                    </x-ui.button>
                </x-ui.card-section>

            </div>
        </div>
    </div>

    {{-- ── Modal: desativar ─────────────────────────────────────────────── --}}
    <x-ui.modal
        id="modal_disable"
        title="Desativar usuário"
        size="sm"
        center
        :backdropStatic="true"
        x-data
        x-show="$wire.confirmingDisable"
    >
        <x-slot:header>
            <div class="flex items-center gap-2 text-warning">
                @svg('lucide-user-x', ['class' => 'size-4'])
                <h3 class="kt-modal-title">Desativar usuário</h3>
            </div>
            <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" wire:click="$set('confirmingDisable', false)">
                <i class="ki-filled ki-cross text-sm"></i>
            </button>
        </x-slot:header>

        <p class="text-sm text-foreground">
            O usuário <strong>{{ $user->name }}</strong> perderá o acesso ao sistema imediatamente.
            Você poderá reativá-lo a qualquer momento.
        </p>

        <x-slot:footer>
            <x-ui.button ghost="secondary" wire:click="$set('confirmingDisable', false)">Cancelar</x-ui.button>
            <x-ui.button variant="warning" icon="user-x" wire:click="disableUser">
                Desativar
            </x-ui.button>
        </x-slot:footer>
    </x-ui.modal>

    {{-- ── Modal: restaurar ─────────────────────────────────────────────── --}}
    <x-ui.modal
        id="modal_restore"
        title="Reativar usuário"
        size="sm"
        center
        :backdropStatic="true"
        x-data
        x-show="$wire.confirmingRestore"
    >
        <x-slot:header>
            <div class="flex items-center gap-2 text-success">
                @svg('lucide-user-check', ['class' => 'size-4'])
                <h3 class="kt-modal-title">Reativar usuário</h3>
            </div>
            <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" wire:click="$set('confirmingRestore', false)">
                <i class="ki-filled ki-cross text-sm"></i>
            </button>
        </x-slot:header>

        <p class="text-sm text-foreground">
            O usuário <strong>{{ $user->name }}</strong> recuperará o acesso ao sistema.
        </p>

        <x-slot:footer>
            <x-ui.button ghost="secondary" wire:click="$set('confirmingRestore', false)">Cancelar</x-ui.button>
            <x-ui.button variant="success" icon="user-check" wire:click="restoreUser">
                Reativar
            </x-ui.button>
        </x-slot:footer>
    </x-ui.modal>

    {{-- ── Modal: excluir permanentemente ─────────────────────────────── --}}
    <x-ui.modal
        id="modal_delete"
        title="Excluir permanentemente"
        size="sm"
        center
        :backdropStatic="true"
        x-data
        x-show="$wire.confirmingDelete"
    >
        <x-slot:header>
            <div class="flex items-center gap-2 text-destructive">
                @svg('lucide-triangle-alert', ['class' => 'size-4'])
                <h3 class="kt-modal-title">Excluir permanentemente</h3>
            </div>
            <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" wire:click="$set('confirmingDelete', false)">
                <i class="ki-filled ki-cross text-sm"></i>
            </button>
        </x-slot:header>

        <p class="text-sm text-foreground">
            Esta ação <strong>não pode ser desfeita</strong>. O usuário
            <strong class="text-destructive">{{ $user->name }}</strong> e todos os seus dados
            serão removidos permanentemente.
        </p>

        <x-slot:footer>
            <x-ui.button ghost="secondary" wire:click="$set('confirmingDelete', false)">Cancelar</x-ui.button>
            <x-ui.button variant="destructive" icon="trash-2" wire:click="deleteUser">
                Excluir permanentemente
            </x-ui.button>
        </x-slot:footer>
    </x-ui.modal>

    {{-- ── Toasts ───────────────────────────────────────────────────────── --}}
    <div
        x-data
        x-on:toast.window="
            const e = $event.detail[0] ?? $event.detail;
            $dispatch('kt-toast', { variant: e.variant, message: e.message });
        "
    ></div>

</div>
