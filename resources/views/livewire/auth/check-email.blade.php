<div class="kt-card max-w-[440px] w-full">
    <div class="kt-card-content p-10">
        <div class="flex justify-center py-10">
            <img alt="image" class="dark:hidden max-h-[130px]" src="assets/media/illustrations/30.svg"/>
            <img alt="image" class="light:hidden max-h-[130px]" src="assets/media/illustrations/30-dark.svg"/>
        </div>
        <h3 class="text-lg font-medium text-mono text-center mb-3">
            {{ __('auth.check_email.title') }}
        </h3>
        <div class="text-sm text-center text-secondary-foreground mb-7.5">
            {{ __('auth.check_email.description') }}
            <a class="text-sm text-foreground font-medium hover:text-primary" href="#">
                {{ $email ?? 'bob@reui.io' }}
            </a>
            <br/>
            {{ __('auth.check_email.description_end') }}
        </div>
        <div class="flex justify-center mb-5">
            <a class="kt-btn kt-btn-primary flex justify-center"
               href="{{ route('auth.change-password') }}">
                {{ __('auth.check_email.skip') }}
            </a>
        </div>
        <div class="flex items-center justify-center gap-1">
            <span class="text-xs text-secondary-foreground">
                {{ __('auth.check_email.no_email') }}
            </span>
            <a class="text-xs font-medium link" href="{{ route('auth.enter-email') }}">
                {{ __('auth.check_email.resend') }}
            </a>
        </div>
    </div>
</div>
