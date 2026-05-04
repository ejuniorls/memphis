<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('UI Components')]
class extends Component {
    //
}; ?>

<div x-data="{ activeSection: 'button' }">

    {{-- Cabeçalho --}}
    <div class="kt-container-fluid mb-8">
        <div class="flex flex-col gap-1 pt-2">
            <h1 class="text-2xl font-bold text-mono">UI Components</h1>
            <p class="text-sm text-secondary-foreground">Biblioteca de componentes Blade reutilizáveis do projeto Memphis.</p>
        </div>
    </div>

    <div class="kt-container-fluid">
        <div class="flex gap-7.5 items-start">

            {{-- Nav lateral --}}
            <aside class="w-52 shrink-0 sticky top-6">
                <nav class="flex flex-col gap-1">
                    <button @click="activeSection = 'button'" :class="activeSection === 'button' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Button</button>
                    <button @click="activeSection = 'badge'" :class="activeSection === 'badge' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Badge</button>
                    <button @click="activeSection = 'alert'" :class="activeSection === 'alert' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Alert</button>
                    <button @click="activeSection = 'input'" :class="activeSection === 'input' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Input</button>
                    <button @click="activeSection = 'input-group'" :class="activeSection === 'input-group' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Input Group</button>
                    <button @click="activeSection = 'select'" :class="activeSection === 'select' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Select</button>
                    <button @click="activeSection = 'link'" :class="activeSection === 'link' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Link</button>
                    <button @click="activeSection = 'icon-box'" :class="activeSection === 'icon-box' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Icon Box</button>
                    <button @click="activeSection = 'breadcrumb'" :class="activeSection === 'breadcrumb' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Breadcrumb</button>
                </nav>
            </aside>

            {{-- Conteúdo --}}
            <main class="flex-1 min-w-0 flex flex-col gap-6 pb-20">


                {{-- ══════════ BUTTON ══════════ --}}
                <div x-show="activeSection === 'button'" class="flex flex-col gap-6">

                    @php
                        $code = <<<'BLADE'
        <x-ui.button variant="primary">Primary</x-ui.button>
        <x-ui.button variant="secondary">Secondary</x-ui.button>
        <x-ui.button variant="destructive">Destructive</x-ui.button>
        <x-ui.button variant="success">Success</x-ui.button>
        <x-ui.button variant="warning">Warning</x-ui.button>
        <x-ui.button variant="info">Info</x-ui.button>
        <x-ui.button variant="mono">Mono</x-ui.button>
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Button — Variantes" description="Prop <code>variant</code> define a cor semântica do botão." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="primary">Primary</x-ui.button>
                            <x-ui.button variant="secondary">Secondary</x-ui.button>
                            <x-ui.button variant="destructive">Destructive</x-ui.button>
                            <x-ui.button variant="success">Success</x-ui.button>
                            <x-ui.button variant="warning">Warning</x-ui.button>
                            <x-ui.button variant="info">Info</x-ui.button>
                            <x-ui.button variant="mono">Mono</x-ui.button>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
        <x-ui.button variant="primary" size="xs">Extra Small</x-ui.button>
        <x-ui.button variant="primary" size="sm">Small</x-ui.button>
        <x-ui.button variant="primary">Default</x-ui.button>
        <x-ui.button variant="primary" size="lg">Large</x-ui.button>
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Button — Tamanhos" description="Prop <code>size</code>: <code>xs</code>, <code>sm</code>, padrão, <code>lg</code>." :code="$code">
                        <div class="flex flex-wrap items-center gap-3">
                            <x-ui.button variant="primary" size="xs">Extra Small</x-ui.button>
                            <x-ui.button variant="primary" size="sm">Small</x-ui.button>
                            <x-ui.button variant="primary">Default</x-ui.button>
                            <x-ui.button variant="primary" size="lg">Large</x-ui.button>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
        <x-ui.button variant="primary" icon="plus">Novo</x-ui.button>
        <x-ui.button variant="secondary" iconEnd="arrow-right">Próximo</x-ui.button>
        <x-ui.button variant="mono" :iconOnly="true" icon="settings"></x-ui.button>
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Button — Com ícone" description="Props <code>icon</code> e <code>iconEnd</code> aceitam qualquer nome Lucide." :code="$code">
                        <div class="flex flex-wrap items-center gap-3">
                            <x-ui.button variant="primary" icon="plus">Novo</x-ui.button>
                            <x-ui.button variant="secondary" iconEnd="arrow-right">Próximo</x-ui.button>
                            <x-ui.button variant="mono" :iconOnly="true" icon="settings"></x-ui.button>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
        <x-ui.button ghost="">Ghost</x-ui.button>
        <x-ui.button ghost="primary">Ghost Primary</x-ui.button>
        <x-ui.button ghost="destructive">Ghost Destructive</x-ui.button>
        <x-ui.button :disabled="true" variant="primary">Disabled</x-ui.button>
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Button — Ghost & Disabled" description="Botões sem fundo via prop <code>ghost</code> e estado desabilitado." :code="$code">
                        <div class="flex flex-wrap items-center gap-3">
                            <x-ui.button ghost="">Ghost</x-ui.button>
                            <x-ui.button ghost="primary">Ghost Primary</x-ui.button>
                            <x-ui.button ghost="destructive">Ghost Destructive</x-ui.button>
                            <x-ui.button :disabled="true" variant="primary">Disabled</x-ui.button>
                        </div>
                    </x-ui-doc-section>

                </div>


                {{-- ══════════ BADGE ══════════ --}}
                <div x-show="activeSection === 'badge'" class="flex flex-col gap-6">

                    @php
                        $code = <<<'BLADE'
        <x-ui.badge variant="primary">Primary</x-ui.badge>
        <x-ui.badge variant="secondary">Secondary</x-ui.badge>
        <x-ui.badge variant="success">Success</x-ui.badge>
        <x-ui.badge variant="destructive">Destructive</x-ui.badge>
        <x-ui.badge variant="warning">Warning</x-ui.badge>
        <x-ui.badge variant="info">Info</x-ui.badge>
        <x-ui.badge variant="mono">Mono</x-ui.badge>
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Badge — Variantes" description="Prop <code>variant</code> define a cor semântica." :code="$code">
                        <div class="flex flex-wrap gap-2">
                            <x-ui.badge variant="primary">Primary</x-ui.badge>
                            <x-ui.badge variant="secondary">Secondary</x-ui.badge>
                            <x-ui.badge variant="success">Success</x-ui.badge>
                            <x-ui.badge variant="destructive">Destructive</x-ui.badge>
                            <x-ui.badge variant="warning">Warning</x-ui.badge>
                            <x-ui.badge variant="info">Info</x-ui.badge>
                            <x-ui.badge variant="mono">Mono</x-ui.badge>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
        <x-ui.badge variant="primary" style="outline">Outline</x-ui.badge>
        <x-ui.badge variant="success" style="light">Light</x-ui.badge>
        <x-ui.badge variant="info" style="ghost">Ghost</x-ui.badge>
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Badge — Estilos" description="Prop <code>style</code>: <code>outline</code>, <code>light</code>, <code>ghost</code>." :code="$code">
                        <div class="flex flex-wrap gap-2">
                            <x-ui.badge variant="primary" style="outline">Outline</x-ui.badge>
                            <x-ui.badge variant="success" style="light">Light</x-ui.badge>
                            <x-ui.badge variant="info" style="ghost">Ghost</x-ui.badge>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
        <x-ui.badge variant="success" :dot="true">Online</x-ui.badge>
        <x-ui.badge variant="primary" icon="star">Destaque</x-ui.badge>
        <x-ui.badge variant="destructive" :removable="true">Remover</x-ui.badge>
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Badge — Dot, ícone e removível" description="Props <code>dot</code>, <code>icon</code> e <code>removable</code> para indicadores extras." :code="$code">
                        <div class="flex flex-wrap gap-2">
                            <x-ui.badge variant="success" :dot="true">Online</x-ui.badge>
                            <x-ui.badge variant="primary" icon="star">Destaque</x-ui.badge>
                            <x-ui.badge variant="destructive" :removable="true">Remover</x-ui.badge>
                        </div>
                    </x-ui-doc-section>

                </div>


                {{-- ══════════ ALERT ══════════ --}}
                <div x-show="activeSection === 'alert'" class="flex flex-col gap-6">

                    @php
                        $code = <<<'BLADE'
        <x-ui.alert variant="success" title="Salvo!" description="Os dados foram salvos com sucesso." />
        <x-ui.alert variant="destructive" title="Erro" description="Não foi possível processar a solicitação." />
        <x-ui.alert variant="warning" title="Atenção" description="Revise antes de continuar." />
        <x-ui.alert variant="info" title="Dica" description="Você pode editar isso a qualquer momento." />
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Alert — Variantes" description="Ícone padrão resolvido automaticamente pelo <code>variant</code>." :code="$code">
                        <div class="flex flex-col gap-3">
                            <x-ui.alert variant="success" title="Salvo!" description="Os dados foram salvos com sucesso." />
                            <x-ui.alert variant="destructive" title="Erro" description="Não foi possível processar a solicitação." />
                            <x-ui.alert variant="warning" title="Atenção" description="Revise as informações antes de continuar." />
                            <x-ui.alert variant="info" title="Dica" description="Você pode editar isso a qualquer momento." />
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
        <x-ui.alert variant="primary" style="outline" title="Outline" description="Estilo contornado." />
        <x-ui.alert variant="primary" style="light" title="Light" description="Estilo claro com fundo suave." />
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Alert — Estilos" description="Prop <code>style</code>: <code>outline</code>, <code>light</code>." :code="$code">
                        <div class="flex flex-col gap-3">
                            <x-ui.alert variant="primary" style="outline" title="Outline" description="Estilo contornado." />
                            <x-ui.alert variant="primary" style="light" title="Light" description="Estilo claro com fundo suave." />
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
        <x-ui.alert
            variant="primary"
            title="Nova atualização disponível"
            description="Uma nova versão foi lançada com melhorias de segurança."
            actionLabel="Ver detalhes"
            actionHref="#"
            :dismissible="true"
        />
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Alert — Com ação e dismissível" description="Props <code>actionLabel</code>, <code>actionHref</code> e <code>dismissible</code>." :code="$code">
                        <x-ui.alert
                            variant="primary"
                            title="Nova atualização disponível"
                            description="Uma nova versão foi lançada com melhorias de segurança e performance."
                            actionLabel="Ver detalhes"
                            actionHref="#"
                            :dismissible="true"
                        />
                    </x-ui-doc-section>

                </div>


                {{-- ══════════ INPUT ══════════ --}}
                <div x-show="activeSection === 'input'" class="flex flex-col gap-6">

                    @php
                        $code = <<<'BLADE'
        <x-ui.input placeholder="Tamanho sm" size="sm" />
        <x-ui.input placeholder="Tamanho padrão" />
        <x-ui.input placeholder="Tamanho lg" size="lg" />
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Input — Tamanhos" description="Prop <code>size</code>: <code>sm</code>, padrão, <code>lg</code>." :code="$code">
                        <div class="flex flex-col gap-3 max-w-xs">
                            <x-ui.input placeholder="Tamanho sm" size="sm" />
                            <x-ui.input placeholder="Tamanho padrão" />
                            <x-ui.input placeholder="Tamanho lg" size="lg" />
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
        <x-ui.input icon="search" placeholder="Buscar..." />
        <x-ui.input icon="mail" iconEnd="eye" placeholder="email@exemplo.com" type="email" />
        <x-ui.input placeholder="Com erro de validação" :invalid="true" />
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Input — Com ícone e estado de erro" description="Props <code>icon</code>, <code>iconEnd</code> e <code>:invalid</code>." :code="$code">
                        <div class="flex flex-col gap-3 max-w-xs">
                            <x-ui.input icon="search" placeholder="Buscar..." />
                            <x-ui.input icon="mail" iconEnd="eye" placeholder="email@exemplo.com" type="email" />
                            <x-ui.input placeholder="Com erro de validação" :invalid="true" />
                        </div>
                    </x-ui-doc-section>

                </div>


                {{-- ══════════ INPUT GROUP ══════════ --}}
                <div x-show="activeSection === 'input-group'" class="flex flex-col gap-6">

                    @php
                        $code = <<<'BLADE'
        <x-ui.input-group addon="https://">
            <x-ui.input placeholder="seusite.com" />
        </x-ui.input-group>

        <x-ui.input-group addonEnd=".com.br">
            <x-ui.input placeholder="domínio" />
        </x-ui.input-group>
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Input Group — Addon de texto" description="Props <code>addon</code> e <code>addonEnd</code> adicionam texto antes/após o input." :code="$code">
                        <div class="flex flex-col gap-3 max-w-xs">
                            <x-ui.input-group addon="https://">
                                <x-ui.input placeholder="seusite.com" />
                            </x-ui.input-group>
                            <x-ui.input-group addonEnd=".com.br">
                                <x-ui.input placeholder="domínio" />
                            </x-ui.input-group>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
        <x-ui.input-group addonIcon="search">
            <x-ui.input placeholder="Buscar usuário..." />
        </x-ui.input-group>

        <x-ui.input-group addonIcon="dollar-sign" addonEnd="BRL">
            <x-ui.input placeholder="0,00" type="number" />
        </x-ui.input-group>
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Input Group — Addon com ícone" description="Props <code>addonIcon</code> e <code>addonIconEnd</code> para ícones Lucide." :code="$code">
                        <div class="flex flex-col gap-3 max-w-xs">
                            <x-ui.input-group addonIcon="search">
                                <x-ui.input placeholder="Buscar usuário..." />
                            </x-ui.input-group>
                            <x-ui.input-group addonIcon="dollar-sign" addonEnd="BRL">
                                <x-ui.input placeholder="0,00" type="number" />
                            </x-ui.input-group>
                        </div>
                    </x-ui-doc-section>

                </div>


                {{-- ══════════ SELECT ══════════ --}}
                <div x-show="activeSection === 'select'" class="flex flex-col gap-6">

                    @php
                        $code = <<<'BLADE'
        <x-ui.select placeholder="Escolha uma opção">
            <option value="1">Opção 1</option>
            <option value="2">Opção 2</option>
            <option value="3">Opção 3</option>
        </x-ui.select>
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Select — Básico" description="Select nativo potencializado pelo KT Select. Prop <code>placeholder</code> para texto inicial." :code="$code">
                        <div class="max-w-xs">
                            <x-ui.select placeholder="Escolha uma opção">
                                <option value="1">Opção 1</option>
                                <option value="2">Opção 2</option>
                                <option value="3">Opção 3</option>
                            </x-ui.select>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
        <x-ui.select placeholder="Selecione o país" :search="true" searchPlaceholder="Buscar país...">
            <option value="br">Brasil</option>
            <option value="ar">Argentina</option>
            <option value="cl">Chile</option>
            <option value="co">Colômbia</option>
            <option value="pe">Peru</option>
        </x-ui.select>
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Select — Com busca" description="Prop <code>:search=&quot;true&quot;</code> adiciona campo de busca no dropdown." :code="$code">
                        <div class="max-w-xs">
                            <x-ui.select placeholder="Selecione o país" :search="true" searchPlaceholder="Buscar país...">
                                <option value="br">Brasil</option>
                                <option value="ar">Argentina</option>
                                <option value="cl">Chile</option>
                                <option value="co">Colômbia</option>
                                <option value="pe">Peru</option>
                            </x-ui.select>
                        </div>
                    </x-ui-doc-section>

                </div>


                {{-- ══════════ LINK ══════════ --}}
                <div x-show="activeSection === 'link'" class="flex flex-col gap-6">

                    @php
                        $code = <<<'BLADE'
        <x-ui.link href="#">Default</x-ui.link>
        <x-ui.link href="#" :underline="true">Com underline no hover</x-ui.link>
        <x-ui.link href="#" :underlined="true">Sempre sublinhado</x-ui.link>
        <x-ui.link href="#" :underlined="true" :dashed="true">Sublinhado tracejado</x-ui.link>
        <x-ui.link href="#" :mono="true">Cor mono</x-ui.link>
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Link — Variações" description="Props <code>underline</code>, <code>underlined</code>, <code>dashed</code>, <code>mono</code>." :code="$code">
                        <div class="flex flex-wrap gap-4">
                            <x-ui.link href="#">Default</x-ui.link>
                            <x-ui.link href="#" :underline="true">Com underline no hover</x-ui.link>
                            <x-ui.link href="#" :underlined="true">Sempre sublinhado</x-ui.link>
                            <x-ui.link href="#" :underlined="true" :dashed="true">Sublinhado tracejado</x-ui.link>
                            <x-ui.link href="#" :mono="true">Cor mono</x-ui.link>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
        <x-ui.link href="#" icon="external-link" size="sm">Abrir (sm)</x-ui.link>
        <x-ui.link href="#" iconEnd="arrow-right">Ver mais</x-ui.link>
        <x-ui.link href="#" icon="download" size="lg">Download (lg)</x-ui.link>
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Link — Com ícone e tamanhos" description="Props <code>icon</code>, <code>iconEnd</code> e <code>size</code>: <code>sm</code>, padrão, <code>lg</code>." :code="$code">
                        <div class="flex flex-wrap items-center gap-4">
                            <x-ui.link href="#" icon="external-link" size="sm">Abrir (sm)</x-ui.link>
                            <x-ui.link href="#" iconEnd="arrow-right">Ver mais</x-ui.link>
                            <x-ui.link href="#" icon="download" size="lg">Download (lg)</x-ui.link>
                        </div>
                    </x-ui-doc-section>

                </div>


                {{-- ══════════ ICON BOX ══════════ --}}
                <div x-show="activeSection === 'icon-box'" class="flex flex-col gap-6">

                    @php
                        $code = <<<'BLADE'
        <x-ui.icon-box icon="settings" size="sm" />
        <x-ui.icon-box icon="settings" size="md" />
        <x-ui.icon-box icon="settings" size="lg" />
        <x-ui.icon-box icon="settings" size="xl" />
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Icon Box — Tamanhos" description="Prop <code>size</code>: <code>sm</code>, <code>md</code>, <code>lg</code>, <code>xl</code>." :code="$code">
                        <div class="flex flex-wrap items-center gap-4">
                            <x-ui.icon-box icon="settings" size="sm" />
                            <x-ui.icon-box icon="settings" size="md" />
                            <x-ui.icon-box icon="settings" size="lg" />
                            <x-ui.icon-box icon="settings" size="xl" />
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
        <x-ui.icon-box icon="check" bg="bg-success/10" color="text-success" />
        <x-ui.icon-box icon="triangle-alert" bg="bg-warning/10" color="text-warning" />
        <x-ui.icon-box icon="x" bg="bg-destructive/10" color="text-destructive" />
        <x-ui.icon-box icon="info" bg="bg-info/10" color="text-info" radius="full" />
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Icon Box — Cores e raio" description="Props <code>bg</code>, <code>color</code> e <code>radius</code>: <code>sm</code>, <code>md</code>, <code>lg</code>, <code>full</code>." :code="$code">
                        <div class="flex flex-wrap items-center gap-4">
                            <x-ui.icon-box icon="check" bg="bg-success/10" color="text-success" />
                            <x-ui.icon-box icon="triangle-alert" bg="bg-warning/10" color="text-warning" />
                            <x-ui.icon-box icon="x" bg="bg-destructive/10" color="text-destructive" />
                            <x-ui.icon-box icon="info" bg="bg-info/10" color="text-info" radius="full" />
                        </div>
                    </x-ui-doc-section>

                </div>


                {{-- ══════════ BREADCRUMB ══════════ --}}
                <div x-show="activeSection === 'breadcrumb'" class="flex flex-col gap-6">

                    @php
                        $code = <<<'BLADE'
        <x-ui.breadcrumb>
            <x-ui.breadcrumb-item href="#" :first="true">Home</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item href="#">Configurações</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item :active="true">Perfil</x-ui.breadcrumb-item>
        </x-ui.breadcrumb>
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Breadcrumb — Padrão" description="Container <code>x-ui.breadcrumb</code> com items filhos <code>x-ui.breadcrumb-item</code>." :code="$code">
                        <x-ui.breadcrumb>
                            <x-ui.breadcrumb-item href="#" :first="true">Home</x-ui.breadcrumb-item>
                            <x-ui.breadcrumb-item href="#">Configurações</x-ui.breadcrumb-item>
                            <x-ui.breadcrumb-item :active="true">Perfil</x-ui.breadcrumb-item>
                        </x-ui.breadcrumb>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
        <x-ui.breadcrumb>
            <x-ui.breadcrumb-item href="#" :first="true" separator="dot">Home</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item href="#" separator="dot">Usuários</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item :active="true" separator="dot">João Silva</x-ui.breadcrumb-item>
        </x-ui.breadcrumb>
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Breadcrumb — Separador dot" description="Prop <code>separator=&quot;dot&quot;</code> usa bolinha como separador." :code="$code">
                        <x-ui.breadcrumb>
                            <x-ui.breadcrumb-item href="#" :first="true" separator="dot">Home</x-ui.breadcrumb-item>
                            <x-ui.breadcrumb-item href="#" separator="dot">Usuários</x-ui.breadcrumb-item>
                            <x-ui.breadcrumb-item :active="true" separator="dot">João Silva</x-ui.breadcrumb-item>
                        </x-ui.breadcrumb>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
        <x-ui.breadcrumb>
            <x-ui.breadcrumb-item href="#" icon="house" :first="true"></x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item href="#">Relatórios</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item :active="true">Mensal</x-ui.breadcrumb-item>
        </x-ui.breadcrumb>
        BLADE;
                    @endphp
                    <x-ui-doc-section title="Breadcrumb — Com ícone" description="Prop <code>icon</code> substitui o texto por um ícone Lucide no item." :code="$code">
                        <x-ui.breadcrumb>
                            <x-ui.breadcrumb-item href="#" icon="house" :first="true"></x-ui.breadcrumb-item>
                            <x-ui.breadcrumb-item href="#">Relatórios</x-ui.breadcrumb-item>
                            <x-ui.breadcrumb-item :active="true">Mensal</x-ui.breadcrumb-item>
                        </x-ui.breadcrumb>
                    </x-ui-doc-section>

                </div>

            </main>
        </div>
    </div>

</div>
