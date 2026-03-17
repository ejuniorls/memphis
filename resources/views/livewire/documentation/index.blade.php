<!-- Container -->
<div class="kt-container-fluid">
    <div class="grid gap-5 lg:gap-7.5">
        <!-- begin: grid -->
        <div class="grid lg:grid-cols-1 gap-5 lg:gap-7.5 items-stretch">
            <div class="lg:col-span-2">
                <div class="kt-card h-full">
                    <div class="kt-card-content flex flex-col place-content-center gap-5">
                        <h1>Buttons</h1>

                        {{-- Basic Usage --}}
                        <h2>Basic usage</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.button>Primary</x-ui.button>
                            <x-ui.button variant="secondary">Secondary</x-ui.button>
                            <x-ui.button variant="destructive">Destructive</x-ui.button>
                            <x-ui.button variant="mono">Mono</x-ui.button>
                            <x-ui.button variant="outline">Outline</x-ui.button>
                            <x-ui.button variant="ghost">Ghost</x-ui.button>
                        </div>

                        {{-- Circle --}}
                        <h2>Circle</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.button circle>Primary</x-ui.button>
                            <x-ui.button circle variant="secondary">Secondary</x-ui.button>
                            <x-ui.button circle variant="destructive">Destructive</x-ui.button>
                            <x-ui.button circle variant="mono">Mono</x-ui.button>
                            <x-ui.button circle variant="outline">Outline</x-ui.button>
                            <x-ui.button circle variant="ghost">Ghost</x-ui.button>
                        </div>

                        {{-- Ghost --}}
                        <h2>Ghost</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.button ghost>Default</x-ui.button>
                            <x-ui.button ghost="primary">Primary</x-ui.button>
                            <x-ui.button ghost="destructive">Destructive</x-ui.button>
                        </div>

                        {{-- With Icon --}}
                        <h2>With Icon</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.button icon="settings">Primary</x-ui.button>
                            <x-ui.button icon="settings" variant="secondary">Secondary</x-ui.button>
                            <x-ui.button icon="settings" variant="destructive">Destructive</x-ui.button>
                            <x-ui.button icon="settings" variant="mono">Mono</x-ui.button>
                            <x-ui.button icon="settings" variant="outline">Outline</x-ui.button>
                            <x-ui.button icon="settings" variant="ghost">Ghost</x-ui.button>
                        </div>

                        {{-- Icon Only --}}
                        <h2>Icon Only</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.button :icon-only="true" icon="dog"/>
                            <x-ui.button :icon-only="true" icon="cat" variant="secondary"/>
                            <x-ui.button :icon-only="true" icon="panda" variant="destructive"/>
                            <x-ui.button :icon-only="true" icon="bird" variant="mono"/>
                        </div>

                        {{-- Size --}}
                        <h2>Size</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.button size="sm">Small</x-ui.button>
                            <x-ui.button>Default</x-ui.button>
                            <x-ui.button size="lg">Large</x-ui.button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="kt-card h-full">
                    <div class="kt-card-content flex flex-col place-content-center gap-5">
                        <h1>Alerts</h1>

                        {{-- Basic Usage --}}
                        <h2>Basic Usage</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.alert :dismissible="true" title="This is a default alert"/>
                            <x-ui.alert :dismissible="true" variant="primary" title="This is a primary alert"/>
                            <x-ui.alert :dismissible="true" variant="success" title="This is a success alert"/>
                            <x-ui.alert :dismissible="true" variant="info" title="This is an info alert"/>
                            <x-ui.alert :dismissible="true" variant="destructive" title="This is a destructive alert"/>
                            <x-ui.alert :dismissible="true" variant="warning" title="This is a warning alert"/>
                            <x-ui.alert :dismissible="true" variant="mono" title="This is a mono alert"/>
                        </div>

                        {{-- Mono --}}
                        <h2>Mono</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.alert :dismissible="true" style="mono" variant="primary"
                                        title="This is a primary alert"/>
                            <x-ui.alert :dismissible="true" style="mono" variant="success"
                                        title="This is a success alert"/>
                            <x-ui.alert :dismissible="true" style="mono" variant="info" title="This is an info alert"/>
                            <x-ui.alert :dismissible="true" style="mono" variant="destructive"
                                        title="This is a destructive alert"/>
                            <x-ui.alert :dismissible="true" style="mono" variant="warning"
                                        title="This is a warning alert"/>
                        </div>

                        {{-- Outline --}}
                        <h2>Outline</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.alert :dismissible="true" style="outline" variant="primary"
                                        title="This is a primary alert"/>
                            <x-ui.alert :dismissible="true" style="outline" variant="success"
                                        title="This is a success alert"/>
                            <x-ui.alert :dismissible="true" style="outline" variant="info"
                                        title="This is an info alert"/>
                            <x-ui.alert :dismissible="true" style="outline" variant="destructive"
                                        title="This is a destructive alert"/>
                            <x-ui.alert :dismissible="true" style="outline" variant="warning"
                                        title="This is a warning alert"/>
                        </div>

                        {{-- Light --}}
                        <h2>Light</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.alert :dismissible="true" style="light" variant="primary"
                                        title="This is a primary alert"/>
                            <x-ui.alert :dismissible="true" style="light" variant="success"
                                        title="This is a success alert"/>
                            <x-ui.alert :dismissible="true" style="light" variant="info" title="This is an info alert"/>
                            <x-ui.alert :dismissible="true" style="light" variant="destructive"
                                        title="This is a destructive alert"/>
                            <x-ui.alert :dismissible="true" style="light" variant="warning"
                                        title="This is a warning alert"/>
                        </div>

                        {{-- Size --}}
                        <h2>Size</h2>
                        <div class="flex flex-wrap items-start gap-4">
                            <x-ui.alert :dismissible="true" size="sm" style="outline" variant="primary"
                                        title="This is a small alert"/>
                            <x-ui.alert :dismissible="true" style="outline" variant="primary"
                                        title="This is a default alert"/>
                            <x-ui.alert :dismissible="true" size="lg" style="outline" variant="primary"
                                        title="This is a large alert"/>
                        </div>

                        {{-- Icon customizado --}}
                        <h2>Custom Icon</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.alert :dismissible="true" variant="warning" icon="shield-alert"
                                        title="Ícone customizado com shield-alert"/>
                            <x-ui.alert :dismissible="true" variant="info" :icon="false" title="Sem ícone"/>
                        </div>

                        {{-- Actions: action-label (prop atalho) --}}
                        <h2>Actions — prop atalho</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.alert
                                style="outline"
                                title="Example Alert Title"
                                description="Insert the alert description here. It would look better as two lines of text."
                                action-label="Upgrade"
                                action-href="/upgrade"
                                :dismissible="true"
                            />
                            <x-ui.alert
                                style="outline"
                                variant="destructive"
                                title="Example Alert Title"
                                description="Insert the alert description here. It would look better as two lines of text."
                                action-label="Upgrade"
                                action-href="/upgrade"
                                :dismissible="true"
                            />
                            <x-ui.alert
                                style="outline"
                                variant="warning"
                                title="Example Alert Title"
                                description="Insert the alert description here. It would look better as two lines of text."
                                action-label="Upgrade"
                                action-href="/upgrade"
                                :dismissible="true"
                            />
                        </div>

                        {{-- Actions: slot com múltiplos botões/links --}}
                        <h2>Actions — múltiplas ações via slot</h2>
                        <div class="flex flex-wrap gap-4">

                            {{-- Slot simples, sem descrição --}}
                            <x-ui.alert variant="primary" title="Você tem mensagens novas." :dismissible="true">
                                <x-slot:actions>
                                    <a href="/mensagens" class="kt-link kt-link-xs kt-link-underlined kt-link-inverse">Ver
                                        agora</a>
                                </x-slot:actions>
                            </x-ui.alert>

                            {{-- Slot simples, dois botões --}}
                            <x-ui.alert variant="warning" style="outline" title="Plano próximo do limite."
                                        :dismissible="true">
                                <x-slot:actions>
                                    <a href="/upgrade"
                                       class="kt-link kt-link-xs kt-link-underlined text-mono-foreground">Fazer
                                        upgrade</a>
                                    <button class="kt-link kt-link-xs text-mono-foreground">Ignorar</button>
                                </x-slot:actions>
                            </x-ui.alert>

                            {{-- Com descrição + dois links --}}
                            <x-ui.alert
                                style="outline"
                                variant="destructive"
                                title="Example Alert Title"
                                description="Insert the alert description here."
                                :dismissible="true"
                            >
                                <x-slot:actions>
                                    <a href="/upgrade"
                                       class="kt-link kt-link-xs kt-link-underlined text-mono-foreground">Upgrade</a>
                                    <button class="kt-link kt-link-xs text-mono-foreground">Dismiss</button>
                                </x-slot:actions>
                            </x-ui.alert>

                            {{-- Com descrição + dois links de navegação --}}
                            <x-ui.alert
                                style="outline"
                                variant="destructive"
                                title="Falha ao salvar"
                                description="Ocorreu um erro inesperado. Tente novamente ou contate o suporte."
                                :dismissible="true"
                            >
                                <x-slot:actions>
                                    <a href="/retry" class="kt-link kt-link-xs kt-link-underlined text-mono-foreground">Tentar
                                        novamente</a>
                                    <a href="/suporte" class="kt-link kt-link-xs text-mono-foreground">Contatar
                                        suporte</a>
                                </x-slot:actions>
                            </x-ui.alert>

                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-2">
                <div class="kt-card h-full">
                    <div class="kt-card-content flex flex-col place-content-center gap-5">
                        <h1>Badges</h1>

                        {{-- Basic --}}
                        <h2>Basic</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge>Default</x-ui.badge>
                            <x-ui.badge :stroke="true">Stroke</x-ui.badge>
                        </div>

                        {{-- Solid --}}
                        <h2>Solid</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge variant="primary">Primary</x-ui.badge>
                            <x-ui.badge variant="secondary">Secondary</x-ui.badge>
                            <x-ui.badge variant="success">Success</x-ui.badge>
                            <x-ui.badge variant="destructive">Destructive</x-ui.badge>
                            <x-ui.badge variant="warning">Warning</x-ui.badge>
                            <x-ui.badge variant="info">Info</x-ui.badge>
                            <x-ui.badge variant="mono">Mono</x-ui.badge>
                        </div>

                        {{-- Outline --}}
                        <h2>Outline</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge style="outline" variant="primary">Primary</x-ui.badge>
                            <x-ui.badge style="outline" variant="secondary">Secondary</x-ui.badge>
                            <x-ui.badge style="outline" variant="success">Success</x-ui.badge>
                            <x-ui.badge style="outline" variant="destructive">Destructive</x-ui.badge>
                            <x-ui.badge style="outline" variant="warning">Warning</x-ui.badge>
                            <x-ui.badge style="outline" variant="info">Info</x-ui.badge>
                            <x-ui.badge style="outline" variant="mono">Mono</x-ui.badge>
                        </div>

                        {{-- Light --}}
                        <h2>Light</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge style="light" variant="primary">Primary</x-ui.badge>
                            <x-ui.badge style="light" variant="secondary">Secondary</x-ui.badge>
                            <x-ui.badge style="light" variant="success">Success</x-ui.badge>
                            <x-ui.badge style="light" variant="destructive">Destructive</x-ui.badge>
                            <x-ui.badge style="light" variant="warning">Warning</x-ui.badge>
                            <x-ui.badge style="light" variant="info">Info</x-ui.badge>
                            <x-ui.badge style="light" variant="mono">Mono</x-ui.badge>
                        </div>

                        {{-- Circle --}}
                        <h2>Circle</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge style="light" :circle="true" variant="primary">Primary</x-ui.badge>
                            <x-ui.badge style="light" :circle="true" variant="secondary">Secondary</x-ui.badge>
                            <x-ui.badge style="light" :circle="true" variant="success">Success</x-ui.badge>
                            <x-ui.badge style="light" :circle="true" variant="destructive">Destructive</x-ui.badge>
                            <x-ui.badge style="light" :circle="true" variant="warning">Warning</x-ui.badge>
                            <x-ui.badge style="light" :circle="true" variant="info">Info</x-ui.badge>
                            <x-ui.badge style="light" :circle="true" variant="mono">Mono</x-ui.badge>
                        </div>

                        {{-- Ghost --}}
                        <h2>Ghost</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge style="ghost" :circle="true" variant="primary">Primary</x-ui.badge>
                            <x-ui.badge style="ghost" :circle="true" variant="secondary">Secondary</x-ui.badge>
                            <x-ui.badge style="ghost" :circle="true" variant="success">Success</x-ui.badge>
                            <x-ui.badge style="ghost" :circle="true" variant="destructive">Destructive</x-ui.badge>
                            <x-ui.badge style="ghost" :circle="true" variant="warning">Warning</x-ui.badge>
                            <x-ui.badge style="ghost" :circle="true" variant="info">Info</x-ui.badge>
                            <x-ui.badge style="ghost" :circle="true" variant="mono">Mono</x-ui.badge>
                        </div>

                        {{-- Square --}}
                        <h2>Square</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge style="ghost" :circle="true" variant="primary">Primary</x-ui.badge>
                            <x-ui.badge style="ghost" :circle="true" variant="secondary">Secondary</x-ui.badge>
                            <x-ui.badge style="ghost" :circle="true" variant="success">Success</x-ui.badge>
                            <x-ui.badge style="ghost" :circle="true" variant="destructive">Destructive</x-ui.badge>
                            <x-ui.badge style="ghost" :circle="true" variant="warning">Warning</x-ui.badge>
                            <x-ui.badge style="ghost" :circle="true" variant="info">Info</x-ui.badge>
                            <x-ui.badge style="ghost" :circle="true" variant="mono">Mono</x-ui.badge>
                        </div>

                        {{-- Dot --}}
                        <h2>Dot</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge style="ghost" :dot="true" variant="">Ghost</x-ui.badge>
                            <x-ui.badge variant="">Solid</x-ui.badge>
                            <x-ui.badge style="outline" :dot="true" variant="">Outline</x-ui.badge>
                            <x-ui.badge style="light" :dot="true" variant="">Light</x-ui.badge>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge variant="primary" style="ghost" :dot="true">Ghost</x-ui.badge>
                            <x-ui.badge variant="primary">Solid</x-ui.badge>
                            <x-ui.badge variant="primary" style="outline" :dot="true">Outline</x-ui.badge>
                            <x-ui.badge variant="primary" style="light" :dot="true">Light</x-ui.badge>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge variant="destructive" style="ghost" :dot="true">Ghost</x-ui.badge>
                            <x-ui.badge variant="destructive">Solid</x-ui.badge>
                            <x-ui.badge variant="destructive" style="outline" :dot="true">Outline</x-ui.badge>
                            <x-ui.badge variant="destructive" style="light" :dot="true">Light</x-ui.badge>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge variant="warning" style="ghost" :dot="true">Ghost</x-ui.badge>
                            <x-ui.badge variant="warning">Solid</x-ui.badge>
                            <x-ui.badge variant="warning" style="outline" :dot="true">Outline</x-ui.badge>
                            <x-ui.badge variant="warning" style="light" :dot="true">Light</x-ui.badge>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge variant="success" style="ghost" :dot="true">Ghost</x-ui.badge>
                            <x-ui.badge variant="success">Solid</x-ui.badge>
                            <x-ui.badge variant="success" style="outline" :dot="true">Outline</x-ui.badge>
                            <x-ui.badge variant="success" style="light" :dot="true">Light</x-ui.badge>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge variant="info" style="ghost" :dot="true">Ghost</x-ui.badge>
                            <x-ui.badge variant="info">Solid</x-ui.badge>
                            <x-ui.badge variant="info" style="outline" :dot="true">Outline</x-ui.badge>
                            <x-ui.badge variant="info" style="light" :dot="true">Light</x-ui.badge>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge variant="mono" style="ghost" :dot="true">Ghost</x-ui.badge>
                            <x-ui.badge variant="mono">Solid</x-ui.badge>
                            <x-ui.badge variant="mono" style="outline" :dot="true">Outline</x-ui.badge>
                            <x-ui.badge variant="mono" style="light" :dot="true">Light</x-ui.badge>
                        </div>

                        {{-- Icon --}}
                        <h2>Icon</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge style="ghost" icon="tag">Ghost</x-ui.badge>
                            <x-ui.badge icon="mail">Solid</x-ui.badge>
                            <x-ui.badge style="outline" icon="file">Outline</x-ui.badge>
                            <x-ui.badge style="light" icon="activity">Light</x-ui.badge>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge variant="primary" style="ghost" icon="tag">Ghost</x-ui.badge>
                            <x-ui.badge variant="primary" icon="mail">Solid</x-ui.badge>
                            <x-ui.badge variant="primary" style="outline" icon="file">Outline</x-ui.badge>
                            <x-ui.badge variant="primary" style="light" icon="activity">Light</x-ui.badge>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge variant="secondary" style="ghost" icon="tag">Ghost</x-ui.badge>
                            <x-ui.badge variant="secondary" icon="mail">Solid</x-ui.badge>
                            <x-ui.badge variant="secondary" style="outline" icon="file">Outline</x-ui.badge>
                            <x-ui.badge variant="secondary" style="light" icon="activity">Light</x-ui.badge>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge variant="destructive" style="ghost" icon="tag">Ghost</x-ui.badge>
                            <x-ui.badge variant="destructive" icon="mail">Solid</x-ui.badge>
                            <x-ui.badge variant="destructive" style="outline" icon="file">Outline</x-ui.badge>
                            <x-ui.badge variant="destructive" style="light" icon="activity">Light</x-ui.badge>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge variant="warning" style="ghost" icon="tag">Ghost</x-ui.badge>
                            <x-ui.badge variant="warning" icon="mail">Solid</x-ui.badge>
                            <x-ui.badge variant="warning" style="outline" icon="file">Outline</x-ui.badge>
                            <x-ui.badge variant="warning" style="light" icon="activity">Light</x-ui.badge>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge variant="success" style="ghost" icon="tag">Ghost</x-ui.badge>
                            <x-ui.badge variant="success" icon="mail">Solid</x-ui.badge>
                            <x-ui.badge variant="success" style="outline" icon="file">Outline</x-ui.badge>
                            <x-ui.badge variant="success" style="light" icon="activity">Light</x-ui.badge>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge variant="info" style="ghost" icon="tag">Ghost</x-ui.badge>
                            <x-ui.badge variant="info" icon="mail">Solid</x-ui.badge>
                            <x-ui.badge variant="info" style="outline" icon="file">Outline</x-ui.badge>
                            <x-ui.badge variant="info" style="light" icon="activity">Light</x-ui.badge>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge variant="mono" style="ghost" icon="tag">Ghost</x-ui.badge>
                            <x-ui.badge variant="mono" icon="mail">Solid</x-ui.badge>
                            <x-ui.badge variant="mono" style="outline" icon="file">Outline</x-ui.badge>
                            <x-ui.badge variant="mono" style="light" icon="activity">Light</x-ui.badge>
                        </div>


                        {{-- Size --}}
                        <h2>Size</h2>
                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge style="outline" variant="primary" size="xs" :circle="true">Extra small</x-ui.badge>
                            <x-ui.badge style="outline" variant="primary" size="sm" :circle="true">Small</x-ui.badge>
                            <x-ui.badge style="outline" variant="primary" :circle="true">Default</x-ui.badge>
                            <x-ui.badge style="outline" variant="primary" size="lg" :circle="true">Large</x-ui.badge>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge style="outline" variant="secondary" size="xs" :circle="true">Extra small</x-ui.badge>
                            <x-ui.badge style="outline" variant="secondary" size="sm" :circle="true">Small</x-ui.badge>
                            <x-ui.badge style="outline" variant="secondary" :circle="true">Default</x-ui.badge>
                            <x-ui.badge style="outline" variant="secondary" size="lg" :circle="true">Large</x-ui.badge>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge style="outline" variant="destructive" size="xs" :circle="true">Extra small</x-ui.badge>
                            <x-ui.badge style="outline" variant="destructive" size="sm" :circle="true">Small</x-ui.badge>
                            <x-ui.badge style="outline" variant="destructive" :circle="true">Default</x-ui.badge>
                            <x-ui.badge style="outline" variant="destructive" size="lg" :circle="true">Large</x-ui.badge>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge style="outline" variant="warning" size="xs" :circle="true">Extra small</x-ui.badge>
                            <x-ui.badge style="outline" variant="warning" size="sm" :circle="true">Small</x-ui.badge>
                            <x-ui.badge style="outline" variant="warning" :circle="true">Default</x-ui.badge>
                            <x-ui.badge style="outline" variant="warning" size="lg" :circle="true">Large</x-ui.badge>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge style="outline" variant="success" size="xs" :circle="true">Extra small</x-ui.badge>
                            <x-ui.badge style="outline" variant="success" size="sm" :circle="true">Small</x-ui.badge>
                            <x-ui.badge style="outline" variant="success" :circle="true">Default</x-ui.badge>
                            <x-ui.badge style="outline" variant="success" size="lg" :circle="true">Large</x-ui.badge>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge style="outline" variant="info" size="xs" :circle="true">Extra small</x-ui.badge>
                            <x-ui.badge style="outline" variant="info" size="sm" :circle="true">Small</x-ui.badge>
                            <x-ui.badge style="outline" variant="info" :circle="true">Default</x-ui.badge>
                            <x-ui.badge style="outline" variant="info" size="lg" :circle="true">Large</x-ui.badge>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <x-ui.badge style="outline" variant="mono" size="xs" :circle="true">Extra small</x-ui.badge>
                            <x-ui.badge style="outline" variant="mono" size="sm" :circle="true">Small</x-ui.badge>
                            <x-ui.badge style="outline" variant="mono" :circle="true">Default</x-ui.badge>
                            <x-ui.badge style="outline" variant="mono" size="lg" :circle="true">Large</x-ui.badge>
                        </div>

                        {{-- Com ícone --}}
                        <x-ui.badge variant="secondary" icon="tag">Tag</x-ui.badge>
                        <x-ui.badge style="light" variant="info" icon="activity">Live</x-ui.badge>

                        {{-- Removable --}}
                        <x-ui.badge variant="primary" :removable="true">Primary</x-ui.badge>
                        <x-ui.badge style="outline" variant="destructive" :removable="true">Remover</x-ui.badge>

                        {{-- Como link --}}
                        <x-ui.badge tag="a" href="/categoria/php" variant="secondary" style="outline">PHP</x-ui.badge>

                        {{-- Contador numérico (Square da doc) --}}
                        <x-ui.badge variant="primary" :circle="true">2</x-ui.badge>
                        <x-ui.badge style="ghost" variant="destructive" :circle="true">3</x-ui.badge>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end: grid -->
</div>
</div>
<!-- End of Container -->
