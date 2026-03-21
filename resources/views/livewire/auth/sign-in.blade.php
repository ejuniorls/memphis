<div class="kt-card max-w-[370px] w-full">
    <form action="#" class="kt-card-content flex flex-col gap-5 p-10" id="sign_in_form" method="get">
        <div class="text-center mb-2.5">
            <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
                {{ __('auth.sign_in.title') }}
            </h3>
            <div class="flex items-center justify-center font-medium">
                <span class="text-sm text-secondary-foreground me-1.5">
                    {{ __('auth.sign_in.need_account') }}
                </span>
                <a class="text-sm link" href="{{ route('auth.sign-up') }}">
                    {{ __('auth.sign_in.sign_up_link') }}
                </a>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-2.5">
            <a class="kt-btn kt-btn-outline justify-center" href="#">
                <img alt="" class="size-3.5 shrink-0" src="assets/media/brand-logos/google.svg"/>
                {{ __('auth.sign_in.use_google') }}
            </a>
            <a class="kt-btn kt-btn-outline justify-center" href="#">
                <img alt="" class="size-3.5 shrink-0 dark:hidden" src="assets/media/brand-logos/apple-black.svg"/>
                <img alt="" class="size-3.5 shrink-0 light:hidden" src="assets/media/brand-logos/apple-white.svg"/>
                {{ __('auth.sign_in.use_apple') }}
            </a>
        </div>
        <div class="flex items-center gap-2">
            <span class="border-t border-border w-full"></span>
            <span class="text-xs text-muted-foreground font-medium uppercase">
                {{ __('auth.sign_in.or') }}
            </span>
            <span class="border-t border-border w-full"></span>
        </div>
        <div class="flex flex-col gap-1">
            <label class="kt-form-label font-normal text-mono">
                {{ __('auth.sign_in.email_label') }}
            </label>
            <input class="kt-input"
                   placeholder="{{ __('auth.sign_in.email_placeholder') }}"
                   type="text"
                   value=""/>
        </div>
        <div class="flex flex-col gap-1">
            <div class="flex items-center justify-between gap-1">
                <label class="kt-form-label font-normal text-mono">
                    {{ __('auth.sign_in.password_label') }}
                </label>
                <a class="text-sm kt-link shrink-0" href="{{ route('auth.enter-email') }}">
                    {{ __('auth.sign_in.forgot_password') }}
                </a>
            </div>
            <div class="kt-input" data-kt-toggle-password="true">
                <input name="user_password"
                       placeholder="{{ __('auth.sign_in.password_placeholder') }}"
                       type="password"
                       value=""/>
                <button class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5"
                        data-kt-toggle-password-trigger="true"
                        type="button">
                    <span class="kt-toggle-password-active:hidden">
                        <i class="ki-filled ki-eye text-muted-foreground"></i>
                    </span>
                    <span class="hidden kt-toggle-password-active:block">
                        <i class="ki-filled ki-eye-slash text-muted-foreground"></i>
                    </span>
                </button>
            </div>
        </div>
        <label class="kt-label">
            <input class="kt-checkbox kt-checkbox-sm" name="check" type="checkbox" value="1"/>
            <span class="kt-checkbox-label">
                {{ __('auth.sign_in.remember_me') }}
            </span>
        </label>

        <x-ui.button>{{ __('auth.sign_in.submit') }}</x-ui.button>
    </form>
</div>
