{{-- ===================================================
     Select — content.blade.php
     resources/views/livewire/docs/partials/select/content.blade.php
     =================================================== --}}

{{-- Cabeçalho --}}
<div class="mb-8">
    <div class="flex items-center gap-3 mb-2">
        <h1 class="text-2xl font-bold text-mono">Select</h1>
        <x-ui.badge variant="success" size="sm">Estável</x-ui.badge>
    </div>
    <p class="text-sm text-gray-500 leading-relaxed max-w-2xl">
        Componente de seleção baseado no KTUI. Suporta seleção simples e múltipla, modo tags,
        busca no dropdown, pré-seleção, limite de seleções, scroll e carregamento remoto via API.
    </p>
    <div class="flex items-center gap-3 mt-3 text-xs text-gray-400">
        <code class="bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded font-mono">&lt;x-ui.select&gt;</code>
        <span>·</span>
        <x-ui.button tag="a" href="https://ktui.io/docs/select" target="_blank" variant="ghost" size="sm" iconEnd="external-link">
            KTUI Reference
        </x-ui.button>
    </div>
</div>

{{-- ── Uso básico ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.select placeholder="Selecione uma opção">
        <option value="1">Opção 1</option>
        <option value="2">Opção 2</option>
        <option value="3">Opção 3</option>
    </x-ui.select>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Uso básico</h2>
    <p class="text-xs text-gray-500 mb-4">
        Envolva as tags <code class="font-mono text-xs">option</code> nativas dentro do componente.
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">placeholder</code>
        para exibir um texto inicial antes da seleção.
    </p>
    <x-docs.code-preview title="Select simples" :code="$code">
        <div class="max-w-sm">
            <x-ui.select placeholder="Selecione uma opção">
                <option value="1">Opção 1</option>
                <option value="2">Opção 2</option>
                <option value="3">Opção 3</option>
            </x-ui.select>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Tamanhos ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.select size="sm" placeholder="Small">
        <option value="1">Opção 1</option>
        <option value="2">Opção 2</option>
    </x-ui.select>

    <x-ui.select placeholder="Default">
        <option value="1">Opção 1</option>
        <option value="2">Opção 2</option>
    </x-ui.select>

    <x-ui.select size="lg" placeholder="Large">
        <option value="1">Opção 1</option>
        <option value="2">Opção 2</option>
    </x-ui.select>
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
            <x-ui.select size="sm" placeholder="Small">
                <option value="1">Opção 1</option>
                <option value="2">Opção 2</option>
            </x-ui.select>
            <x-ui.select placeholder="Default">
                <option value="1">Opção 1</option>
                <option value="2">Opção 2</option>
            </x-ui.select>
            <x-ui.select size="lg" placeholder="Large">
                <option value="1">Opção 1</option>
                <option value="2">Opção 2</option>
            </x-ui.select>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Disabled ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.select placeholder="Campo desabilitado" disabled>
        <option value="1">Opção 1</option>
        <option value="2">Opção 2</option>
    </x-ui.select>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Disabled</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use a prop booleana <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">disabled</code>
        para desabilitar o select. O componente aplica o atributo HTML e o flag interno do KTUI simultaneamente.
    </p>
    <x-docs.code-preview title="Select desabilitado" :code="$code">
        <div class="max-w-sm">
            <x-ui.select placeholder="Campo desabilitado" disabled>
                <option value="1">Opção 1</option>
                <option value="2">Opção 2</option>
            </x-ui.select>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Com busca ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.select placeholder="Selecione um país" search>
        <option value="br">Brasil</option>
        <option value="us">Estados Unidos</option>
        <option value="pt">Portugal</option>
        <option value="de">Alemanha</option>
        <option value="fr">França</option>
        <option value="jp">Japão</option>
    </x-ui.select>

    {{-- Com placeholder personalizado na busca --}}
    <x-ui.select placeholder="Selecione uma linguagem" search searchPlaceholder="Buscar linguagem...">
        <option value="php">PHP</option>
        <option value="js">JavaScript</option>
        <option value="ts">TypeScript</option>
        <option value="py">Python</option>
        <option value="go">Go</option>
    </x-ui.select>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Com busca</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">search</code>
        para habilitar o campo de busca dentro do dropdown. Personalize o placeholder da busca com
        <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">searchPlaceholder</code>.
    </p>
    <x-docs.code-preview title="Select com busca" :code="$code">
        <div class="space-y-3 max-w-sm">
            <x-ui.select placeholder="Selecione um país" search>
                <option value="br">Brasil</option>
                <option value="us">Estados Unidos</option>
                <option value="pt">Portugal</option>
                <option value="de">Alemanha</option>
                <option value="fr">França</option>
                <option value="jp">Japão</option>
            </x-ui.select>
            <x-ui.select placeholder="Selecione uma linguagem" search searchPlaceholder="Buscar linguagem...">
                <option value="php">PHP</option>
                <option value="js">JavaScript</option>
                <option value="ts">TypeScript</option>
                <option value="py">Python</option>
                <option value="go">Go</option>
            </x-ui.select>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Múltipla seleção ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.select placeholder="Selecione as permissões" multiple>
        <option value="read">Leitura</option>
        <option value="write">Escrita</option>
        <option value="delete">Exclusão</option>
        <option value="admin">Administrador</option>
    </x-ui.select>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Múltipla seleção</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">multiple</code>
        para permitir a seleção de mais de um item. Os valores selecionados são exibidos como lista no campo.
    </p>
    <x-docs.code-preview title="Select múltiplo" :code="$code">
        <div class="max-w-sm">
            <x-ui.select placeholder="Selecione as permissões" multiple>
                <option value="read">Leitura</option>
                <option value="write">Escrita</option>
                <option value="delete">Exclusão</option>
                <option value="admin">Administrador</option>
            </x-ui.select>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Modo tags ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.select placeholder="Adicione tecnologias" tags multiple>
        <option value="laravel">Laravel</option>
        <option value="livewire">Livewire</option>
        <option value="tailwind">Tailwind CSS</option>
        <option value="alpine">Alpine.js</option>
        <option value="vite">Vite</option>
    </x-ui.select>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Modo tags</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">tags</code>
        em conjunto com <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">multiple</code>
        para exibir os itens selecionados como badges removíveis dentro do campo.
    </p>
    <x-docs.code-preview title="Select com tags" :code="$code">
        <div class="max-w-sm">
            <x-ui.select placeholder="Adicione tecnologias" tags multiple>
                <option value="laravel">Laravel</option>
                <option value="livewire">Livewire</option>
                <option value="tailwind">Tailwind CSS</option>
                <option value="alpine">Alpine.js</option>
                <option value="vite">Vite</option>
            </x-ui.select>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Limite de seleções ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.select placeholder="Escolha até 2 opções" multiple :maxSelections="2">
        <option value="php">PHP</option>
        <option value="js">JavaScript</option>
        <option value="py">Python</option>
        <option value="go">Go</option>
        <option value="rust">Rust</option>
    </x-ui.select>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Limite de seleções</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">:maxSelections="N"</code>
        para limitar quantos itens o usuário pode selecionar em modo múltiplo.
    </p>
    <x-docs.code-preview title="Máximo de seleções" :code="$code">
        <div class="max-w-sm">
            <x-ui.select placeholder="Escolha até 2 opções" multiple :maxSelections="2">
                <option value="php">PHP</option>
                <option value="js">JavaScript</option>
                <option value="py">Python</option>
                <option value="go">Go</option>
                <option value="rust">Rust</option>
            </x-ui.select>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Pré-selecionado ── --}}
