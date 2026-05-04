<x-layouts::auth :title="__('auth.login.title')">
    <div class="kt-card max-w-[420px] w-full">
        <form action="{{ route('login.store') }}" class="kt-card-content flex flex-col gap-5 p-10" id="sign_in_form" method="POST">
            @csrf

            {{-- Título e link de cadastro --}}
            <div class="text-center mb-2.5">
                <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
                    {{ __('auth.login.heading') }}
                </h3>
                <div class="flex items-center justify-center font-medium">
                    <span class="text-sm text-secondary-foreground me-1.5">
                        {{ __('auth.login.need_account') }}
                    </span>
                    @if (Route::has('register'))
                        <x-ui.link href="{{ route('register') }}" wire:navigate size="sm">
                            {{ __('auth.login.sign_up') }}
                        </x-ui.link>
                    @endif
                </div>
            </div>

            {{-- Mensagem de status (ex: logout, link de reset enviado) --}}
            <x-auth-session-status class="text-center text-sm text-red-600" :status="session('status')" />

            {{-- Botões OAuth --}}
            <x-ui.oauth-buttons :providers="['google', 'apple']" />

            <x-ui.divider :label="__('auth.login.or')" />

            {{-- Campo e-mail --}}
            <x-ui.form-field label="{{ __('auth.login.email') }}" name="email">
                <x-ui.input
                    id="email"
                    name="email"
                    type="email"
                    placeholder="email@email.com"
                    value="{{ old('email') }}"
                    :invalid="$errors->has('email')"
                    required
                    autofocus
                />
            </x-ui.form-field>

            {{-- Campo senha --}}
            <x-ui.form-field label="{{ __('auth.login.password') }}" name="password">
                <x-slot:actions>
                    @if (Route::has('password.request'))
                        <x-ui.link href="{{ route('password.request') }}" wire:navigate size="sm" class="shrink-0">
                            {{ __('auth.login.forgot_password') }}
                        </x-ui.link>
                    @endif
                </x-slot:actions>
                <x-ui.password-input
                    id="password"
                    name="password"
                    placeholder="{{ __('auth.login.password_placeholder') }}"
                    :invalid="$errors->has('password')"
                    required
                />
            </x-ui.form-field>

            {{-- Remember me --}}
            <x-ui.checkbox name="remember" label="{{ __('auth.login.remember_me') }}" :checked="old('remember')" />

            {{-- Submit --}}
            <x-ui.button variant="primary" type="submit" class="flex justify-center grow">
                {{ __('auth.login.submit') }}
            </x-ui.button>

        </form>
    </div>
</x-layouts::auth>
