<?php

use App\Concerns\ProfileValidationRules;
use App\Enums\ContactType;
use App\Enums\IntegrationSystem;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Title('Meu Perfil')] class extends Component
{
    use ProfileValidationRules, WithFileUploads;

    public string $name           = '';
    public string $email          = '';
    public string $bio            = '';
    public string $job_title      = '';
    public string $company        = '';
    public string $location       = '';
    public string $website        = '';
    public string $linkedin       = '';
    public string $github         = '';
    public string $twitter        = '';
    public string $instagram      = '';
    public bool   $profile_public = true;
    public bool   $show_email     = false;
    public        $avatar_upload  = null;

    public array $contacts     = [];
    public array $integrations = [];

    public string $new_contact_type            = '';
    public string $new_contact_number          = '';
    public string $new_integration_system      = '';
    public string $new_integration_external_id = '';

    public function mount(): void
    {
        $user = Auth::user();

        $this->name           = $user->name          ?? '';
        $this->email          = $user->email         ?? '';
        $this->bio            = $user->bio           ?? '';
        $this->job_title      = $user->job_title     ?? '';
        $this->company        = $user->company       ?? '';
        $this->location       = $user->location      ?? '';
        $this->website        = $user->website       ?? '';
        $this->linkedin       = $user->linkedin      ?? '';
        $this->github         = $user->github        ?? '';
        $this->twitter        = $user->twitter       ?? '';
        $this->instagram      = $user->instagram     ?? '';
        $this->profile_public = (bool) ($user->profile_public ?? true);
        $this->show_email     = (bool) ($user->show_email     ?? false);

        $this->loadContacts();
        $this->loadIntegrations();
    }

    public function resetForm(): void
    {
        $this->mount();
    }

    private function loadContacts(): void
    {
        $this->contacts = Auth::user()
            ->contacts()
            ->orderByDesc('is_primary')
            ->orderBy('id')
            ->get()
            ->map(fn($c) => [
                'id'         => $c->id,
                'type'       => $c->type->value,
                'type_label' => $c->type->label(),
                'type_icon'  => $c->type->icon(),
                'number'     => $c->number,
                'is_primary' => $c->is_primary,
            ])
            ->toArray();
    }

    private function loadIntegrations(): void
    {
        $this->integrations = Auth::user()
            ->integrations()
            ->get()
            ->map(fn($i) => [
                'id'           => $i->id,
                'system'       => $i->system->value,
                'system_label' => $i->system->label(),
                'system_icon'  => $i->system->icon(),
                'external_id'  => $i->external_id,
                'active'       => $i->active,
            ])
            ->toArray();
    }

    // ---------------------------------------------------------------- Perfil

    public function updateProfileInformation(): void
    {
        $user      = Auth::user();
        $validated = $this->validate($this->profileRules($user->id));

        if ($this->avatar_upload) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $this->avatar_upload->store('avatars', 'public');
        }

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
        $this->avatar_upload = null;

        $this->dispatch('toast', variant: 'success', message: __('pages.account.profile.toast_profile_updated'));
    }

    public function removeAvatar(): void
    {
        $user = Auth::user();
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
            $user->avatar = null;
            $user->save();
            $this->dispatch('toast', variant: 'success', message: __('pages.account.profile.toast_avatar_removed'));
        }
    }

    public function resendVerificationNotification(): void
    {
        $user = Auth::user();
        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }
        $user->sendEmailVerificationNotification();
        $this->dispatch('toast', variant: 'info', message: __('pages.account.profile.toast_verification_sent'));
    }

    // ---------------------------------------------------------------- Contatos

    public function addContact(): void
    {
        $this->validate([
            'new_contact_type'   => ['required', 'string'],
            'new_contact_number' => ['required', 'string', 'max:30'],
        ], [], ['new_contact_type' => 'tipo', 'new_contact_number' => 'número']);

        $isPrimary = Auth::user()->contacts()->count() === 0;

        Auth::user()->contacts()->create([
            'type'       => $this->new_contact_type,
            'number'     => $this->new_contact_number,
            'is_primary' => $isPrimary,
        ]);

        $this->new_contact_type   = '';
        $this->new_contact_number = '';
        $this->loadContacts();
        $this->dispatch('toast', variant: 'success', message: __('pages.account.profile.toast_phone_added'));
    }

    public function setPrimaryContact(int $id): void
    {
        $user = Auth::user();
        $user->contacts()->update(['is_primary' => false]);
        $user->contacts()->where('id', $id)->update(['is_primary' => true]);
        $this->loadContacts();
    }

    public function removeContact(int $id): void
    {
        Auth::user()->contacts()->where('id', $id)->delete();
        $this->loadContacts();
        $this->dispatch('toast', variant: 'success', message: __('pages.account.profile.toast_phone_removed'));
    }

    // ---------------------------------------------------------------- Integrações

    public function addIntegration(): void
    {
        $this->validate([
            'new_integration_system'      => ['required', 'string'],
            'new_integration_external_id' => ['required', 'string', 'max:100'],
        ], [], ['new_integration_system' => 'sistema', 'new_integration_external_id' => 'ID externo']);

        Auth::user()->integrations()->updateOrCreate(
            ['system' => $this->new_integration_system],
            ['external_id' => $this->new_integration_external_id, 'active' => true],
        );

        $this->new_integration_system      = '';
        $this->new_integration_external_id = '';
        $this->loadIntegrations();
        $this->dispatch('toast', variant: 'success', message: __('pages.account.profile.toast_integration_added'));
    }

    public function removeIntegration(int $id): void
    {
        Auth::user()->integrations()->where('id', $id)->delete();
        $this->loadIntegrations();
        $this->dispatch('toast', variant: 'success', message: __('pages.account.profile.toast_integration_removed'));
    }

    // ---------------------------------------------------------------- Computed

    #[Computed]
    public function hasUnverifiedEmail(): bool
    {
        return Auth::user() instanceof MustVerifyEmail && !Auth::user()->hasVerifiedEmail();
    }

    #[Computed]
    public function currentAvatarUrl(): string
    {
        if ($this->avatar_upload) {
            return $this->avatar_upload->temporaryUrl();
        }
        return Auth::user()->avatarUrl();
    }

    #[Computed]
    public function contactTypes(): array
    {
        return collect(ContactType::cases())
            ->map(fn($c) => ['value' => $c->value, 'label' => $c->label()])
            ->toArray();
    }

    #[Computed]
    public function integrationSystems(): array
    {
        $used = collect($this->integrations)->pluck('system')->toArray();

        return collect(IntegrationSystem::cases())
            ->reject(fn($s) => in_array($s->value, $used))
            ->map(fn($s) => ['value' => $s->value, 'label' => $s->label()])
            ->toArray();
    }
}; ?>