@php
    $code = <<<'BLADE'
    {{-- Seleção simples --}}
    <x-ui.select placeholder="Status" preSelected="active">
        <option value="active">Ativo</option>
        <option value="inactive">Inativo</option>
        <option value="pending">Pendente</option>
    </x-ui.select>

    {{-- Múltiplos pré-selecionados (separados por vírgula) --}}
    <x-ui.select placeholder="Perfis" multiple preSelected="editor,viewer">
        <option value="admin">Administrador</option>
        <option value="editor">Editor</option>
        <option value="viewer">Visualizador</option>
    </x-ui.select>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Pré-selecionado</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">preSelected</code>
        para definir o(s) valor(es) inicial(ais). Em modo múltiplo, separe os valores por vírgula.
    </p>
    <x-docs.code-preview title="Com valor pré-selecionado" :code="$code">
        <div class="space-y-3 max-w-sm">
            <x-ui.select placeholder="Status" preSelected="active">
                <option value="active">Ativo</option>
                <option value="inactive">Inativo</option>
                <option value="pending">Pendente</option>
            </x-ui.select>
            <x-ui.select placeholder="Perfis" multiple preSelected="editor,viewer">
                <option value="admin">Administrador</option>
                <option value="editor">Editor</option>
                <option value="viewer">Visualizador</option>
            </x-ui.select>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Dropdown com scroll ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.select placeholder="Selecione um país" search optionsScrollable>
        <option value="ar">Argentina</option>
        <option value="br">Brasil</option>
        <option value="cl">Chile</option>
        <option value="co">Colômbia</option>
        <option value="de">Alemanha</option>
        <option value="es">Espanha</option>
        <option value="fr">França</option>
        <option value="it">Itália</option>
        <option value="jp">Japão</option>
        <option value="mx">México</option>
        <option value="pt">Portugal</option>
        <option value="us">Estados Unidos</option>
    </x-ui.select>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Dropdown com scroll</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">optionsScrollable</code>
        para limitar a altura do dropdown a 250px e habilitar scroll quando há muitas opções.
    </p>
    <x-docs.code-preview title="Dropdown scrollável" :code="$code">
        <div class="max-w-sm">
            <x-ui.select placeholder="Selecione um país" search optionsScrollable>
                <option value="ar">Argentina</option>
                <option value="br">Brasil</option>
                <option value="cl">Chile</option>
                <option value="co">Colômbia</option>
                <option value="de">Alemanha</option>
                <option value="es">Espanha</option>
                <option value="fr">França</option>
                <option value="it">Itália</option>
                <option value="jp">Japão</option>
                <option value="mx">México</option>
                <option value="pt">Portugal</option>
                <option value="us">Estados Unidos</option>
            </x-ui.select>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Carregamento remoto ── --}}
