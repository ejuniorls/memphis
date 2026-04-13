<x-layouts::auth :title="__('Register')">
    <div class="kt-card max-w-[370px] w-full">
        <form action="{{ route('register.store') }}" class="kt-card-content flex flex-col gap-5 p-10" id="sign_up_form" method="POST">
            @csrf

            <div class="text-center mb-2.5">
                <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
                    {{ __('Create an account') }}
                </h3>
                <div class="flex items-center justify-center">
                    <span class="text-sm text-secondary-foreground me-1.5">
                        {{ __('Already have an account?') }}
                    </span>
                    <a class="text-sm link" href="{{ route('login') }}" wire:navigate>
                        {{ __('Log in') }}
                    </a>
                </div>
            </div>

            <div class="flex flex-col gap-1">
                <label class="kt-form-label text-mono" for="name">
                    {{ __('Name') }}
                </label>
                <input
                    id="name"
                    name="name"
                    class="kt-input @error('name') border-red-500 @enderror"
                    placeholder="{{ __('Full name') }}"
                    type="text"
                    value="{{ old('name') }}"
                    required
                    autofocus
                />
                @error('name')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label class="kt-form-label text-mono" for="email">
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
                />
                @error('email')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex flex-col gap-1">
                <label class="kt-form-label font-normal text-mono" for="password">
                    {{ __('Password') }}
                </label>
                <div class="kt-input flex items-center" data-kt-toggle-password="true">
                    <input
                        id="password"
                        name="password"
                        placeholder="{{ __('Password') }}"
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

            <div class="flex flex-col gap-1">
                <label class="kt-form-label font-normal text-mono" for="password_confirmation">
                    {{ __('Confirm Password') }}
                </label>
                <div class="kt-input flex items-center" data-kt-toggle-password="true">
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="{{ __('Confirm Password') }}"
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
            </div>

            <label class="kt-checkbox-group">
                <input class="kt-checkbox kt-checkbox-sm" name="terms" type="checkbox" required value="1"/>
                <span class="kt-checkbox-label">
                    {{ __('I accept the') }}
                    <a class="text-sm link" href="#">
                        {{ __('Terms and Conditions') }}
                    </a>
                </span>
            </label>

            <button type="submit" class="kt-btn kt-btn-primary flex justify-center grow">
                {{ __('Create account') }}
            </button>
        </form>
    </div>
</x-layouts::auth>
