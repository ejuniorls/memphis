{{-- ===================================================
     Form Input — content.blade.php
     resources/views/livewire/docs/partials/form-input/content.blade.php
     =================================================== --}}

{{-- Cabeçalho --}}
<div class="mb-8">
    <div class="flex items-center gap-3 mb-2">
        <h1 class="text-2xl font-bold text-mono">Form Input</h1>
        <x-ui.badge variant="success" size="sm">Estável</x-ui.badge>
    </div>
    <p class="text-sm text-gray-500 leading-relaxed max-w-2xl">
        Componente de campo de formulário baseado no KTUI. Suporta tipos nativos HTML, ícones,
        estados de erro, tamanhos, wrappers com botões e grupos com addons.
    </p>
    <div class="flex items-center gap-3 mt-3 text-xs text-gray-400">
        <code class="bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded font-mono">&lt;x-ui.input&gt;</code>
        <span>·</span>
        <code class="bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded font-mono">&lt;x-ui.input-group&gt;</code>
        <span>·</span>
        <x-ui.button tag="a" href="https://ktui.io/docs/input" target="_blank" variant="ghost" size="sm"
                     iconEnd="external-link">
            KTUI Reference
        </x-ui.button>
    </div>
</div>

{{-- ── Uso básico ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.input type="text" placeholder="Texto simples" />
    <x-ui.input type="email" placeholder="Email address" />
    <x-ui.input type="password" placeholder="Senha" />
    <x-ui.input type="number" placeholder="Número" />
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Uso básico</h2>
    <p class="text-xs text-gray-500 mb-4">
        O componente <code
            class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">&lt;x-ui.input&gt;</code>
        renderiza um campo <code class="font-mono text-xs">kt-input</code> com suporte a todos os tipos nativos HTML.
    </p>
    <x-docs.code-preview title="Input básico" :code="$code">
        <div class="space-y-3 max-w-sm">
            <x-ui.input type="text" placeholder="Texto simples"/>
            <x-ui.input type="email" placeholder="Email address"/>
            <x-ui.input type="password" placeholder="Senha"/>
            <x-ui.input type="number" placeholder="Número"/>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Estados ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.input placeholder="Campo normal" />
    <x-ui.input placeholder="Campo desabilitado" disabled />
    <x-ui.input placeholder="Campo somente leitura" readonly />
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Estados</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use as props booleanas
        <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">disabled</code> e
        <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">readonly</code>
        para controlar a interatividade do campo.
    </p>
    <x-docs.code-preview title="Disabled e Readonly" :code="$code">
        <div class="space-y-3 max-w-sm">
            <x-ui.input placeholder="Campo normal"/>
            <x-ui.input placeholder="Campo desabilitado" disabled/>
            <x-ui.input placeholder="Campo somente leitura" readonly/>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Tipo file ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.input type="file" />
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Upload de arquivo</h2>
    <p class="text-xs text-gray-500 mb-4">
        O tipo <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">file</code>
        aplica estilos adequados ao seletor de arquivos nativo do navegador.
    </p>
    <x-docs.code-preview title="Input type file" :code="$code">
        <div class="max-w-sm">
            <x-ui.input type="file"/>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Ícones ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.input icon="mail" placeholder="Email address" />
    <x-ui.input icon="search" placeholder="Buscar..." />
    <x-ui.input iconEnd="paperclip" placeholder="Nome do arquivo" />
    <x-ui.input icon="user" iconEnd="check" placeholder="Com ícones dos dois lados" />
    <x-ui.input wrapper>

    <x-ui.button iconOnly ghost="" size="xs" class="-ms-0.5 size-6" data-kt-tooltip="true">
        @svg('lucide-user')
        <span class="kt-tooltip" data-kt-tooltip-content="true">Lookup for user.</span>
        </x-ui.button>
        <input type="text" class="kt-input" placeholder="Clickable icon button" />
    </x-ui.input>

    <x-ui.input wrapper>
        <input type="text" class="kt-input" placeholder="Clickable icon button" />
        <x-ui.button iconOnly ghost="" size="xs" class="-me-1.5 size-6" data-kt-tooltip="true">
            @svg('lucide-download')
            <span class="kt-tooltip" data-kt-tooltip-content="true">Download a file.</span>
        </x-ui.button>
    </x-ui.input>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Ícones</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">icon</code>
        para posicionar um ícone Lucide à esquerda, ou
        <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">iconEnd</code>
        para posicioná-lo à direita.
    </p>
    <x-docs.code-preview title="Ícone à esquerda e à direita" :code="$code">
        <div class="space-y-3 max-w-sm">
            <x-ui.input icon="mail" placeholder="Email address"/>
            <x-ui.input icon="search" placeholder="Buscar..."/>
            <x-ui.input iconEnd="paperclip" placeholder="Nome do arquivo"/>
            <x-ui.input icon="user" iconEnd="check" placeholder="Com ícones dos dois lados"/>

            <x-ui.input wrapper>
                <x-ui.button iconOnly ghost="" size="xs" class="-ms-0.5 size-6" data-kt-tooltip="true">
                    @svg('lucide-user')
                    <span class="kt-tooltip" data-kt-tooltip-content="true">Lookup for user.</span>
                </x-ui.button>
                <input type="text" class="kt-input" placeholder="Clickable icon button"/>
            </x-ui.input>

            <x-ui.input wrapper>
                <input type="text" class="kt-input" placeholder="Clickable icon button"/>
                <x-ui.button iconOnly ghost="" size="xs" class="-me-1.5 size-6" data-kt-tooltip="true">
                    @svg('lucide-download')
                    <span class="kt-tooltip" data-kt-tooltip-content="true">Download a file.</span>
                </x-ui.button>
            </x-ui.input>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Tamanhos ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.input size="sm" placeholder="Small" />
    <x-ui.input placeholder="Default" />
    <x-ui.input size="lg" placeholder="Large" />
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Tamanhos</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use a prop <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">size</code>
        para ajustar a altura do campo: <code class="font-mono text-xs">sm · default · lg</code>.
    </p>
    <x-docs.code-preview title="Tamanhos: sm, default, lg" :code="$code">
        <div class="space-y-3 max-w-sm">
            <x-ui.input size="sm" placeholder="Small"/>
            <x-ui.input placeholder="Default"/>
            <x-ui.input size="lg" placeholder="Large"/>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Estado de erro ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.input type="text" placeholder="Campo com erro" :invalid="true" />
    <x-ui.input type="password" placeholder="Senha inválida" :invalid="true" />
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Estado de erro</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">:invalid="true"</code>
        para aplicar o estilo de validação com erro ao campo.
    </p>
    <x-docs.code-preview title="Input inválido" :code="$code">
        <div class="space-y-3 max-w-sm">
            <x-ui.input type="text" placeholder="Campo com erro" :invalid="true"/>
            <x-ui.input type="password" placeholder="Senha inválida" :invalid="true"/>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Wrapper com botão ── --}}
