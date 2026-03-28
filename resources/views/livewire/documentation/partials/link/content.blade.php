{{-- ===================================================
     Link — content.blade.php
     resources/views/livewire/docs/partials/link/content.blade.php
     =================================================== --}}

{{-- Cabeçalho --}}
<div class="mb-8">
    <div class="flex items-center gap-3 mb-2">
        <h1 class="text-2xl font-bold text-mono">Link</h1>
        <x-ui.badge variant="success" size="sm">Estável</x-ui.badge>
    </div>
    <p class="text-sm text-gray-500 leading-relaxed max-w-2xl">
        Componente de link baseado no KTUI. Suporta sublinhado no hover, sublinhado permanente,
        estilo tracejado, versão inverse para fundos escuros, cor mono, estado desabilitado, tamanhos e ícones Lucide.
    </p>
    <div class="flex items-center gap-3 mt-3 text-xs text-gray-400">
        <code class="bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded font-mono">&lt;x-ui.link&gt;</code>
        <span>·</span>
        <x-ui.button tag="a" href="https://ktui.io/docs/link" target="_blank" variant="ghost" size="sm"
                     iconEnd="external-link">
            KTUI Reference
        </x-ui.button>
    </div>
</div>

{{-- ── Uso básico ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.link href="#">Link simples</x-ui.link>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Uso básico</h2>
    <p class="text-xs text-gray-500 mb-4">
        Sem nenhuma prop adicional, o componente renderiza um link com a classe
        <code class="font-mono text-xs">kt-link</code> — cor primária, sem sublinhado por padrão.
    </p>
    <x-docs.code-preview title="Link básico" :code="$code">
        <x-ui.link href="#">Link simples</x-ui.link>
    </x-docs.code-preview>
</section>

{{-- ── Sublinhado ── --}}
@php
    $code = <<<'BLADE'
    {{-- Sublinhado apenas no hover --}}
    <x-ui.link href="#" underline>Sublinhado no hover</x-ui.link>

    {{-- Sempre sublinhado --}}
    <x-ui.link href="#" underlined>Sempre sublinhado</x-ui.link>

    {{-- Tracejado (requer underlined) --}}
    <x-ui.link href="#" underlined dashed>Sublinhado tracejado</x-ui.link>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Sublinhado</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">underline</code>
        para sublinhar apenas no hover,
        <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">underlined</code>
        para sublinhar sempre, e
        <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">dashed</code>
        para o estilo tracejado — que requer <code class="font-mono text-xs">underlined</code>.
    </p>
    <x-docs.code-preview title="Variações de sublinhado" :code="$code">
        <div class="flex flex-wrap items-center gap-6">
            <x-ui.link href="#" underline>Sublinhado no hover</x-ui.link>
            <x-ui.link href="#" underlined>Sempre sublinhado</x-ui.link>
            <x-ui.link href="#" underlined dashed>Sublinhado tracejado</x-ui.link>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Variantes de cor ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.link href="#" underlined>Padrão (primary)</x-ui.link>
    <x-ui.link href="#" underlined inverse>Inverse</x-ui.link>
    <x-ui.link href="#" underlined mono>Mono</x-ui.link>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Variantes de cor</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">inverse</code>
        para links em fundos escuros (cor clara) e
        <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">mono</code>
        para a variante em escala de cinza.
    </p>
    <x-docs.code-preview title="Cores: padrão, inverse, mono" :code="$code">
        <div class="flex flex-wrap items-center gap-6">
            <x-ui.link href="#" underlined>Padrão (primary)</x-ui.link>
            <div class="bg-gray-800 px-3 py-1.5 rounded-lg">
                <x-ui.link href="#" underlined inverse>Inverse</x-ui.link>
            </div>
            <x-ui.link href="#" underlined mono>Mono</x-ui.link>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Tamanhos ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.link href="#" underlined size="sm">Small</x-ui.link>
    <x-ui.link href="#" underlined>Default</x-ui.link>
    <x-ui.link href="#" underlined size="lg">Large</x-ui.link>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Tamanhos</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use a prop <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">size</code>
        para ajustar o tamanho do texto: <code class="font-mono text-xs">sm · default · lg</code>.
    </p>
    <x-docs.code-preview title="Tamanhos: sm, default, lg" :code="$code">
        <div class="flex flex-wrap items-center gap-6">
            <x-ui.link href="#" underlined size="sm">Small</x-ui.link>
            <x-ui.link href="#" underlined>Default</x-ui.link>
            <x-ui.link href="#" underlined size="lg">Large</x-ui.link>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Disabled ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.link href="#" underlined disabled>Link desabilitado</x-ui.link>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Disabled</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">disabled</code>
        para aplicar a aparência desabilitada via classe CSS. O link ainda é renderizado como
        <code class="font-mono text-xs">&lt;a&gt;</code> — bloqueie a navegação via
        <code class="font-mono text-xs">href="#"</code> ou removendo o href conforme necessário.
    </p>
    <x-docs.code-preview title="Link desabilitado" :code="$code">
        <x-ui.link href="#" underlined disabled>Link desabilitado</x-ui.link>
    </x-docs.code-preview>
</section>

{{-- ── Com ícones ── --}}
@php
    $code = <<<'BLADE'
    {{-- Ícone à esquerda --}}
    <x-ui.link href="#" underlined icon="download">Baixar arquivo</x-ui.link>

    {{-- Ícone à direita --}}
    <x-ui.link href="#" underlined iconEnd="arrow-right">Ver mais</x-ui.link>

    {{-- Ícone nos dois lados --}}
    <x-ui.link href="#" underlined icon="external-link" iconEnd="arrow-up-right">Abrir em nova aba</x-ui.link>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Com ícones</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">icon</code>
        para adicionar um ícone Lucide antes do texto e
        <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">iconEnd</code>
        para adicioná-lo após.
    </p>
    <x-docs.code-preview title="Links com ícones" :code="$code">
        <div class="flex flex-wrap items-center gap-6">
            <x-ui.link href="#" underlined icon="download">Baixar arquivo</x-ui.link>
            <x-ui.link href="#" underlined iconEnd="arrow-right">Ver mais</x-ui.link>
            <x-ui.link href="#" underlined icon="external-link" iconEnd="arrow-up-right">Abrir em nova aba</x-ui.link>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Combinações comuns ── --}}
