<x-layouts::auth :title="__('auth.register.title')">
    <div class="kt-card max-w-[420px] w-full">
        <form action="{{ route('register.store') }}" class="kt-card-content flex flex-col gap-5 p-10" id="sign_up_form" method="POST">
            @csrf

            <div class="text-center mb-2.5">
                <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
                    {{ __('auth.register.heading') }}
                </h3>
                <div class="flex items-center justify-center font-medium">
                    <span class="text-sm text-secondary-foreground me-1.5">
                        {{ __('auth.register.already_have_account') }}
                    </span>
                    <x-ui.link href="{{ route('login') }}" wire:navigate size="sm">
                        {{ __('auth.register.log_in') }}
                    </x-ui.link>
                </div>
            </div>

            <x-ui.oauth-buttons :providers="['google', 'apple']" />

            <x-ui.divider :label="__('auth.register.or')" />

            <x-ui.form-field label="{{ __('auth.register.name') }}" name="name">
                <x-ui.input
                    id="name"
                    name="name"
                    type="text"
                    placeholder="{{ __('auth.register.name_placeholder') }}"
                    value="{{ old('name') }}"
                    :invalid="$errors->has('name')"
                    required
                    autofocus
                />
            </x-ui.form-field>

            <x-ui.form-field label="{{ __('auth.register.email') }}" name="email">
                <x-ui.input
                    id="email"
                    name="email"
                    type="email"
                    placeholder="email@example.com"
                    value="{{ old('email') }}"
                    :invalid="$errors->has('email')"
                    required
                />
            </x-ui.form-field>

            <x-ui.form-field label="{{ __('auth.register.password') }}" name="password">
                <x-ui.password-input
                    id="password"
                    name="password"
                    placeholder="{{ __('auth.register.password_placeholder') }}"
                    :invalid="$errors->has('password')"
                    required
                />
            </x-ui.form-field>

            <x-ui.form-field label="{{ __('auth.register.confirm_password') }}" name="password_confirmation">
                <x-ui.password-input
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="{{ __('auth.register.confirm_password_placeholder') }}"
                    required
                />
            </x-ui.form-field>

            <x-ui.checkbox name="terms" :required="true">
                {{ __('auth.register.accept_terms') }}
                <x-ui.link href="#" size="sm">{{ __('auth.register.terms_link') }}</x-ui.link>
            </x-ui.checkbox>

            <x-ui.button variant="primary" type="submit" class="flex justify-center grow">
                {{ __('auth.register.submit') }}
            </x-ui.button>
        </form>
    </div>
</x-layouts::auth>
