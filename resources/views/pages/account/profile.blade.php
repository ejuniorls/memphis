<?php

use App\Concerns\ProfileValidationRules;
use App\Enums\ContactType;
use App\Enums\IntegrationSystem;
use App\Models\UserContact;
use App\Models\UserIntegration;
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

    // Dados básicos
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

    // Contatos
    public array $contacts = [];

    // Novo contato (form inline)
    public string $new_contact_type   = '';
    public string $new_contact_number = '';

    // Integrações
    public array $integrations = [];

    // Nova integração (form inline)
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
                'id'          => $i->id,
                'system'      => $i->system->value,
                'system_label'=> $i->system->label(),
                'system_icon' => $i->system->icon(),
                'external_id' => $i->external_id,
                'active'      => $i->active,
            ])
            ->toArray();
    }

    // ----------------------------------------------------------------
    // Perfil principal
    // ----------------------------------------------------------------

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

    // ----------------------------------------------------------------
    // Contatos
    // ----------------------------------------------------------------

    public function addContact(): void
    {
        $this->validate([
            'new_contact_type'   => ['required', 'string'],
            'new_contact_number' => ['required', 'string', 'max:30'],
        ], [], [
            'new_contact_type'   => 'tipo',
            'new_contact_number' => 'número',
        ]);

        $isPrimary = Auth::user()->contacts()->count() === 0;

        Auth::user()->contacts()->create([
            'type'       => $this->new_contact_type,
            'number'     => $this->new_contact_number,
            'is_primary' => $isPrimary,
        ]);

        $this->new_contact_type   = '';
        $this->new_contact_number = '';
        $this->loadContacts();
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
    }

    // ----------------------------------------------------------------
    // Integrações
    // ----------------------------------------------------------------

    public function addIntegration(): void
    {
        $this->validate([
            'new_integration_system'      => ['required', 'string'],
            'new_integration_external_id' => ['required', 'string', 'max:100'],
        ], [], [
            'new_integration_system'      => 'sistema',
            'new_integration_external_id' => 'ID externo',
        ]);

        Auth::user()->integrations()->updateOrCreate(
            ['system' => $this->new_integration_system],
            ['external_id' => $this->new_integration_external_id, 'active' => true],
        );

        $this->new_integration_system      = '';
        $this->new_integration_external_id = '';
        $this->loadIntegrations();
    }

    public function removeIntegration(int $id): void
    {
        Auth::user()->integrations()->where('id', $id)->delete();
        $this->loadIntegrations();
    }

    // ----------------------------------------------------------------
    // Computed
    // ----------------------------------------------------------------

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

    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-mono">Meu Perfil</h1>
            <p class="text-sm text-secondary-foreground mt-1">Gerencie suas informações pessoais e como você aparece para outros usuários.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ============================================================ --}}
        {{-- Sidebar: Avatar + Visibilidade --}}
        {{-- ============================================================ --}}
        <div class="lg:col-span-1 flex flex-col gap-6">

            {{-- Avatar --}}
            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Foto do Perfil</h3>
                </div>
                <div class="kt-card-content flex flex-col items-center gap-5 py-6">
                    <div class="relative">
                        <img src="{{ $this->currentAvatarUrl }}" alt="{{ $name }}"
                             class="size-28 rounded-full object-cover ring-4 ring-border" />
                        @if ($avatar_upload)
                            <span class="absolute -bottom-1 -right-1 kt-badge kt-badge-sm kt-badge-primary rounded-full px-2">Prévia</span>
                        @endif
                    </div>

                    <div class="flex flex-col gap-2 w-full">
                        <label class="kt-btn kt-btn-outline w-full justify-center cursor-pointer" for="avatar_input">
                            <i class="ki-filled ki-picture"></i>
                            {{ $avatar_upload ? 'Trocar foto' : 'Enviar foto' }}
                        </label>
                        <input id="avatar_input" type="file" accept="image/*" wire:model="avatar_upload" class="hidden" />

                        @if (Auth::user()->avatar)
                            <button type="button" wire:click="removeAvatar"
                                    wire:confirm="Deseja remover sua foto de perfil?"
                                    class="kt-btn kt-btn-ghost kt-btn-sm text-destructive hover:text-destructive w-full justify-center">
                                <i class="ki-filled ki-trash"></i> Remover foto
                            </button>
                        @endif
                    </div>

                    <p class="text-xs text-secondary-foreground text-center">JPG, PNG ou GIF. Máximo 2MB.</p>
                    @error('avatar_upload') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                </div>
            </div>

            {{-- Visibilidade --}}
            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Visibilidade</h3>
                </div>
                <div class="kt-card-content flex flex-col gap-5 py-4">
                    <p class="text-xs text-secondary-foreground">Controle quais informações outros usuários podem visualizar.</p>

                    <label class="flex items-center justify-between gap-3 cursor-pointer">
                        <div class="flex flex-col gap-0.5">
                            <span class="text-sm font-medium text-foreground">Perfil público</span>
                            <span class="text-xs text-secondary-foreground">Outros usuários podem ver seu perfil</span>
                        </div>
                        <input type="checkbox" class="kt-switch" wire:model="profile_public" />
                    </label>

                    <div class="border-b border-input"></div>

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

        {{-- ============================================================ --}}
        {{-- Main --}}
        {{-- ============================================================ --}}
        <div class="lg:col-span-2 flex flex-col gap-6">

            {{-- Informações Básicas --}}
            <form wire:submit="updateProfileInformation">
                <div class="kt-card">
                    <div class="kt-card-header">
                        <h3 class="kt-card-title">Informações Básicas</h3>
                    </div>
                    <div class="kt-card-content flex flex-col gap-5 py-5">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-1.5">
                                <label class="text-sm font-medium text-foreground" for="name">
                                    Nome completo <span class="text-destructive">*</span>
                                </label>
                                <div class="kt-input">
                                    <i class="ki-filled ki-user"></i>
                                    <input id="name" type="text" wire:model="name" placeholder="Seu nome completo" required autocomplete="name" />
                                </div>
                                @error('name') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label class="text-sm font-medium text-foreground" for="email">
                                    E-mail <span class="text-destructive">*</span>
                                </label>
                                <div class="kt-input">
                                    <i class="ki-filled ki-sms"></i>
                                    <input id="email" type="email" wire:model="email" placeholder="seu@email.com" required autocomplete="email" />
                                </div>
                                @if ($this->hasUnverifiedEmail)
                                    <p class="text-xs text-warning flex items-center gap-1">
                                        <i class="ki-filled ki-information-2"></i>
                                        E-mail não verificado.
                                        <button type="button" wire:click.prevent="resendVerificationNotification" class="underline font-medium hover:text-primary">Reenviar.</button>
                                    </p>
                                @endif
                                @error('email') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5">
                            <label class="text-sm font-medium text-foreground" for="bio">Bio / Descrição</label>
                            <textarea id="bio" wire:model="bio" rows="3" maxlength="500"
                                      placeholder="Conte um pouco sobre você..."
                                      class="kt-textarea"
                                      x-data x-ref="bio"
                                      @input="$refs.bioCount.textContent = $el.value.length"
                            ></textarea>
                            <div class="flex items-center justify-between">
                                @error('bio') <p class="text-xs text-destructive">{{ $message }}</p> @else <span></span> @enderror
                                <span class="text-xs text-secondary-foreground"><span x-ref="bioCount">{{ strlen($bio) }}</span>/500</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-1.5">
                                <label class="text-sm font-medium text-foreground" for="job_title">Cargo / Função</label>
                                <div class="kt-input">
                                    <i class="ki-filled ki-briefcase"></i>
                                    <input id="job_title" type="text" wire:model="job_title" placeholder="Ex: Desenvolvedor Full Stack" />
                                </div>
                                @error('job_title') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label class="text-sm font-medium text-foreground" for="company">Empresa</label>
                                <div class="kt-input">
                                    <i class="ki-filled ki-office-bag"></i>
                                    <input id="company" type="text" wire:model="company" placeholder="Nome da empresa" />
                                </div>
                                @error('company') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex flex-col gap-1.5">
                                <label class="text-sm font-medium text-foreground" for="location">Localização</label>
                                <div class="kt-input">
                                    <i class="ki-filled ki-geolocation"></i>
                                    <input id="location" type="text" wire:model="location" placeholder="Ex: São Paulo, SP" />
                                </div>
                                @error('location') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label class="text-sm font-medium text-foreground" for="website">Website / Portfólio</label>
                                <div class="kt-input">
                                    <i class="ki-filled ki-global"></i>
                                    <input id="website" type="url" wire:model="website" placeholder="https://seusite.com" />
                                </div>
                                @error('website') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Redes Sociais --}}
                <div class="kt-card mt-6">
                    <div class="kt-card-header">
                        <h3 class="kt-card-title">Redes Sociais</h3>
                    </div>
                    <div class="kt-card-content flex flex-col gap-4 py-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                            <div class="flex flex-col gap-1.5">
                                <label class="text-sm font-medium text-foreground" for="linkedin">LinkedIn</label>
                                <div class="kt-input-group">
                                    <span class="kt-input-group-text min-w-[44px] justify-center">
                                        <i class="ki-filled ki-linkedin text-[#0A66C2]"></i>
                                    </span>
                                    <input id="linkedin" type="text" wire:model="linkedin" class="kt-input rounded-s-none" placeholder="linkedin.com/in/usuario" />
                                </div>
                                @error('linkedin') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label class="text-sm font-medium text-foreground" for="github">GitHub</label>
                                <div class="kt-input-group">
                                    <span class="kt-input-group-text min-w-[44px] justify-center">
                                        <i class="ki-filled ki-github"></i>
                                    </span>
                                    <input id="github" type="text" wire:model="github" class="kt-input rounded-s-none" placeholder="github.com/usuario" />
                                </div>
                                @error('github') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label class="text-sm font-medium text-foreground" for="twitter">Twitter / X</label>
                                <div class="kt-input-group">
                                    <span class="kt-input-group-text min-w-[44px] justify-center">
                                        <i class="ki-filled ki-twitter"></i>
                                    </span>
                                    <input id="twitter" type="text" wire:model="twitter" class="kt-input rounded-s-none" placeholder="@usuario" />
                                </div>
                                @error('twitter') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                            </div>

                            <div class="flex flex-col gap-1.5">
                                <label class="text-sm font-medium text-foreground" for="instagram">Instagram</label>
                                <div class="kt-input-group">
                                    <span class="kt-input-group-text min-w-[44px] justify-center">
                                        <i class="ki-filled ki-instagram text-[#E1306C]"></i>
                                    </span>
                                    <input id="instagram" type="text" wire:model="instagram" class="kt-input rounded-s-none" placeholder="@usuario" />
                                </div>
                                @error('instagram') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3 mt-4">
                    <button type="button" wire:click="resetForm" class="kt-btn kt-btn-outline">Cancelar</button>
                    <button type="submit" class="kt-btn kt-btn-primary" wire:loading.attr="disabled">
                        <span wire:loading.remove><i class="ki-filled ki-check"></i> Salvar alterações</span>
                        <span wire:loading class="flex items-center gap-2">
                            <svg class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            Salvando...
                        </span>
                    </button>
                </div>
            </form>

            {{-- ============================================================ --}}
            {{-- Contatos / Telefones --}}
            {{-- ============================================================ --}}
            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Telefones</h3>
                </div>
                <div class="kt-card-content flex flex-col gap-4 py-5">

                    {{-- Lista de contatos --}}
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
                                            <span class="kt-badge kt-badge-sm kt-badge-success kt-badge-outline">Principal</span>
                                        @endif
                                    </div>
                                    <span class="text-xs text-secondary-foreground">{{ $contact['type_label'] }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-1">
                                @if (!$contact['is_primary'])
                                    <button type="button"
                                            wire:click="setPrimaryContact({{ $contact['id'] }})"
                                            class="kt-btn kt-btn-ghost kt-btn-sm"
                                            title="Definir como principal">
                                        <i class="ki-filled ki-star text-muted-foreground"></i>
                                    </button>
                                @endif
                                <button type="button"
                                        wire:click="removeContact({{ $contact['id'] }})"
                                        wire:confirm="Remover este telefone?"
                                        class="kt-btn kt-btn-ghost kt-btn-sm text-destructive hover:text-destructive">
                                    <i class="ki-filled ki-trash"></i>
                                </button>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-secondary-foreground text-center py-4">Nenhum telefone cadastrado.</p>
                    @endforelse

                    {{-- Adicionar novo contato --}}
                    <div class="border-t border-input pt-4 flex flex-col gap-3">
                        <p class="text-sm font-medium text-foreground">Adicionar telefone</p>
                        <div class="flex gap-2">
                            <select wire:model="new_contact_type" class="kt-select w-40 shrink-0">
                                <option value="">Tipo</option>
                                @foreach ($this->contactTypes as $type)
                                    <option value="{{ $type['value'] }}">{{ $type['label'] }}</option>
                                @endforeach
                            </select>
                            <div class="kt-input flex-1">
                                <i class="ki-filled ki-phone"></i>
                                <input type="tel" wire:model="new_contact_number" placeholder="(11) 99999-9999"
                                       wire:keydown.enter.prevent="addContact" />
                            </div>
                            <button type="button" wire:click="addContact" class="kt-btn kt-btn-primary shrink-0">
                                <i class="ki-filled ki-plus"></i>
                                Adicionar
                            </button>
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
                <div class="kt-card-content flex flex-col gap-4 py-5">

                    {{-- Lista de integrações --}}
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
                            <button type="button"
                                    wire:click="removeIntegration({{ $integration['id'] }})"
                                    wire:confirm="Remover esta integração?"
                                    class="kt-btn kt-btn-ghost kt-btn-sm text-destructive hover:text-destructive">
                                <i class="ki-filled ki-trash"></i>
                            </button>
                        </div>
                    @empty
                        <p class="text-sm text-secondary-foreground text-center py-4">Nenhuma integração configurada.</p>
                    @endforelse

                    {{-- Adicionar integração --}}
                    @if (count($this->integrationSystems) > 0)
                        <div class="border-t border-input pt-4 flex flex-col gap-3">
                            <p class="text-sm font-medium text-foreground">Adicionar integração</p>
                            <div class="flex gap-2">
                                <select wire:model="new_integration_system" class="kt-select w-48 shrink-0">
                                    <option value="">Sistema</option>
                                    @foreach ($this->integrationSystems as $system)
                                        <option value="{{ $system['value'] }}">{{ $system['label'] }}</option>
                                    @endforeach
                                </select>
                                <div class="kt-input flex-1">
                                    <i class="ki-filled ki-code"></i>
                                    <input type="text" wire:model="new_integration_external_id"
                                           placeholder="ID do usuário no sistema"
                                           wire:keydown.enter.prevent="addIntegration" />
                                </div>
                                <button type="button" wire:click="addIntegration" class="kt-btn kt-btn-primary shrink-0">
                                    <i class="ki-filled ki-plus"></i>
                                    Adicionar
                                </button>
                            </div>
                            @error('new_integration_system')      <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                            @error('new_integration_external_id') <p class="text-xs text-destructive">{{ $message }}</p> @enderror
                        </div>
                    @else
                        <p class="text-xs text-secondary-foreground text-center">Todos os sistemas disponíveis já foram configurados.</p>
                    @endif

                </div>
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