@php
    $code = <<<'BLADE'
    {{-- Em texto corrido --}}
    <p class="text-sm text-gray-600">
        Ao continuar, você concorda com os
        <x-ui.link href="#" underlined>Termos de Uso</x-ui.link>
        e a
        <x-ui.link href="#" underlined>Política de Privacidade</x-ui.link>.
    </p>

    {{-- Como CTA discreto --}}
    <x-ui.link href="#" underlined size="sm" iconEnd="chevron-right">Ver todos os planos</x-ui.link>

    {{-- Link externo com ícone --}}
    <x-ui.link href="https://ktui.io" underlined iconEnd="external-link">KTUI Documentation</x-ui.link>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Combinações comuns</h2>
    <p class="text-xs text-gray-500 mb-4">
        Exemplos de uso em contextos reais: dentro de texto corrido, como CTA discreto e link externo.
    </p>
    <x-docs.code-preview title="Usos práticos" :code="$code">
        <div class="space-y-4">
            <p class="text-sm text-gray-600">
                Ao continuar, você concorda com os
                <x-ui.link href="#" underlined>Termos de Uso</x-ui.link>
                e a
                <x-ui.link href="#" underlined>Política de Privacidade</x-ui.link>
                .
            </p>
            <div>
                <x-ui.link href="#" underlined size="sm" iconEnd="chevron-right">Ver todos os planos</x-ui.link>
            </div>
            <div>
                <x-ui.link href="#" underlined iconEnd="external-link">KTUI Documentation</x-ui.link>
            </div>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Props ── --}}
<section class="mb-2">
    <h2 class="text-base font-semibold text-mono mb-3">Props</h2>
    <x-docs.prop-table :props="[
        ['name' => 'href',       'type' => 'string',  'default' => '#',     'description' => 'URL de destino do link.'],
        ['name' => 'underline',  'type' => 'boolean', 'default' => 'false', 'description' => 'Exibe sublinhado apenas no hover (kt-link-underline).'],
        ['name' => 'underlined', 'type' => 'boolean', 'default' => 'false', 'description' => 'Exibe sublinhado permanente (kt-link-underlined).'],
        ['name' => 'dashed',     'type' => 'boolean', 'default' => 'false', 'description' => 'Sublinhado no estilo tracejado. Requer underlined.'],
        ['name' => 'inverse',    'type' => 'boolean', 'default' => 'false', 'description' => 'Versão com cor clara para uso em fundos escuros (kt-link-inverse).'],
        ['name' => 'mono',       'type' => 'boolean', 'default' => 'false', 'description' => 'Cor monocromática (kt-link-mono).'],
        ['name' => 'disabled',   'type' => 'boolean', 'default' => 'false', 'description' => 'Aparência desabilitada via kt-link-disabled. Não bloqueia navegação.'],
        ['name' => 'size',       'type' => 'string',  'default' => 'null',  'description' => 'Tamanho do texto: sm, lg. Omitir usa o tamanho padrão.'],
        ['name' => 'icon',       'type' => 'string',  'default' => 'null',  'description' => 'Nome do ícone Lucide exibido antes do texto.'],
        ['name' => 'iconEnd',    'type' => 'string',  'default' => 'null',  'description' => 'Nome do ícone Lucide exibido após o texto.'],
    ]"/>
</section>

{{-- ── Slots ── --}}
<section class="mt-6 mb-2">
    <h2 class="text-base font-semibold text-mono mb-3">Slots</h2>
    <x-docs.prop-table :props="[
        ['name' => 'default', 'type' => 'slot', 'default' => '—', 'description' => 'Texto do link.'],
    ]"/>
</section>
