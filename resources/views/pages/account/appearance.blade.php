<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Aparência')] class extends Component
{
    public string $layout_width     = 'fixed';
    public string $sidebar_default  = 'expanded';
    public bool   $sidebar_mini     = false;
    public string $theme_mode       = 'system';
    public string $primary_color    = 'blue';
    public string $font_size        = 'md';
    public string $font_family      = 'inter';
    public string $density          = 'comfortable';
    public bool   $topbar_sticky    = true;
    public bool   $show_breadcrumbs = true;
    public bool   $show_page_title  = true;
    public bool   $animations       = true;

    public function mount(): void
    {
        $prefs    = Auth::user()->appearancePreferences();
        $defaults = $this->getDefaultPreferences();

        foreach ($defaults as $key => $default) {
            $value = $prefs[$key] ?? $default;

            $this->$key = match (gettype($default)) {
                'boolean' => (bool) $value,
                'integer' => (int) $value,
                default   => is_array($value) ? $default : (string) $value,
            };
        }
    }

    private function getDefaultPreferences(): array
    {
        return [
            'layout_width'     => 'fixed',
            'sidebar_default'  => 'expanded',
            'sidebar_mini'     => false,
            'theme_mode'       => 'system',
            'primary_color'    => 'blue',
            'font_size'        => 'md',
            'font_family'      => 'inter',
            'density'          => 'comfortable',
            'topbar_sticky'    => true,
            'show_breadcrumbs' => true,
            'show_page_title'  => true,
            'animations'       => true,
        ];
    }

    public function save(): void
    {
        $data = [];
        foreach (array_keys($this->getDefaultPreferences()) as $key) {
            $data[$key] = $this->$key;
        }

        Auth::user()->update(['appearance_preferences' => $data]);

        $this->dispatch('appearance-saved', preferences: $data);
        $this->dispatch('toast', variant: 'success', message: __('pages.account.appearance.toast_saved'));
    }

    public function resetPreferences(): void
    {
        foreach ($this->getDefaultPreferences() as $key => $value) {
            $this->$key = $value;
        }
        $this->dispatch('toast', variant: 'info', message: __('pages.account.appearance.toast_reset'));
    }
}; ?>

