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
                    <button @click="activeSection = 'accordion'" :class="activeSection === 'accordion' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Accordion</button>
                    <button @click="activeSection = 'alert'" :class="activeSection === 'alert' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Alert</button>
                    <button @click="activeSection = 'badge'" :class="activeSection === 'badge' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Badge</button>
                    <button @click="activeSection = 'breadcrumb'" :class="activeSection === 'breadcrumb' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Breadcrumb</button>
                    <button @click="activeSection = 'button'" :class="activeSection === 'button' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Button</button>
                    <button @click="activeSection = 'icon-box'" :class="activeSection === 'icon-box' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Icon Box</button>
                    <button @click="activeSection = 'input'" :class="activeSection === 'input' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Input</button>
                    <button @click="activeSection = 'input-group'" :class="activeSection === 'input-group' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Input Group</button>
                    <button @click="activeSection = 'link'" :class="activeSection === 'link' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Link</button>
                    <button @click="activeSection = 'modal'" :class="activeSection === 'modal' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Modal</button>
                    <button @click="activeSection = 'select'" :class="activeSection === 'select' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Select</button>
                    <button @click="activeSection = 'toast'" :class="activeSection === 'toast' ? 'bg-primary/10 text-primary font-semibold' : 'text-secondary-foreground hover:text-mono hover:bg-muted'" class="text-left text-sm px-3 py-2 rounded-lg transition-colors">Toast</button>
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
                    <x-ui-doc-section title="Button - Variantes" description="Prop <code>variant</code> define a cor semântica do botão." :code="$code">
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
                    <x-ui-doc-section title="Button - Tamanhos" description="Prop <code>size</code>: <code>xs</code>, <code>sm</code>, padrão, <code>lg</code>." :code="$code">
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
                    <x-ui-doc-section title="Button - Com ícone" description="Props <code>icon</code> e <code>iconEnd</code> aceitam qualquer nome Lucide." :code="$code">
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
                    <x-ui-doc-section title="Button - Ghost & Disabled" description="Botões sem fundo via prop <code>ghost</code> e estado desabilitado." :code="$code">
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
                    <x-ui-doc-section title="Badge - Variantes" description="Prop <code>variant</code> define a cor semântica." :code="$code">
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
                    <x-ui-doc-section title="Badge - Estilos" description="Prop <code>style</code>: <code>outline</code>, <code>light</code>, <code>ghost</code>." :code="$code">
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
                    <x-ui-doc-section title="Badge - Dot, ícone e removível" description="Props <code>dot</code>, <code>icon</code> e <code>removable</code> para indicadores extras." :code="$code">
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
                    <x-ui-doc-section title="Alert - Variantes" description="Ícone padrão resolvido automaticamente pelo <code>variant</code>." :code="$code">
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
                    <x-ui-doc-section title="Alert - Estilos" description="Prop <code>style</code>: <code>outline</code>, <code>light</code>." :code="$code">
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
                    <x-ui-doc-section title="Alert - Com ação e dismissível" description="Props <code>actionLabel</code>, <code>actionHref</code> e <code>dismissible</code>." :code="$code">
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
                    <x-ui-doc-section title="Input - Tamanhos" description="Prop <code>size</code>: <code>sm</code>, padrão, <code>lg</code>." :code="$code">
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
                    <x-ui-doc-section title="Input - Com ícone e estado de erro" description="Props <code>icon</code>, <code>iconEnd</code> e <code>:invalid</code>." :code="$code">
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
                    <x-ui-doc-section title="Input Group - Addon de texto" description="Props <code>addon</code> e <code>addonEnd</code> adicionam texto antes/após o input." :code="$code">
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
                    <x-ui-doc-section title="Input Group - Addon com ícone" description="Props <code>addonIcon</code> e <code>addonIconEnd</code> para ícones Lucide." :code="$code">
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
                    <x-ui-doc-section title="Select - Básico" description="Select nativo potencializado pelo KT Select. Prop <code>placeholder</code> para texto inicial." :code="$code">
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
                    <x-ui-doc-section title="Select - Com busca" description="Prop <code>:search=&quot;true&quot;</code> adiciona campo de busca no dropdown." :code="$code">
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
                    <x-ui-doc-section title="Link - Variações" description="Props <code>underline</code>, <code>underlined</code>, <code>dashed</code>, <code>mono</code>." :code="$code">
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
                    <x-ui-doc-section title="Link - Com ícone e tamanhos" description="Props <code>icon</code>, <code>iconEnd</code> e <code>size</code>: <code>sm</code>, padrão, <code>lg</code>." :code="$code">
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
                    <x-ui-doc-section title="Icon Box - Tamanhos" description="Prop <code>size</code>: <code>sm</code>, <code>md</code>, <code>lg</code>, <code>xl</code>." :code="$code">
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
                    <x-ui-doc-section title="Icon Box - Cores e raio" description="Props <code>bg</code>, <code>color</code> e <code>radius</code>: <code>sm</code>, <code>md</code>, <code>lg</code>, <code>full</code>." :code="$code">
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
                    <x-ui-doc-section title="Breadcrumb - Padrão" description="Container <code>x-ui.breadcrumb</code> com items filhos <code>x-ui.breadcrumb-item</code>." :code="$code">
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
                    <x-ui-doc-section title="Breadcrumb - Separador dot" description="Prop <code>separator=&quot;dot&quot;</code> usa bolinha como separador." :code="$code">
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
                    <x-ui-doc-section title="Breadcrumb - Com ícone" description="Prop <code>icon</code> substitui o texto por um ícone Lucide no item." :code="$code">
                        <x-ui.breadcrumb>
                            <x-ui.breadcrumb-item href="#" icon="house" :first="true"></x-ui.breadcrumb-item>
                            <x-ui.breadcrumb-item href="#">Relatórios</x-ui.breadcrumb-item>
                            <x-ui.breadcrumb-item :active="true">Mensal</x-ui.breadcrumb-item>
                        </x-ui.breadcrumb>
                    </x-ui-doc-section>

                </div>

                {{-- ══════════ TOAST ══════════ --}}
                <div x-show="activeSection === 'toast'" class="flex flex-col gap-6">

                    @php
                        $code = <<<'BLADE'
    <button
        class="kt-btn kt-btn-outline"
        onclick="KTToast.show({ message: 'Operação realizada com sucesso!' })"
    >
        Show Toast
    </button>
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Toast - Uso básico" description="O Toast é acionado via JavaScript com <code>KTToast.show(options)</code>." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Operação realizada com sucesso!' })">Show Toast</x-ui.button>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    KTToast.show({ message: 'Salvo com sucesso!', variant: 'success' });
    KTToast.show({ message: 'Atenção: revise antes de continuar.', variant: 'warning' });
    KTToast.show({ message: 'Erro ao processar solicitação.', variant: 'destructive' });
    KTToast.show({ message: 'Nova atualização disponível.', variant: 'primary' });
    KTToast.show({ message: 'Informação importante.', variant: 'info' });
    KTToast.show({ message: 'Notificação padrão.', variant: 'mono' });
    KTToast.show({ message: 'Mensagem secundária.', variant: 'secondary' });
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Toast - Variantes" description="Prop <code>variant</code> define a cor semântica do toast." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" class="text-success" onclick="KTToast.show({ message: 'Salvo com sucesso!', variant: 'success' })">Success</x-ui.button>
                            <x-ui.button variant="outline" class="text-warning" onclick="KTToast.show({ message: 'Atenção: revise antes de continuar.', variant: 'warning' })">Warning</x-ui.button>
                            <x-ui.button variant="outline" class="text-destructive" onclick="KTToast.show({ message: 'Erro ao processar solicitação.', variant: 'destructive' })">Destructive</x-ui.button>
                            <x-ui.button variant="outline" class="text-primary" onclick="KTToast.show({ message: 'Nova atualização disponível.', variant: 'primary' })">Primary</x-ui.button>
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Informação importante.', variant: 'info' })">Info</x-ui.button>
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Notificação padrão.', variant: 'mono' })">Mono</x-ui.button>
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Mensagem secundária.', variant: 'secondary' })">Secondary</x-ui.button>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    KTToast.show({ message: 'Toast sólido (padrão).', variant: 'primary' });
    KTToast.show({ message: 'Toast com contorno.', variant: 'primary', appearance: 'outline' });
    KTToast.show({ message: 'Toast com fundo suave.', variant: 'primary', appearance: 'light' });
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Toast - Appearance" description="Prop <code>appearance</code>: <code>solid</code> (padrão), <code>outline</code>, <code>light</code>." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Toast sólido (padrão).', variant: 'primary' })">Solid</x-ui.button>
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Toast com contorno.', variant: 'primary', appearance: 'outline' })">Outline</x-ui.button>
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Toast com fundo suave.', variant: 'primary', appearance: 'light' })">Light</x-ui.button>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    KTToast.show({ message: 'Top End', position: 'top-end' });
    KTToast.show({ message: 'Top Center', position: 'top-center' });
    KTToast.show({ message: 'Top Start', position: 'top-start' });
    KTToast.show({ message: 'Bottom End', position: 'bottom-end' });
    KTToast.show({ message: 'Bottom Center', position: 'bottom-center' });
    KTToast.show({ message: 'Bottom Start', position: 'bottom-start' });
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Toast - Posição" description="Prop <code>position</code> define onde o toast aparece na tela." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Top End', position: 'top-end' })">Top End</x-ui.button>
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Top Center', position: 'top-center' })">Top Center</x-ui.button>
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Top Start', position: 'top-start' })">Top Start</x-ui.button>
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Bottom End', position: 'bottom-end' })">Bottom End</x-ui.button>
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Bottom Center', position: 'bottom-center' })">Bottom Center</x-ui.button>
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Bottom Start', position: 'bottom-start' })">Bottom Start</x-ui.button>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    KTToast.show({ message: 'Toast pequeno.', size: 'sm' });
    KTToast.show({ message: 'Toast médio (padrão).' });
    KTToast.show({ message: 'Toast grande.', size: 'lg' });
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Toast - Tamanho" description="Prop <code>size</code>: <code>sm</code>, padrão, <code>lg</code>." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Toast pequeno.', size: 'sm' })">Small</x-ui.button>
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Toast médio (padrão).' })">Medium</x-ui.button>
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Toast grande.', size: 'lg' })">Large</x-ui.button>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    KTToast.show({
        title: 'Salvo com sucesso',
        message: 'Suas alterações foram salvas.',
        variant: 'success',
    });
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Toast - Com título" description="Prop <code>title</code> adiciona um título acima da mensagem." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" onclick="KTToast.show({ title: 'Salvo com sucesso', message: 'Suas alterações foram salvas.', variant: 'success' })">Com título (success)</x-ui.button>
                            <x-ui.button variant="outline" onclick="KTToast.show({ title: 'Erro ao salvar', message: 'Não foi possível salvar. Tente novamente.', variant: 'destructive' })">Com título (erro)</x-ui.button>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    KTToast.show({ message: 'Toast com ícone customizado.', icon: 'rocket' });
    KTToast.show({ message: 'Toast sem ícone.', icon: false });
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Toast - Ícone" description="Prop <code>icon</code> aceita nome Lucide. Use <code>false</code> para ocultar." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Toast com ícone customizado.', icon: 'rocket' })">Ícone customizado</x-ui.button>
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Toast sem ícone.', icon: false })">Sem ícone</x-ui.button>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    KTToast.show({
        message: 'Este toast fecha automaticamente.',
        variant: 'primary',
        duration: 5000,
        progress: true,
    });
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Toast - Progresso" description="Prop <code>progress: true</code> exibe barra de progresso do tempo restante." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Este toast fecha automaticamente.', variant: 'primary', duration: 5000, progress: true })">Com progresso</x-ui.button>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    KTToast.show({
        message: 'Registro excluído.',
        variant: 'destructive',
        action: {
            label: 'Desfazer',
            onClick: (id) => console.log('Undo', id),
        },
        cancel: {
            label: 'Ignorar',
            onClick: (id) => KTToast.hide(id),
        },
    });
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Toast - Ação & Cancelar" description="Props <code>action</code> e <code>cancel</code> adicionam botões de ação ao toast." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Registro excluído.', variant: 'destructive', action: { label: 'Desfazer', onClick: function(id){ console.log('Undo', id) } }, cancel: { label: 'Ignorar', onClick: function(id){ KTToast.hide(id) } } })">Ação & Cancelar</x-ui.button>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    KTToast.show({ message: 'Este toast dura 10 segundos.', duration: 10000 });
    KTToast.show({ message: 'Este toast não fecha sozinho.', duration: 0 });
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Toast - Duração" description="Prop <code>duration</code> em ms. Use <code>0</code> para toast permanente." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Este toast dura 10 segundos.', duration: 10000 })">10 segundos</x-ui.button>
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Este toast não fecha sozinho.', duration: 0, dismissible: true })">Permanente</x-ui.button>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    KTToast.show({
        message: 'Toast importante - não é removido ao navegar.',
        variant: 'warning',
        important: true,
    });
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Toast - Importante" description="Prop <code>important: true</code> persiste o toast mesmo durante navegação." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Toast importante - não é removido ao navegar.', variant: 'warning', important: true })">Importante</x-ui.button>
                            <x-ui.button variant="destructive" onclick="KTToast.clearAll()">Limpar todos</x-ui.button>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    KTToast.show({ message: 'Passe o mouse para pausar.', pauseOnHover: true, duration: 6000, progress: true });
    KTToast.show({ message: 'Hover não pausa este toast.', pauseOnHover: false, duration: 6000, progress: true });
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Toast - Pause on Hover" description="Prop <code>pauseOnHover</code> pausa o temporizador quando o mouse está sobre o toast." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Passe o mouse para pausar.', pauseOnHover: true, duration: 6000, progress: true })">Pausa no hover</x-ui.button>
                            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Hover não pausa este toast.', pauseOnHover: false, duration: 6000, progress: true })">Sem pausa</x-ui.button>
                        </div>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    {{-- Toast estático renderizado diretamente no HTML --}}
    <x-ui.toast
        variant="success"
        message="Operação realizada com sucesso!"
        position="top-end"
        :progress="true"
        :duration="5000"
    />

    {{-- Com título e botões de ação --}}
    <x-ui.toast
        variant="warning"
        title="Atenção"
        message="Revise os dados antes de continuar."
        :action="['label' => 'Revisar', 'href' => '/revisao']"
        :cancel="['label' => 'Ignorar', 'href' => '#']"
    />
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Toast - Componente Blade estático" description="O componente <code>&lt;x-ui.toast&gt;</code> gera a estrutura HTML sem JS. Use a API <code>KTToast.show()</code> para comportamento dinâmico." :code="$code">
                        <div class="text-sm text-secondary-foreground bg-muted/40 rounded-lg p-4 border border-input">
                            <p class="font-medium text-mono mb-1">Nota sobre uso estático</p>
                            <p>O componente Blade é ideal para toasts gerados server-side (ex: flash messages do Laravel). Para toasts disparados por interação do usuário, use <code class="text-xs bg-muted px-1 py-0.5 rounded">KTToast.show()</code>.</p>
                        </div>
                    </x-ui-doc-section>

                </div>


                {{-- ══════════ MODAL ══════════ --}}
                <div x-show="activeSection === 'modal'" class="flex flex-col gap-6">

                    {{-- Básico --}}
                    @php
                        $code = <<<'BLADE'
    <button class="kt-btn kt-btn-outline" data-kt-modal-toggle="#modal_basic">
        Abrir Modal
    </button>

    <x-ui.modal id="modal_basic" title="Título do Modal" top="10%">
        <div class="rounded-lg bg-muted w-full h-48"></div>
    </x-ui.modal>
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Modal - Uso básico" description="Conecte o botão via <code>data-kt-modal-toggle</code> e o componente via <code>id</code>." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" data-kt-modal-toggle="#modal_basic">Abrir Modal</x-ui.button>
                        </div>

                        <x-ui.modal id="modal_basic" title="Título do Modal" top="10%">
                            <div class="rounded-lg bg-muted w-full h-48"></div>
                        </x-ui.modal>
                    </x-ui-doc-section>

                    {{-- Com footer --}}
                    @php
                        $code = <<<'BLADE'
    <x-ui.modal id="modal_footer" title="Confirmar ação" top="5%">
        <p class="text-sm text-secondary-foreground">
            Tem certeza que deseja continuar? Esta ação não pode ser desfeita.
        </p>

        <x-slot:footer>
            <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_footer">Cancelar</x-ui.button>
            <x-ui.button variant="primary">Confirmar</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Modal - Com footer" description="Use o slot <code>footer</code> para adicionar botões de ação." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" data-kt-modal-toggle="#modal_footer">Com footer</x-ui.button>
                        </div>

                        <x-ui.modal id="modal_footer" title="Confirmar ação" top="5%">
                            <p class="text-sm text-secondary-foreground">
                                Tem certeza que deseja continuar? Esta ação não pode ser desfeita.
                            </p>
                            <x-slot:footer>
                                <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_footer">Cancelar</x-ui.button>
                                <x-ui.button variant="primary">Confirmar</x-ui.button>
                            </x-slot:footer>
                        </x-ui.modal>
                    </x-ui-doc-section>

                    {{-- Centralizado --}}
                    @php
                        $code = <<<'BLADE'
    <x-ui.modal id="modal_center" title="Modal centralizado" :center="true">
        <p class="text-sm text-secondary-foreground">
            Este modal aparece centralizado vertical e horizontalmente na tela.
        </p>
        <x-slot:footer>
            <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_center">Fechar</x-ui.button>
            <x-ui.button variant="primary">Salvar</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Modal - Centralizado" description="Prop <code>center</code> posiciona o modal centralizado vertical e horizontalmente." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" data-kt-modal-toggle="#modal_center">Centralizado</x-ui.button>
                        </div>

                        <x-ui.modal id="modal_center" title="Modal centralizado" :center="true">
                            <p class="text-sm text-secondary-foreground">
                                Este modal aparece centralizado vertical e horizontalmente na tela.
                            </p>
                            <x-slot:footer>
                                <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_center">Fechar</x-ui.button>
                                <x-ui.button variant="primary">Salvar</x-ui.button>
                            </x-slot:footer>
                        </x-ui.modal>
                    </x-ui-doc-section>

                    {{-- Tamanhos --}}
                    @php
                        $code = <<<'BLADE'
    <x-ui.modal id="modal_sm"   title="Modal Pequeno"  size="sm"   top="10%" />
    <x-ui.modal id="modal_md"   title="Modal Padrão"               top="10%" />
    <x-ui.modal id="modal_lg"   title="Modal Grande"   size="lg"   top="10%" />
    <x-ui.modal id="modal_xl"   title="Modal Extra"    size="xl"   top="10%" />
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Modal - Tamanhos" description="Prop <code>size</code>: <code>sm</code>, padrão (400px), <code>lg</code>, <code>xl</code>." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" data-kt-modal-toggle="#modal_sm">Small</x-ui.button>
                            <x-ui.button variant="outline" data-kt-modal-toggle="#modal_md">Medium</x-ui.button>
                            <x-ui.button variant="outline" data-kt-modal-toggle="#modal_lg">Large</x-ui.button>
                            <x-ui.button variant="outline" data-kt-modal-toggle="#modal_xl">Extra Large</x-ui.button>
                        </div>

                        <x-ui.modal id="modal_sm" title="Modal Pequeno" size="sm" top="10%">
                            <div class="rounded-lg bg-muted w-full h-36"></div>
                        </x-ui.modal>
                        <x-ui.modal id="modal_md" title="Modal Padrão" top="10%">
                            <div class="rounded-lg bg-muted w-full h-36"></div>
                        </x-ui.modal>
                        <x-ui.modal id="modal_lg" title="Modal Grande" size="lg" top="10%">
                            <div class="rounded-lg bg-muted w-full h-36"></div>
                        </x-ui.modal>
                        <x-ui.modal id="modal_xl" title="Modal Extra Large" size="xl" top="10%">
                            <div class="rounded-lg bg-muted w-full h-36"></div>
                        </x-ui.modal>
                    </x-ui-doc-section>

                    {{-- Scrollable --}}
                    @php
                        $code = <<<'BLADE'
    <x-ui.modal id="modal_scroll" title="Conteúdo longo" :scrollable="true" maxBodyHeight="260px" top="10%">
        <div class="rounded-lg bg-muted w-full h-[600px]"></div>
        <x-slot:footer>
            <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_scroll">Cancelar</x-ui.button>
            <x-ui.button variant="primary">Salvar</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Modal - Scrollable" description="Prop <code>scrollable</code> ativa scroll interno no body. Use <code>maxBodyHeight</code> para controlar a altura." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" data-kt-modal-toggle="#modal_scroll">Scrollable</x-ui.button>
                        </div>

                        <x-ui.modal id="modal_scroll" title="Conteúdo longo" :scrollable="true" maxBodyHeight="260px" top="10%">
                            <div class="rounded-lg bg-muted w-full h-[600px]"></div>
                            <x-slot:footer>
                                <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_scroll">Cancelar</x-ui.button>
                                <x-ui.button variant="primary">Salvar</x-ui.button>
                            </x-slot:footer>
                        </x-ui.modal>
                    </x-ui-doc-section>

                    {{-- Backdrop estático / sem backdrop --}}
                    @php
                        $code = <<<'BLADE'
    {{-- Backdrop estático: clicar fora não fecha --}}
    <x-ui.modal id="modal_static" title="Backdrop estático" :backdropStatic="true" top="10%">
        <p class="text-sm text-secondary-foreground">Clicar fora deste modal não o fecha.</p>
        <x-slot:footer>
            <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_static">Fechar</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>

    {{-- Sem backdrop --}}
    <x-ui.modal id="modal_no_backdrop" title="Sem backdrop" :backdrop="false" :center="true">
        <p class="text-sm text-secondary-foreground">Modal sem camada de fundo escura.</p>
        <x-slot:footer>
            <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_no_backdrop">Fechar</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Modal - Backdrop" description="<code>backdropStatic</code> impede fechar ao clicar fora. <code>:backdrop=&quot;false&quot;</code> remove o fundo escuro." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" data-kt-modal-toggle="#modal_static">Backdrop estático</x-ui.button>
                            <x-ui.button variant="outline" data-kt-modal-toggle="#modal_no_backdrop">Sem backdrop</x-ui.button>
                        </div>

                        <x-ui.modal id="modal_static" title="Backdrop estático" :backdropStatic="true" top="10%">
                            <p class="text-sm text-secondary-foreground">Clicar fora deste modal não o fecha. Use o botão para fechar.</p>
                            <x-slot:footer>
                                <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_static">Fechar</x-ui.button>
                            </x-slot:footer>
                        </x-ui.modal>

                        <x-ui.modal id="modal_no_backdrop" title="Sem backdrop" :backdrop="false" :center="true">
                            <p class="text-sm text-secondary-foreground">Modal exibido sem camada de fundo escura.</p>
                            <x-slot:footer>
                                <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_no_backdrop">Fechar</x-ui.button>
                            </x-slot:footer>
                        </x-ui.modal>
                    </x-ui-doc-section>

                    {{-- Header customizado --}}
                    @php
                        $code = <<<'BLADE'
    <x-ui.modal id="modal_custom_header" top="10%">
        <x-slot:header>
            <div class="flex items-center gap-3">
                <div class="flex items-center justify-center size-9 rounded-lg bg-destructive/10 text-destructive shrink-0">
                    @svg('lucide-trash-2', ['class' => 'size-4'])
                </div>
                <div>
                    <h3 class="kt-modal-title">Excluir registro</h3>
                    <p class="text-xs text-secondary-foreground">Esta ação é permanente</p>
                </div>
            </div>
        </x-slot:header>

        <p class="text-sm text-secondary-foreground">
            Tem certeza que deseja excluir este registro? Todos os dados relacionados serão removidos permanentemente.
        </p>

        <x-slot:footer>
            <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_custom_header">Cancelar</x-ui.button>
            <x-ui.button variant="destructive" icon="trash-2">Excluir</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Modal - Header customizado" description="Use o slot <code>header</code> para substituir completamente o cabeçalho padrão." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" data-kt-modal-toggle="#modal_custom_header">Header customizado</x-ui.button>
                        </div>

                        <x-ui.modal id="modal_custom_header" top="10%">
                            <x-slot:header>
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center size-9 rounded-lg bg-destructive/10 text-destructive shrink-0">
                                        @svg('lucide-trash-2', ['class' => 'size-4'])
                                    </div>
                                    <div>
                                        <h3 class="kt-modal-title">Excluir registro</h3>
                                        <p class="text-xs text-secondary-foreground">Esta ação é permanente</p>
                                    </div>
                                </div>
                                <button type="button" class="kt-modal-close" aria-label="Fechar" data-kt-modal-dismiss="#modal_custom_header">
                                    @svg('lucide-x')
                                </button>
                            </x-slot:header>
                            <p class="text-sm text-secondary-foreground">
                                Tem certeza que deseja excluir este registro? Todos os dados relacionados serão removidos permanentemente.
                            </p>
                            <x-slot:footer>
                                <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_custom_header">Cancelar</x-ui.button>
                                <x-ui.button variant="destructive" icon="trash-2">Excluir</x-ui.button>
                            </x-slot:footer>
                        </x-ui.modal>
                    </x-ui-doc-section>

                    {{-- Footer alinhamentos --}}
                    @php
                        $code = <<<'BLADE'
    {{-- Alinhado à direita (padrão) --}}
    <x-ui.modal id="modal_footer_end" title="Footer - End" footerAlign="end" top="10%">
        <x-slot:footer>
            <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_footer_end">Cancelar</x-ui.button>
            <x-ui.button variant="primary">Salvar</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>

    {{-- Espaço entre (between) --}}
    <x-ui.modal id="modal_footer_between" title="Footer - Between" footerAlign="between" top="10%">
        <x-slot:footer>
            <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_footer_between">Cancelar</x-ui.button>
            <x-ui.button variant="primary">Salvar</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Modal - Alinhamento do footer" description="Prop <code>footerAlign</code>: <code>end</code> (padrão), <code>start</code>, <code>between</code>." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="outline" data-kt-modal-toggle="#modal_footer_end">Footer End</x-ui.button>
                            <x-ui.button variant="outline" data-kt-modal-toggle="#modal_footer_between">Footer Between</x-ui.button>
                        </div>

                        <x-ui.modal id="modal_footer_end" title="Footer - End" footerAlign="end" top="10%">
                            <div class="rounded-lg bg-muted w-full h-32"></div>
                            <x-slot:footer>
                                <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_footer_end">Cancelar</x-ui.button>
                                <x-ui.button variant="primary">Salvar</x-ui.button>
                            </x-slot:footer>
                        </x-ui.modal>

                        <x-ui.modal id="modal_footer_between" title="Footer - Between" footerAlign="between" top="10%">
                            <div class="rounded-lg bg-muted w-full h-32"></div>
                            <x-slot:footer>
                                <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_footer_between">Cancelar</x-ui.button>
                                <x-ui.button variant="primary">Salvar</x-ui.button>
                            </x-slot:footer>
                        </x-ui.modal>
                    </x-ui-doc-section>

                    {{-- Com formulário --}}
                    @php
                        $code = <<<'BLADE'
    <x-ui.modal id="modal_form" title="Novo usuário" top="8%" size="lg">
        <div class="flex flex-col gap-4">
            <div class="grid grid-cols-2 gap-4">
                <x-ui.form-field label="Nome" required>
                    <x-ui.input placeholder="João" />
                </x-ui.form-field>
                <x-ui.form-field label="Sobrenome" required>
                    <x-ui.input placeholder="Silva" />
                </x-ui.form-field>
            </div>
            <x-ui.form-field label="E-mail" required>
                <x-ui.input type="email" placeholder="joao@exemplo.com" />
            </x-ui.form-field>
            <x-ui.form-field label="Função">
                <x-ui.select>
                    <option value="">Selecionar...</option>
                    <option>Administrador</option>
                    <option>Editor</option>
                    <option>Visualizador</option>
                </x-ui.select>
            </x-ui.form-field>
        </div>
        <x-slot:footer>
            <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_form">Cancelar</x-ui.button>
            <x-ui.button variant="primary" icon="user-plus">Criar usuário</x-ui.button>
        </x-slot:footer>
    </x-ui.modal>
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Modal - Com formulário" description="Exemplo prático com campos de formulário dentro do modal." :code="$code">
                        <div class="flex flex-wrap gap-3">
                            <x-ui.button variant="primary" icon="user-plus" data-kt-modal-toggle="#modal_form">Novo usuário</x-ui.button>
                        </div>

                        <x-ui.modal id="modal_form" title="Novo usuário" top="8%" size="lg">
                            <div class="flex flex-col gap-4">
                                <div class="grid grid-cols-2 gap-4">
                                    <x-ui.form-field label="Nome" :required="true">
                                        <x-ui.input placeholder="João" />
                                    </x-ui.form-field>
                                    <x-ui.form-field label="Sobrenome" :required="true">
                                        <x-ui.input placeholder="Silva" />
                                    </x-ui.form-field>
                                </div>
                                <x-ui.form-field label="E-mail" :required="true">
                                    <x-ui.input type="email" placeholder="joao@exemplo.com" />
                                </x-ui.form-field>
                                <x-ui.form-field label="Função">
                                    <x-ui.select>
                                        <option value="">Selecionar...</option>
                                        <option>Administrador</option>
                                        <option>Editor</option>
                                        <option>Visualizador</option>
                                    </x-ui.select>
                                </x-ui.form-field>
                            </div>
                            <x-slot:footer>
                                <x-ui.button variant="secondary" data-kt-modal-dismiss="#modal_form">Cancelar</x-ui.button>
                                <x-ui.button variant="primary" icon="user-plus">Criar usuário</x-ui.button>
                            </x-slot:footer>
                        </x-ui.modal>
                    </x-ui-doc-section>

                </div>

                {{-- ══════════ ACCORDION ══════════ --}}
                <div x-show="activeSection === 'accordion'" class="flex flex-col gap-6">

                    @php
                        $code = <<<'BLADE'
    <x-ui.accordion>
        <x-ui.accordion-item title="Como é determinado o preço de cada plano?">
            Os planos são calculados com base no número de usuários e recursos utilizados.
        </x-ui.accordion-item>
        <x-ui.accordion-item title="Existem taxas ocultas nos preços?">
            Não. Todos os valores são exibidos de forma transparente antes da contratação.
        </x-ui.accordion-item>
        <x-ui.accordion-item title="Posso cancelar a qualquer momento?">
            Sim. O cancelamento é imediato e sem burocracia.
        </x-ui.accordion-item>
    </x-ui.accordion>
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Accordion - Padrão" description="Estrutura básica: apenas um item aberto por vez." :code="$code">
                        <x-ui.accordion>
                            <x-ui.accordion-item title="Como é determinado o preço de cada plano?">
                                Os planos são calculados com base no número de usuários e recursos utilizados.
                            </x-ui.accordion-item>
                            <x-ui.accordion-item title="Existem taxas ocultas nos preços?">
                                Não. Todos os valores são exibidos de forma transparente antes da contratação.
                            </x-ui.accordion-item>
                            <x-ui.accordion-item title="Posso cancelar a qualquer momento?">
                                Sim. O cancelamento é imediato e sem burocracia.
                            </x-ui.accordion-item>
                        </x-ui.accordion>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    <x-ui.accordion>
        <x-ui.accordion-item title="Este item começa aberto" :open="true">
            Use a prop open para expandir automaticamente ao carregar a página.
        </x-ui.accordion-item>
        <x-ui.accordion-item title="Este item começa fechado">
            Conteúdo visível após clicar.
        </x-ui.accordion-item>
    </x-ui.accordion>
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Accordion - Item aberto por padrão" description="Prop <code>open</code> no item expande-o na carga inicial." :code="$code">
                        <x-ui.accordion>
                            <x-ui.accordion-item title="Este item começa aberto" :open="true">
                                Use a prop <code>open</code> para expandir automaticamente ao carregar a página.
                            </x-ui.accordion-item>
                            <x-ui.accordion-item title="Este item começa fechado">
                                Conteúdo visível após clicar no cabeçalho acima.
                            </x-ui.accordion-item>
                        </x-ui.accordion>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    <x-ui.accordion :expandAll="true">
        <x-ui.accordion-item title="Suporte técnico 24/7">
            Nossa equipe está disponível a qualquer hora para resolver suas dúvidas.
        </x-ui.accordion-item>
        <x-ui.accordion-item title="Backups automáticos diários">
            Realizamos backups completos todos os dias às 3h, com retenção de 30 dias.
        </x-ui.accordion-item>
        <x-ui.accordion-item title="Certificado SSL incluso">
            Todos os planos incluem SSL gratuito com renovação automática.
        </x-ui.accordion-item>
    </x-ui.accordion>
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Accordion - Múltiplos abertos (expandAll)" description="Prop <code>expandAll</code> permite que vários itens fiquem abertos ao mesmo tempo." :code="$code">
                        <x-ui.accordion :expandAll="true">
                            <x-ui.accordion-item title="Suporte técnico 24/7">
                                Nossa equipe está disponível a qualquer hora para resolver suas dúvidas.
                            </x-ui.accordion-item>
                            <x-ui.accordion-item title="Backups automáticos diários">
                                Realizamos backups completos todos os dias às 3h, com retenção de 30 dias.
                            </x-ui.accordion-item>
                            <x-ui.accordion-item title="Certificado SSL incluso">
                                Todos os planos incluem SSL gratuito com renovação automática.
                            </x-ui.accordion-item>
                        </x-ui.accordion>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    <x-ui.accordion>
        <x-ui.accordion-item title="Qual é a política de reembolso?" indicator="plus-minus">
            Oferecemos reembolso integral em até 14 dias após a contratação, sem perguntas.
        </x-ui.accordion-item>
        <x-ui.accordion-item title="Como funciona a migração de dados?" indicator="plus-minus">
            Nossa equipe cuida de toda a migração gratuitamente para planos anuais.
        </x-ui.accordion-item>
        <x-ui.accordion-item title="Quais formas de pagamento são aceitas?" indicator="plus-minus">
            Aceitamos cartão de crédito, boleto bancário e Pix.
        </x-ui.accordion-item>
    </x-ui.accordion>
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Accordion - Indicador plus/minus" description="Prop <code>indicator</code> como <code>plus-minus</code> troca o chevron por + e −." :code="$code">
                        <x-ui.accordion>
                            <x-ui.accordion-item title="Qual é a política de reembolso?" indicator="plus-minus">
                                Oferecemos reembolso integral em até 14 dias após a contratação, sem perguntas.
                            </x-ui.accordion-item>
                            <x-ui.accordion-item title="Como funciona a migração de dados?" indicator="plus-minus">
                                Nossa equipe cuida de toda a migração gratuitamente para planos anuais.
                            </x-ui.accordion-item>
                            <x-ui.accordion-item title="Quais formas de pagamento são aceitas?" indicator="plus-minus">
                                Aceitamos cartão de crédito, boleto bancário e Pix.
                            </x-ui.accordion-item>
                        </x-ui.accordion>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    <x-ui.accordion :bordered="true">
        <x-ui.accordion-item title="Integração com APIs externas">
            Suportamos OAuth 2.0, webhooks e REST APIs para integrar com qualquer sistema.
        </x-ui.accordion-item>
        <x-ui.accordion-item title="Controle de permissões por perfil">
            Configure permissões granulares para cada usuário ou grupo de acesso.
        </x-ui.accordion-item>
        <x-ui.accordion-item title="Relatórios e exportações">
            Exporte dados em CSV, Excel ou PDF com filtros personalizados.
        </x-ui.accordion-item>
    </x-ui.accordion>
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Accordion - Bordered" description="Prop <code>bordered</code> aplica bordas visíveis ao redor do componente." :code="$code">
                        <x-ui.accordion :bordered="true">
                            <x-ui.accordion-item title="Integração com APIs externas">
                                Suportamos OAuth 2.0, webhooks e REST APIs para integrar com qualquer sistema.
                            </x-ui.accordion-item>
                            <x-ui.accordion-item title="Controle de permissões por perfil">
                                Configure permissões granulares para cada usuário ou grupo de acesso.
                            </x-ui.accordion-item>
                            <x-ui.accordion-item title="Relatórios e exportações">
                                Exporte dados em CSV, Excel ou PDF com filtros personalizados.
                            </x-ui.accordion-item>
                        </x-ui.accordion>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    <x-ui.accordion :flushed="true">
        <x-ui.accordion-item title="Modo escuro disponível">
            Alterne entre tema claro e escuro nas configurações de aparência.
        </x-ui.accordion-item>
        <x-ui.accordion-item title="Suporte a múltiplos idiomas">
            A plataforma está disponível em português, inglês e espanhol.
        </x-ui.accordion-item>
        <x-ui.accordion-item title="Atualizações automáticas">
            Todas as melhorias são aplicadas automaticamente, sem downtime.
        </x-ui.accordion-item>
    </x-ui.accordion>
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Accordion - Flushed" description="Prop <code>flushed</code> remove as bordas laterais, alinhando ao container pai." :code="$code">
                        <x-ui.accordion :flushed="true">
                            <x-ui.accordion-item title="Modo escuro disponível">
                                Alterne entre tema claro e escuro nas configurações de aparência.
                            </x-ui.accordion-item>
                            <x-ui.accordion-item title="Suporte a múltiplos idiomas">
                                A plataforma está disponível em português, inglês e espanhol.
                            </x-ui.accordion-item>
                            <x-ui.accordion-item title="Atualizações automáticas">
                                Todas as melhorias são aplicadas automaticamente, sem downtime.
                            </x-ui.accordion-item>
                        </x-ui.accordion>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    <x-ui.accordion :separated="true">
        <x-ui.accordion-item title="Onboarding guiado">
            Nosso assistente de configuração leva você do zero ao produto em minutos.
        </x-ui.accordion-item>
        <x-ui.accordion-item title="Central de ajuda integrada">
            Acesse artigos, vídeos e tutoriais diretamente dentro da plataforma.
        </x-ui.accordion-item>
        <x-ui.accordion-item title="Comunidade de usuários">
            Participe do nosso fórum e troque experiências com outros clientes.
        </x-ui.accordion-item>
    </x-ui.accordion>
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Accordion - Separated" description="Prop <code>separated</code> adiciona espaçamento entre os itens." :code="$code">
                        <x-ui.accordion :separated="true">
                            <x-ui.accordion-item title="Onboarding guiado">
                                Nosso assistente de configuração leva você do zero ao produto em minutos.
                            </x-ui.accordion-item>
                            <x-ui.accordion-item title="Central de ajuda integrada">
                                Acesse artigos, vídeos e tutoriais diretamente dentro da plataforma.
                            </x-ui.accordion-item>
                            <x-ui.accordion-item title="Comunidade de usuários">
                                Participe do nosso fórum e troque experiências com outros clientes.
                            </x-ui.accordion-item>
                        </x-ui.accordion>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    <x-ui.accordion>
        <x-ui.accordion-item title="Segurança dos dados" icon="shield-check">
            Utilizamos criptografia AES-256 em repouso e TLS 1.3 em trânsito.
        </x-ui.accordion-item>
        <x-ui.accordion-item title="Conformidade e compliance" icon="file-check">
            Somos certificados ISO 27001 e em conformidade com LGPD e GDPR.
        </x-ui.accordion-item>
        <x-ui.accordion-item title="Autenticação em dois fatores" icon="lock">
            Ative 2FA via aplicativo autenticador ou SMS para sua conta.
        </x-ui.accordion-item>
    </x-ui.accordion>
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Accordion - Com ícone no título" description="Prop <code>icon</code> exibe um ícone Lucide à esquerda do título do item." :code="$code">
                        <x-ui.accordion>
                            <x-ui.accordion-item title="Segurança dos dados" icon="shield-check">
                                Utilizamos criptografia AES-256 em repouso e TLS 1.3 em trânsito.
                            </x-ui.accordion-item>
                            <x-ui.accordion-item title="Conformidade e compliance" icon="file-check">
                                Somos certificados ISO 27001 e em conformidade com LGPD e GDPR.
                            </x-ui.accordion-item>
                            <x-ui.accordion-item title="Autenticação em dois fatores" icon="lock">
                                Ative 2FA via aplicativo autenticador ou SMS para sua conta.
                            </x-ui.accordion-item>
                        </x-ui.accordion>
                    </x-ui-doc-section>

                    @php
                        $code = <<<'BLADE'
    <x-ui.accordion>
        <x-ui.accordion-item title="Plano disponível">
            Este item está habilitado e pode ser clicado normalmente.
        </x-ui.accordion-item>
        <x-ui.accordion-item title="Recurso em manutenção" :disabled="true">
            Este conteúdo não é acessível enquanto o item estiver desabilitado.
        </x-ui.accordion-item>
        <x-ui.accordion-item title="Outro item disponível">
            Conteúdo normalmente acessível.
        </x-ui.accordion-item>
    </x-ui.accordion>
    BLADE;
                    @endphp
                    <x-ui-doc-section title="Accordion - Item desabilitado" description="Prop <code>disabled</code> impede a interação com o item." :code="$code">
                        <x-ui.accordion>
                            <x-ui.accordion-item title="Plano disponível">
                                Este item está habilitado e pode ser clicado normalmente.
                            </x-ui.accordion-item>
                            <x-ui.accordion-item title="Recurso em manutenção" :disabled="true">
                                Este conteúdo não é acessível enquanto o item estiver desabilitado.
                            </x-ui.accordion-item>
                            <x-ui.accordion-item title="Outro item disponível">
                                Conteúdo normalmente acessível.
                            </x-ui.accordion-item>
                        </x-ui.accordion>
                    </x-ui-doc-section>

                </div>

            </main>
        </div>
    </div>
</div>
