<?php

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new #[Title('Usuários')]
class extends Component {
    use WithPagination;

    #[Url(as: 'q', except: '')]
    public string $search = '';

    #[Url(as: 'status', except: 'active')]
    public string $status = 'active';

    #[Url(as: 'sort', except: 'name')]
    public string $sortBy = 'name';

    #[Url(as: 'dir', except: 'asc')]
    public string $sortDir = 'asc';

    public bool $confirmingDelete = false;
    public ?int $deletingUserId = null;
    public ?int $restoringUserId = null;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    public function sortOn(string $column): void
    {
        if ($this->sortBy === $column) {
            $this->sortDir = $this->sortDir === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDir = 'asc';
        }
        $this->resetPage();
    }

    public function toggleStatus(int $id): void
    {
        $user = User::withTrashed()->findOrFail($id);

        if ($user->trashed()) {
            $user->restore();
            $this->dispatch('toast', variant: 'success', message: 'Usuário reativado com sucesso.');
        } else {
            $user->delete();
            $this->dispatch('toast', variant: 'warning', message: 'Usuário desativado.');
        }
    }

    public function confirmDelete(int $id): void
    {
        $this->deletingUserId = $id;
        $this->confirmingDelete = true;
    }

    public function deleteUser(): void
    {
        $user = User::withTrashed()->findOrFail($this->deletingUserId);
        $user->forceDelete();

        $this->confirmingDelete = false;
        $this->deletingUserId = null;

        $this->dispatch('toast', variant: 'destructive', message: 'Usuário excluído permanentemente.');
    }

    public function cancelDelete(): void
    {
        $this->confirmingDelete = false;
        $this->deletingUserId = null;
    }

    public function users()
    {
        return User::withTrashed()
            ->when($this->search, fn($q) => $q->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            }))
            ->when($this->status === 'active', fn($q) => $q->whereNull('deleted_at'))
            ->when($this->status === 'disabled', fn($q) => $q->whereNotNull('deleted_at'))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate(15);
    }
}; ?>

