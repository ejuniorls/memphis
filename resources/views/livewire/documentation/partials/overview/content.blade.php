{{-- Introdução --}}
<div class="mb-10">
    <div class="flex items-center gap-3 mb-3">
        <h1 class="text-2xl font-bold text-mono">Introdução</h1>
        <x-ui.badge variant="primary">v1.0</x-ui.badge>
    </div>
    <p class="text-sm text-gray-500 leading-relaxed">
        Biblioteca de componentes Blade construída sobre o
        <x-ui.button tag="a" href="https://ktui.io" ghost="primary" class="inline-flex px-0! gap-1 h-auto!">KTUI</x-ui.button>
        e o tema
        <x-ui.button tag="a" href="https://keenthemes.com/metronic" ghost="primary" class="inline-flex px-0! gap-1 h-auto!">Metronic 9</x-ui.button>,
        integrada ao Laravel 12 com Livewire 3 e Tailwind CSS.
    </p>
</div>

{{-- Stack --}}
<section class="mb-10">
    <h2 class="text-base font-semibold text-mono mb-4">Stack</h2>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        @foreach([
            ['label' => 'Laravel 12',   'icon' => 'lucide-code',              'color' => 'text-primary',    'bg' => 'bg-primary/10 dark:bg-red-900/20'],
            ['label' => 'Livewire 3',   'icon' => 'lucide-zap',               'color' => 'text-primary',    'bg' => 'bg-primary/10 dark:bg-pink-900/20'],
            ['label' => 'Tailwind CSS', 'icon' => 'lucide-paintbrush',        'color' => 'text-primary',    'bg' => 'bg-primary/10 dark:bg-blue-900/20'],
            ['label' => 'KTUI',         'icon' => 'lucide-layout-panel-left', 'color' => 'text-violet-500', 'bg' => 'bg-violet-900 dark:bg-violet-900'],
        ] as $tech)
            <div class="kt-card">
                <div class="kt-card-content flex items-center gap-3 p-4">
                    <div class="size-9 rounded-lg {{ $tech['bg'] }} flex items-center justify-center shrink-0">
                        @svg($tech['icon'], ['class' => 'size-4 ' . $tech['color']])
                    </div>
                    <span class="text-sm font-semibold text-mono">{{ $tech['label'] }}</span>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- Componentes disponíveis --}}
<section>
    <h2 class="text-base font-semibold text-mono mb-4">Componentes disponíveis</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
        @foreach([
            ['slug' => 'alert',      'label' => 'Alert',      'desc' => 'Mensagens de feedback contextual ao usuário.',      'icon' => 'lucide-info',              'stable' => true],
            ['slug' => 'badge',      'label' => 'Badge',      'desc' => 'Indicadores de status, contadores e rótulos.',      'icon' => 'lucide-tag',               'stable' => true],
            ['slug' => 'breadcrumb', 'label' => 'Breadcrumb', 'desc' => 'Trilha de navegação hierárquica com separadores.',  'icon' => 'lucide-navigation',        'stable' => true],
            ['slug' => 'button',     'label' => 'Button',     'desc' => 'Botões com variantes, tamanhos e ícones.',          'icon' => 'lucide-mouse-pointer-2',   'stable' => true],
            ['slug' => 'form-input', 'label' => 'Form Input', 'desc' => 'Campos de formulário com validação e estados.',     'icon' => 'lucide-text-cursor-input', 'stable' => true],
            ['slug' => 'link',       'label' => 'Link',       'desc' => 'Links com sublinhado, variantes e ícones.',         'icon' => 'lucide-link',              'stable' => true],
            ['slug' => 'select',     'label' => 'Select',     'desc' => 'Seleção simples, múltipla, tags e busca.',          'icon' => 'lucide-chevrons-up-down',  'stable' => true],
            ['slug' => 'card',       'label' => 'Card',       'desc' => 'Contêiner de conteúdo com header e footer.',        'icon' => 'lucide-square',            'stable' => false],
            ['slug' => 'modal',      'label' => 'Modal',      'desc' => 'Diálogos sobrepostos com foco.',                    'icon' => 'lucide-maximize-2',        'stable' => false],
            ['slug' => 'accordion',  'label' => 'Accordion',  'desc' => 'Seções expansíveis de conteúdo.',                   'icon' => 'lucide-panel-top-open',    'stable' => false],
            ['slug' => 'table',      'label' => 'Table',      'desc' => 'Tabelas de dados com suporte a ordenação.',         'icon' => 'lucide-table',             'stable' => false],
        ] as $comp)
            <a href="{{ route('documentation.index', $comp['slug']) }}"
               class="kt-card hover:shadow-md transition-all group cursor-pointer">
                <div class="kt-card-content p-4">
                    <div class="flex items-start justify-between mb-3">
                        <div class="size-10 rounded-xl bg-primary/10 flex items-center justify-center group-hover:bg-primary/20 transition-colors">
                            @svg($comp['icon'], ['class' => 'size-5 text-primary'])
                        </div>
                        @if($comp['stable'])
                            <x-ui.badge variant="success" size="xs">Estável</x-ui.badge>
                        @else
                            <x-ui.badge size="xs">Em breve</x-ui.badge>
                        @endif
                    </div>
                    <div class="text-sm font-semibold text-mono mb-1">{{ $comp['label'] }}</div>
                    <div class="text-xs text-gray-400 leading-relaxed">{{ $comp['desc'] }}</div>
                    <div class="flex items-center gap-1 mt-3 text-xs text-primary opacity-0 group-hover:opacity-100 transition-opacity">
                        Ver documentação
                        <x-lucide-arrow-right class="size-3"/>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>
