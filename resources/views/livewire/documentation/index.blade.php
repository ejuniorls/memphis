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
        </div>
        <!-- end: grid -->
    </div>
</div>
<!-- End of Container -->
