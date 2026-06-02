<?php

use App\Services\FundepagService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

new #[Title('Contratos')]
class extends Component {

    #[Url(as: 'q', except: '')]
    public string|array $search = '';

    #[Url(as: 'active', except: '')]
    public string|array $active = '1';

    #[Url(as: 'status', except: '')]
    public string|array $status = '';

    #[Url(as: 'institute', except: '')]
    public string|array $instituteId = '';

    public int $page = 1;
    public int $perPage = 15;

    public array $result = [];
    public array $institutes = [];
    public ?string $error = null;

    public function mount(): void
    {
        $this->active      = (string) (is_array($this->active)      ? '' : $this->active);
        $this->status      = (string) (is_array($this->status)      ? '' : $this->status);
        $this->instituteId = (string) (is_array($this->instituteId) ? '' : $this->instituteId);
        $this->search      = (string) (is_array($this->search)      ? '' : $this->search);
        $this->loadInstitutes();
        $this->load();
    }

    public function updatedSearch(): void { $this->page = 1; $this->load(); }
    public function updatedActive(): void { $this->page = 1; $this->load(); }
    public function updatedStatus(): void { $this->page = 1; $this->load(); }
    public function updatedInstituteId(): void { $this->page = 1; $this->load(); }

    public function goToPage(int $page): void
    {
        $this->page = $page;
        $this->load();
    }

    protected function loadInstitutes(): void
    {
        try {
            $res = app(FundepagService::class)->institutes(['per_page' => 100]);
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
                'status'       => $this->status ?: null,
                'per_page'     => $this->perPage,
                'page'         => $this->page,
            ];

            if ($this->active !== '') {
                $params['active'] = $this->active;
            }

            $this->result = app(FundepagService::class)->contracts($params);
        } catch (\Throwable $e) {
            $this->error = 'Não foi possível carregar os contratos. Verifique a conexão com a Fundepag API.';
            $this->result = [];
        }
    }
}; ?>