<div>
    <x-slot name="toolbar">
        <x-ui.breadcrumb>
            <x-ui.breadcrumb-item :first="true" href="{{ route('dashboard') }}">Home</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item>Configurações</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item :active="true">Usuários</x-ui.breadcrumb-item>
        </x-ui.breadcrumb>
    </x-slot>

    <x-slot name="toolbarActions">
        <x-ui.button tag="a" :href="route('settings.users.invite')" ghost="secondary" icon="mail">
            Convidar
        </x-ui.button>
        <x-ui.button tag="a" :href="route('settings.users.create')" variant="primary" icon="plus">
            Novo Usuário
        </x-ui.button>
    </x-slot>

    <div class="py-6">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-mono">Usuários</h1>
            <p class="text-sm text-secondary-foreground mt-1">Gerencie os usuários com acesso ao sistema.</p>
        </div>

        <div class="kt-card kt-card-grid w-full">
            <div class="kt-card-header flex-wrap gap-2">
                <h3 class="kt-card-title text-sm text-secondary-foreground font-normal">
                    Exibindo {{ $this->users()->total() }} usuário(s)
                </h3>
                <div class="flex flex-wrap gap-2 lg:gap-4">
                    <label class="kt-input kt-input-sm">
                        <i class="ki-filled ki-magnifier"></i>
                        <input type="text" placeholder="Buscar…" wire:model.live.debounce.300ms="search"/>
                    </label>
                    <x-ui.select size="sm" wire:model.live="status" placeholder="Status">
                        <option value="active">Ativos</option>
                        <option value="disabled">Desativados</option>
                        <option value="all">Todos</option>
                    </x-ui.select>
                </div>
            </div>

            <div class="kt-card-content p-0">
                <div class="kt-scrollable-x-auto">
                    <table class="kt-table table-auto kt-table-border">
                        <thead>
                        <tr>
                            <th>
                                <button wire:click="sortOn('name')" class="kt-table-col group">
                                    <span class="kt-table-col-label">Usuário</span>
                                    <span class="kt-table-col-sort">
                                        @if ($sortBy === 'name')
                                            <i class="ki-filled ki-arrow-{{ $sortDir === 'asc' ? 'up' : 'down' }} text-primary text-xs"></i>
                                        @else
                                            <i class="ki-filled ki-arrows-up-down text-muted text-xs opacity-40 group-hover:opacity-70"></i>
                                        @endif
                                    </span>
                                </button>
                            </th>
                            {{-- Oculta em mobile --}}
                            <th class="hidden md:table-cell">
                                <button wire:click="sortOn('email')" class="kt-table-col group">
                                    <span class="kt-table-col-label">E-mail</span>
                                    <span class="kt-table-col-sort">
                                        @if ($sortBy === 'email')
                                            <i class="ki-filled ki-arrow-{{ $sortDir === 'asc' ? 'up' : 'down' }} text-primary text-xs"></i>
                                        @else
                                            <i class="ki-filled ki-arrows-up-down text-muted text-xs opacity-40 group-hover:opacity-70"></i>
                                        @endif
                                    </span>
                                </button>
                            </th>
                            <th class="hidden lg:table-cell">
                                <button wire:click="sortOn('created_at')" class="kt-table-col group">
                                    <span class="kt-table-col-label">Criado em</span>
                                    <span class="kt-table-col-sort">
                                        @if ($sortBy === 'created_at')
                                            <i class="ki-filled ki-arrow-{{ $sortDir === 'asc' ? 'up' : 'down' }} text-primary text-xs"></i>
                                        @else
                                            <i class="ki-filled ki-arrows-up-down text-muted text-xs opacity-40 group-hover:opacity-70"></i>
                                        @endif
                                    </span>
                                </button>
                            </th>
                            <th class="text-center">Status</th>
                            <th class="w-[60px]"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($this->users() as $user)
                            <tr wire:key="user-{{ $user->id }}" class="{{ $user->trashed() ? 'opacity-60' : '' }}">
                                <td>
                                    <div class="flex items-center gap-3">
                                        <div class="relative shrink-0">
                                            <img src="{{ $user->avatarUrl() }}" alt="{{ $user->name }}"
                                                 class="rounded-full size-8 object-cover"/>
                                            @if ($user->trashed())
                                                <span
                                                    class="absolute -bottom-0.5 -right-0.5 size-2.5 rounded-full bg-muted border-2 border-background"></span>
                                            @else
                                                <span
                                                    class="absolute -bottom-0.5 -right-0.5 size-2.5 rounded-full bg-success border-2 border-background"></span>
                                            @endif
                                        </div>
                                        <div class="flex flex-col min-w-0">
                                            <a href="{{ route('settings.users.edit', $user) }}" wire:navigate
                                               class="text-sm font-medium text-mono hover:text-primary truncate">
                                                {{ $user->name }}
                                            </a>
                                            {{-- Em mobile mostra o email aqui --}}
                                            <span class="text-xs text-secondary-foreground truncate md:hidden">
                                                {{ $user->email }}
                                            </span>
                                            @if ($user->job_title)
                                                <span
                                                    class="text-xs text-secondary-foreground hidden md:block">{{ $user->job_title }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <td class="text-sm text-foreground hidden md:table-cell">
                                    {{ $user->email }}
                                    @if (! $user->email_verified_at)
                                        <x-ui.badge variant="warning" style="light" size="xs" class="ml-1">
                                            Não verificado
                                        </x-ui.badge>
                                    @endif
                                </td>

                                <td class="text-sm text-secondary-foreground hidden lg:table-cell">
                                    {{ $user->created_at->format('d/m/Y') }}
                                </td>

                                <td class="text-center">
                                    @if ($user->trashed())
                                        <x-ui.badge variant="secondary" style="outline" dot>Desativado</x-ui.badge>
                                    @else
                                        <x-ui.badge variant="success" style="light" dot>Ativo</x-ui.badge>
                                    @endif
                                </td>

                                <td>
                                    <div x-data="{ open: false }" class="relative flex justify-end">
                                        <button @click="open = !open" @click.outside="open = false"
                                                class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost">
                                            <i class="ki-filled ki-dots-vertical text-lg"></i>
                                        </button>
                                        <div x-show="open"
                                             x-transition:enter="transition ease-out duration-100"
                                             x-transition:enter-start="opacity-0 scale-95"
                                             x-transition:enter-end="opacity-100 scale-100"
                                             x-transition:leave="transition ease-in duration-75"
                                             x-transition:leave-start="opacity-100 scale-100"
                                             x-transition:leave-end="opacity-0 scale-95"
                                             @click="open = false"
                                             class="absolute right-0 top-8 z-50 min-w-[160px] rounded-lg border border-border bg-background shadow-lg py-1"
                                             style="display:none">
                                            <a class="kt-menu-link" href="{{ route('settings.users.edit', $user) }}"
                                               wire:navigate>
                                                <span class="kt-menu-icon"><i class="ki-filled ki-pencil"></i></span>
                                                <span class="kt-menu-title">Editar</span>
                                            </a>
                                            <div class="my-1 h-px bg-border"></div>
                                            <button class="kt-menu-link w-full text-left"
                                                    wire:click="toggleStatus({{ $user->id }})"
                                                    wire:confirm="{{ $user->trashed() ? 'Reativar este usuário?' : 'Desativar este usuário? Ele perderá o acesso ao sistema.' }}">
                                                <span class="kt-menu-icon">
                                                    @if ($user->trashed())
                                                        <i class="ki-filled ki-check-circle text-success"></i>
                                                    @else
                                                        <i class="ki-filled ki-minus-circle text-warning"></i>
                                                    @endif
                                                </span>
                                                <span
                                                    class="kt-menu-title">{{ $user->trashed() ? 'Reativar' : 'Desativar' }}</span>
                                            </button>
                                            <div class="my-1 h-px bg-border"></div>
                                            <button class="kt-menu-link w-full text-left"
                                                    wire:click="confirmDelete({{ $user->id }})">
                                                <span class="kt-menu-icon"><i
                                                        class="ki-filled ki-trash text-destructive"></i></span>
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
                                        @svg('lucide-users', ['class' => 'size-8 opacity-30'])
                                        <span class="text-sm">Nenhum usuário encontrado.</span>
                                        @if ($search)
                                            <button class="text-xs text-primary underline"
                                                    wire:click="$set('search', '')">
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

                @if ($this->users()->hasPages())
                    <div class="px-5 py-4 border-t border-border">
                        {{ $this->users()->links() }}
                    </div>
                @endif
            </div>
        </div>

    </div>

    <x-ui.modal id="modal_confirm_delete" size="sm" center :backdropStatic="true"
                x-data x-show="$wire.confirmingDelete"
                x-on:close-modal.window="$wire.cancelDelete()">
        <x-slot:header>
            <div class="flex items-center gap-2 text-destructive">
                @svg('lucide-triangle-alert', ['class' => 'size-4'])
                <h3 class="kt-modal-title">Excluir permanentemente</h3>
            </div>
            <button class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" wire:click="cancelDelete">
                <i class="ki-filled ki-cross text-sm"></i>
            </button>
        </x-slot:header>
        <p class="text-sm text-foreground">
            Esta ação <strong>não pode ser desfeita</strong>. O usuário será removido permanentemente do banco de dados,
            incluindo todos os seus dados relacionados.
        </p>
        <x-slot:footer>
            <x-ui.button ghost="secondary" wire:click="cancelDelete">Cancelar</x-ui.button>
            <x-ui.button variant="destructive" wire:click="deleteUser" icon="trash-2">
                Excluir permanentemente
            </x-ui.button>
        </x-slot:footer>
    </x-ui.modal>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('toast', ({variant, message}) => {
                KTToast.show({message, variant});
            });
        });
    </script>

</div>
