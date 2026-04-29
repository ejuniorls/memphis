<x-layouts::auth :title="__('Email verification')">
    <div class="kt-card max-w-[440px] w-full">
        <div class="kt-card-content p-10">

            <div class="flex justify-center py-10">
                <img alt="" class="dark:hidden max-h-[130px]" src="assets/media/illustrations/30.svg"/>
                <img alt="" class="light:hidden max-h-[130px]" src="assets/media/illustrations/30-dark.svg"/>
            </div>

            <h3 class="text-lg font-medium text-mono text-center mb-3">
                {{ __('Check your email') }}
            </h3>

            <p class="text-sm text-center text-secondary-foreground mb-7.5">
                {{ __('Please click the link sent to your email to verify your account. Thank you.') }}
            </p>

            @if (session('status') == 'verification-link-sent')
                <p class="text-sm text-center font-medium text-green-600 dark:text-green-400 mb-5">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
            @endif

            <div class="flex justify-center mb-5">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="kt-btn kt-btn-primary flex justify-center">
                        {{ __('Resend verification email') }}
                    </button>
                </form>
            </div>

            <div class="flex items-center justify-center gap-1 text-2sm">
                <span class="text-secondary-foreground">
                    {{ __('Want to use another account?') }}
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="font-medium kt-link">
                        {{ __('Log out') }}
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-layouts::auth>
