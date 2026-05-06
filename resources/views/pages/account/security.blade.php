<?php

use App\Models\UserAccessLog;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Laravel\Fortify\Actions\ConfirmTwoFactorAuthentication;
use Laravel\Fortify\Actions\DisableTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Laravel\Fortify\Actions\GenerateNewRecoveryCodes;

new #[Title('Segurança')] class extends Component
{
    // ---------------------------------------------------------------- Senha
    public string $current_password     = '';
    public string $password             = '';
    public string $password_confirmation = '';

    // ---------------------------------------------------------------- 2FA
    public bool   $showingQrCode        = false;
    public bool   $showingConfirmation  = false;
    public bool   $showingRecoveryCodes = false;
    public string $two_factor_code      = '';

    // ---------------------------------------------------------------- Excluir conta
    public bool   $showDeleteModal = false;
    public string $delete_password = '';

    // ---------------------------------------------------------------- Senha

    public function updatePassword(): void
    {
        $this->validate([
            'current_password' => ['required', 'string'],
            'password'         => ['required', 'string', 'confirmed', Password::defaults()],
        ]);

        $user = Auth::user();

        if (! Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', __('pages.account.security.password_incorrect'));
            return;
        }

        $user->update(['password' => Hash::make($this->password)]);

        $this->current_password      = '';
        $this->password              = '';
        $this->password_confirmation = '';

        $this->dispatch('toast', variant: 'success', message: __('pages.account.security.toast_password_updated'));
    }

    // ---------------------------------------------------------------- 2FA

    public function enableTwoFactorAuthentication(EnableTwoFactorAuthentication $enable): void
    {
        $enable(Auth::user());
        $this->showingQrCode       = true;
        $this->showingConfirmation = true;
    }

    public function confirmTwoFactorAuthentication(ConfirmTwoFactorAuthentication $confirm): void
    {
        $this->validate(['two_factor_code' => ['required', 'string']]);

        try {
            $confirm(Auth::user(), $this->two_factor_code);
        } catch (\Exception) {
            $this->addError('two_factor_code', __('pages.account.security.two_factor_code_invalid'));
            return;
        }

        $this->showingQrCode        = false;
        $this->showingConfirmation  = false;
        $this->showingRecoveryCodes = true;
        $this->two_factor_code      = '';

        $this->dispatch('toast', variant: 'success', message: __('pages.account.security.toast_2fa_enabled'));
    }

    public function disableTwoFactorAuthentication(DisableTwoFactorAuthentication $disable): void
    {
        $disable(Auth::user());

        $this->showingQrCode        = false;
        $this->showingConfirmation  = false;
        $this->showingRecoveryCodes = false;

        $this->dispatch('toast', variant: 'info', message: __('pages.account.security.toast_2fa_disabled'));
    }

    public function regenerateRecoveryCodes(GenerateNewRecoveryCodes $generate): void
    {
        $generate(Auth::user());
        $this->showingRecoveryCodes = true;

        $this->dispatch('toast', variant: 'success', message: __('pages.account.security.toast_recovery_codes_regenerated'));
    }

    public function showRecoveryCodes(): void
    {
        $this->showingRecoveryCodes = true;
    }

    // ---------------------------------------------------------------- Sessões

    public function revokeSession(string $sessionId): void
    {
        DB::table('sessions')
            ->where('id', $sessionId)
            ->where('user_id', Auth::id())
            ->delete();

        $this->dispatch('toast', variant: 'success', message: __('pages.account.security.toast_session_revoked'));
    }

    public function revokeOtherSessions(): void
    {
        $currentSessionId = session()->getId();

        DB::table('sessions')
            ->where('user_id', Auth::id())
            ->where('id', '!=', $currentSessionId)
            ->delete();

        $this->dispatch('toast', variant: 'success', message: __('pages.account.security.toast_sessions_revoked'));
    }

    // ---------------------------------------------------------------- Excluir conta

    public function openDeleteModal(): void
    {
        $this->delete_password = '';
        $this->showDeleteModal = true;
    }

    public function deleteAccount(): void
    {
        $this->validate([
            'delete_password' => ['required', 'string'],
        ]);

        $user = Auth::user();

        if (! Hash::check($this->delete_password, $user->password)) {
            $this->addError('delete_password', __('pages.account.security.password_incorrect'));
            return;
        }

        // Soft delete primeiro, logout depois para não perder a sessão no meio da requisição
        $user->delete();

        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        $this->redirect(route('login'), navigate: true);
    }

    // ---------------------------------------------------------------- Computed

    #[Computed]
    public function twoFactorEnabled(): bool
    {
        return ! is_null(Auth::user()->two_factor_confirmed_at);
    }

    #[Computed]
    public function twoFactorQrCodeSvg(): string
    {
        if (! Auth::user()->two_factor_secret) return '';
        return Auth::user()->twoFactorQrCodeSvg();
    }

    #[Computed]
    public function recoveryCodes(): array
    {
        if (! Auth::user()->two_factor_recovery_codes) return [];
        return json_decode(decrypt(Auth::user()->two_factor_recovery_codes), true) ?? [];
    }

    #[Computed]
    public function activeSessions(): Collection
    {
        $currentSessionId = session()->getId();

        return DB::table('sessions')
            ->where('user_id', Auth::id())
            ->orderByDesc('last_activity')
            ->get()
            ->map(function ($session) use ($currentSessionId) {
                $ua     = $session->user_agent ?? '';
                $parsed = UserAccessLog::parseUserAgent($ua);
                return (object) [
                    'id'            => $session->id,
                    'ip_address'    => $session->ip_address,
                    'device'        => $parsed['device'],
                    'browser'       => $parsed['browser'],
                    'platform'      => $parsed['platform'],
                    'last_activity' => \Carbon\Carbon::createFromTimestamp($session->last_activity),
                    'is_current'    => $session->id === $currentSessionId,
                ];
            });
    }

    #[Computed]
    public function accessHistory(): Collection
    {
        return Auth::user()
            ->accessLogs()
            ->orderByDesc('created_at')
            ->limit(20)
            ->get();
    }
}; ?>

