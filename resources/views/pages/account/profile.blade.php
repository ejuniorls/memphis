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

        $this->dispatch('toast', variant: 'success', message: 'Perfil atualizado com sucesso.');
    }

    public function removeAvatar(): void
    {
        $user = Auth::user();
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
            $user->avatar = null;
            $user->save();
            $this->dispatch('toast', variant: 'success', message: 'Foto removida.');
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
        $this->dispatch('toast', variant: 'info', message: 'Um novo link de verificação foi enviado para o seu e-mail.');
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
        $this->dispatch('toast', variant: 'success', message: 'Telefone adicionado.');
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
        $this->dispatch('toast', variant: 'success', message: 'Telefone removido.');
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
        $this->dispatch('toast', variant: 'success', message: 'Integração adicionada.');
    }

    public function removeIntegration(int $id): void
    {
        Auth::user()->integrations()->where('id', $id)->delete();
        $this->loadIntegrations();
        $this->dispatch('toast', variant: 'success', message: 'Integração removida.');
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
            <h1 class="text-2xl font-bold text-mono">Meu Perfil</h1>
            <p class="text-sm text-secondary-foreground mt-1">Gerencie suas informações pessoais e como você aparece para outros usuários.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ================================================================ --}}
        {{-- Sidebar --}}
        {{-- ================================================================ --}}
        <div class="lg:col-span-1 flex flex-col gap-6">

            {{-- Avatar com drag & drop --}}
            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Foto do Perfil</h3>
                </div>
                <div class="kt-card-content flex flex-col items-center gap-4 py-6">

                    {{-- Avatar atual --}}
                    <div class="relative">
                        <img
                            src="{{ $this->currentAvatarUrl }}"
                            alt="{{ $name }}"
                            class="size-24 rounded-full object-cover ring-4 ring-border"
                        />
                        @if ($avatar_upload)
                            <x-ui.badge variant="primary" size="sm" class="absolute -bottom-1 -right-1 rounded-full">
                                Prévia
                            </x-ui.badge>
                        @endif
                    </div>

                    {{-- Dropzone --}}
                    <x-ui.file-dropzone
                        id="avatar_input"
                        model="avatar_upload"
                        accept="image/*"
                        label="Arraste uma foto aqui ou"
                        button-label="Selecionar foto"
                        file-label="Trocar foto"
                        hint="JPG, PNG ou GIF · Máximo 2MB."
                        :has-file="(bool) $avatar_upload || (bool) Auth::user()->avatar"
                        class="w-full"
                    />

                    @error('avatar_upload')
                    <p class="text-xs text-destructive text-center">{{ $message }}</p>
                    @enderror

                    @if (Auth::user()->avatar)
                        <x-ui.button
                            ghost="destructive"
                            size="sm"
                            icon="trash-2"
                            wire:click="removeAvatar"
                            wire:confirm="Deseja remover sua foto de perfil?"
                            class="w-full justify-center"
                        >
                            Remover foto
                        </x-ui.button>
                    @endif
                </div>
            </div>

            {{-- Visibilidade --}}
            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Visibilidade</h3>
                </div>
                <div class="kt-card-content flex flex-col gap-5 py-4">
                    <p class="text-xs text-secondary-foreground">
                        Controle quais informações outros usuários podem visualizar no seu perfil.
                    </p>

                    <label class="flex items-center justify-between gap-3 cursor-pointer">
                        <div class="flex flex-col gap-0.5">
                            <span class="text-sm font-medium text-foreground">Perfil público</span>
                            <span class="text-xs text-secondary-foreground">Outros usuários podem ver seu perfil</span>
                        </div>
                        <input type="checkbox" class="kt-switch" wire:model="profile_public" />
                    </label>

                    <x-ui.divider />

                    <label class="flex items-center justify-between gap-3 cursor-pointer">
                        <div class="flex flex-col gap-0.5">
                            <span class="text-sm font-medium text-foreground">Exibir e-mail</span>
                            <span class="text-xs text-secondary-foreground">Visível para outros usuários</span>
                        </div>
                        <input type="checkbox" class="kt-switch" wire:model="show_email" />
                    </label>
                </div>
            </div>

        </div>

        {{-- ================================================================ --}}
        {{-- Main --}}
        {{-- ================================================================ --}}
        <div class="lg:col-span-2 flex flex-col gap-6">

            <form wire:submit="updateProfileInformation" class="flex flex-col gap-6">

                {{-- Informações Básicas --}}
                <div class="kt-card">
                    <div class="kt-card-header">
                        <h3 class="kt-card-title">Informações Básicas</h3>
                    </div>
                    <div class="kt-card-content flex flex-col gap-5 py-5">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <x-ui.form-field label="Nome completo" name="name" :required="true">
                                <x-ui.input id="name" icon="user" wire:model="name"
                                            placeholder="Seu nome completo" autocomplete="name" required />
                            </x-ui.form-field>

                            <x-ui.form-field label="E-mail" name="email" :required="true">
                                <x-ui.input id="email" type="email" icon="mail" wire:model="email"
                                            placeholder="seu@email.com" autocomplete="email" required />
                                @if ($this->hasUnverifiedEmail)
                                    <p class="text-xs text-warning flex items-center gap-1 mt-1">
                                        @svg('lucide-triangle-alert', ['class' => 'size-3 shrink-0'])
                                        E-mail não verificado.
                                        <button type="button" wire:click.prevent="resendVerificationNotification"
                                                class="underline font-medium hover:text-primary">Reenviar.</button>
                                    </p>
                                @endif
                            </x-ui.form-field>
                        </div>

                        <x-ui.form-field label="Bio / Descrição" name="bio">
                            <textarea
                                id="bio"
                                wire:model="bio"
                                rows="3"
                                maxlength="500"
                                placeholder="Conte um pouco sobre você..."
                                class="kt-textarea"
                                x-data
                                @input="$el.nextElementSibling.querySelector('[x-ref=bioCount]') || null"
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
                            <x-ui.form-field label="Cargo / Função" name="job_title">
                                <x-ui.input id="job_title" icon="briefcase" wire:model="job_title"
                                            placeholder="Ex: Desenvolvedor Full Stack" />
                            </x-ui.form-field>

                            <x-ui.form-field label="Empresa" name="company">
                                <x-ui.input id="company" icon="building-2" wire:model="company"
                                            placeholder="Nome da empresa" />
                            </x-ui.form-field>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <x-ui.form-field label="Localização" name="location">
                                <x-ui.input id="location" icon="map-pin" wire:model="location"
                                            placeholder="Ex: São Paulo, SP" />
                            </x-ui.form-field>

                            <x-ui.form-field label="Website / Portfólio" name="website">
                                <x-ui.input id="website" type="url" icon="globe" wire:model="website"
                                            placeholder="https://seusite.com" />
                            </x-ui.form-field>
                        </div>

                    </div>
                </div>

                {{-- Redes Sociais --}}
                <div class="kt-card">
                    <div class="kt-card-header">
                        <h3 class="kt-card-title">Redes Sociais</h3>
                    </div>
                    <div class="kt-card-content grid grid-cols-1 sm:grid-cols-2 gap-4 py-5">

                        <x-ui.form-field label="LinkedIn" name="linkedin">
                            <x-ui.input-group addonIcon="linkedin">
                                <x-ui.input id="linkedin" wire:model="linkedin"
                                            placeholder="linkedin.com/in/usuario" class="rounded-s-none" />
                            </x-ui.input-group>
                        </x-ui.form-field>

                        <x-ui.form-field label="GitHub" name="github">
                            <x-ui.input-group addonIcon="github">
                                <x-ui.input id="github" wire:model="github"
                                            placeholder="github.com/usuario" class="rounded-s-none" />
                            </x-ui.input-group>
                        </x-ui.form-field>

                        <x-ui.form-field label="Twitter / X" name="twitter">
                            <x-ui.input-group addonIcon="twitter">
                                <x-ui.input id="twitter" wire:model="twitter"
                                            placeholder="@usuario" class="rounded-s-none" />
                            </x-ui.input-group>
                        </x-ui.form-field>

                        <x-ui.form-field label="Instagram" name="instagram">
                            <x-ui.input-group addonIcon="instagram">
                                <x-ui.input id="instagram" wire:model="instagram"
                                            placeholder="@usuario" class="rounded-s-none" />
                            </x-ui.input-group>
                        </x-ui.form-field>

                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3">
                    <x-ui.button type="button" :outline="true" wire:click="resetForm">
                        Cancelar
                    </x-ui.button>
                    <x-ui.button type="submit" variant="primary" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="updateProfileInformation" class="flex items-center gap-2">
                            @svg('lucide-check', ['class' => 'size-4'])
                            Salvar alterações
                        </span>
                        <span wire:loading wire:target="updateProfileInformation" class="flex items-center gap-2">
                            <svg class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            Salvando...
                        </span>
                    </x-ui.button>
                </div>

            </form>

            {{-- ============================================================ --}}
            {{-- Telefones --}}
            {{-- ============================================================ --}}
            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Telefones</h3>
                </div>
                <div class="kt-card-content flex flex-col gap-3 py-5">

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
                                            <x-ui.badge variant="success" style="outline" size="sm">Principal</x-ui.badge>
                                        @endif
                                    </div>
                                    <span class="text-xs text-secondary-foreground">{{ $contact['type_label'] }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-1">
                                @if (!$contact['is_primary'])
                                    <x-ui.button ghost="" size="sm" :iconOnly="true" icon="star"
                                                 wire:click="setPrimaryContact({{ $contact['id'] }})"
                                                 tooltip="Definir como principal" tooltipPlacement="left" />
                                @endif
                                <x-ui.button ghost="destructive" size="sm" :iconOnly="true" icon="trash-2"
                                             wire:click="removeContact({{ $contact['id'] }})"
                                             wire:confirm="Remover este telefone?" />
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-secondary-foreground text-center py-4">Nenhum telefone cadastrado.</p>
                    @endforelse

                    <div class="border-t border-input pt-4 flex flex-col gap-3">
                        <p class="text-sm font-medium text-foreground">Adicionar telefone</p>
                        <div class="flex gap-2">
                            <x-ui.select wire:model="new_contact_type" placeholder="Tipo" class="w-40 shrink-0">
                                @foreach ($this->contactTypes as $type)
                                    <option value="{{ $type['value'] }}">{{ $type['label'] }}</option>
                                @endforeach
                            </x-ui.select>

                            <x-ui.input type="tel" icon="phone" wire:model="new_contact_number"
                                        placeholder="(11) 99999-9999"
                                        wire:keydown.enter.prevent="addContact"
                                        class="flex-1" />

                            <x-ui.button variant="primary" icon="plus" wire:click="addContact" class="shrink-0">
                                Adicionar
                            </x-ui.button>
                        </div>
                        @error('new_contact_type')   <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                        @error('new_contact_number') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                    </div>

                </div>
            </div>

            {{-- ============================================================ --}}
            {{-- Integrações --}}
            {{-- ============================================================ --}}
            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Integrações</h3>
                    <span class="text-xs text-secondary-foreground">IDs em sistemas externos</span>
                </div>
                <div class="kt-card-content flex flex-col gap-3 py-5">

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
                                         wire:confirm="Remover esta integração?" />
                        </div>
                    @empty
                        <p class="text-sm text-secondary-foreground text-center py-4">Nenhuma integração configurada.</p>
                    @endforelse

                    @if (count($this->integrationSystems) > 0)
                        <div class="border-t border-input pt-4 flex flex-col gap-3">
                            <p class="text-sm font-medium text-foreground">Adicionar integração</p>
                            <div class="flex gap-2">
                                <x-ui.select wire:model="new_integration_system" placeholder="Sistema" class="w-48 shrink-0">
                                    @foreach ($this->integrationSystems as $system)
                                        <option value="{{ $system['value'] }}">{{ $system['label'] }}</option>
                                    @endforeach
                                </x-ui.select>

                                <x-ui.input icon="hash" wire:model="new_integration_external_id"
                                            placeholder="ID do usuário no sistema"
                                            wire:keydown.enter.prevent="addIntegration"
                                            class="flex-1" />

                                <x-ui.button variant="primary" icon="plus" wire:click="addIntegration" class="shrink-0">
                                    Adicionar
                                </x-ui.button>
                            </div>
                            @error('new_integration_system')      <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                            @error('new_integration_external_id') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                        </div>
                    @else
                        <p class="text-xs text-secondary-foreground text-center">
                            Todos os sistemas disponíveis já foram configurados.
                        </p>
                    @endif

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