<div>

    <x-slot name="toolbar">
        <x-ui.breadcrumb>
            <x-ui.breadcrumb-item :first="true" href="{{ route('dashboard') }}">{{ __('Home') }}</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item href="{{ route('dashboard') }}">{{ __('Account') }}</x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item :active="true">{{ __('pages.account.appearance.page_heading') }}</x-ui.breadcrumb-item>
        </x-ui.breadcrumb>
    </x-slot>

    <x-slot name="toolbarActions">
        <x-ui.button tag="button" type="button" :outline="true" size="sm" icon="rotate-ccw"
                     wire:click="resetPreferences"
                     wire:confirm="{{ __('pages.account.appearance.reset_confirm') }}">
            {{ __('pages.account.appearance.btn_reset') }}
        </x-ui.button>
    </x-slot>

    <div class="py-6">

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-mono">{{ __('pages.account.appearance.page_heading') }}</h1>
            <p class="text-sm text-secondary-foreground mt-1">{{ __('pages.account.appearance.page_subheading') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            {{-- ============================================================ --}}
            {{-- Coluna esquerda: Tema, Cor, Tipografia                        --}}
            {{-- ============================================================ --}}
            <div class="lg:col-span-1 flex flex-col gap-6">

                {{-- Modo de Tema --}}
                <x-ui.card-section icon="lucide-sun-moon"
                                   :title="__('pages.account.appearance.section_theme')"
                                   contentClass="flex flex-col gap-2 py-4">
                    <p class="text-xs text-secondary-foreground mb-2">
                        {{ __('pages.account.appearance.theme_description') }}
                    </p>

                    @foreach ([
                        ['value' => 'light',  'icon' => 'lucide-sun',      'label' => __('pages.account.appearance.theme_light'),  'hint' => __('pages.account.appearance.theme_light_hint')],
                        ['value' => 'dark',   'icon' => 'lucide-moon',     'label' => __('pages.account.appearance.theme_dark'),   'hint' => __('pages.account.appearance.theme_dark_hint')],
                        ['value' => 'system', 'icon' => 'lucide-laptop-2', 'label' => __('pages.account.appearance.theme_system'), 'hint' => __('pages.account.appearance.theme_system_hint')],
                    ] as $opt)
                        <x-ui.option-row
                            value="{{ $opt['value'] }}"
                            wire-model="theme_mode"
                            :current="$theme_mode"
                            :label="$opt['label']"
                            :hint="$opt['hint']"
                            icon="{{ $opt['icon'] }}"
                        />
                    @endforeach
                </x-ui.card-section>

                {{-- Cor Principal --}}
                <x-ui.card-section icon="lucide-palette"
                                   :title="__('pages.account.appearance.section_color')"
                                   contentClass="flex flex-col gap-4 py-4">
                    <p class="text-xs text-secondary-foreground">
                        {{ __('pages.account.appearance.color_description') }}
                    </p>

                    <div class="grid grid-cols-3 gap-2">
                        @foreach ([
                            ['value' => 'blue',   'bg' => 'bg-blue-500',   'label' => __('pages.account.appearance.color_blue')],
                            ['value' => 'violet', 'bg' => 'bg-violet-500', 'label' => __('pages.account.appearance.color_violet')],
                            ['value' => 'green',  'bg' => 'bg-green-500',  'label' => __('pages.account.appearance.color_green')],
                            ['value' => 'orange', 'bg' => 'bg-orange-500', 'label' => __('pages.account.appearance.color_orange')],
                            ['value' => 'rose',   'bg' => 'bg-rose-500',   'label' => __('pages.account.appearance.color_rose')],
                            ['value' => 'slate',  'bg' => 'bg-slate-600',  'label' => __('pages.account.appearance.color_slate')],
                        ] as $color)
                            @php $colorSelected = $primary_color === $color['value']; @endphp
                            <label wire:key="color-{{ $color['value'] }}"
                                   class="flex flex-col items-center gap-2 p-2 rounded-lg border cursor-pointer select-none transition-colors
                                {{ $colorSelected ? 'border-primary bg-primary/5' : 'border-input hover:border-primary/40 hover:bg-muted/50' }}">
                                <input type="radio" class="sr-only" wire:model.live="primary_color" value="{{ $color['value'] }}" />
                                <div class="size-8 rounded-full {{ $color['bg'] }} flex items-center justify-center">
                                    @if ($colorSelected)
                                        @svg('lucide-check', ['class' => 'size-4 text-white'])
                                    @endif
                                </div>
                                <span class="text-xs text-foreground font-medium">{{ $color['label'] }}</span>
                            </label>
                        @endforeach
                    </div>
                </x-ui.card-section>

                {{-- Tipografia --}}
                <x-ui.card-section icon="lucide-type"
                                   :title="__('pages.account.appearance.section_typography')"
                                   contentClass="flex flex-col gap-4 py-4">

                    <x-ui.form-field :label="__('pages.account.appearance.field_font_family')" name="font_family">
                        <x-ui.select wire:model="font_family">
                            <option value="inter">Inter (padrão)</option>
                            <option value="system">System UI</option>
                            <option value="mono">Monospace</option>
                        </x-ui.select>
                    </x-ui.form-field>

                    <div class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-foreground">
                            {{ __('pages.account.appearance.field_font_size') }}
                        </span>
                        <div class="flex gap-2">
                            @foreach ([
                                ['value' => 'sm', 'label' => __('pages.account.appearance.font_sm')],
                                ['value' => 'md', 'label' => __('pages.account.appearance.font_md')],
                                ['value' => 'lg', 'label' => __('pages.account.appearance.font_lg')],
                            ] as $size)
                                <x-ui.option-card
                                    value="{{ $size['value'] }}"
                                    wire-model="font_size"
                                    :current="$font_size"
                                    size="sm"
                                    class="flex-1 justify-center"
                                >
                                    <span class="text-sm font-medium {{ $font_size === $size['value'] ? 'text-primary' : 'text-foreground' }}">
                                        {{ $size['label'] }}
                                    </span>
                                </x-ui.option-card>
                            @endforeach
                        </div>
                    </div>
                </x-ui.card-section>

            </div>

            {{-- ============================================================ --}}
            {{-- Coluna principal: Layout, Sidebar, Interface                  --}}
            {{-- ============================================================ --}}
            <div class="lg:col-span-2 flex flex-col gap-6">

                {{-- Layout --}}
                <x-ui.card-section icon="lucide-layout"
                                   :title="__('pages.account.appearance.section_layout')"
                                   contentClass="flex flex-col gap-5 py-4">
                    <x-slot name="subtitle">{{ __('pages.account.appearance.section_layout_subtitle') }}</x-slot>

                    {{-- Container --}}
                    <div class="flex flex-col gap-3">
                        <span class="text-sm font-medium text-foreground">
                            {{ __('pages.account.appearance.field_layout_width') }}
                        </span>
                        <div class="grid grid-cols-2 gap-3">

                            <x-ui.option-card
                                value="fixed"
                                wire-model="layout_width"
                                :current="$layout_width"
                                :label="__('pages.account.appearance.layout_fixed')"
                                :hint="__('pages.account.appearance.layout_fixed_hint')"
                            >
                                {{-- Preview Fixed --}}
                                <div class="w-full h-12 rounded-md bg-muted flex items-center justify-center overflow-hidden mb-1">
                                    <div class="w-3/5 h-full bg-background border border-input rounded-sm flex flex-col gap-1 px-1.5 pt-1.5">
                                        <div class="w-full h-1.5 rounded-full bg-muted-foreground/20"></div>
                                        <div class="w-4/5 h-1 rounded-full bg-muted-foreground/15"></div>
                                        <div class="w-3/5 h-1 rounded-full bg-muted-foreground/15"></div>
                                    </div>
                                </div>
                            </x-ui.option-card>

                            <x-ui.option-card
                                value="fluid"
                                wire-model="layout_width"
                                :current="$layout_width"
                                :label="__('pages.account.appearance.layout_fluid')"
                                :hint="__('pages.account.appearance.layout_fluid_hint')"
                            >
                                {{-- Preview Fluid --}}
                                <div class="w-full h-12 rounded-md bg-muted flex items-center justify-center overflow-hidden mb-1">
                                    <div class="w-full h-full bg-background border border-input rounded-sm flex flex-col gap-1 px-1.5 pt-1.5 mx-1">
                                        <div class="w-full h-1.5 rounded-full bg-muted-foreground/20"></div>
                                        <div class="w-4/5 h-1 rounded-full bg-muted-foreground/15"></div>
                                        <div class="w-3/5 h-1 rounded-full bg-muted-foreground/15"></div>
                                    </div>
                                </div>
                            </x-ui.option-card>

                        </div>
                    </div>

                    <x-ui.divider />

                    {{-- Densidade --}}
                    <div class="flex flex-col gap-3">
                        <div class="flex flex-col gap-0.5">
                            <span class="text-sm font-medium text-foreground">{{ __('pages.account.appearance.field_density') }}</span>
                            <span class="text-xs text-secondary-foreground">{{ __('pages.account.appearance.field_density_hint') }}</span>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach ([
                                ['value' => 'compact',     'icon' => 'lucide-align-justify', 'label' => __('pages.account.appearance.density_compact'),     'hint' => __('pages.account.appearance.density_compact_hint')],
                                ['value' => 'comfortable', 'icon' => 'lucide-layout-list',   'label' => __('pages.account.appearance.density_comfortable'), 'hint' => __('pages.account.appearance.density_comfortable_hint')],
                                ['value' => 'spacious',    'icon' => 'lucide-rows-3',         'label' => __('pages.account.appearance.density_spacious'),    'hint' => __('pages.account.appearance.density_spacious_hint')],
                            ] as $opt)
                                <x-ui.option-card
                                    value="{{ $opt['value'] }}"
                                    wire-model="density"
                                    :current="$density"
                                    icon="{{ $opt['icon'] }}"
                                    :label="$opt['label']"
                                    :hint="$opt['hint']"
                                    size="sm"
                                />
                            @endforeach
                        </div>
                    </div>

                </x-ui.card-section>

                {{-- Sidebar --}}
                <x-ui.card-section icon="lucide-panel-left"
                                   :title="__('pages.account.appearance.section_sidebar')"
                                   contentClass="flex flex-col gap-5 py-4">
                    <x-slot name="subtitle">{{ __('pages.account.appearance.section_sidebar_subtitle') }}</x-slot>

                    <div class="flex flex-col gap-3">
                        <span class="text-sm font-medium text-foreground">
                            {{ __('pages.account.appearance.field_sidebar_default') }}
                        </span>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach ([
                                ['value' => 'expanded',  'icon' => 'lucide-panel-left-open',  'label' => __('pages.account.appearance.sidebar_expanded'),  'hint' => __('pages.account.appearance.sidebar_expanded_hint')],
                                ['value' => 'collapsed', 'icon' => 'lucide-panel-left-close', 'label' => __('pages.account.appearance.sidebar_collapsed'), 'hint' => __('pages.account.appearance.sidebar_collapsed_hint')],
                                ['value' => 'hidden',    'icon' => 'lucide-layout-template',  'label' => __('pages.account.appearance.sidebar_hidden'),    'hint' => __('pages.account.appearance.sidebar_hidden_hint')],
                            ] as $opt)
                                <x-ui.option-card
                                    value="{{ $opt['value'] }}"
                                    wire-model="sidebar_default"
                                    :current="$sidebar_default"
                                    icon="{{ $opt['icon'] }}"
                                    :label="$opt['label']"
                                    :hint="$opt['hint']"
                                    size="sm"
                                />
                            @endforeach
                        </div>
                    </div>

                    <x-ui.divider />

                    <x-ui.toggle-row
                        wire-model="sidebar_mini"
                        :label="__('pages.account.appearance.sidebar_mini_label')"
                        :hint="__('pages.account.appearance.sidebar_mini_hint')"
                        icon="lucide-sidebar"
                    />

                </x-ui.card-section>

                {{-- Interface & Comportamento --}}
                <x-ui.card-section icon="lucide-sliders-horizontal"
                                   :title="__('pages.account.appearance.section_interface')"
                                   contentClass="flex flex-col divide-y divide-input py-0">
                    <x-slot name="subtitle">{{ __('pages.account.appearance.section_interface_subtitle') }}</x-slot>

                    <x-ui.toggle-row
                        wire-model="topbar_sticky"
                        :label="__('pages.account.appearance.topbar_sticky_label')"
                        :hint="__('pages.account.appearance.topbar_sticky_hint')"
                        icon="lucide-pin"
                    />
                    <x-ui.toggle-row
                        wire-model="show_breadcrumbs"
                        :label="__('pages.account.appearance.breadcrumbs_label')"
                        :hint="__('pages.account.appearance.breadcrumbs_hint')"
                        icon="lucide-navigation"
                    />
                    <x-ui.toggle-row
                        wire-model="show_page_title"
                        :label="__('pages.account.appearance.page_title_label')"
                        :hint="__('pages.account.appearance.page_title_hint')"
                        icon="lucide-heading-1"
                    />
                    <x-ui.toggle-row
                        wire-model="animations"
                        :label="__('pages.account.appearance.animations_label')"
                        :hint="__('pages.account.appearance.animations_hint')"
                        icon="lucide-sparkles"
                        icon-color="text-secondary-foreground"
                        icon-bg="bg-secondary/10"
                    />

                </x-ui.card-section>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3">
                    <x-ui.button type="button" :outline="true" wire:click="resetPreferences">
                        {{ __('pages.account.appearance.btn_cancel') }}
                    </x-ui.button>
                    <x-ui.button type="button" variant="primary" wire:click="save" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="save" class="flex items-center gap-2">
                            @svg('lucide-check', ['class' => 'size-4'])
                            {{ __('pages.account.appearance.btn_save') }}
                        </span>
                        <span wire:loading wire:target="save" class="flex items-center gap-2">
                            <svg class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            {{ __('pages.account.appearance.btn_saving') }}
                        </span>
                    </x-ui.button>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {

            Livewire.on('toast', ({ variant, message }) => {
                KTToast.show({ message, variant });
            });

            Livewire.on('appearance-saved', ({ preferences: prefs }) => {

                // ── Tema ──────────────────────────────────────────────────
                let themeMode = prefs.theme_mode || 'system';
                if (themeMode === 'system') {
                    themeMode = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                }
                localStorage.setItem('kt-theme', themeMode);
                document.documentElement.classList.remove('light', 'dark');
                document.documentElement.classList.add(themeMode);
                document.documentElement.setAttribute('data-kt-theme-mode', prefs.theme_mode || 'system');

                // ── Layout Width ──────────────────────────────────────────
                document.documentElement.classList.toggle('layout-fluid', prefs.layout_width === 'fluid');

                // ── Sidebar ───────────────────────────────────────────────
                const shouldCollapse = prefs.sidebar_default === 'collapsed' || prefs.sidebar_default === 'hidden';
                document.body.classList.toggle('kt-sidebar-collapse', shouldCollapse);

                // ── Animações ─────────────────────────────────────────────
                let animStyle = document.getElementById('__no-animations');
                if (prefs.animations === false) {
                    if (!animStyle) {
                        animStyle = document.createElement('style');
                        animStyle.id = '__no-animations';
                        animStyle.textContent = '*, *::before, *::after { transition: none !important; animation: none !important; }';
                        document.head.appendChild(animStyle);
                    }
                } else {
                    animStyle?.remove();
                }

                // ── Densidade ─────────────────────────────────────────────
                document.documentElement.classList.remove('density-compact', 'density-comfortable', 'density-spacious');
                document.documentElement.classList.add('density-' + (prefs.density || 'comfortable'));

                // ── Font Size ─────────────────────────────────────────────
                document.documentElement.classList.remove('font-size-sm', 'font-size-md', 'font-size-lg');
                document.documentElement.classList.add('font-size-' + (prefs.font_size || 'md'));

                // ── Font Family ───────────────────────────────────────────
                document.documentElement.classList.remove('font-inter', 'font-system', 'font-mono-custom');
                const fontMap = { inter: 'font-inter', system: 'font-system', mono: 'font-mono-custom' };
                document.documentElement.classList.add(fontMap[prefs.font_family] || 'font-inter');
            });
        });
    </script>

</div>
