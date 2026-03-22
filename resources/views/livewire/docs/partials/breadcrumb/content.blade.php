{{-- ===================================================
     Breadcrumb — content.blade.php
     resources/views/livewire/docs/partials/breadcrumb/content.blade.php
     =================================================== --}}

{{-- Cabeçalho --}}
<div class="mb-8">
    <div class="flex items-center gap-3 mb-2">
        <h1 class="text-2xl font-bold text-mono">Breadcrumb</h1>
        <x-ui.badge variant="success" size="sm">Estável</x-ui.badge>
    </div>
    <p class="text-sm text-gray-500 leading-relaxed max-w-2xl">
        Componente de navegação hierárquica baseado no KTUI. Suporta links, item ativo, ícones Lucide
        e separadores customizáveis (ícone Lucide ou bolinha).
    </p>
    <div class="flex items-center gap-3 mt-3 text-xs text-gray-400">
        <code class="bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded font-mono">&lt;x-ui.breadcrumb&gt;</code>
        <span>·</span>
        <code class="bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded font-mono">&lt;x-ui.breadcrumb-item&gt;</code>
        <span>·</span>
        <x-ui.button tag="a" href="https://ktui.io/docs/breadcrumb" target="_blank" variant="ghost" size="sm" iconEnd="external-link">
            KTUI Reference
        </x-ui.button>
    </div>
</div>

{{-- ── Uso básico ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.breadcrumb>
        <x-ui.breadcrumb-item href="/dashboard" first>Dashboard</x-ui.breadcrumb-item>
        <x-ui.breadcrumb-item href="/usuarios">Usuários</x-ui.breadcrumb-item>
        <x-ui.breadcrumb-item active>Editar</x-ui.breadcrumb-item>
    </x-ui.breadcrumb>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Uso básico</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">&lt;x-ui.breadcrumb&gt;</code>
        como wrapper e adicione os itens com
        <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">&lt;x-ui.breadcrumb-item&gt;</code>.
        Sempre adicione <code class="font-mono text-xs">first</code> no primeiro item — ele suprime o separador inicial.
        O item atual deve receber <code class="font-mono text-xs">active</code>.
    </p>
    <x-docs.code-preview title="Breadcrumb simples" :code="$code">
        <x-ui.breadcrumb>
            <x-ui.breadcrumb-item href="#" first>Dashboard</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item href="#">Usuários</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item active>Editar</x-ui.breadcrumb-item>
        </x-ui.breadcrumb>
    </x-docs.code-preview>
</section>

{{-- ── Separadores ── --}}
@php
    $code = <<<'BLADE'
    {{-- Padrão: chevron-right --}}
    <x-ui.breadcrumb>
        <x-ui.breadcrumb-item href="#" first>Home</x-ui.breadcrumb-item>
        <x-ui.breadcrumb-item href="#">Produtos</x-ui.breadcrumb-item>
        <x-ui.breadcrumb-item active>Detalhes</x-ui.breadcrumb-item>
    </x-ui.breadcrumb>

    {{-- Bolinha --}}
    <x-ui.breadcrumb>
        <x-ui.breadcrumb-item href="#" first separator="dot">Home</x-ui.breadcrumb-item>
        <x-ui.breadcrumb-item href="#" separator="dot">Produtos</x-ui.breadcrumb-item>
        <x-ui.breadcrumb-item active separator="dot">Detalhes</x-ui.breadcrumb-item>
    </x-ui.breadcrumb>

    {{-- Outro ícone Lucide --}}
    <x-ui.breadcrumb>
        <x-ui.breadcrumb-item href="#" first separator="slash">Home</x-ui.breadcrumb-item>
        <x-ui.breadcrumb-item href="#" separator="slash">Produtos</x-ui.breadcrumb-item>
        <x-ui.breadcrumb-item active separator="slash">Detalhes</x-ui.breadcrumb-item>
    </x-ui.breadcrumb>

    {{-- Sem separador --}}
    <x-ui.breadcrumb>
        <x-ui.breadcrumb-item href="#" first :separator="false">Home</x-ui.breadcrumb-item>
        <x-ui.breadcrumb-item href="#" :separator="false">Produtos</x-ui.breadcrumb-item>
        <x-ui.breadcrumb-item active :separator="false">Detalhes</x-ui.breadcrumb-item>
    </x-ui.breadcrumb>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Separadores</h2>
    <p class="text-xs text-gray-500 mb-4">
        Configure <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">separator</code>
        em cada item. Aceita qualquer nome de ícone Lucide,
        <code class="font-mono text-xs">"dot"</code> para uma bolinha, ou
        <code class="font-mono text-xs">:separator="false"</code> para remover o separador completamente.
    </p>
    <x-docs.code-preview title="Variações de separador" :code="$code">
        <div class="space-y-4">
            <x-ui.breadcrumb>
                <x-ui.breadcrumb-item href="#" first>Home</x-ui.breadcrumb-item>
                <x-ui.breadcrumb-item href="#">Produtos</x-ui.breadcrumb-item>
                <x-ui.breadcrumb-item active>Detalhes</x-ui.breadcrumb-item>
            </x-ui.breadcrumb>
            <x-ui.breadcrumb>
                <x-ui.breadcrumb-item href="#" first separator="dot">Home</x-ui.breadcrumb-item>
                <x-ui.breadcrumb-item href="#" separator="dot">Produtos</x-ui.breadcrumb-item>
                <x-ui.breadcrumb-item active separator="dot">Detalhes</x-ui.breadcrumb-item>
            </x-ui.breadcrumb>
            <x-ui.breadcrumb>
                <x-ui.breadcrumb-item href="#" first separator="slash">Home</x-ui.breadcrumb-item>
                <x-ui.breadcrumb-item href="#" separator="slash">Produtos</x-ui.breadcrumb-item>
                <x-ui.breadcrumb-item active separator="slash">Detalhes</x-ui.breadcrumb-item>
            </x-ui.breadcrumb>
            <x-ui.breadcrumb>
                <x-ui.breadcrumb-item href="#" first :separator="false">Home</x-ui.breadcrumb-item>
                <x-ui.breadcrumb-item href="#" :separator="false">Produtos</x-ui.breadcrumb-item>
                <x-ui.breadcrumb-item active :separator="false">Detalhes</x-ui.breadcrumb-item>
            </x-ui.breadcrumb>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Com ícone ── --}}