@php
    $code = <<<'BLADE'
    <x-ui.select
        placeholder="Buscar usuário..."
        search
        remote
        dataUrl="/api/users"
        dataFieldValue="id"
        dataFieldText="name"
    />
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Carregamento remoto</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">remote</code>
        junto com <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">dataUrl</code>
        para carregar as opções via API. Configure quais campos da resposta JSON serão usados como
        valor e texto com <code class="font-mono text-xs">dataFieldValue</code> e <code class="font-mono text-xs">dataFieldText</code>.
        Neste modo o slot de opções deve ser omitido.
    </p>
    <x-docs.code-preview title="Select remoto" :code="$code" :preview="false" />
</section>

{{-- ── Uso em formulário ── --}}
@php
    $code = <<<'BLADE'
    <form class="kt-form">
        <div class="kt-form-item">
            <label class="kt-form-label">País:</label>
            <div class="kt-form-control">
                <x-ui.select name="country" placeholder="Selecione um país" search>
                    <option value="br">Brasil</option>
                    <option value="pt">Portugal</option>
                    <option value="us">Estados Unidos</option>
                </x-ui.select>
            </div>
            <div class="kt-form-description">Selecione seu país de origem.</div>
        </div>

        <div class="kt-form-item">
            <label class="kt-form-label">Perfis:</label>
            <div class="kt-form-control">
                <x-ui.select name="roles[]" placeholder="Selecione os perfis" multiple tags>
                    <option value="admin">Administrador</option>
                    <option value="editor">Editor</option>
                    <option value="viewer">Visualizador</option>
                </x-ui.select>
            </div>
            <div class="kt-form-description">Você pode selecionar mais de um perfil.</div>
        </div>

        <div class="kt-form-actions">
            <x-ui.button type="reset" variant="outline">Limpar</x-ui.button>
            <x-ui.button type="submit">Salvar</x-ui.button>
        </div>
    </form>
    BLADE;
