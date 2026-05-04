<x-layouts::auth :title="__('Register')">
    <div class="kt-card max-w-[420px] w-full">
        <form action="{{ route('register.store') }}" class="kt-card-content flex flex-col gap-5 p-10" id="sign_up_form" method="POST">
            @csrf

            <div class="text-center mb-2.5">
                <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
                    {{ __('Create an account') }}
                </h3>
                <div class="flex items-center justify-center font-medium">
                    <span class="text-sm text-secondary-foreground me-1.5">
                        {{ __('Already have an account?') }}
                    </span>
                    <x-ui.link href="{{ route('login') }}" wire:navigate size="sm">
                        {{ __('Log in') }}
                    </x-ui.link>
                </div>
            </div>

            <x-ui.oauth-buttons :providers="['google', 'apple']" />

            <x-ui.divider :label="__('Or')" />

            <x-ui.form-field label="{{ __('Name') }}" name="name">
                <x-ui.input
                    id="name"
                    name="name"
                    type="text"
                    placeholder="{{ __('Full name') }}"
                    value="{{ old('name') }}"
                    :invalid="$errors->has('name')"
                    required
                    autofocus
                />
            </x-ui.form-field>

            <x-ui.form-field label="{{ __('Email address') }}" name="email">
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

            <x-ui.form-field label="{{ __('Password') }}" name="password">
                <x-ui.password-input
                    id="password"
                    name="password"
                    placeholder="{{ __('Password') }}"
                    :invalid="$errors->has('password')"
                    required
                />
            </x-ui.form-field>

            <x-ui.form-field label="{{ __('Confirm Password') }}" name="password_confirmation">
                <x-ui.password-input
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="{{ __('Confirm Password') }}"
                    required
                />
            </x-ui.form-field>

            <x-ui.checkbox name="terms" :required="true">
                {{ __('I accept the') }}
                <x-ui.link href="#" size="sm">{{ __('Terms and Conditions') }}</x-ui.link>
            </x-ui.checkbox>

            <x-ui.button variant="primary" type="submit" class="flex justify-center grow">
                {{ __('Create account') }}
            </x-ui.button>
        </form>
    </div>
</x-layouts::auth>