@php
    $code = <<<'BLADE'
    {{-- Ícone "home" no primeiro item --}}
    <x-ui.breadcrumb>
        <x-ui.breadcrumb-item href="#" first icon="house" />
        <x-ui.breadcrumb-item href="#">Configurações</x-ui.breadcrumb-item>
        <x-ui.breadcrumb-item active>Perfil</x-ui.breadcrumb-item>
    </x-ui.breadcrumb>

    {{-- Ícone no item ativo --}}
    <x-ui.breadcrumb>
        <x-ui.breadcrumb-item href="#" first>Dashboard</x-ui.breadcrumb-item>
        <x-ui.breadcrumb-item href="#">Relatórios</x-ui.breadcrumb-item>
        <x-ui.breadcrumb-item active icon="chart-bar" />
    </x-ui.breadcrumb>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Com ícone</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">icon</code>
        para substituir o texto por um ícone Lucide. Funciona em qualquer item — com link, sem link ou ativo.
        Muito útil para representar o "home" no início da trilha.
    </p>
    <x-docs.code-preview title="Items com ícone" :code="$code">
        <div class="space-y-4">
            <x-ui.breadcrumb>
                <x-ui.breadcrumb-item href="#" first icon="house" />
                <x-ui.breadcrumb-item href="#">Configurações</x-ui.breadcrumb-item>
                <x-ui.breadcrumb-item active>Perfil</x-ui.breadcrumb-item>
            </x-ui.breadcrumb>
            <x-ui.breadcrumb>
                <x-ui.breadcrumb-item href="#" first>Dashboard</x-ui.breadcrumb-item>
                <x-ui.breadcrumb-item href="#">Relatórios</x-ui.breadcrumb-item>
                <x-ui.breadcrumb-item active icon="chart-bar" />
            </x-ui.breadcrumb>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Props: x-ui.breadcrumb ── --}}
<section class="mb-2">
    <h2 class="text-base font-semibold text-mono mb-3">Props — <code class="font-mono text-sm">&lt;x-ui.breadcrumb&gt;</code></h2>
    <x-docs.prop-table :props="[
        ['name' => 'separator', 'type' => 'string', 'default' => 'chevron-right', 'description' => 'Prop decorativa — não tem efeito direto. O separador é configurado em cada breadcrumb-item.'],
    ]"/>
</section>

{{-- ── Props: x-ui.breadcrumb-item ── --}}
<section class="mt-6 mb-2">
    <h2 class="text-base font-semibold text-mono mb-3">Props — <code class="font-mono text-sm">&lt;x-ui.breadcrumb-item&gt;</code></h2>
    <x-docs.prop-table :props="[
        ['name' => 'href',      'type' => 'string',       'default' => 'null',          'description' => 'URL de destino. Se informado, renderiza o item como link (kt-breadcrumb-link).'],
        ['name' => 'active',    'type' => 'boolean',      'default' => 'false',         'description' => 'Marca o item como página atual (kt-breadcrumb-page). Não renderiza link.'],
        ['name' => 'first',     'type' => 'boolean',      'default' => 'false',         'description' => 'Suprime o separador antes do item. Obrigatório no primeiro breadcrumb-item.'],
        ['name' => 'icon',      'type' => 'string',       'default' => 'null',          'description' => 'Nome do ícone Lucide. Substitui o conteúdo do slot quando informado.'],
        ['name' => 'separator', 'type' => 'string|false', 'default' => 'chevron-right', 'description' => 'Separador exibido antes do item. Aceita ícone Lucide, dot para bolinha, ou :separator=false para ocultar.'],
    ]"/>
</section>

{{-- ── Slots ── --}}
<section class="mt-6 mb-2">
    <h2 class="text-base font-semibold text-mono mb-3">Slots</h2>
    <x-docs.prop-table :props="[
        ['name' => 'default (x-ui.breadcrumb)',      'type' => 'slot', 'default' => '—', 'description' => 'Itens do breadcrumb: sequência de x-ui.breadcrumb-item.'],
        ['name' => 'default (x-ui.breadcrumb-item)', 'type' => 'slot', 'default' => '—', 'description' => 'Texto do item. Ignorado quando a prop icon estiver definida.'],
    ]"/>
</section>
