<x-layouts::auth :title="__('Reset password')">
    <div class="kt-card max-w-[370px] w-full">
        <form action="{{ route('password.update') }}" class="kt-card-content flex flex-col gap-5 p-10" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <div class="text-center mb-2.5">
                <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
                    {{ __('Reset password') }}
                </h3>
                <p class="text-sm text-secondary-foreground">
                    {{ __('Please enter your new password below') }}
                </p>
            </div>

            <x-auth-session-status class="text-center text-sm text-red-600" :status="session('status')" />

            <div class="flex flex-col gap-1">
                <label class="kt-form-label font-normal text-mono" for="email">
                    {{ __('Email') }}
                </label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    class="kt-input @error('email') border-red-500 @enderror"
                    value="{{ request('email') }}"
                    required
                    autocomplete="email"
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
                        type="password"
                        class="w-full bg-transparent border-none focus:ring-0"
                        placeholder="{{ __('Enter new password') }}"
                        required
                        autocomplete="new-password"
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
                    {{ __('Confirm password') }}
                </label>
                <div class="kt-input flex items-center" data-kt-toggle-password="true">
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        class="w-full bg-transparent border-none focus:ring-0"
                        placeholder="{{ __('Confirm new password') }}"
                        required
                        autocomplete="new-password"
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
                @error('password_confirmation')
                <span class="text-xs text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="kt-btn kt-btn-primary flex justify-center grow">
                {{ __('Reset password') }}
            </button>
        </form>
    </div>
</x-layouts::auth>