<div class="kt-container-fluid py-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-mono">{{ __('pages.account.security.page_heading') }}</h1>
            <p class="text-sm text-secondary-foreground mt-1">{{ __('pages.account.security.page_subheading') }}</p>
        </div>
    </div>

    <div class="flex flex-col gap-6 max-w-2xl">

        {{-- ================================================================ --}}
        {{-- 1. Alterar Senha --}}
        {{-- ================================================================ --}}
        <div class="kt-card">
            <div class="kt-card-header">
                <h3 class="kt-card-title flex items-center gap-2">
                    @svg('lucide-lock', ['class' => 'size-4 text-primary'])
                    {{ __('pages.account.security.section_password') }}
                </h3>
            </div>
            <div class="kt-card-content flex flex-col gap-4 py-5">
                <p class="text-sm text-secondary-foreground">{{ __('pages.account.security.password_description') }}</p>

                <x-ui.form-field :label="__('pages.account.security.field_current_password')" name="current_password" :required="true">
                    <x-ui.password-input id="current_password" wire:model="current_password"
                                         :placeholder="__('pages.account.security.field_current_password_placeholder')"
                                         autocomplete="current-password" />
                </x-ui.form-field>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <x-ui.form-field :label="__('pages.account.security.field_new_password')" name="password" :required="true">
                        <x-ui.password-input id="password" wire:model="password"
                                             :placeholder="__('pages.account.security.field_new_password_placeholder')"
                                             autocomplete="new-password" />
                    </x-ui.form-field>

                    <x-ui.form-field :label="__('pages.account.security.field_confirm_password')" name="password_confirmation" :required="true">
                        <x-ui.password-input id="password_confirmation" wire:model="password_confirmation"
                                             :placeholder="__('pages.account.security.field_confirm_password_placeholder')"
                                             autocomplete="new-password" />
                    </x-ui.form-field>
                </div>

                <div class="flex justify-end">
                    <x-ui.button variant="primary" wire:click="updatePassword" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="updatePassword" class="flex items-center gap-2">
                            @svg('lucide-check', ['class' => 'size-4'])
                            {{ __('pages.account.security.btn_update_password') }}
                        </span>
                        <span wire:loading wire:target="updatePassword" class="flex items-center gap-2">
                            <svg class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            {{ __('pages.account.security.btn_saving') }}
                        </span>
                    </x-ui.button>
                </div>
            </div>
        </div>

        {{-- ================================================================ --}}
        {{-- 2. Autenticação em Dois Fatores --}}
        {{-- ================================================================ --}}
        <div class="kt-card">
            <div class="kt-card-header">
                <h3 class="kt-card-title flex items-center gap-2">
                    @svg('lucide-shield-check', ['class' => 'size-4 text-primary'])
                    {{ __('pages.account.security.section_2fa') }}
                </h3>
                @if ($this->twoFactorEnabled)
                    <x-ui.badge variant="success" style="outline" size="sm">
                        {{ __('pages.account.security.two_factor_active') }}
                    </x-ui.badge>
                @else
                    <x-ui.badge variant="warning" style="outline" size="sm">
                        {{ __('pages.account.security.two_factor_inactive') }}
                    </x-ui.badge>
                @endif
            </div>
            <div class="kt-card-content flex flex-col gap-4 py-5">
                <p class="text-sm text-secondary-foreground">{{ __('pages.account.security.two_factor_description') }}</p>

                @if (! $this->twoFactorEnabled && ! $showingQrCode)
                    <x-ui.button variant="primary" wire:click="enableTwoFactorAuthentication" wire:loading.attr="disabled">
                        @svg('lucide-shield-plus', ['class' => 'size-4'])
                        {{ __('pages.account.security.btn_enable_2fa') }}
                    </x-ui.button>
                @endif

                @if ($showingQrCode || $showingConfirmation)
                    <div class="p-4 bg-muted rounded-lg border border-input flex flex-col gap-4">
                        <p class="text-sm font-medium text-foreground">{{ __('pages.account.security.two_factor_scan_instruction') }}</p>
                        <div class="flex justify-center">
                            {!! $this->twoFactorQrCodeSvg !!}
                        </div>
                        @if ($showingConfirmation)
                            <x-ui.form-field :label="__('pages.account.security.field_2fa_code')" name="two_factor_code">
                                <x-ui.input id="two_factor_code" wire:model="two_factor_code"
                                            :placeholder="__('pages.account.security.field_2fa_code_placeholder')"
                                            autocomplete="one-time-code"
                                            wire:keydown.enter.prevent="confirmTwoFactorAuthentication" />
                            </x-ui.form-field>
                            <x-ui.button variant="primary" wire:click="confirmTwoFactorAuthentication">
                                {{ __('pages.account.security.btn_confirm_2fa') }}
                            </x-ui.button>
                        @endif
                    </div>
                @endif

                @if ($this->twoFactorEnabled)
                    @if ($showingRecoveryCodes)
                        <div class="p-4 bg-warning/10 border border-warning/30 rounded-lg flex flex-col gap-3">
                            <p class="text-sm font-medium text-warning flex items-center gap-2">
                                @svg('lucide-triangle-alert', ['class' => 'size-4 shrink-0'])
                                {{ __('pages.account.security.recovery_codes_warning') }}
                            </p>
                            <div class="grid grid-cols-2 gap-1.5">
                                @foreach ($this->recoveryCodes as $code)
                                    <code class="text-xs font-mono bg-muted px-2 py-1 rounded text-foreground tracking-wider">{{ $code }}</code>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="flex flex-wrap gap-2">
                        @if (! $showingRecoveryCodes)
                            <x-ui.button :outline="true" size="sm" icon="key-round" wire:click="showRecoveryCodes">
                                {{ __('pages.account.security.btn_show_recovery_codes') }}
                            </x-ui.button>
                        @endif
                        <x-ui.button :outline="true" size="sm" icon="refresh-cw" wire:click="regenerateRecoveryCodes">
                            {{ __('pages.account.security.btn_regenerate_recovery') }}
                        </x-ui.button>
                        <x-ui.button ghost="destructive" size="sm" icon="shield-off" wire:click="disableTwoFactorAuthentication"
                                     wire:confirm="{{ __('pages.account.security.two_factor_disable_confirm') }}">
                            {{ __('pages.account.security.btn_disable_2fa') }}
                        </x-ui.button>
                    </div>
                @endif
            </div>
        </div>

        {{-- ================================================================ --}}
        {{-- 3. Sessões Ativas --}}
        {{-- ================================================================ --}}
        <div class="kt-card">
            <div class="kt-card-header flex items-center justify-between">
                <h3 class="kt-card-title flex items-center gap-2">
                    @svg('lucide-monitor', ['class' => 'size-4 text-primary'])
                    {{ __('pages.account.security.section_sessions') }}
                </h3>
                @if ($this->activeSessions->count() > 1)
                    <x-ui.button ghost="destructive" size="sm" wire:click="revokeOtherSessions"
                                 wire:confirm="{{ __('pages.account.security.sessions_revoke_all_confirm') }}">
                        {{ __('pages.account.security.btn_revoke_all') }}
                    </x-ui.button>
                @endif
            </div>
            <div class="kt-card-content flex flex-col divide-y divide-input py-0">
                @forelse ($this->activeSessions as $session)
                    <div class="flex items-center justify-between gap-3 py-4 px-1">
                        <div class="flex items-center gap-3">
                            <div class="size-9 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                @if ($session->device === 'mobile')
                                    @svg('lucide-smartphone', ['class' => 'size-4 text-primary'])
                                @elseif ($session->device === 'tablet')
                                    @svg('lucide-tablet', ['class' => 'size-4 text-primary'])
                                @else
                                    @svg('lucide-monitor', ['class' => 'size-4 text-primary'])
                                @endif
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-medium text-foreground">
                                        {{ $session->browser }} — {{ $session->platform }}
                                    </span>
                                    @if ($session->is_current)
                                        <x-ui.badge variant="success" size="sm">
                                            {{ __('pages.account.security.session_current') }}
                                        </x-ui.badge>
                                    @endif
                                </div>
                                <span class="text-xs text-secondary-foreground">
                                    {{ $session->ip_address }} · {{ __('pages.account.security.session_last_active') }} {{ $session->last_activity->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                        @if (! $session->is_current)
                            <x-ui.button ghost="destructive" size="sm" :iconOnly="true" icon="x"
                                         wire:click="revokeSession('{{ $session->id }}')"
                                         :tooltip="__('pages.account.security.btn_revoke_session')"
                                         tooltipPlacement="left" />
                        @endif
                    </div>
                @empty
                    <p class="text-sm text-secondary-foreground text-center py-6">
                        {{ __('pages.account.security.sessions_empty') }}
                    </p>
                @endforelse
            </div>
        </div>

        {{-- ================================================================ --}}
        {{-- 4. Histórico de Acesso --}}
        {{-- ================================================================ --}}
        <div class="kt-card">
            <div class="kt-card-header">
                <h3 class="kt-card-title flex items-center gap-2">
                    @svg('lucide-history', ['class' => 'size-4 text-primary'])
                    {{ __('pages.account.security.section_access_history') }}
                </h3>
                <span class="text-xs text-secondary-foreground">{{ __('pages.account.security.access_history_subtitle') }}</span>
            </div>
            <div class="kt-card-content flex flex-col divide-y divide-input py-0">
                @forelse ($this->accessHistory as $log)
                    <div class="flex items-center justify-between gap-3 py-3 px-1">
                        <div class="flex items-center gap-3">
                            <div @class([
                                'size-8 rounded-full flex items-center justify-center shrink-0',
                                'bg-success/10' => $log->event === 'login',
                                'bg-secondary/10' => $log->event === 'logout',
                                'bg-destructive/10' => $log->event === 'failed',
                            ])>
                                @if ($log->event === 'login')
                                    @svg('lucide-log-in', ['class' => 'size-3.5 text-success'])
                                @elseif ($log->event === 'logout')
                                    @svg('lucide-log-out', ['class' => 'size-3.5 text-secondary-foreground'])
                                @else
                                    @svg('lucide-shield-alert', ['class' => 'size-3.5 text-destructive'])
                                @endif
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <span class="text-sm font-medium text-foreground">
                                    {{ $log->browser }} — {{ $log->platform }}
                                </span>
                                <span class="text-xs text-secondary-foreground">
                                    {{ $log->ip_address }} · {{ $log->created_at->format('d/m/Y H:i') }}
                                </span>
                            </div>
                        </div>
                        <x-ui.badge
                            variant="{{ $log->event === 'login' ? 'success' : ($log->event === 'failed' ? 'destructive' : 'secondary') }}"
                            style="outline"
                            size="sm">
                            {{ __('pages.account.security.event_' . $log->event) }}
                        </x-ui.badge>
                    </div>
                @empty
                    <p class="text-sm text-secondary-foreground text-center py-6">
                        {{ __('pages.account.security.access_history_empty') }}
                    </p>
                @endforelse
            </div>
        </div>

        {{-- ================================================================ --}}
        {{-- 5. Zona de Perigo — Excluir Conta --}}
        {{-- ================================================================ --}}
        <div class="kt-card border-destructive/30">
            <div class="kt-card-header border-destructive/20 bg-destructive/5">
                <h3 class="kt-card-title flex items-center gap-2 text-destructive">
                    @svg('lucide-triangle-alert', ['class' => 'size-4'])
                    {{ __('pages.account.security.section_danger') }}
                </h3>
            </div>
            <div class="kt-card-content flex flex-col gap-4 py-5">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex flex-col gap-1">
                        <p class="text-sm font-medium text-foreground">{{ __('pages.account.security.delete_account_label') }}</p>
                        <p class="text-xs text-secondary-foreground">{{ __('pages.account.security.delete_account_description') }}</p>
                    </div>
                    <button type="button" onclick="document.getElementById('delete-account-modal').classList.remove('hidden')"
                            class="kt-btn kt-btn-ghost kt-btn-destructive kt-btn-sm shrink-0">
                        @svg('lucide-trash-2', ['class' => 'size-4'])
                        {{ __('pages.account.security.btn_delete_account') }}
                    </button>
                </div>
            </div>
        </div>

        {{-- Modal: Excluir Conta --}}
        <div id="delete-account-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
            <div class="kt-card w-full max-w-md mx-4 shadow-2xl">
                <div class="kt-card-header border-destructive/20 bg-destructive/5">
                    <h3 class="kt-card-title text-destructive flex items-center gap-2">
                        @svg('lucide-trash-2', ['class' => 'size-4'])
                        {{ __('pages.account.security.delete_modal_title') }}
                    </h3>
                    <button type="button" onclick="document.getElementById('delete-account-modal').classList.add('hidden')"
                            class="text-secondary-foreground hover:text-foreground transition-colors">
                        @svg('lucide-x', ['class' => 'size-4'])
                    </button>
                </div>
                <div class="kt-card-content flex flex-col gap-4 py-5">
                    <p class="text-sm text-secondary-foreground">{{ __('pages.account.security.delete_modal_description') }}</p>

                    <x-ui.alert variant="warning">
                        <p class="text-xs">{{ __('pages.account.security.delete_soft_delete_notice') }}</p>
                    </x-ui.alert>

                    <x-ui.form-field :label="__('pages.account.security.field_confirm_password_label')" name="delete_password" :required="true">
                        <x-ui.password-input id="delete_password" wire:model="delete_password"
                                             :placeholder="__('pages.account.security.field_confirm_password_placeholder')"
                                             autocomplete="current-password" />
                    </x-ui.form-field>

                    @error('delete_password')
                    <p class="text-xs text-destructive">{{ $message }}</p>
                    @enderror
                </div>
                <div class="kt-card-footer flex items-center justify-end gap-3 py-4">
                    <button type="button" onclick="document.getElementById('delete-account-modal').classList.add('hidden')"
                            class="kt-btn kt-btn-outline">
                        {{ __('pages.account.security.btn_cancel') }}
                    </button>
                    <button type="button" wire:click="deleteAccount" class="kt-btn kt-btn-ghost kt-btn-destructive">
                        @svg('lucide-trash-2', ['class' => 'size-4'])
                        {{ __('pages.account.security.btn_confirm_delete') }}
                    </button>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
    Livewire.on('toast', ({ variant, message }) => {
        KTToast.show({ message, variant });
    });
</script>
