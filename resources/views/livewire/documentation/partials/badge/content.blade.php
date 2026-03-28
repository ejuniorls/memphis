{{-- ===================================================
     Badge — content.blade.php
     resources/views/livewire/docs/partials/badge/content.blade.php
     =================================================== --}}

{{-- Cabeçalho --}}
<div class="mb-8">
    <div class="flex items-center gap-3 mb-2">
        <h1 class="text-2xl font-bold text-mono">Badge</h1>
        <span class="kt-badge kt-badge-success kt-badge-sm">Estável</span>
    </div>
    <p class="text-sm text-gray-500 leading-relaxed max-w-2xl">
        Componente de indicador visual compacto baseado no KTUI. Ideal para status, contadores,
        categorias e rótulos. Suporta ícones Lucide, dot, removable e renderização como
        <code class="text-primary text-xs">a</code> ou <code class="text-primary text-xs">button</code>.
    </p>
    <div class="flex items-center gap-3 mt-3 text-xs text-gray-400">
        <code class="bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded font-mono">&lt;x-ui.badge&gt;</code>
        <span>·</span>
        <a href="https://ktui.io/docs/badge" target="_blank" class="hover:text-primary flex items-center gap-1 transition-colors">
            <i class="ki-exit-right-corner"></i> KTUI Reference
        </a>
    </div>
</div>