@php
    $code = <<<'BLADE'
    {{-- Botão à esquerda --}}
    <x-ui.input wrapper>
        <x-ui.button iconOnly ghost="" size="xs" class="-ms-0.5 size-6" data-kt-tooltip="true">
            @svg('lucide-user')
            <span class="kt-tooltip" data-kt-tooltip-content="true">Buscar usuário.</span>
        </x-ui.button>
        <input type="text" class="kt-input" placeholder="Botão à esquerda" />
    </x-ui.input>

    {{-- Botão à direita --}}
    <x-ui.input wrapper>
        <input type="text" class="kt-input" placeholder="Botão à direita" />
        <x-ui.button iconOnly ghost="" size="xs" class="-me-1.5 size-6" data-kt-tooltip="true">
            @svg('lucide-download')
            <span class="kt-tooltip" data-kt-tooltip-content="true">Fazer download.</span>
        </x-ui.button>
    </x-ui.input>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Wrapper com botão</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">wrapper</code>
        para compor o input com botões clicáveis internos — útil para ações contextuais como lookup ou download.
    </p>
    <x-docs.code-preview title="Input com botão interno" :code="$code">
        <div class="space-y-3 max-w-sm">
            <x-ui.input wrapper>
                <x-ui.button iconOnly ghost="" size="xs" class="-ms-0.5 size-6" data-kt-tooltip="true">
                    @svg('lucide-user')
                    <span class="kt-tooltip" data-kt-tooltip-content="true">Buscar usuário.</span>
                </x-ui.button>
                <input type="text" class="kt-input" placeholder="Botão à esquerda"/>
            </x-ui.input>
            <x-ui.input wrapper>
                <input type="text" class="kt-input" placeholder="Botão à direita"/>
                <x-ui.button iconOnly ghost="" size="xs" class="-me-1.5 size-6" data-kt-tooltip="true">
                    @svg('lucide-download')
                    <span class="kt-tooltip" data-kt-tooltip-content="true">Fazer download.</span>
                </x-ui.button>
            </x-ui.input>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Input Group — addon texto ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.input-group addon="https://">
        <x-ui.input placeholder="seu-site.com" />
    </x-ui.input-group>

    <x-ui.input-group addonEnd=".com">
        <x-ui.input placeholder="domínio" />
    </x-ui.input-group>

    <x-ui.input-group addon="R$" addonEnd="reais">
        <x-ui.input type="number" placeholder="0,00" />
    </x-ui.input-group>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Input Group — Addon texto</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code
            class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">&lt;x-ui.input-group&gt;</code>
        com as props <code class="font-mono text-xs">addon</code> e <code class="font-mono text-xs">addonEnd</code>
        para adicionar rótulos de texto antes ou depois do campo.
    </p>
    <x-docs.code-preview title="Input Group com addon de texto" :code="$code">
        <div class="space-y-3 max-w-sm">
            <x-ui.input-group addon="https://">
                <x-ui.input placeholder="seu-site.com"/>
            </x-ui.input-group>
            <x-ui.input-group addonEnd=".com">
                <x-ui.input placeholder="domínio"/>
            </x-ui.input-group>
            <x-ui.input-group addon="R$" addonEnd="reais">
                <x-ui.input type="number" placeholder="0,00"/>
            </x-ui.input-group>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Input Group — addon ícone ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.input-group addonIcon="euro">
        <x-ui.input placeholder="Valor em euros" />
    </x-ui.input-group>

    <x-ui.input-group addonIconEnd="ticket-percent">
        <x-ui.input placeholder="Código de desconto" />
    </x-ui.input-group>

    <x-ui.input-group addonIcon="mail">
        <x-ui.input placeholder="Email address" />
    </x-ui.input-group>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Input Group — Addon ícone</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">addonIcon</code>
        e <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">addonIconEnd</code>
        para substituir o texto por um ícone Lucide no addon.
    </p>
    <x-docs.code-preview title="Input Group com addon de ícone" :code="$code">
        <div class="space-y-3 max-w-sm">
            <x-ui.input-group addonIcon="euro">
                <x-ui.input placeholder="Valor em euros"/>
            </x-ui.input-group>
            <x-ui.input-group addonIconEnd="ticket-percent">
                <x-ui.input placeholder="Código de desconto"/>
            </x-ui.input-group>
            <x-ui.input-group addonIcon="mail">
                <x-ui.input placeholder="Email address"/>
            </x-ui.input-group>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Input Group — addon + botão ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.input-group addonIcon="mail">
        <x-ui.input placeholder="Email address" />
        <x-ui.button variant="outline">Inscrever</x-ui.button>
    </x-ui.input-group>

    <x-ui.input-group addonIcon="search">
        <x-ui.input placeholder="Buscar..." />
        <x-ui.button>Buscar</x-ui.button>
    </x-ui.input-group>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Input Group — Addon com botão</h2>
    <p class="text-xs text-gray-500 mb-4">
        O slot do <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">&lt;x-ui.input-group&gt;</code>
        aceita múltiplos elementos — combine um input com um botão para criar campos de ação como busca ou envio.
    </p>
    <x-docs.code-preview title="Input Group com botão" :code="$code">
        <div class="space-y-3 max-w-sm">
            <x-ui.input-group addonIcon="mail">
                <x-ui.input placeholder="Email address"/>
                <x-ui.button variant="outline">Inscrever</x-ui.button>
            </x-ui.input-group>
            <x-ui.input-group addonIcon="search">
                <x-ui.input placeholder="Buscar..."/>
                <x-ui.button>Buscar</x-ui.button>
            </x-ui.input-group>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Formulário completo ── --}}
