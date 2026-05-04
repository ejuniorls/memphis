<x-layouts::auth :title="__('Reset password')">
    <div class="kt-card max-w-[420px] w-full">
        <form action="{{ route('password.update') }}" class="kt-card-content flex flex-col gap-5 p-10" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ request()->route('token') }}">
            <input type="hidden" name="email" value="{{ request('email') }}">

            <div class="text-center mb-2.5">
                <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
                    {{ __('Reset password') }}
                </h3>
                <p class="text-sm text-secondary-foreground">
                    {{ __('Please enter your new password below') }}
                </p>
            </div>

            <x-auth-session-status class="text-center text-sm text-red-600" :status="session('status')" />

            <x-ui.form-field label="{{ __('Password') }}" name="password">
                <x-ui.password-input
                    id="password"
                    name="password"
                    placeholder="{{ __('Enter new password') }}"
                    :invalid="$errors->has('password')"
                    required
                    autocomplete="new-password"
                />
            </x-ui.form-field>

            <x-ui.form-field label="{{ __('Confirm password') }}" name="password_confirmation">
                <x-ui.password-input
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="{{ __('Confirm new password') }}"
                    :invalid="$errors->has('password_confirmation')"
                    required
                    autocomplete="new-password"
                />
            </x-ui.form-field>

            <x-ui.button variant="primary" type="submit" class="flex justify-center grow">
                {{ __('Reset password') }}
            </x-ui.button>
        </form>
    </div>
</x-layouts::auth>
