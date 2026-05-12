<?php

use Illuminate\Support\Facades\Artisan;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Layout')] class extends Component
{
    public string $container = 'kt-container-fixed';

    public function mount(): void
    {
        $this->container = config('layout.container', 'kt-container-fixed');
    }

    public function save(): void
    {
        // Persiste no .env para sobreviver a deploys
        $this->updateEnv('LAYOUT_CONTAINER', $this->container);

        // Atualiza o valor em runtime sem precisar reiniciar
        config(['layout.container' => $this->container]);

        Artisan::call('config:clear');

        $this->dispatch('toast', variant: 'success', message: 'Configuração de layout salva.');
    }

    protected function updateEnv(string $key, string $value): void
    {
        $path = base_path('.env');

        if (! file_exists($path)) return;

        $content = file_get_contents($path);

        if (str_contains($content, "{$key}=")) {
            $content = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $content);
        } else {
            $content .= PHP_EOL . "{$key}={$value}";
        }

        file_put_contents($path, $content);
    }
}; ?>

<div class="{{ config('layout.container') }}">
    <div class="grid gap-5 lg:gap-7.5 max-w-2xl">

        {{-- ── Breadcrumb ───────────────────────────────────────────────── --}}
        <x-ui.breadcrumb>
            <x-ui.breadcrumb-item :href="route('dashboard')" label="Home" />
            <x-ui.breadcrumb-item label="Configurações" />
            <x-ui.breadcrumb-item label="Layout" :current="true" />
        </x-ui.breadcrumb>

        {{-- ── Header ──────────────────────────────────────────────────── --}}
        <div>
            <h1 class="text-xl font-semibold text-mono">Layout</h1>
            <p class="text-sm text-secondary-foreground mt-0.5">
                Defina como o conteúdo das páginas é apresentado no painel.
            </p>
        </div>

        {{-- ── Seleção de container ─────────────────────────────────────── --}}
        <x-ui.card-section icon="lucide-layout" title="Container de conteúdo">

            <x-slot:subtitle>
                Controla a largura máxima da área de conteúdo em todas as páginas do painel.
                A alteração é aplicada globalmente e de forma imediata.
            </x-slot:subtitle>

            <x-slot:actions>
                <x-ui.button
                    type="button"
                    variant="primary"
                    size="sm"
                    icon="save"
                    wire:click="save"
                    wire:loading.attr="disabled"
                    wire:target="save"
                >
                    <span wire:loading.remove wire:target="save">Salvar</span>
                    <span wire:loading wire:target="save">Salvando…</span>
                </x-ui.button>
            </x-slot:actions>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                {{-- Opção: Fixed --}}
                <label
                    class="relative flex flex-col gap-3 p-4 rounded-xl border-2 cursor-pointer transition-colors
                        {{ $container === 'kt-container-fixed'
                            ? 'border-primary bg-primary/5'
                            : 'border-border hover:border-input' }}"
                >
                    <input
                        type="radio"
                        name="container"
                        value="kt-container-fixed"
                        wire:model="container"
                        class="sr-only"
                    />

                    {{-- Checkmark --}}
                    @if ($container === 'kt-container-fixed')
                        <span class="absolute top-3 right-3 size-5 rounded-full bg-primary flex items-center justify-center">
                            @svg('lucide-check', ['class' => 'size-3 text-white'])
                        </span>
                    @endif

                    {{-- Preview visual --}}
                    <div class="rounded-lg bg-muted/60 p-3 flex flex-col gap-1.5 overflow-hidden">
                        {{-- Barra de topo simulada --}}
                        <div class="h-2 w-full rounded bg-border/80"></div>
                        {{-- Área de conteúdo centralizada --}}
                        <div class="flex gap-1.5 mt-1">
                            <div class="w-2 rounded bg-border/50 self-stretch"></div>
                            <div class="flex-1 flex flex-col gap-1 mx-4">
                                <div class="h-1.5 rounded bg-primary/30 w-3/4"></div>
                                <div class="h-1.5 rounded bg-border/70 w-full"></div>
                                <div class="h-1.5 rounded bg-border/70 w-5/6"></div>
                                <div class="h-1.5 rounded bg-border/70 w-2/3"></div>
                            </div>
                            <div class="w-2 rounded bg-border/50 self-stretch"></div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-0.5">
                        <span class="text-sm font-medium text-mono">Largura fixa</span>
                        <span class="text-xs text-secondary-foreground">
                            Conteúdo centralizado com largura máxima definida.
                            Ideal para leitura confortável em telas largas.
                        </span>
                        <code class="text-xs text-primary mt-1 font-mono">kt-container-fixed</code>
                    </div>
                </label>

                {{-- Opção: Fluid --}}
                <label
                    class="relative flex flex-col gap-3 p-4 rounded-xl border-2 cursor-pointer transition-colors
                        {{ $container === 'kt-container-fluid'
                            ? 'border-primary bg-primary/5'
                            : 'border-border hover:border-input' }}"
                >
                    <input
                        type="radio"
                        name="container"
                        value="kt-container-fluid"
                        wire:model="container"
                        class="sr-only"
                    />

                    @if ($container === 'kt-container-fluid')
                        <span class="absolute top-3 right-3 size-5 rounded-full bg-primary flex items-center justify-center">
                            @svg('lucide-check', ['class' => 'size-3 text-white'])
                        </span>
                    @endif

                    {{-- Preview visual --}}
                    <div class="rounded-lg bg-muted/60 p-3 flex flex-col gap-1.5 overflow-hidden">
                        <div class="h-2 w-full rounded bg-border/80"></div>
                        <div class="flex gap-1.5 mt-1">
                            <div class="w-2 rounded bg-border/50 self-stretch"></div>
                            <div class="flex-1 flex flex-col gap-1">
                                <div class="h-1.5 rounded bg-primary/30 w-3/4"></div>
                                <div class="h-1.5 rounded bg-border/70 w-full"></div>
                                <div class="h-1.5 rounded bg-border/70 w-full"></div>
                                <div class="h-1.5 rounded bg-border/70 w-full"></div>
                            </div>
                            <div class="w-2 rounded bg-border/50 self-stretch"></div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-0.5">
                        <span class="text-sm font-medium text-mono">Largura total</span>
                        <span class="text-xs text-secondary-foreground">
                            Conteúdo ocupa toda a largura disponível.
                            Ideal para tabelas e dashboards com muitos dados.
                        </span>
                        <code class="text-xs text-primary mt-1 font-mono">kt-container-fluid</code>
                    </div>
                </label>

            </div>

            {{-- Valor atual --}}
            <div class="flex items-center gap-2 text-xs text-secondary-foreground pt-1">
                @svg('lucide-info', ['class' => 'size-3.5 shrink-0'])
                <span>
                    Configuração atual:
                    <code class="font-mono text-foreground">{{ config('layout.container') }}</code>
                    — definida via
                    <code class="font-mono">LAYOUT_CONTAINER</code> no <code class="font-mono">.env</code>
                </span>
            </div>

        </x-ui.card-section>

    </div>

    {{-- Toast --}}
    <div
        x-data
        x-on:toast.window="
            const e = $event.detail[0] ?? $event.detail;
            $dispatch('kt-toast', { variant: e.variant, message: e.message });
        "
    ></div>

</div>