@php
    $code = <<<'BLADE'
    <form class="kt-form">
        <div class="kt-form-item">
            <label class="kt-form-label">Email:</label>
            <div class="kt-form-control">
                <x-ui.input type="text" placeholder="Email address" />
            </div>
            <div class="kt-form-description">Digite seu email para continuar.</div>
            <div class="kt-form-message">Por favor, insira um email válido.</div>
        </div>

        <div class="kt-form-item">
            <label class="kt-form-label">Senha:</label>
            <div class="kt-form-control">
                <x-ui.input type="password" placeholder="Senha" :invalid="true" />
            </div>
            <div class="kt-form-description">Mínimo de 8 caracteres.</div>
            <div class="kt-form-message">Por favor, insira uma senha válida.</div>
        </div>

        <div class="kt-form-actions">
            <x-ui.button type="reset" variant="outline">Limpar</x-ui.button>
            <x-ui.button type="submit">Entrar</x-ui.button>
        </div>
    </form>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Formulário completo</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use a estrutura <code class="font-mono text-xs">kt-form → kt-form-item → kt-form-label + kt-form-control</code>
        para montar formulários com label, descrição e mensagem de erro integrados.
    </p>
    <x-docs.code-preview title="Form com label, descrição e erro" :code="$code">
        <div class="max-w-sm">
            <form class="kt-form">
                <div class="kt-form-item">
                    <label class="kt-form-label">Email:</label>
                    <div class="kt-form-control">
                        <x-ui.input type="text" placeholder="Email address"/>
                    </div>
                    <div class="kt-form-description">Digite seu email para continuar.</div>
                    <div class="kt-form-message">Por favor, insira um email válido.</div>
                </div>
                <div class="kt-form-item">
                    <label class="kt-form-label">Senha:</label>
                    <div class="kt-form-control">
                        <x-ui.input type="password" placeholder="Senha" :invalid="true"/>
                    </div>
                    <div class="kt-form-description">Mínimo de 8 caracteres.</div>
                    <div class="kt-form-message">Por favor, insira uma senha válida.</div>
                </div>
                <div class="kt-form-actions">
                    <x-ui.button type="reset" variant="outline">Limpar</x-ui.button>
                    <x-ui.button type="submit">Entrar</x-ui.button>
                </div>
            </form>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Props: x-ui.input ── --}}
