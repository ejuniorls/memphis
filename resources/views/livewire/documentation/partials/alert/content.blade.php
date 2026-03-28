{{-- ===================================================
     Alert — content.blade.php
     resources/views/livewire/docs/partials/alert/content.blade.php
     =================================================== --}}

{{-- Cabeçalho --}}
<div class="mb-8">
    <div class="flex items-center gap-3 mb-2">
        <h1 class="text-2xl font-bold text-mono">Alert</h1>
        <span class="kt-badge kt-badge-success kt-badge-sm">Estável</span>
    </div>
    <p class="text-sm text-gray-500 leading-relaxed max-w-2xl">
        Componente de alerta contextual baseado no KTUI. Suporta variantes de cor, estilos visuais,
        ícones Lucide automáticos, título, descrição, ações e dismiss.
    </p>
    <div class="flex items-center gap-3 mt-3 text-xs text-gray-400">
        <code class="bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded font-mono">&lt;x-ui.alert&gt;</code>
        <span>·</span>
        <a href="https://ktui.io/docs/alert" target="_blank" class="hover:text-primary flex items-center gap-1 transition-colors">
            <i class="ki-exit-right-corner"></i> KTUI Reference
        </a>
    </div>
</div>

{{-- ── Variantes ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Variantes</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use a prop <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">variant</code>.
        Cada variante tem um ícone Lucide padrão atribuído automaticamente.
    </p>
    <x-docs.code-preview title="Variantes de cor">
        <div class="space-y-3">
            <x-ui.alert variant="info"        title="Info"        description="Mensagem informativa para o usuário." />
            <x-ui.alert variant="success"     title="Sucesso"     description="Operação realizada com sucesso." />
            <x-ui.alert variant="warning"     title="Atenção"     description="Verifique os dados antes de continuar." />
            <x-ui.alert variant="destructive" title="Erro"        description="Algo deu errado. Tente novamente." />
            <x-ui.alert variant="primary"     title="Primary"     description="Alerta com a cor primária da aplicação." />
            <x-ui.alert variant="mono"        title="Mono"        description="Alerta em escala de cinza." />
        </div>
        @slot('code')
            <x-ui.alert variant="info" title="Info" description="Mensagem informativa."/>
            <x-ui.alert variant="success" title="Sucesso" description="Operação com sucesso."/>
            <x-ui.alert variant="warning" title="Atenção" description="Verifique os dados."/>
            <x-ui.alert variant="destructive" title="Erro" description="Algo deu errado."/>
            <x-ui.alert variant="primary" title="Primary" description="Cor primária."/>
            <x-ui.alert variant="mono" title="Mono" description="Escala de cinza."/>
        @endslot
    </x-docs.code-preview>
</section>

{{-- ── Estilos ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Estilos visuais</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use a prop <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">style</code>
        para alterar a aparência: <code class="font-mono text-xs">outline · light · mono</code>.
        Combina com <code class="font-mono text-xs">variant</code>.
    </p>
    <x-docs.code-preview title="Estilos: outline, light, mono">
        <div class="space-y-3">
            <x-ui.alert variant="success" style="outline" title="Outline" description="Borda colorida, sem fundo."/>
            <x-ui.alert variant="success" style="light" title="Light" description="Fundo suave e ícone colorido."/>
            <x-ui.alert variant="success" style="mono" title="Mono" description="Estilo monocromático."/>
        </div>
        @slot('code')
            <x-ui.alert variant="success" style="outline" title="Outline" description="Borda colorida, sem fundo."/>
            <x-ui.alert variant="success" style="light" title="Light" description="Fundo suave."/>
            <x-ui.alert variant="success" style="mono" title="Mono" description="Monocromático."/>
        @endslot
    </x-docs.code-preview>
</section>

{{-- ── Apenas título (layout simples) ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Layout simples</h2>
    <p class="text-xs text-gray-500 mb-4">
        Quando apenas <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">title</code>
        é passado (sem <code class="font-mono text-xs">description</code> nem slot), o componente usa
        o layout inline — ícone, título e toolbar na mesma linha.
    </p>
    <x-docs.code-preview title="Somente título">
        <div class="space-y-3">
            <x-ui.alert variant="info" title="Seu e-mail foi confirmado."/>
            <x-ui.alert variant="warning" title="Esta ação não pode ser desfeita."/>
        </div>
        @slot('code')
            <x-ui.alert variant="info" title="Seu e-mail foi confirmado."/>
            <x-ui.alert variant="warning" title="Esta ação não pode ser desfeita."/>
        @endslot
    </x-docs.code-preview>
</section>

{{-- ── Slot padrão como descrição ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Slot como descrição</h2>
    <p class="text-xs text-gray-500 mb-4">
        Em vez da prop <code
            class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">description</code>,
        você pode passar o conteúdo via slot padrão — útil para HTML rico.
    </p>
    <x-docs.code-preview title="Conteúdo via slot">
        <x-ui.alert variant="info" title="Atualização disponível">
            Uma nova versão está disponível.
            <a href="#" class="kt-link kt-link-xs kt-link-underlined kt-link-inverse">Atualizar agora</a>
        </x-ui.alert>
        @slot('code')
            <x-ui.alert variant="info" title="Atualização disponível">
                Uma nova versão está disponível.
                <a href="#" class="kt-link kt-link-xs kt-link-underlined kt-link-inverse">Atualizar agora</a>
            </x-ui.alert>
        @endslot
    </x-docs.code-preview>
</section>

{{-- ── Ação simples ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Ação simples</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">actionLabel</code>
        e <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">actionHref</code>
        para adicionar um link de ação direto no alerta.
    </p>
    <x-docs.code-preview title="Alert com action">
        <x-ui.alert
            variant="warning"
            title="Plano expirando"
            description="Seu plano expira em 3 dias. Renove para não perder acesso."
            actionLabel="Renovar agora"
            actionHref="#"
        />
        @slot('code')
            <x-ui.alert
                variant="warning"
                title="Plano expirando"
                description="Seu plano expira em 3 dias."
                actionLabel="Renovar agora"
                actionHref="/planos"
            />
        @endslot
    </x-docs.code-preview>
</section>

{{-- ── Slot de ações ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Slot de ações customizadas</h2>
    <p class="text-xs text-gray-500 mb-4">
        Para múltiplas ações ou ações mais complexas, use o slot nomeado
        <code class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">actions</code>.
    </p>
    <x-docs.code-preview title="Slot actions">
        <x-ui.alert variant="primary" title="Confirmar operação"
                    description="Deseja prosseguir com a exclusão dos dados selecionados?">
            <x-slot:actions>
                <x-ui.button size="sm" variant="destructive">Confirmar</x-ui.button>
                <x-ui.button size="sm" variant="ghost">Cancelar</x-ui.button>
            </x-slot:actions>
        </x-ui.alert>
        @slot('code')
            <x-ui.alert
                variant="primary"
                title="Confirmar operação"
                description="Deseja prosseguir com a exclusão?"
            >
                <x-slot:actions>
                    <x-ui.button size="sm" variant="destructive">Confirmar</x-ui.button>
                    <x-ui.button size="sm" variant="ghost">Cancelar</x-ui.button>
                </x-slot:actions>
            </x-ui.alert>
        @endslot
    </x-docs.code-preview>
</section>

{{-- ── Dismissible ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Dismissible</h2>
    <p class="text-xs text-gray-500 mb-4">
        Use a prop booleana <code
            class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">dismissible</code>
        para exibir o botão de fechar (×). O KTUI controla a visibilidade via
        <code class="font-mono text-xs">data-kt-dismiss</code> usando o <code class="font-mono text-xs">id</code> gerado
        automaticamente.
    </p>
    <x-docs.code-preview title="Alert com dismiss">
        <x-ui.alert
            variant="info"
            title="Novidade disponível"
            description="Confira as novas funcionalidades do painel."
            dismissible
        />
        @slot('code')
            <x-ui.alert
                variant="info"
                title="Novidade disponível"
                description="Confira as novas funcionalidades."
                dismissible
            />

            {{-- Com id manual (opcional) --}}
            <x-ui.alert id="meu-alerta" variant="warning" title="Atenção" dismissible/>
        @endslot
    </x-docs.code-preview>
</section>

{{-- ── Ícone customizado / oculto ── --}}
<section class="mb-8">
    <h2 class="text-base font-semibold text-mono mb-1">Ícone customizado ou oculto</h2>
    <p class="text-xs text-gray-500 mb-4">
        Passe um nome Lucide em <code
            class="text-primary bg-primary/10 px-1.5 py-0.5 rounded text-xs font-mono">icon</code>
        para substituir o padrão, ou passe <code class="font-mono text-xs">:icon="false"</code> para ocultar
        completamente.
    </p>
    <x-docs.code-preview title="Ícone customizado e sem ícone">
        <div class="space-y-3">
            <x-ui.alert variant="success" icon="rocket" title="Deploy concluído"
                        description="Sua aplicação foi publicada com sucesso."/>
            <x-ui.alert variant="info" :icon="false" title="Sem ícone" description="Este alerta não exibe ícone."/>
        </div>
        @slot('code')
            {{-- Ícone Lucide customizado --}}
            <x-ui.alert variant="success" icon="rocket" title="Deploy concluído" description="..."/>

            {{-- Sem ícone --}}
            <x-ui.alert variant="info" :icon="false" title="Sem ícone" description="..."/>
        @endslot
    </x-docs.code-preview>
</section>

{{-- ── Props ── --}}
<section class="mb-2">
    <h2 class="text-base font-semibold text-mono mb-3">Props</h2>
    <x-docs.prop-table :props="[
        ['name' => 'variant',     'type' => 'string',       'default' => 'null',   'description' => 'Cor contextual: primary, success, info, destructive, warning, mono.'],
        ['name' => 'style',       'type' => 'string',       'default' => 'null',   'description' => 'Estilo visual: outline, light, mono. Combina com variant.'],
        ['name' => 'size',        'type' => 'string',       'default' => 'null',   'description' => 'Tamanho: sm, lg.'],
        ['name' => 'title',       'type' => 'string',       'default' => 'null',   'description' => 'Texto do título em destaque.'],
        ['name' => 'description', 'type' => 'string',       'default' => 'null',   'description' => 'Texto da descrição. Alternativa ao slot padrão.'],
        ['name' => 'icon', 'type' => 'string|false', 'default' => 'auto', 'description' => 'Nome do ícone Lucide. Automático por variant. :icon=false oculta.'],
        ['name' => 'dismissible', 'type' => 'boolean',      'default' => 'false',  'description' => 'Exibe botão × para fechar via data-kt-dismiss.'],
        ['name' => 'id',          'type' => 'string',       'default' => 'auto',   'description' => 'ID HTML. Gerado automaticamente se omitido (usado pelo dismiss).'],
        ['name' => 'actionLabel', 'type' => 'string',       'default' => 'null',   'description' => 'Label do link de ação rápida.'],
        ['name' => 'actionHref',  'type' => 'string',       'default' => '#',      'description' => 'URL do link de ação rápida.'],
    ]"/>
</section>

{{-- ── Slots ── --}}
<section class="mt-6 mb-2">
    <h2 class="text-base font-semibold text-mono mb-3">Slots</h2>
    <x-docs.prop-table :props="[
        ['name' => 'default', 'type' => 'slot', 'default' => '—', 'description' => 'Conteúdo da descrição (alternativa à prop description). Aceita HTML.'],
        ['name' => 'actions', 'type' => 'slot', 'default' => '—', 'description' => 'Ações customizadas renderizadas na toolbar do alerta.'],
    ]" />
</section>
