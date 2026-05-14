<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Notificações')] class extends Component
{
    // ---------------------------------------------------------------- Canais
    public bool $notify_inapp   = true;
    public bool $notify_email   = true;
    public bool $notify_push    = false;
    public bool $notify_sms     = false;

    // ---------------------------------------------------------------- Eventos - Conta
    public bool $notify_login_new_device    = true;
    public bool $notify_password_changed    = true;
    public bool $notify_email_changed       = true;
    public bool $notify_two_factor_changed  = true;

    // ---------------------------------------------------------------- Eventos - Atividade
    public bool $notify_mentions            = true;
    public bool $notify_comments            = true;
    public bool $notify_assignments         = true;
    public bool $notify_deadlines           = true;
    public bool $notify_status_updates      = false;

    // ---------------------------------------------------------------- Eventos - Sistema
    public bool $notify_maintenance         = true;
    public bool $notify_new_features        = false;
    public bool $notify_billing             = true;
    public bool $notify_team_invites        = true;

    // ---------------------------------------------------------------- Frequência & Resumo
    public string $digest_frequency = 'realtime'; // realtime | daily | weekly | never
    public string $quiet_hours_start = '22:00';
    public string $quiet_hours_end   = '08:00';
    public bool   $quiet_hours_enabled = false;

    public function mount(): void
    {
        $user = Auth::user();

        // Carrega preferências salvas (se existirem no model/settings)
        $prefs = $user->notification_preferences ?? [];

        foreach (array_keys($this->getDefaultPreferences()) as $key) {
            if (array_key_exists($key, $prefs)) {
                $this->$key = $prefs[$key];
            }
        }
    }

    private function getDefaultPreferences(): array
    {
        return [
            'notify_inapp'              => true,
            'notify_email'              => true,
            'notify_push'               => false,
            'notify_sms'                => false,
            'notify_login_new_device'   => true,
            'notify_password_changed'   => true,
            'notify_email_changed'      => true,
            'notify_two_factor_changed' => true,
            'notify_mentions'           => true,
            'notify_comments'           => true,
            'notify_assignments'        => true,
            'notify_deadlines'          => true,
            'notify_status_updates'     => false,
            'notify_maintenance'        => true,
            'notify_new_features'       => false,
            'notify_billing'            => true,
            'notify_team_invites'       => true,
            'digest_frequency'          => 'realtime',
            'quiet_hours_enabled'       => false,
            'quiet_hours_start'         => '22:00',
            'quiet_hours_end'           => '08:00',
        ];
    }

    public function save(): void
    {
        $prefs = $this->getDefaultPreferences();

        $data = [];
        foreach (array_keys($prefs) as $key) {
            $data[$key] = $this->$key;
        }

        Auth::user()->update(['notification_preferences' => $data]);

        $this->dispatch('toast', variant: 'success', message: __('pages.account.notifications.toast_saved'));
    }

    public function resetPreferences(): void
    {
        foreach ($this->getDefaultPreferences() as $key => $value) {
            $this->$key = $value;
        }
    }

    public function disableAll(): void
    {
        $boolKeys = [
            'notify_inapp', 'notify_email', 'notify_push', 'notify_sms',
            'notify_login_new_device', 'notify_password_changed', 'notify_email_changed',
            'notify_two_factor_changed', 'notify_mentions', 'notify_comments',
            'notify_assignments', 'notify_deadlines', 'notify_status_updates',
            'notify_maintenance', 'notify_new_features', 'notify_billing', 'notify_team_invites',
        ];

        foreach ($boolKeys as $key) {
            $this->$key = false;
        }

        $this->dispatch('toast', variant: 'info', message: __('pages.account.notifications.toast_all_disabled'));
    }

    #[Computed]
    public function activeChannelsCount(): int
    {
        return collect([
            $this->notify_inapp,
            $this->notify_email,
            $this->notify_push,
            $this->notify_sms,
        ])->filter()->count();
    }

    #[Computed]
    public function digestFrequencyLabel(): string
    {
        return match ($this->digest_frequency) {
            'realtime' => __('pages.account.notifications.digest_realtime'),
            'daily'    => __('pages.account.notifications.digest_daily'),
            'weekly'   => __('pages.account.notifications.digest_weekly'),
            'never'    => __('pages.account.notifications.digest_never'),
            default    => '',
        };
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
                {{ __('pages.account.notifications.page_heading') }}
            </x-ui.breadcrumb-item>
        </x-ui.breadcrumb>
    </x-slot>

    <x-slot name="toolbarActions">
        <x-ui.button tag="button" type="button" :outline="true" size="sm" icon="bell-off"
                     wire:click="disableAll"
                     wire:confirm="{{ __('pages.account.notifications.disable_all_confirm') }}">
            {{ __('pages.account.notifications.btn_disable_all') }}
        </x-ui.button>
    </x-slot>

    {{-- ------------------------------------------------------------------ --}}
    {{-- Conteúdo                                                             --}}
    {{-- ------------------------------------------------------------------ --}}
    <div class="py-6">

        {{-- Título --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-mono">{{ __('pages.account.notifications.page_heading') }}</h1>
            <p class="text-sm text-secondary-foreground mt-1">{{ __('pages.account.notifications.page_subheading') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            {{-- ============================================================ --}}
            {{-- Sidebar: Canais + Resumo + Horário Silencioso                --}}
            {{-- ============================================================ --}}
            <div class="lg:col-span-1 flex flex-col gap-6">

                {{-- Canais de notificação --}}
                <x-ui.card-section
                    icon="lucide-radio"
                    :title="__('pages.account.notifications.section_channels')"
                    contentClass="flex flex-col gap-5 py-4"
                >
                    <p class="text-xs text-secondary-foreground">
                        {{ __('pages.account.notifications.channels_description') }}
                    </p>

                    {{-- In-App --}}
                    <label class="flex items-center justify-between gap-3 cursor-pointer">
                        <div class="flex items-center gap-3">
                            <div class="size-8 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
                                @svg('lucide-bell', ['class' => 'size-4 text-primary'])
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <span class="text-sm font-medium text-foreground">{{ __('pages.account.notifications.channel_inapp') }}</span>
                                <span class="text-xs text-secondary-foreground">{{ __('pages.account.notifications.channel_inapp_hint') }}</span>
                            </div>
                        </div>
                        <input type="checkbox" class="kt-switch" wire:model="notify_inapp" />
                    </label>

                    <x-ui.divider />

                    {{-- E-mail --}}
                    <label class="flex items-center justify-between gap-3 cursor-pointer">
                        <div class="flex items-center gap-3">
                            <div class="size-8 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
                                @svg('lucide-mail', ['class' => 'size-4 text-primary'])
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <span class="text-sm font-medium text-foreground">{{ __('pages.account.notifications.channel_email') }}</span>
                                <span class="text-xs text-secondary-foreground">{{ __('pages.account.notifications.channel_email_hint') }}</span>
                            </div>
                        </div>
                        <input type="checkbox" class="kt-switch" wire:model="notify_email" />
                    </label>

                    <x-ui.divider />

                    {{-- Push --}}
                    <label class="flex items-center justify-between gap-3 cursor-pointer">
                        <div class="flex items-center gap-3">
                            <div class="size-8 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
                                @svg('lucide-smartphone', ['class' => 'size-4 text-primary'])
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <span class="text-sm font-medium text-foreground">{{ __('pages.account.notifications.channel_push') }}</span>
                                <span class="text-xs text-secondary-foreground">{{ __('pages.account.notifications.channel_push_hint') }}</span>
                            </div>
                        </div>
                        <input type="checkbox" class="kt-switch" wire:model="notify_push" />
                    </label>

                    <x-ui.divider />

                    {{-- SMS --}}
                    <label class="flex items-center justify-between gap-3 cursor-pointer">
                        <div class="flex items-center gap-3">
                            <div class="size-8 rounded-lg bg-primary/10 flex items-center justify-center shrink-0">
                                @svg('lucide-message-square', ['class' => 'size-4 text-primary'])
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <span class="text-sm font-medium text-foreground">{{ __('pages.account.notifications.channel_sms') }}</span>
                                <span class="text-xs text-secondary-foreground">{{ __('pages.account.notifications.channel_sms_hint') }}</span>
                            </div>
                        </div>
                        <input type="checkbox" class="kt-switch" wire:model="notify_sms" />
                    </label>

                    {{-- Resumo de canais ativos --}}
                    @if ($this->activeChannelsCount > 0)
                        <div class="mt-1 p-3 rounded-lg bg-success/10 border border-success/20">
                            <p class="text-xs text-success font-medium flex items-center gap-1.5">
                                @svg('lucide-check-circle-2', ['class' => 'size-3.5 shrink-0'])
                                {{ $this->activeChannelsCount }} {{ __('pages.account.notifications.channels_active_count') }}
                            </p>
                        </div>
                    @else
                        <div class="mt-1 p-3 rounded-lg bg-warning/10 border border-warning/20">
                            <p class="text-xs text-warning font-medium flex items-center gap-1.5">
                                @svg('lucide-triangle-alert', ['class' => 'size-3.5 shrink-0'])
                                {{ __('pages.account.notifications.channels_none_warning') }}
                            </p>
                        </div>
                    @endif

                </x-ui.card-section>

                {{-- Frequência do resumo (digest) --}}
                <x-ui.card-section
                    icon="lucide-clock"
                    :title="__('pages.account.notifications.section_digest')"
                    contentClass="flex flex-col gap-4 py-4"
                >
                    <p class="text-xs text-secondary-foreground">
                        {{ __('pages.account.notifications.digest_description') }}
                    </p>

                    <div class="flex flex-col gap-2">
                        @foreach (['realtime', 'daily', 'weekly', 'never'] as $freq)
                            <label class="flex items-center gap-3 p-3 rounded-lg border cursor-pointer transition-colors
                                {{ $digest_frequency === $freq ? 'border-primary bg-primary/5' : 'border-input hover:bg-muted/50' }}">
                                <input type="radio" class="kt-radio shrink-0" wire:model="digest_frequency" value="{{ $freq }}" />
                                <div class="flex flex-col gap-0.5">
                                    <span class="text-sm font-medium text-foreground">{{ __('pages.account.notifications.digest_' . $freq) }}</span>
                                    <span class="text-xs text-secondary-foreground">{{ __('pages.account.notifications.digest_' . $freq . '_hint') }}</span>
                                </div>
                            </label>
                        @endforeach
                    </div>

                </x-ui.card-section>

                {{-- Horário silencioso --}}
                <x-ui.card-section
                    icon="lucide-moon"
                    :title="__('pages.account.notifications.section_quiet_hours')"
                    contentClass="flex flex-col gap-4 py-4"
                >
                    <label class="flex items-center justify-between gap-3 cursor-pointer">
                        <div class="flex flex-col gap-0.5">
                            <span class="text-sm font-medium text-foreground">{{ __('pages.account.notifications.quiet_hours_enable') }}</span>
                            <span class="text-xs text-secondary-foreground">{{ __('pages.account.notifications.quiet_hours_hint') }}</span>
                        </div>
                        <input type="checkbox" class="kt-switch" wire:model="quiet_hours_enabled" />
                    </label>

                    @if ($quiet_hours_enabled)
                        <x-ui.divider />
                        <div class="grid grid-cols-2 gap-3">
                            <x-ui.form-field :label="__('pages.account.notifications.quiet_hours_start')" name="quiet_hours_start">
                                <x-ui.input type="time" wire:model="quiet_hours_start" icon="sunrise" />
                            </x-ui.form-field>
                            <x-ui.form-field :label="__('pages.account.notifications.quiet_hours_end')" name="quiet_hours_end">
                                <x-ui.input type="time" wire:model="quiet_hours_end" icon="sunset" />
                            </x-ui.form-field>
                        </div>
                        <p class="text-xs text-secondary-foreground flex items-start gap-1.5">
                            @svg('lucide-info', ['class' => 'size-3.5 shrink-0 mt-0.5'])
                            {{ __('pages.account.notifications.quiet_hours_info') }}
                        </p>
                    @endif

                </x-ui.card-section>

            </div>

            {{-- ============================================================ --}}
            {{-- Main: Preferências por tipo de evento                        --}}
            {{-- ============================================================ --}}
            <div class="lg:col-span-2 flex flex-col gap-6">

                {{-- Segurança da Conta --}}
                <x-ui.card-section
                    icon="lucide-shield-check"
                    :title="__('pages.account.notifications.section_security')"
                    contentClass="flex flex-col divide-y divide-input py-0"
                >
                    <x-slot name="subtitle">{{ __('pages.account.notifications.section_security_subtitle') }}</x-slot>

                    @php
                        $securityEvents = [
                            ['key' => 'notify_login_new_device',   'icon' => 'lucide-monitor-smartphone', 'label' => 'notifications.event_login_new_device',   'hint' => 'notifications.event_login_new_device_hint',   'badge' => 'warning'],
                            ['key' => 'notify_password_changed',   'icon' => 'lucide-key-round',          'label' => 'notifications.event_password_changed',   'hint' => 'notifications.event_password_changed_hint',   'badge' => 'warning'],
                            ['key' => 'notify_email_changed',      'icon' => 'lucide-mail-check',         'label' => 'notifications.event_email_changed',      'hint' => 'notifications.event_email_changed_hint',      'badge' => 'warning'],
                            ['key' => 'notify_two_factor_changed', 'icon' => 'lucide-shield',             'label' => 'notifications.event_2fa_changed',        'hint' => 'notifications.event_2fa_changed_hint',        'badge' => 'warning'],
                        ];
                    @endphp

                    @foreach ($securityEvents as $event)
                        <div class="flex items-center justify-between gap-4 py-4 px-1">
                            <div class="flex items-center gap-3">
                                <div class="size-9 rounded-full bg-warning/10 flex items-center justify-center shrink-0">
                                    @svg($event['icon'], ['class' => 'size-4 text-warning'])
                                </div>
                                <div class="flex flex-col gap-0.5">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <span class="text-sm font-medium text-foreground">
                                            {{ __('pages.account.' . $event['label']) }}
                                        </span>
                                        <x-ui.badge variant="warning" style="outline" size="sm">
                                            {{ __('pages.account.notifications.badge_recommended') }}
                                        </x-ui.badge>
                                    </div>
                                    <span class="text-xs text-secondary-foreground">
                                        {{ __('pages.account.' . $event['hint']) }}
                                    </span>
                                </div>
                            </div>
                            <input type="checkbox" class="kt-switch shrink-0" wire:model="{{ $event['key'] }}" />
                        </div>
                    @endforeach

                </x-ui.card-section>

                {{-- Atividade & Colaboração --}}
                <x-ui.card-section
                    icon="lucide-users"
                    :title="__('pages.account.notifications.section_activity')"
                    contentClass="flex flex-col divide-y divide-input py-0"
                >
                    <x-slot name="subtitle">{{ __('pages.account.notifications.section_activity_subtitle') }}</x-slot>

                    @php
                        $activityEvents = [
                            ['key' => 'notify_mentions',        'icon' => 'lucide-at-sign',       'label' => 'notifications.event_mentions',       'hint' => 'notifications.event_mentions_hint'],
                            ['key' => 'notify_comments',        'icon' => 'lucide-message-circle', 'label' => 'notifications.event_comments',       'hint' => 'notifications.event_comments_hint'],
                            ['key' => 'notify_assignments',     'icon' => 'lucide-clipboard-list', 'label' => 'notifications.event_assignments',    'hint' => 'notifications.event_assignments_hint'],
                            ['key' => 'notify_deadlines',       'icon' => 'lucide-calendar-clock', 'label' => 'notifications.event_deadlines',      'hint' => 'notifications.event_deadlines_hint'],
                            ['key' => 'notify_status_updates',  'icon' => 'lucide-refresh-cw',    'label' => 'notifications.event_status_updates', 'hint' => 'notifications.event_status_updates_hint'],
                        ];
                    @endphp

                    @foreach ($activityEvents as $event)
                        <div class="flex items-center justify-between gap-4 py-4 px-1">
                            <div class="flex items-center gap-3">
                                <div class="size-9 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                    @svg($event['icon'], ['class' => 'size-4 text-primary'])
                                </div>
                                <div class="flex flex-col gap-0.5">
                                    <span class="text-sm font-medium text-foreground">
                                        {{ __('pages.account.' . $event['label']) }}
                                    </span>
                                    <span class="text-xs text-secondary-foreground">
                                        {{ __('pages.account.' . $event['hint']) }}
                                    </span>
                                </div>
                            </div>
                            <input type="checkbox" class="kt-switch shrink-0" wire:model="{{ $event['key'] }}" />
                        </div>
                    @endforeach

                </x-ui.card-section>

                {{-- Sistema & Plataforma --}}
                <x-ui.card-section
                    icon="lucide-settings-2"
                    :title="__('pages.account.notifications.section_system')"
                    contentClass="flex flex-col divide-y divide-input py-0"
                >
                    <x-slot name="subtitle">{{ __('pages.account.notifications.section_system_subtitle') }}</x-slot>

                    @php
                        $systemEvents = [
                            ['key' => 'notify_maintenance',  'icon' => 'lucide-wrench',      'label' => 'notifications.event_maintenance',  'hint' => 'notifications.event_maintenance_hint'],
                            ['key' => 'notify_new_features', 'icon' => 'lucide-sparkles',    'label' => 'notifications.event_new_features', 'hint' => 'notifications.event_new_features_hint'],
                            ['key' => 'notify_billing',      'icon' => 'lucide-credit-card', 'label' => 'notifications.event_billing',      'hint' => 'notifications.event_billing_hint'],
                            ['key' => 'notify_team_invites', 'icon' => 'lucide-user-plus',   'label' => 'notifications.event_team_invites', 'hint' => 'notifications.event_team_invites_hint'],
                        ];
                    @endphp

                    @foreach ($systemEvents as $event)
                        <div class="flex items-center justify-between gap-4 py-4 px-1">
                            <div class="flex items-center gap-3">
                                <div class="size-9 rounded-full bg-secondary/10 flex items-center justify-center shrink-0">
                                    @svg($event['icon'], ['class' => 'size-4 text-secondary-foreground'])
                                </div>
                                <div class="flex flex-col gap-0.5">
                                    <span class="text-sm font-medium text-foreground">
                                        {{ __('pages.account.' . $event['label']) }}
                                    </span>
                                    <span class="text-xs text-secondary-foreground">
                                        {{ __('pages.account.' . $event['hint']) }}
                                    </span>
                                </div>
                            </div>
                            <input type="checkbox" class="kt-switch shrink-0" wire:model="{{ $event['key'] }}" />
                        </div>
                    @endforeach

                </x-ui.card-section>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3">
                    <x-ui.button type="button" :outline="true" wire:click="resetPreferences">
                        {{ __('pages.account.notifications.btn_reset') }}
                    </x-ui.button>
                    <x-ui.button type="button" variant="primary" wire:click="save" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="save" class="flex items-center gap-2">
                            @svg('lucide-check', ['class' => 'size-4'])
                            {{ __('pages.account.notifications.btn_save') }}
                        </span>
                        <span wire:loading wire:target="save" class="flex items-center gap-2">
                            <svg class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            {{ __('pages.account.notifications.btn_saving') }}
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
