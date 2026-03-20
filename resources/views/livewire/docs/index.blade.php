<div class="kt-container-fluid">
    teste
</div>

<div class="flex gap-6 items-start">

    {{-- Sidebar --}}
    <x-docs.sidebar :active="null"/>

    {{-- Main --}}
    <div class="flex-1 min-w-0">
        <div class="mb-8">
            <h1 class="text-2xl font-semibold text-mono mb-1">Components</h1>
            <p class="text-sm text-gray-500">
                Documentação dos componentes Blade/Livewire baseados no KTUI + Metronic 9.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach([
                ['slug' => 'button',     'label' => 'Button',     'desc' => 'Botões com variantes, tamanhos e ícones.',        'icon' => 'ki-mouse-square'],
                ['slug' => 'alert',      'label' => 'Alert',      'desc' => 'Mensagens de feedback para o usuário.',             'icon' => 'ki-information'],
                ['slug' => 'badge',      'label' => 'Badge',      'desc' => 'Indicadores de status e contadores.',               'icon' => 'ki-tag'],
                ['slug' => 'card',       'label' => 'Card',       'desc' => 'Contêiner de conteúdo com header e footer.',        'icon' => 'ki-element-equal'],
                ['slug' => 'modal',      'label' => 'Modal',      'desc' => 'Diálogos sobrepostos com foco.',                    'icon' => 'ki-maximize'],
                ['slug' => 'accordion',  'label' => 'Accordion',  'desc' => 'Seções expansíveis de conteúdo.',                   'icon' => 'ki-row-vertical'],
                ['slug' => 'table',      'label' => 'Table',      'desc' => 'Tabelas de dados com suporte a ordenação.',         'icon' => 'ki-tablet'],
                ['slug' => 'form-form-input', 'label' => 'Form Input', 'desc' => 'Campos de formulário com validação e estados.',     'icon' => 'ki-text-align-left'],
            ] as $comp)
                <a href="{{ route('docs.component', $comp['slug']) }}"
                   class="card hover:shadow-md transition-shadow group">
                    <div class="card-body p-5 flex gap-4 items-start">
                        <div
                            class="size-10 rounded-lg bg-primary/10 flex items-center justify-center shrink-0 group-hover:bg-primary/20 transition-colors">
                            <i class="{{ $comp['icon'] }} text-primary text-lg"></i>
                        </div>
                        <div>
                            <div class="font-medium text-mono text-sm mb-0.5">{{ $comp['label'] }}</div>
                            <div class="text-xs text-gray-500 leading-relaxed">{{ $comp['desc'] }}</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

</div>