<div class="kt-container-fluid py-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-mono">{{ __('pages.account.profile.page_heading') }}</h1>
            <p class="text-sm text-secondary-foreground mt-1">{{ __('pages.account.profile.page_subheading') }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ================================================================ --}}
        {{-- Sidebar --}}
        {{-- ================================================================ --}}
        <div class="lg:col-span-1 flex flex-col gap-6">

            {{-- Avatar --}}
            <x-ui.card-section icon="lucide-image" :title="__('pages.account.profile.section_avatar')" contentClass="flex flex-col items-center gap-4 py-6">

                {{-- Cropper modal --}}
                <x-ui.image-cropper
                    id="profile_cropper"
                    target-input="profile_avatar_lw"
                    :aspect-ratio="1"
                    :output-width="512"
                    :output-height="512"
                    modal-title="Ajustar foto de perfil"
                />

                {{-- Input Livewire --}}
                <input id="profile_avatar_lw" type="file" accept="image/*"
                       wire:model="avatar_upload" class="hidden" />

                {{-- Input raw --}}
                <input
                    id="profile_avatar_raw"
                    type="file"
                    accept="image/*"
                    class="hidden"
                    x-ref="rawInput"
                />

                {{-- Store para controlar o preview modal --}}
                <div x-data style="display:none"
                     x-init="Alpine.store('avatarPreview', { show: false })">
                </div>

                <div
                    x-data="{
                        dragging: false,
                        processFile(file) {
                            if (!file || !file.type.startsWith('image/')) return;
                            if (file.size > 10 * 1024 * 1024) {
                                KTToast.show({ message: 'Arquivo muito grande. Máximo: 10 MB.', variant: 'destructive' });
                                return;
                            }
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                Alpine.store('profile_cropper').open(e.target.result, (dataUrl) => {
                                    document.getElementById('profile_avatar_preview').src = dataUrl;
                                });
                            };
                            reader.readAsDataURL(file);
                        },
                        init() {
                            const raw = document.getElementById('profile_avatar_raw');
                            if (raw) raw.addEventListener('change', (e) => {
                                this.processFile(e.target.files[0]);
                                e.target.value = '';
                            });
                        }
                    }"
                    class="w-full flex flex-col items-center gap-4"
                    @dragover.prevent="dragging = true"
                    @dragleave.prevent="dragging = false"
                    @drop.prevent="dragging = false; processFile($event.dataTransfer.files[0])"
                >
                    {{-- Avatar clicável --}}
                    <div class="relative shrink-0 group cursor-pointer"
                         @click="Alpine.store('avatarPreview').show = true">
                        <img
                            id="profile_avatar_preview"
                            src="{{ $this->currentAvatarUrl }}"
                            alt="{{ $name }}"
                            style="width:112px;height:112px;min-width:112px;min-height:112px;border-radius:9999px;object-fit:cover;"
                            class="ring-4 ring-border transition-opacity duration-150 group-hover:opacity-75"
                        />
                        <div class="absolute inset-0 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-150 bg-black/30">
                            @svg('lucide-expand', ['class' => 'size-5 text-white'])
                        </div>
                        @if ($avatar_upload)
                            <x-ui.badge variant="primary" size="sm" class="absolute -bottom-1 -right-1 rounded-full">
                                {{ __('pages.account.profile.avatar_preview_badge') }}
                            </x-ui.badge>
                        @endif
                    </div>

                    {{-- Dropzone ou botão --}}
                    @if ((bool) Auth::user()->avatar || (bool) $avatar_upload)
                        <label for="profile_avatar_raw"
                               class="kt-btn kt-btn-outline kt-btn-sm w-full justify-center cursor-pointer"
                               :class="dragging ? 'ring-2 ring-primary' : ''">
                            @svg('lucide-image', ['class' => 'size-3.5 shrink-0'])
                            {{ __('pages.account.profile.avatar_dropzone_file_label') }}
                        </label>
                    @else
                        <div class="w-full border-2 border-dashed rounded-xl px-6 py-8 text-center transition-colors cursor-pointer"
                             :class="dragging ? 'border-primary bg-primary/5' : 'border-border'"
                             @click="document.getElementById('profile_avatar_raw').click()">
                            @svg('lucide-upload-cloud', ['class' => 'mx-auto mb-2 size-8 text-muted-foreground'])
                            <p class="text-xs text-secondary-foreground mb-3">{{ __('pages.account.profile.avatar_dropzone_label') }}</p>
                            <span class="kt-btn kt-btn-outline kt-btn-sm pointer-events-none">
                                @svg('lucide-image', ['class' => 'size-3.5 shrink-0'])
                                {{ __('pages.account.profile.avatar_dropzone_button') }}
                            </span>
                            <p class="text-xs text-muted-foreground mt-3">JPG, PNG ou WebP · Máx 10MB</p>
                        </div>
                    @endif

                    @error('avatar_upload')
                    <p class="text-xs text-destructive text-center">{{ $message }}</p>
                    @enderror

                    @if (Auth::user()->avatar)
                        <x-ui.button ghost="destructive" size="sm" icon="trash-2"
                                     wire:click="removeAvatar"
                                     wire:confirm="{{ __('pages.account.profile.avatar_remove_confirm') }}"
                                     class="w-full justify-center">
                            {{ __('pages.account.profile.avatar_remove') }}
                        </x-ui.button>
                    @endif

                </div>

            </x-ui.card-section>

            {{-- Modal preview do avatar --}}
            <div
                x-data
                x-show="$store.avatarPreview && $store.avatarPreview.show"
                x-cloak
                x-on:keydown.escape.window="if($store.avatarPreview) $store.avatarPreview.show = false"
                style="position:fixed;inset:0;z-index:9998;background:rgba(0,0,0,0.88);backdrop-filter:blur(10px);"
            >
                <div style="position:fixed;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:1.5rem;padding:2rem;">
                    <div style="position:absolute;inset:0;"
                         x-on:click="$store.avatarPreview.show = false"></div>

                    <img
                        src="{{ $this->currentAvatarUrl }}"
                        alt="{{ $name }}"
                        style="position:relative;width:220px;height:220px;border-radius:9999px;object-fit:cover;box-shadow:0 25px 60px rgba(0,0,0,0.6);"
                        class="ring-4 ring-white/20"
                    />

                    <p style="position:relative;" class="text-white font-semibold text-xl">{{ $name }}</p>

                    <div style="position:relative;" class="flex items-center gap-3" x-on:click.stop>
                        <label for="profile_avatar_raw"
                               class="kt-btn kt-btn-primary kt-btn-sm cursor-pointer"
                               x-on:click="$store.avatarPreview.show = false">
                            @svg('lucide-pencil', ['class' => 'size-3.5'])
                            Editar foto
                        </label>

                        @php $hasAvatar = (bool) Auth::user()?->avatar; @endphp
                        @if ($hasAvatar)
                            <button type="button"
                                    class="kt-btn kt-btn-ghost kt-btn-destructive kt-btn-sm"
                                    wire:click="removeAvatar"
                                    wire:confirm="{{ __('pages.account.profile.avatar_remove_confirm') }}"
                                    x-on:click="$store.avatarPreview.show = false">
                                @svg('lucide-trash-2', ['class' => 'size-3.5'])
                                Remover
                            </button>
                        @endif

                        <button type="button"
                                class="kt-btn kt-btn-ghost kt-btn-sm"
                                style="color:rgba(255,255,255,0.6);"
                                x-on:click="$store.avatarPreview.show = false">
                            @svg('lucide-x', ['class' => 'size-4'])
                            Fechar
                        </button>
                    </div>
                </div>
            </div>

            {{-- Visibilidade --}}
            <x-ui.card-section icon="lucide-eye" :title="__('pages.account.profile.section_visibility')" contentClass="flex flex-col gap-5 py-4">

                <p class="text-xs text-secondary-foreground">
                    {{ __('pages.account.profile.visibility_description') }}
                </p>

                <label class="flex items-center justify-between gap-3 cursor-pointer">
                    <div class="flex flex-col gap-0.5">
                        <span class="text-sm font-medium text-foreground">{{ __('pages.account.profile.visibility_public_label') }}</span>
                        <span class="text-xs text-secondary-foreground">{{ __('pages.account.profile.visibility_public_hint') }}</span>
                    </div>
                    <input type="checkbox" class="kt-switch" wire:model="profile_public" />
                </label>

                <x-ui.divider />

                <label class="flex items-center justify-between gap-3 cursor-pointer">
                    <div class="flex flex-col gap-0.5">
                        <span class="text-sm font-medium text-foreground">{{ __('pages.account.profile.visibility_email_label') }}</span>
                        <span class="text-xs text-secondary-foreground">{{ __('pages.account.profile.visibility_email_hint') }}</span>
                    </div>
                    <input type="checkbox" class="kt-switch" wire:model="show_email" />
                </label>

            </x-ui.card-section>

        </div>

        {{-- ================================================================ --}}
        {{-- Main --}}
        {{-- ================================================================ --}}
        <div class="lg:col-span-2 flex flex-col gap-6">

            <form wire:submit="updateProfileInformation" class="flex flex-col gap-6">

                {{-- Informações Básicas --}}
                <x-ui.card-section icon="lucide-user" :title="__('pages.account.profile.section_basic')">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-ui.form-field :label="__('pages.account.profile.field_name')" name="name" :required="true">
                            <x-ui.input id="name" icon="user" wire:model="name"
                                        :placeholder="__('pages.account.profile.field_name_placeholder')"
                                        autocomplete="name" required />
                        </x-ui.form-field>

                        <x-ui.form-field :label="__('pages.account.profile.field_email')" name="email" :required="true">
                            <x-ui.input id="email" type="email" icon="mail" wire:model="email"
                                        :placeholder="__('pages.account.profile.field_email_placeholder')"
                                        autocomplete="email" required />
                            @if ($this->hasUnverifiedEmail)
                                <p class="text-xs text-warning flex items-center gap-1 mt-1">
                                    @svg('lucide-triangle-alert', ['class' => 'size-3 shrink-0'])
                                    {{ __('pages.account.profile.unverified_email') }}
                                    <button type="button" wire:click.prevent="resendVerificationNotification"
                                            class="underline font-medium hover:text-primary">{{ __('pages.account.profile.resend_verification') }}</button>
                                </p>
                            @endif
                        </x-ui.form-field>
                    </div>

                    <x-ui.form-field :label="__('pages.account.profile.field_bio')" name="bio">
                        <textarea
                            id="bio"
                            wire:model="bio"
                            rows="3"
                            maxlength="500"
                            :placeholder="__('pages.account.profile.field_bio_placeholder')"
                            class="kt-textarea"
                            x-data
                            x-ref="bioArea"
                            @input.debounce.0="$refs.bioCount.textContent = $el.value.length"
                        ></textarea>
                        <div class="flex items-center justify-between mt-1">
                            @error('bio')
                            <p class="text-xs text-destructive">{{ $message }}</p>
                            @else
                                <span></span>
                                @enderror
                                <span class="text-xs text-secondary-foreground">
                                    <span x-ref="bioCount">{{ strlen($bio) }}</span>/500
                                </span>
                        </div>
                    </x-ui.form-field>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-ui.form-field :label="__('pages.account.profile.field_job_title')" name="job_title">
                            <x-ui.input id="job_title" icon="briefcase" wire:model="job_title"
                                        :placeholder="__('pages.account.profile.field_job_title_placeholder')" />
                        </x-ui.form-field>

                        <x-ui.form-field :label="__('pages.account.profile.field_company')" name="company">
                            <x-ui.input id="company" icon="building-2" wire:model="company"
                                        :placeholder="__('pages.account.profile.field_company_placeholder')" />
                        </x-ui.form-field>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <x-ui.form-field :label="__('pages.account.profile.field_location')" name="location">
                            <x-ui.input id="location" icon="map-pin" wire:model="location"
                                        :placeholder="__('pages.account.profile.field_location_placeholder')" />
                        </x-ui.form-field>

                        <x-ui.form-field :label="__('pages.account.profile.field_website')" name="website">
                            <x-ui.input id="website" type="url" icon="globe" wire:model="website"
                                        :placeholder="__('pages.account.profile.field_website_placeholder')" />
                        </x-ui.form-field>
                    </div>

                </x-ui.card-section>

                {{-- Redes Sociais --}}
                <x-ui.card-section icon="lucide-share-2" :title="__('pages.account.profile.section_social')" contentClass="grid grid-cols-1 sm:grid-cols-2 gap-4 py-5">

                    <x-ui.form-field label="LinkedIn" name="linkedin">
                        <x-ui.input-group addonIcon="linkedin">
                            <x-ui.input id="linkedin" wire:model="linkedin"
                                        :placeholder="__('pages.account.profile.field_linkedin_placeholder')"
                                        class="rounded-s-none" />
                        </x-ui.input-group>
                    </x-ui.form-field>

                    <x-ui.form-field label="GitHub" name="github">
                        <x-ui.input-group addonIcon="github">
                            <x-ui.input id="github" wire:model="github"
                                        :placeholder="__('pages.account.profile.field_github_placeholder')"
                                        class="rounded-s-none" />
                        </x-ui.input-group>
                    </x-ui.form-field>

                    <x-ui.form-field label="Twitter / X" name="twitter">
                        <x-ui.input-group addonIcon="twitter">
                            <x-ui.input id="twitter" wire:model="twitter"
                                        :placeholder="__('pages.account.profile.field_twitter_placeholder')"
                                        class="rounded-s-none" />
                        </x-ui.input-group>
                    </x-ui.form-field>

                    <x-ui.form-field label="Instagram" name="instagram">
                        <x-ui.input-group addonIcon="instagram">
                            <x-ui.input id="instagram" wire:model="instagram"
                                        :placeholder="__('pages.account.profile.field_instagram_placeholder')"
                                        class="rounded-s-none" />
                        </x-ui.input-group>
                    </x-ui.form-field>

                </x-ui.card-section>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3">
                    <x-ui.button type="button" :outline="true" wire:click="resetForm">
                        {{ __('pages.account.profile.btn_cancel') }}
                    </x-ui.button>
                    <x-ui.button type="submit" variant="primary" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="updateProfileInformation" class="flex items-center gap-2">
                            @svg('lucide-check', ['class' => 'size-4'])
                            {{ __('pages.account.profile.btn_save') }}
                        </span>
                        <span wire:loading wire:target="updateProfileInformation" class="flex items-center gap-2">
                            <svg class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            {{ __('pages.account.profile.btn_saving') }}
                        </span>
                    </x-ui.button>
                </div>

            </form>

            {{-- ============================================================ --}}
            {{-- Telefones --}}
            {{-- ============================================================ --}}
            <x-ui.card-section icon="lucide-phone" :title="__('pages.account.profile.section_phones')" contentClass="flex flex-col gap-3 py-5">

                @forelse ($contacts as $contact)
                    <div class="flex items-center justify-between gap-3 p-3 rounded-lg border border-input bg-muted/30">
                        <div class="flex items-center gap-3">
                            <div class="size-9 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                <i class="{{ $contact['type_icon'] }} text-primary text-sm"></i>
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-medium text-foreground">{{ $contact['number'] }}</span>
                                    @if ($contact['is_primary'])
                                        <x-ui.badge variant="success" style="outline" size="sm">
                                            {{ __('pages.account.profile.phone_primary_badge') }}
                                        </x-ui.badge>
                                    @endif
                                </div>
                                <span class="text-xs text-secondary-foreground">{{ $contact['type_label'] }}</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-1">
                            @if (!$contact['is_primary'])
                                <x-ui.button ghost="" size="sm" :iconOnly="true" icon="star"
                                             wire:click="setPrimaryContact({{ $contact['id'] }})"
                                             :tooltip="__('pages.account.profile.phone_set_primary_tooltip')"
                                             tooltipPlacement="left" />
                            @endif
                            <x-ui.button ghost="destructive" size="sm" :iconOnly="true" icon="trash-2"
                                         wire:click="removeContact({{ $contact['id'] }})"
                                         wire:confirm="{{ __('pages.account.profile.phone_remove_confirm') }}" />
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-secondary-foreground text-center py-4">
                        {{ __('pages.account.profile.phones_empty') }}
                    </p>
                @endforelse

                <div class="border-t border-input pt-4 flex flex-col gap-3">
                    <p class="text-sm font-medium text-foreground">{{ __('pages.account.profile.phone_add_heading') }}</p>
                    <div class="flex gap-2">
                        <x-ui.select wire:model="new_contact_type"
                                     :placeholder="__('pages.account.profile.phone_type_placeholder')"
                                     class="w-40 shrink-0">
                            @foreach ($this->contactTypes as $type)
                                <option value="{{ $type['value'] }}">{{ $type['label'] }}</option>
                            @endforeach
                        </x-ui.select>

                        <x-ui.input type="tel" icon="phone" wire:model="new_contact_number"
                                    :placeholder="__('pages.account.profile.phone_number_placeholder')"
                                    wire:keydown.enter.prevent="addContact"
                                    class="flex-1" />

                        <x-ui.button variant="primary" icon="plus" wire:click="addContact" class="shrink-0">
                            {{ __('pages.account.profile.btn_add') }}
                        </x-ui.button>
                    </div>
                    @error('new_contact_type')   <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                    @error('new_contact_number') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                </div>

            </x-ui.card-section>

            {{-- ============================================================ --}}
            {{-- Integrações --}}
            {{-- ============================================================ --}}
            <x-ui.card-section icon="lucide-plug" :title="__('pages.account.profile.section_integrations')" contentClass="flex flex-col gap-3 py-5">
                <x-slot name="subtitle">{{ __('pages.account.profile.integrations_subtitle') }}</x-slot>

                @forelse ($integrations as $integration)
                    <div class="flex items-center justify-between gap-3 p-3 rounded-lg border border-input bg-muted/30">
                        <div class="flex items-center gap-3">
                            <div class="size-9 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                <i class="{{ $integration['system_icon'] }} text-primary text-sm"></i>
                            </div>
                            <div class="flex flex-col gap-0.5">
                                <span class="text-sm font-medium text-foreground">{{ $integration['system_label'] }}</span>
                                <span class="text-xs text-secondary-foreground font-mono">ID: {{ $integration['external_id'] }}</span>
                            </div>
                        </div>
                        <x-ui.button ghost="destructive" size="sm" :iconOnly="true" icon="trash-2"
                                     wire:click="removeIntegration({{ $integration['id'] }})"
                                     wire:confirm="{{ __('pages.account.profile.integration_remove_confirm') }}" />
                    </div>
                @empty
                    <p class="text-sm text-secondary-foreground text-center py-4">
                        {{ __('pages.account.profile.integrations_empty') }}
                    </p>
                @endforelse

                @if (count($this->integrationSystems) > 0)
                    <div class="border-t border-input pt-4 flex flex-col gap-3">
                        <p class="text-sm font-medium text-foreground">{{ __('pages.account.profile.integration_add_heading') }}</p>
                        <div class="flex gap-2">
                            <x-ui.select wire:model="new_integration_system"
                                         :placeholder="__('pages.account.profile.integration_system_placeholder')"
                                         class="w-48 shrink-0">
                                @foreach ($this->integrationSystems as $system)
                                    <option value="{{ $system['value'] }}">{{ $system['label'] }}</option>
                                @endforeach
                            </x-ui.select>

                            <x-ui.input icon="hash" wire:model="new_integration_external_id"
                                        :placeholder="__('pages.account.profile.integration_id_placeholder')"
                                        wire:keydown.enter.prevent="addIntegration"
                                        class="flex-1" />

                            <x-ui.button variant="primary" icon="plus" wire:click="addIntegration" class="shrink-0">
                                {{ __('pages.account.profile.btn_add') }}
                            </x-ui.button>
                        </div>
                        @error('new_integration_system')      <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                        @error('new_integration_external_id') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                    </div>
                @else
                    <p class="text-xs text-secondary-foreground text-center">
                        {{ __('pages.account.profile.integrations_all_configured') }}
                    </p>
                @endif

            </x-ui.card-section>

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
