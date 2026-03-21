<div class="kt-card max-w-[370px] w-full">
    <form action="#" class="kt-card-content flex flex-col gap-5 p-10" id="reset_password_enter_email_form"
          method="post">
        <div class="text-center">
            <h3 class="text-lg font-medium text-mono">
                {{ __('auth.enter_email.title') }}
            </h3>
            <span class="text-sm text-secondary-foreground">
                {{ __('auth.enter_email.subtitle') }}
            </span>
        </div>
        <div class="flex flex-col gap-1">
            <label class="kt-form-label font-normal text-mono">
                {{ __('auth.enter_email.email_label') }}
            </label>
            <input class="kt-input"
                   placeholder="{{ __('auth.enter_email.email_placeholder') }}"
                   type="text"
                   value=""/>
        </div>
        <a class="kt-btn kt-btn-primary flex justify-center grow"
           href="{{ route('auth.check-email') }}">
            {{ __('auth.enter_email.submit') }}
            <i class="ki-filled ki-black-right"></i>
        </a>
    </form>
</div>
