<?php

use App\Models\Role;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Papéis')] class extends Component
{
    use WithPagination;

    #[Url(as: 'q', except: '')]
    public string $search = '';

    #[Url(as: 'status', except: 'active')]
    public string $status = 'active'; // 'active' | 'inactive' | 'all'

    public ?int $confirmingDelete = null;

    public function updatedSearch(): void { $this->resetPage(); }
    public function updatedStatus(): void { $this->resetPage(); }

    public function toggleActive(int $id): void
    {
        $role = Role::withTrashed()->findOrFail($id);
        $role->update(['active' => ! $role->active]);

        $this->dispatch('toast',
            variant: $role->active ? 'success' : 'warning',
            message: $role->active ? 'Papel ativado.' : 'Papel desativado.'
        );
    }

    public function confirmDelete(int $id): void
    {
        $this->confirmingDelete = $id;
    }

    public function deleteRole(): void
    {
        $role = Role::findOrFail($this->confirmingDelete);
        $role->users()->detach();
        $role->delete(); // soft delete

        $this->confirmingDelete = null;
        $this->dispatch('toast', variant: 'destructive', message: 'Papel removido.');
    }

    public function roles()
    {
        return Role::withCount('users')
            ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%'))
            ->when($this->status === 'active',   fn($q) => $q->where('active', true))
            ->when($this->status === 'inactive', fn($q) => $q->where('active', false))
            ->orderBy('name')
            ->paginate(15);
    }
}; ?>

