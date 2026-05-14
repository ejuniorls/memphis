<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Aparência')] class extends Component
{
    // ---------------------------------------------------------------- Layout
    public string $layout_width    = 'fixed';    // fixed | fluid
    public string $sidebar_default = 'expanded'; // expanded | collapsed | hidden
    public bool   $sidebar_mini    = false;       // mini mode (icons only on hover)

    // ---------------------------------------------------------------- Tema
    public string $theme_mode     = 'system'; // light | dark | system
    public string $primary_color  = 'blue';   // blue | violet | green | orange | rose | slate

    // ---------------------------------------------------------------- Tipografia
    public string $font_size    = 'md'; // sm | md | lg
    public string $font_family  = 'inter'; // inter | system | mono

    // ---------------------------------------------------------------- Densidade
    public string $density = 'comfortable'; // compact | comfortable | spacious

    // ---------------------------------------------------------------- Navegação
    public bool   $topbar_sticky    = true;
    public bool   $show_breadcrumbs = true;
    public bool   $show_page_title  = true;
    public bool   $animations       = true;

    public function mount(): void
    {
        $user  = Auth::user();
        $prefs = $user->appearance_preferences ?? [];

        foreach (array_keys($this->getDefaultPreferences()) as $key) {
            if (array_key_exists($key, $prefs)) {
                $this->$key = $prefs[$key];
            }
        }
    }

    private function getDefaultPreferences(): array
    {
        return [
            'layout_width'    => 'fixed',
            'sidebar_default' => 'expanded',
            'sidebar_mini'    => false,
            'theme_mode'      => 'system',
            'primary_color'   => 'blue',
            'font_size'       => 'md',
            'font_family'     => 'inter',
            'density'         => 'comfortable',
            'topbar_sticky'   => true,
            'show_breadcrumbs'=> true,
            'show_page_title' => true,
            'animations'      => true,
        ];
    }

    public function save(): void
    {
        $data = [];
        foreach (array_keys($this->getDefaultPreferences()) as $key) {
            $data[$key] = $this->$key;
        }

        Auth::user()->update(['appearance_preferences' => $data]);

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

{{-- Div raiz obrigatória do Livewire --}}
<div>

    {{-- ------------------------------------------------------------------ --}}
    {{-- Toolbar                                                              --}}
    {{-- ------------------------------------------------------------------ --}}
    <x-slot name="toolbar">
        <x-ui.breadcrumb>
            <x-ui.breadcrumb-item :first="true" href="{{ route('dashboard') }}">
                {{ __('Home') }}
            </x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item href="{{ route('dashboard') }}">
                {{ __('Account') }}
            </x-ui.breadcrumb-item>
            <x-ui.breadcrumb-item :active="true">
                {{ __('pages.account.appearance.page_heading') }}
            </x-ui.breadcrumb-item>
        </x-ui.breadcrumb>
    </x-slot>

    <x-slot name="toolbarActions">
        <x-ui.button tag="button" type="button" :outline="true" size="sm" icon="rotate-ccw"
                     wire:click="resetPreferences"
                     wire:confirm="{{ __('pages.account.appearance.reset_confirm') }}">
            {{ __('pages.account.appearance.btn_reset') }}
        </x-ui.button>
    </x-slot>

    {{-- ------------------------------------------------------------------ --}}
    {{-- Conteúdo                                                             --}}
    {{-- ------------------------------------------------------------------ --}}
    <div class="py-6">

        {{-- Título --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-mono">{{ __('pages.account.appearance.page_heading') }}</h1>
            <p class="text-sm text-secondary-foreground mt-1">{{ __('pages.account.appearance.page_subheading') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            {{-- ============================================================ --}}
            {{-- Sidebar: Tema e Cor                                           --}}
            {{-- ============================================================ --}}
            <div class="lg:col-span-1 flex flex-col gap-6">

                {{-- Modo de Tema --}}
                <x-ui.card-section
                    icon="lucide-sun-moon"
                    :title="__('pages.account.appearance.section_theme')"
                    contentClass="flex flex-col gap-4 py-4"
                >
                    <p class="text-xs text-secondary-foreground">
                        {{ __('pages.account.appearance.theme_description') }}
                    </p>

                    <div class="flex flex-col gap-2">
                        @foreach ([
                            ['value' => 'light',  'icon' => 'lucide-sun',     'label' => 'appearance.theme_light',  'hint' => 'appearance.theme_light_hint'],
                            ['value' => 'dark',   'icon' => 'lucide-moon',    'label' => 'appearance.theme_dark',   'hint' => 'appearance.theme_dark_hint'],
                            ['value' => 'system', 'icon' => 'lucide-laptop-2','label' => 'appearance.theme_system', 'hint' => 'appearance.theme_system_hint'],
                        ] as $option)
                            <label class="flex items-center gap-3 p-3 rounded-lg border cursor-pointer transition-colors
                                {{ $theme_mode === $option['value'] ? 'border-primary bg-primary/5' : 'border-input hover:bg-muted/50' }}">
                                <input type="radio" class="kt-radio shrink-0" wire:model="theme_mode" value="{{ $option['value'] }}" />
                                <div class="flex items-center gap-2.5 flex-1">
                                    <div class="size-7 rounded-md bg-muted flex items-center justify-center shrink-0">
                                        @svg($option['icon'], ['class' => 'size-3.5 text-foreground'])
                                    </div>
                                    <div class="flex flex-col gap-0.5">
                                        <span class="text-sm font-medium text-foreground">{{ __('pages.account.' . $option['label']) }}</span>
                                        <span class="text-xs text-secondary-foreground">{{ __('pages.account.' . $option['hint']) }}</span>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>

                </x-ui.card-section>

                {{-- Cor Principal --}}
                <x-ui.card-section
                    icon="lucide-palette"
                    :title="__('pages.account.appearance.section_color')"
                    contentClass="flex flex-col gap-4 py-4"
                >
                    <p class="text-xs text-secondary-foreground">
                        {{ __('pages.account.appearance.color_description') }}
                    </p>

                    @php
                        $colors = [
                            ['value' => 'blue',   'bg' => 'bg-blue-500',   'label' => 'appearance.color_blue'],
                            ['value' => 'violet', 'bg' => 'bg-violet-500', 'label' => 'appearance.color_violet'],
                            ['value' => 'green',  'bg' => 'bg-green-500',  'label' => 'appearance.color_green'],
                            ['value' => 'orange', 'bg' => 'bg-orange-500', 'label' => 'appearance.color_orange'],
                            ['value' => 'rose',   'bg' => 'bg-rose-500',   'label' => 'appearance.color_rose'],
                            ['value' => 'slate',  'bg' => 'bg-slate-600',  'label' => 'appearance.color_slate'],
                        ];
                    @endphp

                    <div class="grid grid-cols-3 gap-2">
                        @foreach ($colors as $color)
                            <label class="flex flex-col items-center gap-2 p-2 rounded-lg border cursor-pointer transition-colors
                                {{ $primary_color === $color['value'] ? 'border-primary bg-primary/5' : 'border-input hover:bg-muted/50' }}">
                                <input type="radio" class="sr-only" wire:model="primary_color" value="{{ $color['value'] }}" />
                                <div class="size-8 rounded-full {{ $color['bg'] }} flex items-center justify-center">
                                    @if ($primary_color === $color['value'])
                                        @svg('lucide-check', ['class' => 'size-4 text-white'])
                                    @endif
                                </div>
                                <span class="text-xs text-foreground font-medium">{{ __('pages.account.' . $color['label']) }}</span>
                            </label>
                        @endforeach
                    </div>

                </x-ui.card-section>

                {{-- Tipografia --}}
                <x-ui.card-section
                    icon="lucide-type"
                    :title="__('pages.account.appearance.section_typography')"
                    contentClass="flex flex-col gap-4 py-4"
                >
                    {{-- Família de fonte --}}
                    <x-ui.form-field :label="__('pages.account.appearance.field_font_family')" name="font_family">
                        <x-ui.select wire:model="font_family">
                            <option value="inter">Inter (padrão)</option>
                            <option value="system">System UI</option>
                            <option value="mono">Monospace</option>
                        </x-ui.select>
                    </x-ui.form-field>

                    {{-- Tamanho de fonte --}}
                    <div class="flex flex-col gap-2">
                        <span class="text-sm font-medium text-foreground">{{ __('pages.account.appearance.field_font_size') }}</span>
                        <div class="flex gap-2">
                            @foreach ([
                                ['value' => 'sm', 'label' => 'appearance.font_sm'],
                                ['value' => 'md', 'label' => 'appearance.font_md'],
                                ['value' => 'lg', 'label' => 'appearance.font_lg'],
                            ] as $size)
                                <label class="flex-1 text-center p-2 rounded-lg border cursor-pointer transition-colors
                                    {{ $font_size === $size['value'] ? 'border-primary bg-primary/5 text-primary' : 'border-input hover:bg-muted/50 text-foreground' }}">
                                    <input type="radio" class="sr-only" wire:model="font_size" value="{{ $size['value'] }}" />
                                    <span class="text-sm font-medium">{{ __('pages.account.' . $size['label']) }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                </x-ui.card-section>

            </div>

            {{-- ============================================================ --}}
            {{-- Main: Layout, Sidebar, Densidade e Navegação                 --}}
            {{-- ============================================================ --}}
            <div class="lg:col-span-2 flex flex-col gap-6">

                {{-- Layout --}}
                <x-ui.card-section
                    icon="lucide-layout"
                    :title="__('pages.account.appearance.section_layout')"
                    contentClass="flex flex-col gap-5 py-4"
                >
                    <x-slot name="subtitle">{{ __('pages.account.appearance.section_layout_subtitle') }}</x-slot>

                    {{-- Largura do container --}}
                    <div class="flex flex-col gap-3">
                        <span class="text-sm font-medium text-foreground">{{ __('pages.account.appearance.field_layout_width') }}</span>
                        <div class="grid grid-cols-2 gap-3">

                            {{-- Fixed --}}
                            <label class="flex flex-col gap-3 p-4 rounded-xl border-2 cursor-pointer transition-all
                                {{ $layout_width === 'fixed' ? 'border-primary bg-primary/5' : 'border-input hover:border-input/80 hover:bg-muted/50' }}">
                                <input type="radio" class="sr-only" wire:model="layout_width" value="fixed" />
                                {{-- Preview --}}
                                <div class="w-full h-12 rounded-md bg-muted flex items-center justify-center overflow-hidden relative">
                                    <div class="w-3/5 h-full bg-background border border-input rounded-sm flex flex-col gap-1 px-1.5 pt-1.5">
                                        <div class="w-full h-1.5 rounded-full bg-muted-foreground/20"></div>
                                        <div class="w-4/5 h-1 rounded-full bg-muted-foreground/15"></div>
                                        <div class="w-3/5 h-1 rounded-full bg-muted-foreground/15"></div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex flex-col gap-0.5">
                                        <span class="text-sm font-semibold text-foreground">{{ __('pages.account.appearance.layout_fixed') }}</span>
                                        <span class="text-xs text-secondary-foreground">{{ __('pages.account.appearance.layout_fixed_hint') }}</span>
                                    </div>
                                    @if ($layout_width === 'fixed')
                                        <div class="size-5 rounded-full bg-primary flex items-center justify-center shrink-0">
                                            @svg('lucide-check', ['class' => 'size-3 text-primary-foreground'])
                                        </div>
                                    @endif
                                </div>
                            </label>

                            {{-- Fluid --}}
                            <label class="flex flex-col gap-3 p-4 rounded-xl border-2 cursor-pointer transition-all
                                {{ $layout_width === 'fluid' ? 'border-primary bg-primary/5' : 'border-input hover:border-input/80 hover:bg-muted/50' }}">
                                <input type="radio" class="sr-only" wire:model="layout_width" value="fluid" />
                                {{-- Preview --}}
                                <div class="w-full h-12 rounded-md bg-muted flex items-center justify-center overflow-hidden relative">
                                    <div class="w-full h-full bg-background border border-input rounded-sm flex flex-col gap-1 px-1.5 pt-1.5 mx-1">
                                        <div class="w-full h-1.5 rounded-full bg-muted-foreground/20"></div>
                                        <div class="w-4/5 h-1 rounded-full bg-muted-foreground/15"></div>
                                        <div class="w-3/5 h-1 rounded-full bg-muted-foreground/15"></div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between gap-2">
                                    <div class="flex flex-col gap-0.5">
                                        <span class="text-sm font-semibold text-foreground">{{ __('pages.account.appearance.layout_fluid') }}</span>
                                        <span class="text-xs text-secondary-foreground">{{ __('pages.account.appearance.layout_fluid_hint') }}</span>
                                    </div>
                                    @if ($layout_width === 'fluid')
                                        <div class="size-5 rounded-full bg-primary flex items-center justify-center shrink-0">
                                            @svg('lucide-check', ['class' => 'size-3 text-primary-foreground'])
                                        </div>
                                    @endif
                                </div>
                            </label>

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
                                ['value' => 'compact',     'icon' => 'lucide-align-justify',  'label' => 'appearance.density_compact',     'hint' => 'appearance.density_compact_hint'],
                                ['value' => 'comfortable', 'icon' => 'lucide-layout-list',    'label' => 'appearance.density_comfortable', 'hint' => 'appearance.density_comfortable_hint'],
                                ['value' => 'spacious',    'icon' => 'lucide-rows-3',          'label' => 'appearance.density_spacious',    'hint' => 'appearance.density_spacious_hint'],
                            ] as $opt)
                                <label class="flex flex-col items-center gap-2 p-3 rounded-lg border-2 cursor-pointer transition-colors
                                    {{ $density === $opt['value'] ? 'border-primary bg-primary/5' : 'border-input hover:bg-muted/50' }}">
                                    <input type="radio" class="sr-only" wire:model="density" value="{{ $opt['value'] }}" />
                                    @svg($opt['icon'], ['class' => 'size-5 ' . ($density === $opt['value'] ? 'text-primary' : 'text-muted-foreground')])
                                    <div class="flex flex-col items-center gap-0.5">
                                        <span class="text-xs font-semibold text-foreground">{{ __('pages.account.' . $opt['label']) }}</span>
                                        <span class="text-[10px] text-secondary-foreground text-center leading-tight">{{ __('pages.account.' . $opt['hint']) }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                </x-ui.card-section>

                {{-- Sidebar --}}
                <x-ui.card-section
                    icon="lucide-panel-left"
                    :title="__('pages.account.appearance.section_sidebar')"
                    contentClass="flex flex-col gap-5 py-4"
                >
                    <x-slot name="subtitle">{{ __('pages.account.appearance.section_sidebar_subtitle') }}</x-slot>

                    {{-- Estado padrão do sidebar --}}
                    <div class="flex flex-col gap-3">
                        <span class="text-sm font-medium text-foreground">{{ __('pages.account.appearance.field_sidebar_default') }}</span>
                        <div class="grid grid-cols-3 gap-2">

                            @foreach ([
                                ['value' => 'expanded',  'icon' => 'lucide-panel-left-open',  'label' => 'appearance.sidebar_expanded',  'hint' => 'appearance.sidebar_expanded_hint'],
                                ['value' => 'collapsed', 'icon' => 'lucide-panel-left-close', 'label' => 'appearance.sidebar_collapsed', 'hint' => 'appearance.sidebar_collapsed_hint'],
                                ['value' => 'hidden',    'icon' => 'lucide-layout-template',  'label' => 'appearance.sidebar_hidden',    'hint' => 'appearance.sidebar_hidden_hint'],
                            ] as $opt)
                                <label class="flex flex-col items-center gap-2 p-3 rounded-lg border-2 cursor-pointer transition-colors
                                    {{ $sidebar_default === $opt['value'] ? 'border-primary bg-primary/5' : 'border-input hover:bg-muted/50' }}">
                                    <input type="radio" class="sr-only" wire:model="sidebar_default" value="{{ $opt['value'] }}" />
                                    @svg($opt['icon'], ['class' => 'size-5 ' . ($sidebar_default === $opt['value'] ? 'text-primary' : 'text-muted-foreground')])
                                    <div class="flex flex-col items-center gap-0.5">
                                        <span class="text-xs font-semibold text-foreground">{{ __('pages.account.' . $opt['label']) }}</span>
                                        <span class="text-[10px] text-secondary-foreground text-center leading-tight">{{ __('pages.account.' . $opt['hint']) }}</span>
                                    </div>
                                </label>
                            @endforeach

                        </div>
                    </div>

                    <x-ui.divider />

                    {{-- Modo mini --}}
                    <label class="flex items-center justify-between gap-4 cursor-pointer">
                        <div class="flex items-center gap-3">
                            <div class="size-9 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                @svg('lucide-sidebar', ['class' => 'size-4 text-primary'])
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <span class="text-sm font-medium text-foreground">{{ __('pages.account.appearance.sidebar_mini_label') }}</span>
                                <span class="text-xs text-secondary-foreground">{{ __('pages.account.appearance.sidebar_mini_hint') }}</span>
                            </div>
                        </div>
                        <input type="checkbox" class="kt-switch shrink-0" wire:model="sidebar_mini" />
                    </label>

                </x-ui.card-section>

                {{-- Navegação & Interface --}}
                <x-ui.card-section
                    icon="lucide-sliders-horizontal"
                    :title="__('pages.account.appearance.section_interface')"
                    contentClass="flex flex-col divide-y divide-input py-0"
                >
                    <x-slot name="subtitle">{{ __('pages.account.appearance.section_interface_subtitle') }}</x-slot>

                    @php
                        $interfaceOptions = [
                            [
                                'key'   => 'topbar_sticky',
                                'icon'  => 'lucide-pin',
                                'label' => 'appearance.topbar_sticky_label',
                                'hint'  => 'appearance.topbar_sticky_hint',
                                'color' => 'text-primary',
                                'bg'    => 'bg-primary/10',
                            ],
                            [
                                'key'   => 'show_breadcrumbs',
                                'icon'  => 'lucide-navigation',
                                'label' => 'appearance.breadcrumbs_label',
                                'hint'  => 'appearance.breadcrumbs_hint',
                                'color' => 'text-primary',
                                'bg'    => 'bg-primary/10',
                            ],
                            [
                                'key'   => 'show_page_title',
                                'icon'  => 'lucide-heading-1',
                                'label' => 'appearance.page_title_label',
                                'hint'  => 'appearance.page_title_hint',
                                'color' => 'text-primary',
                                'bg'    => 'bg-primary/10',
                            ],
                            [
                                'key'   => 'animations',
                                'icon'  => 'lucide-sparkles',
                                'label' => 'appearance.animations_label',
                                'hint'  => 'appearance.animations_hint',
                                'color' => 'text-secondary-foreground',
                                'bg'    => 'bg-secondary/10',
                            ],
                        ];
                    @endphp

                    @foreach ($interfaceOptions as $opt)
                        <div class="flex items-center justify-between gap-4 py-4 px-1">
                            <div class="flex items-center gap-3">
                                <div class="size-9 rounded-full {{ $opt['bg'] }} flex items-center justify-center shrink-0">
                                    @svg($opt['icon'], ['class' => 'size-4 ' . $opt['color']])
                                </div>
                                <div class="flex flex-col gap-0.5">
                                    <span class="text-sm font-medium text-foreground">{{ __('pages.account.' . $opt['label']) }}</span>
                                    <span class="text-xs text-secondary-foreground">{{ __('pages.account.' . $opt['hint']) }}</span>
                                </div>
                            </div>
                            <input type="checkbox" class="kt-switch shrink-0" wire:model="{{ $opt['key'] }}" />
                        </div>
                    @endforeach

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
        });
    </script>

</div>