{{-- ── Variantes ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Variantes</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use a prop <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">variant</code>
        para definir a cor. Sem valor, usa o estilo padrão do KTUI.
    </p>
    <x-docs.code-preview title="Variantes de cor">
        <div class="flex flex-wrap gap-2">
            <x-ui.badge variant="primary">Primary</x-ui.badge>
            <x-ui.badge variant="secondary">Secondary</x-ui.badge>
            <x-ui.badge variant="destructive">Destructive</x-ui.badge>
            <x-ui.badge variant="warning">Warning</x-ui.badge>
            <x-ui.badge variant="success">Success</x-ui.badge>
            <x-ui.badge variant="info">Info</x-ui.badge>
            <x-ui.badge variant="mono">Mono</x-ui.badge>
        </div>
        @slot('code')
            <x-ui.badge variant="primary">Primary</x-ui.badge>
            <x-ui.badge variant="secondary">Secondary</x-ui.badge>
            <x-ui.badge variant="destructive">Destructive</x-ui.badge>
            <x-ui.badge variant="warning">Warning</x-ui.badge>
            <x-ui.badge variant="success">Success</x-ui.badge>
            <x-ui.badge variant="info">Info</x-ui.badge>
            <x-ui.badge variant="mono">Mono</x-ui.badge>
        @endslot
    </x-docs.code-preview>
</section>

{{-- ── Estilos ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Estilos visuais</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use a prop <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">style</code>:
        <code class="font-mono text-xs">outline · light · ghost</code>.
        Também há a prop booleana <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">stroke</code>
        para a variante stroke do default.
    </p>
    <x-docs.code-preview title="Estilos: outline, light, ghost, stroke">
        <div class="space-y-3">
            <div class="flex flex-wrap gap-2">
                <x-ui.badge variant="primary" style="outline">Outline</x-ui.badge>
                <x-ui.badge variant="success" style="outline">Outline</x-ui.badge>
                <x-ui.badge variant="destructive" style="outline">Outline</x-ui.badge>
            </div>
            <div class="flex flex-wrap gap-2">
                <x-ui.badge variant="primary" style="light">Light</x-ui.badge>
                <x-ui.badge variant="success" style="light">Light</x-ui.badge>
                <x-ui.badge variant="warning" style="light">Light</x-ui.badge>
            </div>
            <div class="flex flex-wrap gap-2">
                <x-ui.badge variant="primary" style="ghost">Ghost</x-ui.badge>
                <x-ui.badge variant="info" style="ghost">Ghost</x-ui.badge>
            </div>
            <div class="flex flex-wrap gap-2">
                <x-ui.badge stroke>Stroke</x-ui.badge>
            </div>
        </div>
        @slot('code')
            {{-- Outline --}}
            <x-ui.badge variant="primary"     style="outline">Outline</x-ui.badge>
            <x-ui.badge variant="success"     style="outline">Outline</x-ui.badge>
            <x-ui.badge variant="destructive" style="outline">Outline</x-ui.badge>

            {{-- Light --}}
            <x-ui.badge variant="primary" style="light">Light</x-ui.badge>
            <x-ui.badge variant="success" style="light">Light</x-ui.badge>
            <x-ui.badge variant="warning" style="light">Light</x-ui.badge>

            {{-- Ghost --}}
            <x-ui.badge variant="primary" style="ghost">Ghost</x-ui.badge>

            {{-- Stroke (variante do default, sem variant) --}}
            <x-ui.badge stroke>Stroke</x-ui.badge>
        @endslot
    </x-docs.code-preview>
</section>

{{-- ── Tamanhos ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Tamanhos</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">size</code>:
        <code class="font-mono text-xs">xs · sm · (padrão) · lg</code>.
    </p>
    <x-docs.code-preview title="Tamanhos">
        <div class="flex flex-wrap items-center gap-3">
            <x-ui.badge variant="primary" size="xs">XSmall</x-ui.badge>
            <x-ui.badge variant="primary" size="sm">Small</x-ui.badge>
            <x-ui.badge variant="primary">Default</x-ui.badge>
            <x-ui.badge variant="primary" size="lg">Large</x-ui.badge>
        </div>
        @slot('code')
            <x-ui.badge variant="primary" size="xs">XSmall</x-ui.badge>
            <x-ui.badge variant="primary" size="sm">Small</x-ui.badge>
            <x-ui.badge variant="primary">Default</x-ui.badge>
            <x-ui.badge variant="primary" size="lg">Large</x-ui.badge>
        @endslot
    </x-docs.code-preview>
</section>

{{-- ── Com ícone ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Com ícone</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">icon</code>
        para ícone antes do texto e
        <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">iconEnd</code>
        para ícone após. Ambos aceitam o nome do ícone Lucide.
    </p>
    <x-docs.code-preview title="Badges com ícone">
        <div class="flex flex-wrap gap-2">
            <x-ui.badge variant="success" icon="check">Aprovado</x-ui.badge>
            <x-ui.badge variant="destructive" icon="x">Rejeitado</x-ui.badge>
            <x-ui.badge variant="warning" icon="clock">Pendente</x-ui.badge>
            <x-ui.badge variant="info" iconEnd="arrow-right">Ver mais</x-ui.badge>
        </div>
        @slot('code')
            <x-ui.badge variant="success"     icon="check">Aprovado</x-ui.badge>
            <x-ui.badge variant="destructive" icon="x">Rejeitado</x-ui.badge>
            <x-ui.badge variant="warning"     icon="clock">Pendente</x-ui.badge>
            <x-ui.badge variant="info"        iconEnd="arrow-right">Ver mais</x-ui.badge>
        @endslot
    </x-docs.code-preview>
</section>

{{-- ── Dot ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Dot</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use a prop booleana <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">dot</code>
        para exibir um ponto colorido de status antes do texto. Gerado via <code class="font-mono text-xs">kt-badge-dot</code>.
    </p>
    <x-docs.code-preview title="Badge dot (indicador de status)">
        <div class="flex flex-wrap gap-3">
            <x-ui.badge variant="success" dot>Online</x-ui.badge>
            <x-ui.badge variant="destructive" dot>Offline</x-ui.badge>
            <x-ui.badge variant="warning" dot>Ausente</x-ui.badge>
            <x-ui.badge variant="info" dot>Sincronizando</x-ui.badge>
        </div>
        @slot('code')
            <x-ui.badge variant="success"     dot>Online</x-ui.badge>
            <x-ui.badge variant="destructive" dot>Offline</x-ui.badge>
            <x-ui.badge variant="warning"     dot>Ausente</x-ui.badge>
            <x-ui.badge variant="info"        dot>Sincronizando</x-ui.badge>
        @endslot
    </x-docs.code-preview>
</section>

{{-- ── Circle ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Circle</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use a prop booleana <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">circle</code>
        para bordas totalmente arredondadas (<code class="font-mono text-xs">rounded-full</code>).
        Útil para contadores numéricos.
    </p>
    <x-docs.code-preview title="Badge circular">
        <div class="flex flex-wrap items-center gap-2">
            <x-ui.badge variant="primary" circle>3</x-ui.badge>
            <x-ui.badge variant="destructive" circle>12</x-ui.badge>
            <x-ui.badge variant="success" circle>99+</x-ui.badge>
            <x-ui.badge variant="mono" circle size="lg">7</x-ui.badge>
        </div>
        @slot('code')
            <x-ui.badge variant="primary"     circle>3</x-ui.badge>
            <x-ui.badge variant="destructive" circle>12</x-ui.badge>
            <x-ui.badge variant="success"     circle>99+</x-ui.badge>
            <x-ui.badge variant="mono"        circle size="lg">7</x-ui.badge>
        @endslot
    </x-docs.code-preview>
</section>

{{-- ── Removable ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Removable</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use a prop booleana <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">removable</code>
        para exibir um botão × ao final do badge. Útil em filtros ativos e tags selecionadas.
    </p>
    <x-docs.code-preview title="Badge removable">
        <div class="flex flex-wrap gap-2">
            <x-ui.badge variant="primary" style="light" removable>Laravel</x-ui.badge>
            <x-ui.badge variant="info"    style="light" removable>Livewire</x-ui.badge>
            <x-ui.badge variant="success" style="light" removable>Tailwind</x-ui.badge>
        </div>
        @slot('code')
            <x-ui.badge variant="primary" style="light" removable>Laravel</x-ui.badge>
            <x-ui.badge variant="info"    style="light" removable>Livewire</x-ui.badge>
            <x-ui.badge variant="success" style="light" removable>Tailwind</x-ui.badge>
        @endslot
    </x-docs.code-preview>
</section>

{{-- ── Como link ou botão ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Como link ou botão</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">tag="a"</code>
        com <code class="font-mono text-xs">href</code> para renderizar como link, ou
        <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">tag="button"</code>
        para elemento clicável.
    </p>
    <x-docs.code-preview title="Tag: a e button">
        <div class="flex flex-wrap gap-2">
            <x-ui.badge tag="a" href="#" variant="primary" iconEnd="arrow-right">Ver categoria</x-ui.badge>
            <x-ui.badge tag="button" variant="secondary" icon="filter">Filtrar</x-ui.badge>
        </div>
        @slot('code')
            {{-- Como link --}}
            <x-ui.badge tag="a" href="/categoria/laravel" variant="primary" iconEnd="arrow-right">
                Ver categoria
            </x-ui.badge>

            {{-- Como botão clicável --}}
            <x-ui.badge tag="button" variant="secondary" icon="filter">
                Filtrar
            </x-ui.badge>
        @endslot
    </x-docs.code-preview>
</section>

{{-- ── Props ── --}}
<section class="mb-2">
    <h2 class="text-base font-semibold text-mono mb-3">Props</h2>
    <x-docs.prop-table :props="[
        ['name' => 'variant',   'type' => 'string',  'default' => 'null',   'description' => 'Cor: primary, secondary, destructive, warning, success, info, mono.'],
        ['name' => 'style',     'type' => 'string',  'default' => 'null',   'description' => 'Estilo visual: outline, light, ghost. Sem valor = solid.'],
        ['name' => 'size',      'type' => 'string',  'default' => 'null',   'description' => 'Tamanho: xs, sm, lg. Sem valor = padrão.'],
        ['name' => 'stroke',    'type' => 'boolean', 'default' => 'false',  'description' => 'Variante stroke do default (kt-badge-stroke). Sem variant.'],
        ['name' => 'dot',       'type' => 'boolean', 'default' => 'false',  'description' => 'Exibe ponto colorido de status antes do texto (kt-badge-dot).'],
        ['name' => 'circle',    'type' => 'boolean', 'default' => 'false',  'description' => 'Adiciona rounded-full para formato circular.'],
        ['name' => 'icon',      'type' => 'string',  'default' => 'null',   'description' => 'Nome do ícone Lucide antes do label.'],
        ['name' => 'iconEnd',   'type' => 'string',  'default' => 'null',   'description' => 'Nome do ícone Lucide após o label.'],
        ['name' => 'removable', 'type' => 'boolean', 'default' => 'false',  'description' => 'Exibe botão × para remoção (kt-badge-btn).'],
        ['name' => 'tag',       'type' => 'string',  'default' => 'span',   'description' => 'Tag HTML: span, a, button.'],
        ['name' => 'href', 'type' => 'string', 'default' => 'null', 'description' => 'URL de destino. Usado quando tag=a.'],
    ]" />
</section>
