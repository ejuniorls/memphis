<x-layouts::auth :title="__('Forgot password')">
    <div class="kt-card max-w-[370px] w-full">
        <form action="{{ route('password.email') }}" class="kt-card-content flex flex-col gap-5 p-10"
              id="reset_password_enter_email_form" method="POST">
            @csrf

            <div class="text-center">
                <h3 class="text-lg font-medium text-mono">
                    {{ __('Forgot password') }}
                </h3>
                <span class="text-sm text-secondary-foreground">
                    {{ __('Enter your email to receive a password reset link') }}
                </span>
            </div>

            <x-auth-session-status class="text-center text-sm text-green-600 dark:text-green-400"
                                   :status="session('status')"/>

            <div class="flex flex-col gap-1">
                <label class="kt-form-label font-normal text-mono" for="email">
                    {{ __('Email address') }}
                </label>
                <input
                    id="email"
                    name="email"
                    class="kt-input @error('email') border-red-500 @enderror"
                    placeholder="email@example.com"
                    type="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                />
                @error('email')
                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="kt-btn kt-btn-primary flex justify-center grow">
                {{ __('Email password reset link') }}
                <i class="ki-filled ki-black-right"></i>
            </button>

            <div class="text-center mt-2">
                <a class="text-sm kt-link" href="{{ route('login') }}" wire:navigate>
                    {{ __('Back to login') }}
                </a>
            </div>
        </form>
    </div>
</x-layouts::auth>