@endphp
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Uso em formulário</h2>
    <p class="text-xs text-gray-500 mb-4">
        O select integra-se diretamente à estrutura
        <code class="font-mono text-xs">kt-form → kt-form-item</code> com suporte a label, descrição e mensagem de erro.
        Lembre-se de usar <code class="font-mono text-xs">name="campo[]"</code> no modo múltiplo para enviar array.
    </p>
    <x-docs.code-preview title="Select em formulário" :code="$code">
        <div class="max-w-sm">
            <form class="kt-form">
                <div class="kt-form-item">
                    <label class="kt-form-label">País:</label>
                    <div class="kt-form-control">
                        <x-ui.select name="country" placeholder="Selecione um país" search>
                            <option value="br">Brasil</option>
                            <option value="pt">Portugal</option>
                            <option value="us">Estados Unidos</option>
                        </x-ui.select>
                    </div>
                    <div class="kt-form-description">Selecione seu país de origem.</div>
                </div>
                <div class="kt-form-item">
                    <label class="kt-form-label">Perfis:</label>
                    <div class="kt-form-control">
                        <x-ui.select name="roles[]" placeholder="Selecione os perfis" multiple tags>
                            <option value="admin">Administrador</option>
                            <option value="editor">Editor</option>
                            <option value="viewer">Visualizador</option>
                        </x-ui.select>
                    </div>
                    <div class="kt-form-description">Você pode selecionar mais de um perfil.</div>
                </div>
                <div class="kt-form-actions">
                    <x-ui.button type="reset" variant="outline">Limpar</x-ui.button>
                    <x-ui.button type="submit">Salvar</x-ui.button>
                </div>
            </form>
        </div>
    </x-docs.code-preview>
</section>

{{-- ── Props ── --}}
<section class="mb-2">
    <h2 class="text-base font-semibold text-mono mb-3">Props</h2>
    <x-docs.prop-table :props="[
        ['name' => 'placeholder',       'type' => 'string',       'default' => 'null',       'description' => 'Texto exibido antes de qualquer seleção.'],
        ['name' => 'size',              'type' => 'string',       'default' => 'null',       'description' => 'Tamanho do campo: sm, lg. Omitir usa o tamanho padrão.'],
        ['name' => 'disabled',          'type' => 'boolean',      'default' => 'false',      'description' => 'Desabilita o select via atributo HTML e flag interno do KTUI.'],
        ['name' => 'multiple',          'type' => 'boolean',      'default' => 'false',      'description' => 'Habilita seleção de múltiplos itens.'],
        ['name' => 'tags',              'type' => 'boolean',      'default' => 'false',      'description' => 'Exibe os itens selecionados como badges removíveis. Use junto com multiple.'],
        ['name' => 'maxSelections',     'type' => 'int',          'default' => 'null',       'description' => 'Limita o número de itens selecionáveis em modo múltiplo.'],
        ['name' => 'preSelected',       'type' => 'string',       'default' => 'null',       'description' => 'Valor(es) pré-selecionado(s). Em modo múltiplo, separe por vírgula.'],
        ['name' => 'search',            'type' => 'boolean',      'default' => 'false',      'description' => 'Habilita campo de busca dentro do dropdown.'],
        ['name' => 'searchPlaceholder', 'type' => 'string',       'default' => 'Search...',  'description' => 'Placeholder do campo de busca interno.'],
        ['name' => 'optionsScrollable', 'type' => 'boolean',      'default' => 'false',      'description' => 'Limita o dropdown a 250px de altura e habilita scroll.'],
        ['name' => 'remote',            'type' => 'boolean',      'default' => 'false',      'description' => 'Carrega as opções dinamicamente via requisição à API.'],
        ['name' => 'dataUrl',           'type' => 'string',       'default' => 'null',       'description' => 'URL da API para busca remota. Requer remote=true.'],
        ['name' => 'dataFieldValue',    'type' => 'string',       'default' => 'null',       'description' => 'Campo do JSON da API a usar como value da opção.'],
        ['name' => 'dataFieldText',     'type' => 'string',       'default' => 'null',       'description' => 'Campo do JSON da API a usar como texto visível da opção.'],
        ['name' => 'config',            'type' => 'string|array', 'default' => 'null',       'description' => 'Configuração avançada em JSON ou array, mesclada ao data-kt-select-config.'],
    ]"/>
</section>

{{-- ── Slots ── --}}
<section class="mt-6 mb-2">
    <h2 class="text-base font-semibold text-mono mb-3">Slots</h2>
    <x-docs.prop-table :props="[
        ['name' => 'default', 'type' => 'slot', 'default' => '—', 'description' => 'Opções do select: tags option e optgroup nativas do HTML. Omitir no modo remote.'],
    ]"/>
</section>
