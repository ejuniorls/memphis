<div class="kt-card max-w-[440px] w-full">
    <div class="kt-card-content p-10">
        <div class="flex justify-center mb-5">
            <img alt="image" class="dark:hidden max-h-[180px]" src="assets/media/illustrations/32.svg"/>
            <img alt="image" class="light:hidden max-h-[180px]" src="assets/media/illustrations/32-dark.svg"/>
        </div>
        <h3 class="text-lg font-medium text-mono text-center mb-4">
            {{ __('auth.password_changed.title') }}
        </h3>
        <div class="text-sm text-center text-secondary-foreground mb-7.5">
            {{ __('auth.password_changed.description') }}
        </div>
        <div class="flex justify-center">
            <a class="kt-btn kt-btn-primary" href="{{ route('auth.sign-in') }}">
                {{ __('auth.password_changed.sign_in') }}
            </a>
        </div>
    </div>
</div>