<div>

    <x-slot name="toolbar">
        <x-ui.breadcrumb>
            <x-ui.breadcrumb-item :first="true" href="{{ route('dashboard') }}">Home</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item>Fundepag</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item :active="true">Contratos</x-ui.breadcrumb-item>
        </x-ui.breadcrumb>
    </x-slot>

    <div class="py-6">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-mono">Contratos</h1>
            <p class="text-sm text-secondary-foreground mt-1">Contratos sincronizados do Protheus via Fundepag API.</p>
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
                        de {{ $result['meta']['total'] ?? 0 }} contrato(s)
                    @else
                        &nbsp;
                    @endif
                </h3>
                <div class="flex flex-wrap gap-2 lg:gap-4">
                    <label class="kt-input kt-input-sm">
                        <i class="ki-filled ki-magnifier"></i>
                        <input type="text"
                               placeholder="Título, código, coordenador…"
                               wire:model.live.debounce.400ms="search"/>
                    </label>
                    @if (count($institutes))
                        <x-ui.select size="sm" wire:model.live="instituteId">
                            <option value="">Todos os institutos</option>
                            @foreach ($institutes as $inst)
                                <option value="{{ $inst['id'] }}">
                                    {{ $inst['sigla'] ?? $inst['code'] }} — {{ \Str::limit($inst['name'], 35) }}
                                </option>
                            @endforeach
                        </x-ui.select>
                    @endif
                    <x-ui.select size="sm" wire:model.live="status">
                        <option value="">Todos os status</option>
                        <option value="A">Ativo (A)</option>
                        <option value="E">Encerrado (E)</option>
                        <option value="S">Suspenso (S)</option>
                    </x-ui.select>
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
                            <th><span class="kt-table-col-label">Exec / Sub</span></th>
                            <th><span class="kt-table-col-label">Título</span></th>
                            <th class="hidden md:table-cell"><span class="kt-table-col-label">Instituto</span></th>
                            <th class="hidden lg:table-cell"><span class="kt-table-col-label">Centro</span></th>
                            <th class="hidden lg:table-cell text-right"><span class="kt-table-col-label">Valor</span></th>
                            <th class="hidden xl:table-cell"><span class="kt-table-col-label">Vigência</span></th>
                            <th class="hidden md:table-cell"><span class="kt-table-col-label">Coordenador</span></th>
                            <th class="text-center"><span class="kt-table-col-label">Status</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($result['data'] ?? [] as $contract)
                            <tr wire:key="contract-{{ $contract['id'] }}">
                                <td class="text-sm font-mono font-medium text-primary">
                                    {{ $contract['code'] }}
                                </td>
                                <td class="text-xs font-mono text-secondary-foreground">
                                    {{ $contract['exec_code'] ?? '—' }}
                                    @if ($contract['sub_code'])
                                        <span class="text-muted">/{{ $contract['sub_code'] }}</span>
                                    @endif
                                </td>
                                <td class="max-w-[200px]">
                                    <p class="text-sm font-medium text-mono truncate">
                                        {{ $contract['title'] ?? '—' }}
                                    </p>
                                    @if ($contract['type'])
                                        <span class="text-xs text-secondary-foreground">Tipo: {{ $contract['type'] }}</span>
                                    @endif
                                </td>
                                <td class="text-sm text-secondary-foreground hidden md:table-cell">
                                    @if (!empty($contract['institute']))
                                        <span class="font-mono text-xs">{{ $contract['institute']['sigla'] ?? $contract['institute']['code'] }}</span>
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="text-sm text-secondary-foreground hidden lg:table-cell">
                                    @if (!empty($contract['center']))
                                        <span class="font-mono text-xs">{{ $contract['center']['subcenter'] }}</span>
                                        @if ($contract['center']['name'])
                                            <span class="text-xs"> · {{ \Str::limit($contract['center']['name'], 20) }}</span>
                                        @endif
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="text-sm text-right hidden lg:table-cell">
                                    @if ($contract['value'])
                                        R$ {{ number_format($contract['value'], 2, ',', '.') }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="text-xs text-secondary-foreground hidden xl:table-cell whitespace-nowrap">
                                    @if ($contract['start_date'] || $contract['end_date'])
                                        {{ $contract['start_date'] ? \Carbon\Carbon::parse($contract['start_date'])->format('d/m/Y') : '?' }}
                                        →
                                        {{ $contract['end_date'] ? \Carbon\Carbon::parse($contract['end_date'])->format('d/m/Y') : '?' }}
                                    @else
                                        —
                                    @endif
                                </td>
                                <td class="text-sm text-secondary-foreground hidden md:table-cell max-w-[140px]">
                                    <span class="truncate block">{{ $contract['coordinator'] ?? '—' }}</span>
                                </td>
                                <td class="text-center">
                                    @php
                                        $s = $contract['status'] ?? '';
                                        $variant = match($s) {
                                            'A' => 'success',
                                            'E' => 'secondary',
                                            'S' => 'warning',
                                            default => 'secondary'
                                        };
                                        $label = match($s) {
                                            'A' => 'Ativo',
                                            'E' => 'Encerrado',
                                            'S' => 'Suspenso',
                                            default => $s ?: '—'
                                        };
                                    @endphp
                                    <x-ui.badge :variant="$variant" style="light" dot>{{ $label }}</x-ui.badge>
                                </td>
                            </tr>
                        @empty
                            <tr wire:loading.remove>
                                <td colspan="9" class="py-14 text-center">
                                    <div class="flex flex-col items-center gap-2 text-secondary-foreground">
                                        @svg('lucide-file-text', ['class' => 'size-8 opacity-30'])
                                        <span class="text-sm">Nenhum contrato encontrado.</span>
                                        @if ($search || $instituteId || $status)
                                            <button class="text-xs text-primary underline"
                                                    wire:click="$set('search', ''); $set('instituteId', ''); $set('status', '')">
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
