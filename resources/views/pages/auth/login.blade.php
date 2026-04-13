<x-layouts::auth :title="__('Log in')">
    <div class="kt-card max-w-[370px] w-full">
        <form action="{{ route('login.store') }}" class="kt-card-content flex flex-col gap-5 p-10" id="sign_in_form" method="POST">
            @csrf

            <div class="text-center mb-2.5">
                <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
                    {{ __('Sign in') }}
                </h3>
                <div class="flex items-center justify-center font-medium">
                    <span class="text-sm text-secondary-foreground me-1.5">
                        {{ __('Need an account?') }}
                    </span>
                    @if (Route::has('register'))
                        <a class="text-sm link" href="{{ route('register') }}" wire:navigate>
                            {{ __('Sign up') }}
                        </a>
                    @endif
                </div>
            </div>

            <x-auth-session-status class="text-center text-sm text-red-600" :status="session('status')" />

            <div class="grid grid-cols-2 gap-2.5">
                <a class="kt-btn kt-btn-outline justify-center" href="#">
                    <img alt="" class="size-3.5 shrink-0" src="assets/media/brand-logos/google.svg"/>
                    Google
                </a>
                <a class="kt-btn kt-btn-outline justify-center" href="#">
                    <img alt="" class="size-3.5 shrink-0 dark:hidden" src="assets/media/brand-logos/apple-black.svg"/>
                    Apple
                </a>
            </div>

            <div class="flex items-center gap-2">
                <span class="border-t border-border w-full"></span>
                <span class="text-xs text-muted-foreground font-medium uppercase">Or</span>
                <span class="border-t border-border w-full"></span>
            </div>

            <div class="flex flex-col gap-1">
                <label class="kt-form-label font-normal text-mono" for="email">
                    {{ __('Email') }}
                </label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    class="kt-input @error('email') border-red-500 @enderror"
                    placeholder="email@email.com"
                    value="{{ old('email') }}"
                    required
                    autofocus
                />
                @error('email')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <div class="flex items-center justify-between gap-1">
                    <label class="kt-form-label font-normal text-mono" for="password">
                        {{ __('Password') }}
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm kt-link shrink-0" href="{{ route('password.request') }}" wire:navigate>
                            {{ __('Forgot Password?') }}
                        </a>
                    @endif
                </div>
                <div class="kt-input flex items-center" data-kt-toggle-password="true">
                    <input
                        id="password"
                        name="password"
                        placeholder="{{ __('Enter Password') }}"
                        type="password"
                        class="w-full bg-transparent border-none focus:ring-0"
                        required
                    />
                    <button class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5"
                            data-kt-toggle-password-trigger="true" type="button">
                        <span class="kt-toggle-password-active:hidden">
                            <i class="ki-filled ki-eye text-muted-foreground"></i>
                        </span>
                        <span class="hidden kt-toggle-password-active:block">
                            <i class="ki-filled ki-eye-slash text-muted-foreground"></i>
                        </span>
                    </button>
                </div>
                @error('password')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <label class="kt-label">
                <input class="kt-checkbox kt-checkbox-sm" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}/>
                <span class="kt-checkbox-label">
                    {{ __('Remember me') }}
                </span>
            </label>

            <button type="submit" class="kt-btn kt-btn-primary flex justify-center grow">
                {{ __('Sign In') }}
            </button>
        </form>
    </div>
</x-layouts::auth>
