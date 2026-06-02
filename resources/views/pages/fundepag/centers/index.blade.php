<?php

use App\Services\FundepagService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

new #[Title('Centros')]
class extends Component {

    #[Url(as: 'q', except: '')]
    public string $search = '';

    #[Url(as: 'active', except: '')]
    public string $active = '1';

    #[Url(as: 'institute', except: '')]
    public string $instituteId = '';

    public int $page = 1;
    public int $perPage = 15;

    public array $result = [];
    public array $institutes = [];
    public bool $loading = false;
    public ?string $error = null;

    public function mount(): void
    {
        $this->active = (string) $this->active;
        $this->instituteId = (string) $this->instituteId;
        $this->loadInstitutes();
        $this->load();
    }

    public function updatedSearch(): void { $this->page = 1; $this->load(); }
    public function updatedActive(): void { $this->page = 1; $this->load(); }
    public function updatedInstituteId(): void { $this->page = 1; $this->load(); }

    public function goToPage(int $page): void
    {
        $this->page = $page;
        $this->load();
    }

    protected function loadInstitutes(): void
    {
        try {
            $res = app(FundepagService::class)->institutes(['active' => '1', 'per_page' => 100]);
            $this->institutes = $res['data'] ?? [];
        } catch (\Throwable) {
            $this->institutes = [];
        }
    }

    public function load(): void
    {
        $this->error = null;

        try {
            $params = [
                'search'       => $this->search ?: null,
                'institute_id' => $this->instituteId ?: null,
                'per_page'     => $this->perPage,
                'page'         => $this->page,
            ];

            if ($this->active !== '') {
                $params['active'] = $this->active;
            }

            $this->result = app(FundepagService::class)->centers($params);
        } catch (\Throwable $e) {
            $this->error = 'Não foi possível carregar os centros. Verifique a conexão com a Fundepag API.';
            $this->result = [];
        }
    }
}; ?>

<div>

    <x-slot name="toolbar">
        <x-ui.breadcrumb>
            <x-ui.breadcrumb-item :first="true" href="{{ route('dashboard') }}">Home</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item>Fundepag</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item :active="true">Centros</x-ui.breadcrumb-item>
        </x-ui.breadcrumb>
    </x-slot>

    <div class="py-6">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-mono">Centros</h1>
            <p class="text-sm text-secondary-foreground mt-1">Centros de custo vinculados aos institutos.</p>
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
                        de {{ $result['meta']['total'] ?? 0 }} centro(s)
                    @else
                        &nbsp;
                    @endif
                </h3>
                <div class="flex flex-wrap gap-2 lg:gap-4">
                    <label class="kt-input kt-input-sm">
                        <i class="ki-filled ki-magnifier"></i>
                        <input type="text"
                               placeholder="Buscar por nome, código, subcentro…"
                               wire:model.live.debounce.400ms="search"/>
                    </label>
                    @if (count($institutes))
                        <x-ui.select size="sm" wire:model.live="instituteId" placeholder="Instituto">
                            <option value="">Todos os institutos</option>
                            @foreach ($institutes as $inst)
                                <option value="{{ $inst['id'] }}">
                                    {{ $inst['sigla'] ?? $inst['code'] }} — {{ \Str::limit($inst['name'], 40) }}
                                </option>
                            @endforeach
                        </x-ui.select>
                    @endif
                    <x-ui.select size="sm" wire:model.live="active">
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
                            <th><span class="kt-table-col-label">Subcentro</span></th>
                            <th><span class="kt-table-col-label">Nome / Descrição</span></th>
                            <th class="hidden md:table-cell"><span class="kt-table-col-label">Instituto</span></th>
                            <th class="hidden md:table-cell"><span class="kt-table-col-label">E-mail</span></th>
                            <th class="hidden lg:table-cell"><span class="kt-table-col-label">Cidade / UF</span></th>
                            <th class="text-center"><span class="kt-table-col-label">Status</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($result['data'] ?? [] as $center)
                            <tr wire:key="center-{{ $center['id'] }}">
                                <td class="text-sm font-mono font-medium">{{ $center['code'] }}</td>
                                <td class="text-sm font-mono">{{ $center['subcenter'] }}</td>
                                <td>
                                    <div class="text-sm font-medium text-mono">
                                        {{ $center['name'] ?? '—' }}
                                    </div>
                                    @if ($center['description'])
                                        <div class="text-xs text-secondary-foreground truncate max-w-[220px]">
                                            {{ $center['description'] }}
                                        </div>
                                    @endif
                                </td>
                                <td class="text-sm text-secondary-foreground hidden md:table-cell">
                                    @if (!empty($center['institute']))
                                        <span class="font-mono text-xs">{{ $center['institute']['sigla'] ?? $center['institute']['code'] }}</span>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="text-sm text-secondary-foreground hidden md:table-cell">
                                    {{ $center['email'] ?? '—' }}
                                </td>
                                <td class="text-sm text-secondary-foreground hidden lg:table-cell">
                                    @if ($center['city'])
                                        {{ $center['city'] }}{{ $center['state'] ? ' / ' . $center['state'] : '' }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if ($center['active'])
                                        <x-ui.badge variant="success" style="light" dot>Ativo</x-ui.badge>
                                    @else
                                        <x-ui.badge variant="secondary" style="outline" dot>Inativo</x-ui.badge>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr wire:loading.remove>
                                <td colspan="7" class="py-14 text-center">
                                    <div class="flex flex-col items-center gap-2 text-secondary-foreground">
                                        @svg('lucide-layout-grid', ['class' => 'size-8 opacity-30'])
                                        <span class="text-sm">Nenhum centro encontrado.</span>
                                        @if ($search || $instituteId)
                                            <button class="text-xs text-primary underline"
                                                    wire:click="$set('search', ''); $set('instituteId', '')">
                                                Limpar filtros
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

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