<div class="{{ config('layout.container') }}">
    <div class="grid gap-5 lg:gap-7.5">

        {{-- ── Breadcrumb ───────────────────────────────────────────────── --}}
        <x-ui.breadcrumb>
            <x-ui.breadcrumb-item :href="route('dashboard')">Home</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item>Configurações</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item active>Papéis & Permissões</x-ui.breadcrumb-item>
        </x-ui.breadcrumb>

        {{-- ── Header ──────────────────────────────────────────────────── --}}
        <div class="flex items-center justify-between flex-wrap gap-3">
            <div>
                <h1 class="text-xl font-semibold text-mono">Papéis & Permissões</h1>
                <p class="text-sm text-secondary-foreground mt-0.5">
                    Defina os papéis disponíveis e atribua-os aos usuários.
                </p>
            </div>
            <x-ui.button
                tag="a"
                :href="route('settings.roles.create')"
                variant="primary"
                icon="plus"
                wire:navigate
            >
                Novo Papel
            </x-ui.button>
        </div>

        {{-- ── Tabela ───────────────────────────────────────────────────── --}}
        <div class="kt-card kt-card-grid min-w-full">
            <div class="kt-card-header flex-wrap gap-2">
                <h3 class="kt-card-title text-sm text-secondary-foreground font-normal">
                    {{ $this->roles()->total() }} papel(éis) encontrado(s)
                </h3>

                <div class="flex flex-wrap gap-2 lg:gap-4">
                    <label class="kt-input kt-input-sm">
                        <i class="ki-filled ki-magnifier"></i>
                        <input
                            type="text"
                            placeholder="Buscar papel…"
                            wire:model.live.debounce.300ms="search"
                        />
                    </label>

                    <x-ui.select size="sm" wire:model.live="status" placeholder="Status">
                        <option value="active">Ativos</option>
                        <option value="inactive">Inativos</option>
                        <option value="all">Todos</option>
                    </x-ui.select>
                </div>
            </div>

            <div class="kt-card-content p-0">
                <div class="kt-scrollable-x-auto">
                    <table class="kt-table table-auto kt-table-border">
                        <thead>
                        <tr>
                            <th class="min-w-[200px]">Nome</th>
                            <th class="min-w-[300px]">Descrição</th>
                            <th class="min-w-[100px] text-center">Usuários</th>
                            <th class="min-w-[100px] text-center">Status</th>
                            <th class="w-[60px]"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($this->roles() as $role)
                            <tr wire:key="role-{{ $role->id }}">
                                <td>
                                    <div class="flex items-center gap-2.5">
                                        <div class="size-8 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
                                            @svg('lucide-shield', ['class' => 'size-4 text-primary'])
                                        </div>
                                        <a
                                            href="{{ route('settings.roles.edit', $role) }}"
                                            wire:navigate
                                            class="text-sm font-medium text-mono hover:text-primary"
                                        >
                                            {{ $role->name }}
                                        </a>
                                    </div>
                                </td>

                                <td class="text-sm text-secondary-foreground">
                                    {{ $role->description ?: '—' }}
                                </td>

                                <td class="text-center">
                                    <x-ui.badge variant="secondary" style="outline">
                                        {{ $role->users_count }}
                                        {{ Str::plural('usuário', $role->users_count) }}
                                    </x-ui.badge>
                                </td>

                                <td class="text-center">
                                    @if ($role->active)
                                        <x-ui.badge variant="success" style="light" dot>Ativo</x-ui.badge>
                                    @else
                                        <x-ui.badge variant="secondary" style="outline" dot>Inativo</x-ui.badge>
                                    @endif
                                </td>

                                <td>
                                    <div x-data="{ open: false }" class="relative flex justify-end">
                                        <button
                                            @click="open = !open"
                                            @click.outside="open = false"
                                            class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost"
                                        >
                                            <i class="ki-filled ki-dots-vertical text-lg"></i>
                                        </button>
                                        <div
                                            x-show="open"
                                            x-transition:enter="transition ease-out duration-100"
                                            x-transition:enter-start="opacity-0 scale-95"
                                            x-transition:enter-end="opacity-100 scale-100"
                                            x-transition:leave="transition ease-in duration-75"
                                            x-transition:leave-start="opacity-100 scale-100"
                                            x-transition:leave-end="opacity-0 scale-95"
                                            @click="open = false"
                                            class="absolute right-0 top-8 z-50 min-w-[160px] rounded-lg border border-border bg-background shadow-lg py-1"
                                            style="display:none"
                                        >
                                            <a
                                                class="kt-menu-link"
                                                href="{{ route('settings.roles.edit', $role) }}"
                                                wire:navigate
                                            >
                                                <span class="kt-menu-icon"><i class="ki-filled ki-pencil"></i></span>
                                                <span class="kt-menu-title">Editar</span>
                                            </a>
                                            <div class="my-1 h-px bg-border"></div>
                                            <button
                                                class="kt-menu-link w-full text-left"
                                                wire:click="toggleActive({{ $role->id }})"
                                            >
                                                <span class="kt-menu-icon">
                                                    @if ($role->active)
                                                        <i class="ki-filled ki-minus-circle text-warning"></i>
                                                    @else
                                                        <i class="ki-filled ki-check-circle text-success"></i>
                                                    @endif
                                                </span>
                                                <span class="kt-menu-title">{{ $role->active ? 'Desativar' : 'Ativar' }}</span>
                                            </button>
                                            <div class="my-1 h-px bg-border"></div>
                                            <button
                                                class="kt-menu-link w-full text-left"
                                                wire:click="confirmDelete({{ $role->id }})"
                                            >
                                                <span class="kt-menu-icon"><i class="ki-filled ki-trash text-destructive"></i></span>
                                                <span class="kt-menu-title text-destructive">Excluir</span>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-14 text-center">
                                    <div class="flex flex-col items-center gap-2 text-secondary-foreground">
                                        @svg('lucide-shield-off', ['class' => 'size-8 opacity-30'])
                                        <span class="text-sm">Nenhum papel encontrado.</span>
                                        @if ($search)
                                            <button class="text-xs text-primary underline" wire:click="$set('search', '')">
                                                Limpar busca
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($this->roles()->hasPages())
                    <div class="px-5 py-4 border-t border-border">
                        {{ $this->roles()->links() }}
                    </div>
                @endif
            </div>
        </div>

    </div>

    {{-- ── Modal: confirmar exclusão ────────────────────────────────────── --}}
    <x-ui.modal
        id="modal_delete_role"
        size="sm"
        center
        :backdropStatic="true"
        x-data
        x-show="$wire.confirmingDelete !== null"
    >
        <x-slot:header>
            <div class="flex items-center gap-2 text-destructive">
                @svg('lucide-triangle-alert', ['class' => 'size-4'])
                <h3 class="kt-modal-title">Excluir papel</h3>
            </div>
            <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" wire:click="$set('confirmingDelete', null)">
                <i class="ki-filled ki-cross text-sm"></i>
            </button>
        </x-slot:header>

        <p class="text-sm text-foreground">
            O papel será removido e desvinculado de todos os usuários que o possuem.
            Esta ação não pode ser desfeita.
        </p>

        <x-slot:footer>
            <x-ui.button ghost="secondary" wire:click="$set('confirmingDelete', null)">Cancelar</x-ui.button>
            <x-ui.button variant="destructive" icon="trash-2" wire:click="deleteRole">Excluir</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>

    {{-- Toasts --}}
    <div x-data x-on:toast.window="const e=$event.detail[0]??$event.detail;$dispatch('kt-toast',{variant:e.variant,message:e.message})"></div>

</div>