<section class="mb-2">
    <h2 class="text-base font-semibold text-mono mb-3">Props — <code class="font-mono text-sm">&lt;x-ui.input&gt;</code>
    </h2>
    <x-docs.prop-table :props="[
        ['name' => 'type',        'type' => 'string',  'default' => 'text',  'description' => 'Tipo nativo do input: text, email, password, number, file, etc.'],
        ['name' => 'size',        'type' => 'string',  'default' => 'null',  'description' => 'Tamanho do campo: sm, lg. Omitir usa o tamanho padrão.'],
        ['name' => 'icon',        'type' => 'string',  'default' => 'null',  'description' => 'Nome do ícone Lucide exibido à esquerda do campo.'],
        ['name' => 'iconEnd',     'type' => 'string',  'default' => 'null',  'description' => 'Nome do ícone Lucide exibido à direita do campo.'],
        ['name' => 'invalid',     'type' => 'boolean', 'default' => 'false', 'description' => 'Aplica estilo de validação com erro (borda e cor vermelha).'],
        ['name' => 'disabled',    'type' => 'boolean', 'default' => 'false', 'description' => 'Desabilita o campo, impedindo interação e aplicando opacidade.'],
        ['name' => 'readonly',    'type' => 'boolean', 'default' => 'false', 'description' => 'Torna o campo somente leitura — visível mas não editável.'],
        ['name' => 'wrapper',     'type' => 'boolean', 'default' => 'false', 'description' => 'Ativa o modo wrapper, permitindo compor o input com botões internos via slot.'],
        ['name' => 'placeholder', 'type' => 'string',  'default' => 'null',  'description' => 'Texto de placeholder exibido quando o campo está vazio.'],
    ]"/>
</section>

{{-- ── Props: x-ui.input-group ── --}}
<section class="mt-6 mb-2">
    <h2 class="text-base font-semibold text-mono mb-3">Props — <code
            class="font-mono text-sm">&lt;x-ui.input-group&gt;</code></h2>
    <x-docs.prop-table :props="[
        ['name' => 'addon',        'type' => 'string', 'default' => 'null', 'description' => 'Texto exibido como addon à esquerda do input.'],
        ['name' => 'addonEnd',     'type' => 'string', 'default' => 'null', 'description' => 'Texto exibido como addon à direita do input.'],
        ['name' => 'addonIcon',    'type' => 'string', 'default' => 'null', 'description' => 'Nome do ícone Lucide exibido no addon à esquerda (substitui addon).'],
        ['name' => 'addonIconEnd', 'type' => 'string', 'default' => 'null', 'description' => 'Nome do ícone Lucide exibido no addon à direita (substitui addonEnd).'],
    ]"/>
</section>

{{-- ── Slots ── --}}
<section class="mt-6 mb-2">
    <h2 class="text-base font-semibold text-mono mb-3">Slots</h2>
    <x-docs.prop-table :props="[
        ['name' => 'default (x-ui.input wrapper)', 'type' => 'slot', 'default' => '—', 'description' => 'Conteúdo do wrapper: aceita combinação de input.kt-input com x-ui.button.'],
        ['name' => 'default (x-ui.input-group)',   'type' => 'slot', 'default' => '—', 'description' => 'Conteúdo do grupo: aceita x-ui.input e opcionalmente x-ui.button.'],
    ]"/>
</section>
