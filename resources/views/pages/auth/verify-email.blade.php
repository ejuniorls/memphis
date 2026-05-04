<x-layouts::auth :title="__('auth.verify-email.title')">
    <div class="kt-card max-w-[440px] w-full">
        <div class="kt-card-content p-10">

            <div class="flex justify-center py-10">
                <img alt="" class="dark:hidden max-h-[130px]" src="assets/media/illustrations/30.svg"/>
                <img alt="" class="light:hidden max-h-[130px]" src="assets/media/illustrations/30-dark.svg"/>
            </div>

            <h3 class="text-lg font-medium text-mono text-center mb-3">
                {{ __('auth.verify-email.heading') }}
            </h3>

            <p class="text-sm text-center text-secondary-foreground mb-7.5">
                {{ __('auth.verify-email.description') }}
            </p>

            @if (session('status') == 'verification-link-sent')
                <p class="text-sm text-center font-medium text-green-600 dark:text-green-400 mb-5">
                    {{ __('auth.verify-email.link_sent') }}
                </p>
            @endif

            <div class="flex justify-center mb-5">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="kt-btn kt-btn-primary flex justify-center">
                        {{ __('auth.verify-email.resend') }}
                    </button>
                </form>
            </div>

            <div class="flex items-center justify-center gap-1 text-2sm">
                <span class="text-secondary-foreground">
                    {{ __('auth.verify-email.another_account') }}
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="font-medium kt-link">
                        {{ __('auth.verify-email.logout') }}
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-layouts::auth>
