{{-- Button — content.blade.php --}}

{{-- Cabeçalho --}}
<div class="mb-8">
    <div class="flex items-center gap-3 mb-2">
        <h1 class="text-2xl font-bold text-mono">Button</h1>
        <x-ui.badge variant="success" size="sm">Estável</x-ui.badge>
    </div>
    <p class="text-sm text-gray-500 leading-relaxed">
        Componente de botão baseado no KTUI. Suporta variantes de cor, tamanhos, ícones Lucide,
        estados ghost/dim, renderização como <code class="text-primary text-xs">&lt;a&gt;</code> e muito mais.
    </p>
    <div class="flex items-center gap-3 mt-3 text-xs text-gray-400">
        <code class="bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded font-mono">&lt;x-ui.button&gt;</code>
        <span>·</span>
        <x-ui.button tag="a" href="https://ktui.io/docs/button" target="_blank" variant="ghost" size="sm" iconEnd="external-link">
            KTUI Reference
        </x-ui.button>
    </div>
</div>

{{-- ── Variantes ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Variantes</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use a prop <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">variant</code>.
        Sem a prop o botão usa o estilo <strong>primary</strong> (padrão do KTUI).
    </p>
    @php
        $code = <<<'BLADE'
    {{-- Primary é o padrão — sem variant --}}
    <x-ui.button>Primary</x-ui.button>

    <x-ui.button variant="secondary">Secondary</x-ui.button>
    <x-ui.button variant="destructive">Destructive</x-ui.button>
    <x-ui.button variant="mono">Mono</x-ui.button>
    <x-ui.button variant="outline">Outline</x-ui.button>
    <x-ui.button variant="ghost">Ghost</x-ui.button>
    BLADE;
    @endphp
    <x-docs.code-preview title="Variantes de cor" :code="$code">
        <div class="flex flex-wrap gap-2">
            <x-ui.button>Primary (padrão)</x-ui.button>
            <x-ui.button variant="secondary">Secondary</x-ui.button>
            <x-ui.button variant="destructive">Destructive</x-ui.button>
            <x-ui.button variant="mono">Mono</x-ui.button>
            <x-ui.button variant="outline">Outline</x-ui.button>
            <x-ui.button variant="ghost">Ghost</x-ui.button>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Ghost com cor ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Ghost com cor</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use a prop <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">ghost</code>
        passando a cor desejada. Gera <code class="font-mono text-xs">kt-btn-ghost kt-btn-{cor}</code>.
    </p>
    @php
        $code = <<<'BLADE'
    <x-ui.button ghost="primary">Ghost Primary</x-ui.button>
    <x-ui.button ghost="destructive">Ghost Destructive</x-ui.button>
    BLADE;
    @endphp
    <x-docs.code-preview title="Ghost colorido" :code="$code">
        <div class="flex flex-wrap gap-2">
            <x-ui.button ghost="primary">Ghost Primary</x-ui.button>
            <x-ui.button ghost="destructive">Ghost Destructive</x-ui.button>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Tamanhos ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Tamanhos</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use a prop <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">size</code>:
        <code class="font-mono text-xs">sm · (padrão) · lg</code>.
    </p>
    @php
        $code = <<<'BLADE'
    <x-ui.button size="sm">Small</x-ui.button>
    <x-ui.button>Default</x-ui.button>
    <x-ui.button size="lg">Large</x-ui.button>
    BLADE;
    @endphp
    <x-docs.code-preview title="Tamanhos disponíveis" :code="$code">
        <div class="flex flex-wrap items-center gap-2">
            <x-ui.button size="sm">Small</x-ui.button>
            <x-ui.button>Default</x-ui.button>
            <x-ui.button size="lg">Large</x-ui.button>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Com ícone ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Com ícone</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">icon</code> para ícone antes do texto
        e <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">iconEnd</code> para ícone após.
        Ambos aceitam o nome do ícone Lucide (ex: <code class="font-mono text-xs">plus</code>, <code class="font-mono text-xs">trash</code>).
    </p>
    @php
        $code = <<<'BLADE'
    <x-ui.button icon="plus">Criar</x-ui.button>
    <x-ui.button variant="secondary" icon="download">Exportar</x-ui.button>
    <x-ui.button variant="destructive" icon="trash">Excluir</x-ui.button>
    <x-ui.button variant="outline" iconEnd="arrow-right">Próximo</x-ui.button>
    BLADE;
    @endphp
    <x-docs.code-preview title="Ícones Lucide" :code="$code">
        <div class="flex flex-wrap gap-2">
            <x-ui.button icon="plus">Criar</x-ui.button>
            <x-ui.button variant="secondary" icon="download">Exportar</x-ui.button>
            <x-ui.button variant="destructive" icon="trash">Excluir</x-ui.button>
            <x-ui.button variant="outline" iconEnd="arrow-right">Próximo</x-ui.button>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Icon Only ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Icon Only</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use a prop booleana <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">iconOnly</code>
        para remover padding e exibir apenas o ícone. Combine com <code class="font-mono text-xs">dim</code>
        para a variante mais discreta, ou com <code class="font-mono text-xs">circle</code> para formato circular.
    </p>
    @php
        $code = <<<'BLADE'
    <x-ui.button iconOnly icon="search" />
    <x-ui.button iconOnly icon="settings" variant="secondary" />

    {{-- Variante dim: mais discreta --}}
    <x-ui.button iconOnly icon="more-vertical" dim />

    {{-- Circular --}}
    <x-ui.button iconOnly icon="plus" circle />
    BLADE;
    @endphp
    <x-docs.code-preview title="Icon Only + variações" :code="$code">
        <div class="flex flex-wrap items-center gap-2">
            <x-ui.button iconOnly icon="search" />
            <x-ui.button iconOnly icon="settings" variant="secondary" />
            <x-ui.button iconOnly icon="more-vertical" dim />
            <x-ui.button iconOnly icon="plus" circle />
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Renderizado como link ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Renderizado como link</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">tag="a"</code>
        junto com <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">href</code>
        para renderizar como elemento <code class="font-mono text-xs">&lt;a&gt;</code>.
    </p>
    @php
        $code = <<<'BLADE'
    <x-ui.button tag="a" href="/rota" icon="external-link">
        Abrir link
    </x-ui.button>

    <x-ui.button tag="a" href="/rota" variant="outline" iconEnd="arrow-right">
        Ver mais
    </x-ui.button>
    BLADE;
    @endphp
    <x-docs.code-preview title="Como elemento &lt;a&gt;" :code="$code">
        <div class="flex flex-wrap gap-2">
            <x-ui.button tag="a" href="#" icon="external-link">Abrir link</x-ui.button>
            <x-ui.button tag="a" href="#" variant="outline" iconEnd="arrow-right">Ver mais</x-ui.button>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Disabled ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Disabled</h2>
    @php
        $code = <<<'BLADE'
    <x-ui.button disabled>Desabilitado</x-ui.button>
    <x-ui.button variant="secondary" disabled icon="save">Salvar</x-ui.button>
    BLADE;
    @endphp
    <x-docs.code-preview title="Estado desabilitado" :code="$code">
        <div class="flex flex-wrap gap-2">
            <x-ui.button disabled>Desabilitado</x-ui.button>
            <x-ui.button variant="secondary" disabled icon="save">Salvar</x-ui.button>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Props ── --}}
