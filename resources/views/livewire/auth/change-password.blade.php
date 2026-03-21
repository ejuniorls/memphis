<div class="kt-card max-w-[370px] w-full">
    <form action="#" class="kt-card-content flex flex-col gap-5 p-10" id="reset_password_change_password_form"
          method="post">
        <div class="text-center">
            <h3 class="text-lg font-medium text-mono">
                {{ __('auth.change_password.title') }}
            </h3>
            <span class="text-sm text-secondary-foreground">
                {{ __('auth.change_password.subtitle') }}
            </span>
        </div>
        <div class="flex flex-col gap-1">
            <label class="kt-form-label text-mono">
                {{ __('auth.change_password.new_password_label') }}
            </label>
            <label class="kt-input" data-kt-toggle-password="true">
                <input name="user_new_password"
                       placeholder="{{ __('auth.change_password.new_password_placeholder') }}"
                       type="password"
                       value=""/>
                <div class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5"
                     data-kt-toggle-password-trigger="true">
                    <span class="kt-toggle-password-active:hidden">
                        <i class="ki-filled ki-eye text-muted-foreground"></i>
                    </span>
                    <span class="hidden kt-toggle-password-active:block">
                        <i class="ki-filled ki-eye-slash text-muted-foreground"></i>
                    </span>
                </div>
            </label>
        </div>
        <div class="flex flex-col gap-1">
            <label class="kt-form-label font-normal text-mono">
                {{ __('auth.change_password.confirm_password_label') }}
            </label>
            <label class="kt-input" data-kt-toggle-password="true">
                <input name="user_confirm_password"
                       placeholder="{{ __('auth.change_password.confirm_password_placeholder') }}"
                       type="password"
                       value=""/>
                <div class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5"
                     data-kt-toggle-password-trigger="true">
                    <span class="kt-toggle-password-active:hidden">
                        <i class="ki-filled ki-eye text-muted-foreground"></i>
                    </span>
                    <span class="hidden kt-toggle-password-active:block">
                        <i class="ki-filled ki-eye-slash text-muted-foreground"></i>
                    </span>
                </div>
            </label>
        </div>
        <button class="kt-btn kt-btn-primary flex justify-center grow">
            {{ __('auth.change_password.submit') }}
        </button>
    </form>
</div>
