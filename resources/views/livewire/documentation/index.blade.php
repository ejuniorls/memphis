<main class="grow" role="content">
    <!-- Toolbar -->
    <div class="pb-6">
        <div class="kt-container-fixed flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center flex-wrap gap-1 lg:gap-5">
                <h1 class="font-medium text-lg text-mono">
                    {{ __('docs.title') }}
                </h1>
                <div class="flex items-center gap-1 text-sm font-normal">
                    <a class="text-secondary-foreground hover:text-primary" href="">
                        {{ __('docs.breadcrumb_home') }}
                    </a>
                    <span class="text-muted-foreground text-sm">/</span>
                    <span class="text-mono">{{ __('docs.title') }}</span>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <x-ui.button size="sm" tag="a" href="" variant="outline" icon="history">
                    {{ __('docs.btn_changelog') }}
                </x-ui.button>

                <x-ui.button size="sm" tag="a" href="{{ route('documentation.components') }}" variant="primary" icon="book-open">
                    {{ __('docs.btn_components') }}
                </x-ui.button>
            </div>
        </div>
    </div>
    <!-- End of Toolbar -->

    <!-- Container -->
    <div class="kt-container-fixed flex flex-col gap-5 lg:gap-7.5">

        <!-- Superior Block -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 lg:gap-7.5">

            {{-- Grade de 6 mini-cards (3 linhas × 2 colunas) — ocupa 3/5 --}}
            @php
                $categories = [
                    [
                        'title'       => __('docs.cat_ui_title'),
                        'description' => __('docs.cat_ui_desc_short'),
                        'icon'        => 'layout-grid',
                        'icon_bg'     => 'bg-primary/10 text-primary',
                        'route'       => 'documentation.components',
                    ],
                    [
                        'title'       => __('docs.cat_pages_title'),
                        'description' => __('docs.cat_pages_desc_short'),
                        'icon'        => 'panel-left',
                        'icon_bg'     => 'bg-primary/10 text-primary',
                        'route'       => 'documentation.components',
                    ],
                    [
                        'title'       => __('docs.cat_colors_title'),
                        'description' => __('docs.cat_colors_desc_short'),
                        'icon'        => 'palette',
                        'icon_bg'     => 'bg-primary/10 text-primary',
                        'route'       => 'documentation.components',
                    ],
                    [
                        'title'       => __('docs.cat_brand_title'),
                        'description' => __('docs.cat_brand_desc_short'),
                        'icon'        => 'star',
                        'icon_bg'     => 'bg-primary/10 text-primary',
                        'route'       => 'documentation.components',
                    ],
                    [
                        'title'       => __('docs.cat_api_title'),
                        'description' => __('docs.cat_api_desc_short'),
                        'icon'        => 'plug',
                        'icon_bg'     => 'bg-primary/10 text-primary',
                        'route'       => 'documentation.components',
                    ],
                    [
                        'title'       => __('docs.cat_contrib_title'),
                        'description' => __('docs.cat_contrib_desc_short'),
                        'icon'        => 'git-branch',
                        'icon_bg'     => 'bg-primary/10 text-primary',
                        'route'       => 'documentation.components',
                    ],
                ];
            @endphp

            <div class="lg:col-span-1 grid grid-cols-2 gap-3">
                @foreach ($categories as $cat)
                    <a href="{{ route($cat['route']) }}"
                       class="group kt-card p-5 hover:shadow-sm hover:border-primary/30 transition-all duration-200 block">
                        <div class="flex flex-col gap-3">
                            <x-ui.icon-box icon="{{ $cat['icon'] }}" bg="bg-primary/10" color="text-primary" />

                            <div>
                                <h3 class="text-sm font-semibold text-mono mb-1 group-hover:text-primary transition-colors">
                                    {!! $cat['title'] !!}
                                </h3>
                                <p class="text-xs text-muted-foreground leading-relaxed">
                                    {{ $cat['description'] }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Hero roxo — ocupa 2/5 --}}
            <div
                class="bg-primary lg:col-span-2 relative overflow-hidden rounded-xl flex flex-col justify-end min-h-[340px]">

                {{-- Conteúdo --}}
                <div class="relative z-10 flex flex-col gap-5 p-7">
                    <span class="text-xs font-semibold tracking-widest uppercase text-white/50">
                        {{ __('docs.hero_eyebrow') }}
                    </span>

                    <div>
                        <h2 class="text-2xl font-bold text-white leading-snug mb-3">
                            {!! __('docs.hero_title_html') !!}
                        </h2>
                        <p class="text-sm text-white/70 leading-relaxed">
                            {{ __('docs.hero_desc') }}
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2 pt-1">
                        <x-ui.button variant="secondary" tag="a" href="{{ route('documentation.components') }}"
                                     icon="rocket" circle>
                            {{ __('docs.hero_cta_primary') }}
                        </x-ui.button>

                        <x-ui.button variant="outline" tag="a" href="" circle>
                            {{ __('docs.hero_cta_secondary') }}
                        </x-ui.button>
                    </div>
                </div>
            </div>

        </div>
        <!-- End of Superior Block -->

        {{-- ================================================================
                    BLOCO 1: Painel de status + Hero roxo
               ================================================================ --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 lg:gap-6">

            {{-- Painel esquerdo (3/5) --}}
            <div class="lg:col-span-1 flex flex-col gap-4">

                {{-- Mini-cards: UI Kit + Endpoints --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="kt-card p-5 flex items-center gap-4">
                        <x-ui.icon-box icon="layout-grid" bg="bg-primary/10" color="text-primary" />

                        <div>
                            <p class="text-sm font-semibold text-mono">{{ __('docs.kit_title') }}</p>

                            <x-ui.badge>{{ __('docs.kit_version') }}</x-ui.badge>
                        </div>
                    </div>

                    <div class="kt-card p-5 flex items-center gap-4">
                        <x-ui.icon-box icon="globe" bg="bg-primary/10" color="text-primary" />

                        <div>
                            <p class="text-sm font-semibold text-mono">{{ __('docs.endpoints_title') }}</p>

                            <x-ui.badge>{{ __('docs.endpoints_status') }}</x-ui.badge>
                        </div>
                    </div>
                </div>

                {{-- Status do Sistema --}}
                <div class="kt-card p-5 flex flex-col gap-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <x-lucide-check-circle class="size-4 text-emerald-500"/>
                            <span class="text-sm font-semibold text-mono">{{ __('docs.status_title') }}</span>
                        </div>
                        <span class="text-xs text-muted-foreground">{{ __('docs.date_today') }}
                            , {{ now()->format('H:i') }}</span>
                    </div>
                    @php
                        $services = [
                            ['name' => __('docs.svc_gateway'),  'status' => 'ok'],
                            ['name' => __('docs.svc_auth'),     'status' => 'ok'],
                            ['name' => __('docs.svc_database'), 'status' => 'warn'],
                        ];
                    @endphp

                    <div class="flex flex-col gap-2">
                        @foreach ($services as $svc)
                            <div class="flex items-center justify-between py-1 border-b border-border last:border-0">
                                <span class="text-sm text-secondary-foreground">{{ $svc['name'] }}</span>
                                @if ($svc['status'] === 'ok')
                                    <x-ui.badge variant="success">{{ __('docs.status_ok') }}</x-ui.badge>
                                @else
                                    <x-ui.badge variant="warning">{{ __('docs.status_warn') }}</x-ui.badge>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Tópicos Populares --}}
                @php
                    $popularTopics = ['Autenticação JWT', 'Webhooks', 'Rate Limiting', 'Paginação', 'CORS'];
                @endphp
                <div class="kt-card p-5 flex flex-col gap-3">
                    <p class="text-sm font-semibold text-mono">{{ __('docs.popular_title') }}</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($popularTopics as $topic)
                            <x-ui.button tag="a" href="" size="sm" variant="outline">{{ $topic }}</x-ui.button>
                        @endforeach
                    </div>
                </div>

            </div>

            {{-- Hero roxo (2/5) --}}
            <div class="lg:col-span-1 relative overflow-hidden rounded-xl flex flex-col justify-end min-h-[360px]"
                 style="background: linear-gradient(145deg, #7c3aed 0%, #6d28d9 50%, #5b21b6 100%);">

                {{-- Decorações --}}
                <div class="absolute inset-0 pointer-events-none">
                    <div class="absolute -top-10 -right-10 w-56 h-56 rounded-full"
                         style="background:rgba(139,92,246,.35);"></div>
                    <div class="absolute top-1/4 -right-4 w-28 h-28 rounded-full"
                         style="background:rgba(167,139,250,.2);"></div>
                    <div class="absolute inset-0 opacity-[.15]"
                         style="background-image:radial-gradient(circle,rgba(255,255,255,.5) 1px,transparent 1px);background-size:22px 22px;"></div>
                    <div class="absolute top-0 left-0 w-3/5 h-2/5 rounded-br-3xl"
                         style="background:rgba(255,255,255,.06);"></div>
                </div>

                <div class="relative z-10 flex flex-col gap-5 p-6 h-full justify-between">

                    {{-- Cabeçalho --}}
                    <div class="flex items-center justify-between">
                        <span class="text-[10px] font-bold tracking-[.2em] uppercase text-white/50">
                            {{ __('docs.coverage_eyebrow') }}
                        </span>
                        <span class="text-xs font-mono text-white/40">v1.0</span>
                    </div>

                    {{-- Barras de progresso --}}
                    @php
                        $coverage = [
                            ['label' => __('docs.cov_components'), 'value' => 24, 'total' => 30, 'color' => 'bg-white'],
                            ['label' => __('docs.cov_pages'),      'value' => 12, 'total' => 15, 'color' => 'bg-violet-300'],
                            ['label' => __('docs.cov_tokens'),     'value' => 48, 'total' => 48, 'color' => 'bg-emerald-300'],
                            ['label' => __('docs.cov_i18n'),       'value' => 6,  'total' => 8,  'color' => 'bg-amber-300'],
                        ];
                    @endphp
                    <div class="flex flex-col gap-3.5">
                        @foreach ($coverage as $item)
                            @php $pct = round(($item['value'] / $item['total']) * 100); @endphp
                            <div class="flex flex-col gap-1.5">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-medium text-white/70">{{ $item['label'] }}</span>
                                    <span class="text-xs font-bold text-white/90 tabular-nums">
                                        {{ $item['value'] }}<span
                                            class="font-normal text-white/40">/{{ $item['total'] }}</span>
                                    </span>
                                </div>
                                <div class="h-1.5 w-full rounded-full bg-white/15 overflow-hidden">
                                    <div class="h-full rounded-full {{ $item['color'] }} opacity-80 transition-all"
                                         style="width: {{ $pct }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Rodapé --}}
                    <div class="flex items-center justify-between pt-1">
                        <span class="text-xs text-white/40">{{ __('docs.coverage_last_update') }}</span>
                        <a href="{{ route('documentation.components') }}"
                           class="inline-flex items-center gap-1 text-xs font-semibold text-white/80 hover:text-white transition-colors">
                            {{ __('docs.coverage_cta') }}
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-3" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                 stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6"/>
                            </svg>
                        </a>
                    </div>

                </div>
            </div>

        </div>
        {{-- End Bloco 1 --}}

        {{-- ================================================================
             BLOCO 2: Primeiros Passos + Recursos Úteis
             ================================================================ --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-5 lg:gap-6">

            {{-- Primeiros Passos (3/5) --}}
            <div class="lg:col-span-3 kt-card p-6 lg:p-7">
                <div class="flex items-center gap-3 mb-6">
                    <div class="flex items-center justify-center size-8 rounded-lg bg-primary/10">
                        <x-lucide-map class="size-4 text-primary"/>
                    </div>
                    <h3 class="text-base font-semibold text-mono">{{ __('docs.steps_title') }}</h3>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    @php
                        $steps = [
                            ['num' => '01', 'title' => __('docs.step1_title'), 'desc' => __('docs.step1_desc')],
                            ['num' => '02', 'title' => __('docs.step2_title'), 'desc' => __('docs.step2_desc')],
                            ['num' => '03', 'title' => __('docs.step3_title'), 'desc' => __('docs.step3_desc')],
                        ];
                    @endphp
                    @foreach ($steps as $step)
                        <div class="flex flex-col gap-2">
                            <span
                                class="text-3xl font-bold text-muted-foreground/30 leading-none">{{ $step['num'] }}</span>
                            <p class="text-sm font-semibold text-mono">{{ $step['title'] }}</p>
                            <p class="text-xs text-muted-foreground leading-relaxed">{{ $step['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Recursos Úteis (2/5) --}}
            <div class="lg:col-span-2 kt-card p-6">
                <h3 class="text-base font-semibold text-mono mb-5">{{ __('docs.resources_title') }}</h3>
                @php
                    $resources = [
                        ['icon' => 'code-2',   'title' => __('docs.res_sdk_title'),     'sub' => __('docs.res_sdk_sub')],
                        ['icon' => 'file-json','title' => __('docs.res_postman_title'), 'sub' => __('docs.res_postman_sub')],
                        ['icon' => 'video',    'title' => __('docs.res_video_title'),   'sub' => __('docs.res_video_sub')],
                    ];
                @endphp
                <div class="flex flex-col gap-1">
                    @foreach ($resources as $res)
                        <a href="#"
                           class="group flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-accent transition-colors">
                            <div class="flex items-center justify-center size-8 rounded-md bg-muted shrink-0">
                                <x-dynamic-component :component="'lucide-' . $res['icon']"
                                                     class="size-4 text-secondary-foreground group-hover:text-primary transition-colors"/>
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span class="text-sm font-medium text-mono">{{ $res['title'] }}</span>
                                <span class="text-xs text-muted-foreground">{{ $res['sub'] }}</span>
                            </div>

                            <x-ui.icon-box icon="chevron-right" bg="bg-primary/10" color="text-primary" />
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
        {{-- End Bloco 2 --}}

        {{-- ================================================================
             BLOCO 3: Últimas Atualizações + Glossário
             ================================================================ --}}
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-5 lg:gap-6" id="changelog">

            {{-- Últimas Atualizações (3/5) --}}
            <div class="lg:col-span-3 kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">{{ __('docs.changelog_title') }}</h3>
                    <a href="#" class="kt-link kt-link-dashed text-sm">{{ __('docs.changelog_all') }}</a>
                </div>
                <div class="kt-card-body pt-2 pb-4">
                    @php
                        $updates = [
                            [
                                'date_label' => __('docs.date_today'),
                                'title' => 'Módulo de Pagamentos v3.2',
                                'desc'  => 'Introdução do novo fluxo de estorno automático e suporte a múltiplas moedas.',
                                'badge' => 'NOVA API',
                                'badge_class' => 'bg-primary/10 text-primary',
                            ],
                            [
                                'date_label' => __('docs.date_yesterday'),
                                'title' => 'Componentes de Gráficos',
                                'desc'  => 'Refatoração da biblioteca D3 para melhor renderização em dispositivos móveis.',
                                'badge' => 'UI KIT',
                                'badge_class' => 'bg-muted text-secondary-foreground',
                            ],
                            [
                                'date_label' => '20 Jun',
                                'title' => 'Seção Brand Guideline criada',
                                'desc'  => 'Uso de logo, tipografia e cores da marca.',
                                'badge' => 'NOVO',
                                'badge_class' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
                            ],
                        ];
                    @endphp
                    <div class="divide-y divide-border">
                        @foreach ($updates as $u)
                            <div class="flex items-start gap-5 py-4">
                                <span
                                    class="text-xs font-semibold text-muted-foreground uppercase tracking-wide w-14 shrink-0 pt-0.5">
                                    {{ $u['date_label'] }}
                                </span>
                                <div class="flex flex-col gap-1.5 flex-1 min-w-0">
                                    <p class="text-sm font-semibold text-mono">{{ $u['title'] }}</p>
                                    <p class="text-xs text-muted-foreground leading-relaxed">{{ $u['desc'] }}</p>

                                    <x-ui.badge variant="primary" >{{ $u['badge'] }}</x-ui.badge>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Glossário (2/5) --}}
            <div class="lg:col-span-2 kt-card p-6 flex flex-col gap-5">
                <h3 class="text-base font-semibold text-mono">{{ __('docs.glossary_title') }}</h3>

                @php
                    $terms = [
                        [
                            'category'  => __('docs.glossary_cat_context'),
                            'cat_color' => 'text-primary',
                            'term'      => 'Entidade Raiz',
                            'def'       => 'O ponto de entrada principal para qualquer domínio de negócio no sistema.',
                        ],
                        [
                            'category'  => __('docs.glossary_cat_technical'),
                            'cat_color' => 'text-violet-600 dark:text-violet-400',
                            'term'      => 'Idempotência',
                            'def'       => 'Propriedade em que uma operação pode ser aplicada várias vezes sem alterar o resultado.',
                        ],
                    ];
                @endphp

                <div class="flex flex-col gap-5">
                    @foreach ($terms as $term)
                        <div class="flex flex-col gap-1">
                            <span class="text-[10px] font-bold tracking-[.15em] uppercase {{ $term['cat_color'] }}">
                                {{ $term['category'] }}
                            </span>
                            <p class="text-sm font-semibold text-mono">{{ $term['term'] }}</p>
                            <p class="text-xs text-muted-foreground leading-relaxed">{{ $term['def'] }}</p>
                        </div>
                    @endforeach
                </div>

                <a href="#" class="mt-auto kt-btn kt-btn-outline kt-btn-sm w-full justify-center">
                    {{ __('docs.glossary_cta') }}
                </a>
            </div>

        </div>
        {{-- End Bloco 3 --}}

        {{-- ================================================================
             BLOCO 4: Banner comunidade (fundo escuro full-width)
             ================================================================ --}}
        <div class="rounded-xl overflow-hidden"
             style="background: linear-gradient(135deg, #1e1b4b 0%, #1a1a2e 60%, #16213e 100%);">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6 px-8 py-10">
                <div class="flex flex-col gap-2">
                    <h3 class="text-xl font-bold text-white">{{ __('docs.community_title') }}</h3>
                    <p class="text-sm text-white/55 leading-relaxed max-w-md">
                        {{ __('docs.community_desc') }}
                    </p>
                </div>
                <div class="flex items-center gap-3 shrink-0">
                    <a href="#"
                       class="flex items-center justify-center size-12 rounded-full border border-white/20 bg-white/10 hover:bg-white/20 transition-colors text-white">
                        <x-lucide-github class="size-5"/>
                    </a>
                    <a href="#"
                       class="flex items-center justify-center size-12 rounded-full border border-white/20 bg-white/10 hover:bg-white/20 transition-colors text-white">
                        <x-lucide-message-circle class="size-5"/>
                    </a>
                    <a href="#"
                       class="flex items-center justify-center size-12 rounded-full border border-white/20 bg-white/10 hover:bg-white/20 transition-colors text-white">
                        <x-lucide-users class="size-5"/>
                    </a>
                </div>
            </div>
        </div>
        {{-- End Bloco 4 --}}

    </div>
    {{-- End Container --}}

</main>