<section class="mb-2">
    <h2 class="text-base font-semibold text-mono mb-3">Props</h2>
    <x-docs.prop-table :props="[
        ['name' => 'variant',  'type' => 'string',  'default' => 'null',   'description' => 'Estilo visual: secondary, destructive, mono, outline, ghost. Sem valor = primary (padrão KTUI).'],
        ['name' => 'ghost',    'type' => 'string',  'default' => 'null',   'description' => 'Ghost colorido: primary, destructive. Gera kt-btn-ghost + kt-btn-{cor}. Tem precedência sobre variant.'],
        ['name' => 'size',     'type' => 'string',  'default' => 'null',   'description' => 'Tamanho: sm, lg. Sem valor = tamanho padrão.'],
        ['name' => 'icon',     'type' => 'string',  'default' => 'null',   'description' => 'Nome do ícone Lucide exibido antes do label (ex: plus, trash, search).'],
        ['name' => 'iconEnd',  'type' => 'string',  'default' => 'null',   'description' => 'Nome do ícone Lucide exibido após o label.'],
        ['name' => 'iconOnly', 'type' => 'boolean', 'default' => 'false',  'description' => 'Modo somente ícone — adiciona kt-btn-icon (padding quadrado).'],
        ['name' => 'dim',      'type' => 'boolean', 'default' => 'false',  'description' => 'Variante dim (kt-btn-dim), geralmente usada com iconOnly para aparência discreta.'],
        ['name' => 'circle',   'type' => 'boolean', 'default' => 'false',  'description' => 'Adiciona rounded-full para formato circular.'],
        ['name' => 'tag',      'type' => 'string',  'default' => 'button', 'description' => 'Tag HTML renderizada: button ou a.'],
        ['name' => 'href',     'type' => 'string',  'default' => 'null',   'description' => 'URL de destino. Usado quando tag=a.'],
        ['name' => 'type',     'type' => 'string',  'default' => 'button', 'description' => 'Tipo HTML: button, submit, reset. Ignorado quando tag=a.'],
        ['name' => 'disabled', 'type' => 'boolean', 'default' => 'false',  'description' => 'Desabilita o botão com atributo HTML disabled.'],
    ]" />
</section>
