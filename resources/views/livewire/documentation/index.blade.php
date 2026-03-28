<main class="grow" role="content">
    {{-- Toolbar --}}
    <div class="pb-6">
        <div class="kt-container-fluid flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center flex-wrap gap-1 lg:gap-5">
                <h1 class="font-medium text-lg text-mono">
                    Documentação
                </h1>
                <div class="flex items-center gap-1 text-sm font-normal">
                    <a class="text-secondary-foreground hover:text-primary" href="">
                        Home
                    </a>
                    <span class="text-muted-foreground text-sm">/</span>
                    <span class="text-mono">Documentação</span>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a class="kt-btn kt-btn-outline kt-btn-sm" href="#">
                    <x-lucide-github class="size-4"/>
                    Changelog
                </a>
                <a class="kt-btn kt-btn-primary kt-btn-sm" href="">
                    <x-lucide-book-open class="size-4"/>
                    Ver Componentes
                </a>
            </div>
        </div>
    </div>
    {{-- End Toolbar --}}

    <div class="kt-container-fluid grid grid-cols-1 gap-5 lg:gap-7.5">

        {{-- Hero --}}
        <div class="kt-card h-full">
            <div class="kt-card-content flex flex-col place-content-center gap-5">
                <div class="flex justify-center">
                    <img alt="image" class="dark:hidden max-h-[180px]"
                         src="{{ asset('assets/media/illustrations/32.svg') }}">
                    <img alt="image" class="light:hidden max-h-[180px]"
                         src="{{ asset('assets/media/illustrations/32-dark.svg') }}">
                </div>
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-3 text-center">
                        <div class="flex items-center justify-center lg:justify-start gap-2">
                            <span class="kt-badge kt-badge-sm kt-badge-primary kt-badge-outline">Memphis ERP</span>
                            <span class="kt-badge kt-badge-sm kt-badge-outline">v1.0</span>
                        </div>
                        <h2 class="text-xl font-semibold text-mono">
                            Central de Documentação
                        </h2>
                        <p class="text-sm font-medium text-secondary-foreground">
                            Referência central de componentes, estilos, padrões de interface e regras de negócio do
                            Memphis ERP.
                            <br>
                            Tudo que você precisa para desenvolver interfaces consistentes, escaláveis e alinhadas à
                            marca.
                        </p>
                    </div>
                </div>

                <div
                    class="relative flex-shrink-0 grid grid-cols-4 gap-px rounded-xl overflow-hidden border border-border bg-border w-full lg:w-auto">
                    @foreach ([
                        ['value' => '24', 'label' => 'Componentes', 'icon' => 'layout-grid'],
                        ['value' => '6',  'label' => 'Módulos',     'icon' => 'package'],
                        ['value' => '3',  'label' => 'Integrações', 'icon' => 'plug'],
                        ['value' => '3',  'label' => 'Integrações', 'icon' => 'plug'],
                    ] as $stat)
                        <div class="flex flex-col items-center gap-1 py-5 px-6 bg-card">
                            <x-dynamic-component :component="'lucide-' . $stat['icon']"
                                                 class="size-5 text-primary mb-1"/>
                            <span class="text-xl font-bold text-mono">{{ $stat['value'] }}</span>
                            <span class="text-xs text-muted-foreground text-center">{{ $stat['label'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- End Hero --}}

        {{-- Search bar --}}
        <div class="kt-card">
            <div class="kt-card-body py-4">
                <div class="flex items-center gap-3">
                    <div class="relative grow">
                        <x-lucide-search
                            class="absolute left-3 top-1/2 -translate-y-1/2 size-4 text-muted-foreground pointer-events-none"/>
                        <input
                            type="text"
                            placeholder="Buscar na documentação... (ex: Button, cores, brand)"
                            class="kt-input kt-input-sm pl-9 w-full"
                        />
                    </div>
                    <kbd
                        class="hidden sm:inline-flex items-center gap-1 px-2 py-1 rounded border border-border bg-muted text-xs text-muted-foreground font-mono">
                        <span>⌘</span><span>K</span>
                    </kbd>
                </div>
            </div>
        </div>
        {{-- End Search bar --}}

        {{-- Grid de categorias --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5 lg:gap-7.5">

            @php
                $categories = [
                    [
                        'title'       => 'Componentes UI',
                        'description' => 'Buttons, Inputs, Badges, Alerts, Cards, Modais e todos os elementos base da interface.',
                        'icon'        => 'layout-grid',
                        'color'       => 'text-primary bg-primary/10',
                        'badge'       => '24 componentes',
                        'badge_style' => 'kt-badge-primary',
                        'route'       => 'documentation.components',
                        'items'       => ['Button', 'Input', 'Select', 'Badge', 'Alert', 'Modal'],
                    ],
                    [
                        'title'       => 'Páginas &amp; Layouts',
                        'description' => 'Estruturas de página, layouts de autenticação, dashboards, formulários e painéis.',
                        'icon'        => 'panel-left',
                        'color'       => 'text-primary bg-primary/10',
                        'badge'       => '12 páginas',
                        'badge_style' => 'kt-badge-outline',
                        'route'       => 'documentation.components',
                        'items'       => ['Dashboard', 'Auth', 'Perfil', 'Configurações', 'Listagem', 'Detalhe'],
                    ],
                    [
                        'title'       => 'Cores &amp; Tokens',
                        'description' => 'Paleta de cores, tokens semânticos, variáveis CSS e estados (primary, success, warning, danger).',
                        'icon'        => 'palette',
                        'color'       => 'text-primary bg-primary/10',
                        'badge'       => 'Design tokens',
                        'badge_style' => 'kt-badge-outline',
                        'route'       => 'documentation.components',
                        'items'       => ['Primary', 'Muted', 'Success', 'Warning', 'Danger', 'Background'],
                    ],
                    [
                        'title'       => 'Brand Guideline',
                        'description' => 'Logo, tipografia, ícones, espaçamentos, tom de voz e uso correto da identidade visual.',
                        'icon'        => 'star',
                        'color'       => 'text-primary bg-primary/10',
                        'badge'       => 'Identidade',
                        'badge_style' => 'kt-badge-outline',
                        'route'       => 'documentation.components',
                        'items'       => ['Logo', 'Tipografia', 'Ícones', 'Espaçamento', 'Tom de voz'],
                    ],
                    [
                        'title'       => 'Integrações',
                        'description' => 'Referência de APIs internas, webhooks, autenticação e conexões com sistemas externos.',
                        'icon'        => 'plug',
                        'color'       => 'text-primary bg-primary/10',
                        'badge'       => '3 integrações',
                        'badge_style' => 'kt-badge-outline',
                        'route'       => 'documentation.components',
                        'items'       => ['REST API', 'Webhooks', 'OAuth', 'Importação'],
                    ],
                    [
                        'title'       => 'Guia de Contribuição',
                        'description' => 'Como criar novos componentes, convenções de código, padrões de nomenclatura e revisão.',
                        'icon'        => 'git-branch',
                        'color'       => 'text-primary bg-primary/10',
                        'badge'       => 'Contribuidores',
                        'badge_style' => 'kt-badge-outline',
                        'route'       => 'documentation.components',
                        'items'       => ['Convenções', 'Blade', 'Livewire', 'Tailwind', 'i18n'],
                    ],
                ];
            @endphp

            @foreach ($categories as $cat)
                <div class="kt-card p-5 lg:px-7 lg:py-6 ">
                    <div class="flex flex-col gap-2.5">
                        <div
                            class="flex items-center justify-center size-10 rounded-lg {{ $cat['color'] }} shrink-0">
                            <x-dynamic-component :component="'lucide-' . $cat['icon']" class="size-5"/>
                        </div>
                        <div class="flex flex-col gap-3">
                            <h3 class="text-base font-medium leading-none text-mono">
                                {!! $cat['title'] !!}
                            </h3>
                            <div class="text-sm text-secondary-foreground leading-5">
                                {{ $cat['description'] }}
                            </div>
                        </div>
                        <div class="flex items-center flex-wrap">
                            <x-ui.link href="{{ route($cat['route']) }}">Acessar</x-ui.link>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        {{-- End Grid --}}

        {{-- Linha inferior: Atualizações recentes + Links rápidos --}}
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-5 lg:gap-7.5">

            {{-- Atualizações recentes --}}
            <div class="xl:col-span-2 kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Atualizações Recentes</h3>
                    <a href="" class="kt-link kt-link-dashed text-sm">Ver tudo</a>
                </div>
                <div class="kt-card-body pt-2 pb-2">
                    @php
                        $updates = [
                            ['date' => '27 Jun 2025', 'tag' => 'Novo',       'tag_style' => 'kt-badge-success', 'title' => 'Componente Select documentado',         'desc' => 'Suporte a grupos, busca e seleção múltipla.'],
                            ['date' => '24 Jun 2025', 'tag' => 'Melhoria',   'tag_style' => 'kt-badge-primary', 'title' => 'Input Group com exemplos expandidos',   'desc' => 'Adicionados exemplos com ícone à direita e máscara.'],
                            ['date' => '20 Jun 2025', 'tag' => 'Novo',       'tag_style' => 'kt-badge-success', 'title' => 'Seção Brand Guideline criada',          'desc' => 'Uso de logo, tipografia e cores da marca.'],
                            ['date' => '15 Jun 2025', 'tag' => 'Correção',   'tag_style' => 'kt-badge-warning', 'title' => 'Fix: preview de código em dark mode',   'desc' => 'Sintaxe highlighting ajustada para tema escuro.'],
                            ['date' => '10 Jun 2025', 'tag' => 'Novo',       'tag_style' => 'kt-badge-success', 'title' => 'Módulo de Integrações iniciado',        'desc' => 'Documentação da REST API interna.'],
                        ];
                    @endphp

                    <div class="kt-table-scrollable">
                        <table class="kt-table align-middle text-sm">
                            @foreach ($updates as $update)
                                <tr class="border-b border-border last:border-0">
                                    <td class="py-3 pr-4 w-32 shrink-0">
                                        <span
                                            class="text-xs text-muted-foreground whitespace-nowrap">{{ $update['date'] }}</span>
                                    </td>
                                    <td class="py-3 pr-4 w-24">
                                        <span
                                            class="kt-badge kt-badge-xs kt-badge-outline {{ $update['tag_style'] }}">{{ $update['tag'] }}</span>
                                    </td>
                                    <td class="py-3">
                                        <p class="font-medium text-mono text-sm mb-0.5">{{ $update['title'] }}</p>
                                        <p class="text-xs text-muted-foreground">{{ $update['desc'] }}</p>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            {{-- Links rápidos --}}
            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Links Rápidos</h3>
                </div>
                <div class="kt-card-body pt-1 pb-4">
                    @php
                        $links = [
                            ['icon' => 'book-open',     'label' => 'Como começar',          'sub' => 'Setup do projeto',          'route' => 'docs.getting-started'],
                            ['icon' => 'code-2',        'label' => 'Convenções de código',  'sub' => 'Padrões e nomenclatura',    'route' => 'docs.conventions'],
                            ['icon' => 'layers',        'label' => 'Estrutura de pastas',   'sub' => 'Views, components, pages',  'route' => 'docs.structure'],
                            ['icon' => 'globe',         'label' => 'Internacionalização',   'sub' => 'i18n e traduções',          'route' => 'docs.i18n'],
                            ['icon' => 'zap',           'label' => 'Livewire no Memphis',   'sub' => 'Padrões e boas práticas',   'route' => 'docs.livewire'],
                        ];
                    @endphp

                    <div class="flex flex-col gap-1">
                        @foreach ($links as $link)
                            <a href=""
                               class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-accent transition-colors group/item">
                                <div class="flex items-center justify-center size-8 rounded-md bg-muted shrink-0">
                                    <x-dynamic-component :component="'lucide-' . $link['icon']"
                                                         class="size-4 text-secondary-foreground group-hover/item:text-primary transition-colors"/>
                                </div>
                                <div class="flex flex-col min-w-0 flex-1">
                                    <span class="text-sm font-medium text-mono truncate">{{ $link['label'] }}</span>
                                    <span class="text-xs text-muted-foreground">{{ $link['sub'] }}</span>
                                </div>
                                <x-lucide-chevron-right
                                    class="size-4 text-muted-foreground shrink-0 opacity-0 group-hover/item:opacity-100 transition-opacity"/>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        {{-- End linha inferior --}}

    </div>
    {{-- End Container --}}
</main>
