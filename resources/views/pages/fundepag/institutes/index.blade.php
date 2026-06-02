<?php

use App\Services\FundepagService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

new #[Title('Institutos')]
class extends Component {

    #[Url(as: 'q', except: '')]
    public string $search = '';

    #[Url(as: 'active', except: '')]
    public string|array $active = '1';

    public int $page = 1;
    public int $perPage = 15;

    public array $result = [];
    public bool $loading = false;
    public ?string $error = null;

    public function mount(): void
    {
        $this->active = (string) $this->active;
        $this->load();
    }

    public function updatedSearch(): void
    {
        $this->page = 1;
        $this->load();
    }

    public function updatedActive(): void
    {
        $this->page = 1;
        $this->load();
    }

    public function goToPage(int $page): void
    {
        $this->page = $page;
        $this->load();
    }

    public function load(): void
    {
        $this->error = null;

        try {
            $params = [
                'search'   => $this->search ?: null,
                'per_page' => $this->perPage,
                'page'     => $this->page,
            ];

            if ($this->active !== '') {
                $params['active'] = $this->active;
            }

            $this->result = app(FundepagService::class)->institutes($params);
        } catch (\Throwable $e) {
            $this->error = 'Não foi possível carregar os institutos. Verifique a conexão com a Fundepag API.';
            $this->result = [];
        }
    }
}; ?>

<div>

    <x-slot name="toolbar">
        <x-ui.breadcrumb>
            <x-ui.breadcrumb-item :first="true" href="{{ route('dashboard') }}">Home</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item>Fundepag</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item :active="true">Institutos</x-ui.breadcrumb-item>
        </x-ui.breadcrumb>
    </x-slot>

    <div class="py-6">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-mono">Institutos</h1>
            <p class="text-sm text-secondary-foreground mt-1">Instituições financiadoras sincronizadas do Protheus.</p>
        </div>

        @if ($error)
            <x-ui.alert variant="destructive" class="mb-6">
                <i class="ki-filled ki-information-2 mr-2"></i>
                {{ $error }}
                <button wire:click="load" class="ml-3 underline text-sm">Tentar novamente</button>
            </x-ui.alert>
        @endif

        <div class="kt-card kt-card-grid w-full">
            <div class="kt-card-header flex-wrap gap-2">
                <h3 class="kt-card-title text-sm text-secondary-foreground font-normal">
                    @if (!empty($result['meta']))
                        Exibindo {{ $result['meta']['from'] ?? 0 }}–{{ $result['meta']['to'] ?? 0 }}
                        de {{ $result['meta']['total'] ?? 0 }} instituto(s)
                    @else
                        &nbsp;
                    @endif
                </h3>
                <div class="flex flex-wrap gap-2 lg:gap-4">
                    <label class="kt-input kt-input-sm">
                        <i class="ki-filled ki-magnifier"></i>
                        <input type="text"
                               placeholder="Buscar por nome, sigla, código…"
                               wire:model.live.debounce.400ms="search"/>
                    </label>
                    <x-ui.select size="sm" wire:model.live="active" placeholder="Status">
                        <option value="1">Ativos</option>
                        <option value="0">Inativos</option>
                        <option value="">Todos</option>
                    </x-ui.select>
                    <button wire:click="load"
                            class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost"
                            title="Recarregar">
                        <i class="ki-filled ki-arrows-circle text-lg" wire:loading.class="animate-spin"></i>
                    </button>
                </div>
            </div>

            <div class="kt-card-content p-0">
                <div class="kt-scrollable-x-auto">
                    <table class="kt-table table-auto kt-table-border">
                        <thead>
                        <tr>
                            <th><span class="kt-table-col-label">Código</span></th>
                            <th><span class="kt-table-col-label">Sigla</span></th>
                            <th><span class="kt-table-col-label">Nome</span></th>
                            <th class="hidden md:table-cell"><span class="kt-table-col-label">E-mail</span></th>
                            <th class="hidden lg:table-cell"><span class="kt-table-col-label">Cidade / UF</span></th>
                            <th class="text-center"><span class="kt-table-col-label">Status</span></th>
                            <th class="hidden lg:table-cell text-center"><span class="kt-table-col-label">Sincronizado em</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr wire:loading.class.remove="hidden" class="hidden">
                            <td colspan="7" class="py-10 text-center text-secondary-foreground text-sm">
                                <i class="ki-filled ki-arrows-circle animate-spin mr-2"></i> Carregando…
                            </td>
                        </tr>
                        @forelse ($result['data'] ?? [] as $institute)
                            <tr wire:key="institute-{{ $institute['id'] }}">
                                <td class="text-sm font-mono font-medium">{{ $institute['code'] }}</td>
                                <td class="text-sm">{{ $institute['sigla'] ?? '—' }}</td>
                                <td class="text-sm font-medium text-mono">{{ $institute['name'] }}</td>
                                <td class="text-sm text-secondary-foreground hidden md:table-cell">
                                    {{ $institute['email'] ?? '—' }}
                                </td>
                                <td class="text-sm text-secondary-foreground hidden lg:table-cell">
                                    @if ($institute['city'])
                                        {{ $institute['city'] }}{{ $institute['state'] ? ' / ' . $institute['state'] : '' }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($institute['active'])
                                        <x-ui.badge variant="success" style="light" dot>Ativo</x-ui.badge>
                                    @else
                                        <x-ui.badge variant="secondary" style="outline" dot>Inativo</x-ui.badge>
                                    @endif
                                </td>
                                <td class="text-sm text-secondary-foreground hidden lg:table-cell text-center">
                                    {{ $institute['synced_at'] ? \Carbon\Carbon::parse($institute['synced_at'])->format('d/m/Y H:i') : '—' }}
                                </td>
                            </tr>
                        @empty
                            @if (!$error)
                                <tr wire:loading.remove>
                                    <td colspan="7" class="py-14 text-center">
                                        <div class="flex flex-col items-center gap-2 text-secondary-foreground">
                                            @svg('lucide-building-2', ['class' => 'size-8 opacity-30'])
                                            <span class="text-sm">Nenhum instituto encontrado.</span>
                                            @if ($search)
                                                <button class="text-xs text-primary underline"
                                                        wire:click="$set('search', '')">
                                                    Limpar busca
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Paginação manual (API externa, não usa LengthAwarePaginator do Laravel) --}}
                @if (!empty($result['meta']) && $result['meta']['last_page'] > 1)
                    <div class="px-5 py-4 border-t border-border flex items-center justify-between text-sm text-secondary-foreground">
                        <span>Página {{ $result['meta']['current_page'] }} de {{ $result['meta']['last_page'] }}</span>
                        <div class="flex gap-2">
                            <button wire:click="goToPage({{ $result['meta']['current_page'] - 1 }})"
                                    @disabled($result['meta']['current_page'] <= 1)
                                    class="kt-btn kt-btn-sm kt-btn-ghost {{ $result['meta']['current_page'] <= 1 ? 'opacity-40 cursor-not-allowed' : '' }}">
                                <i class="ki-filled ki-left text-xs"></i> Anterior
                            </button>
                            <button wire:click="goToPage({{ $result['meta']['current_page'] + 1 }})"
                                    @disabled($result['meta']['current_page'] >= $result['meta']['last_page'])
                                    class="kt-btn kt-btn-sm kt-btn-ghost {{ $result['meta']['current_page'] >= $result['meta']['last_page'] ? 'opacity-40 cursor-not-allowed' : '' }}">
                                Próxima <i class="ki-filled ki-right text-xs"></i>
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
