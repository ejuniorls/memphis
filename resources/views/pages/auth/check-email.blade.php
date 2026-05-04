<x-layouts::auth :title="__('auth.check-email.title')">
    <div class="kt-card max-w-[420px] w-full">
        <div class="kt-card-content flex flex-col items-center gap-5 p-10 text-center">

            <div class="flex justify-center py-4">
                <img alt="" class="dark:hidden max-h-[130px]" src="{{ asset('assets/media/illustrations/30.svg') }}"/>
                <img alt="" class="light:hidden max-h-[130px]" src="{{ asset('assets/media/illustrations/30-dark.svg') }}"/>
            </div>

            <div class="flex flex-col gap-2">
                <h3 class="text-lg font-medium text-mono leading-none">
                    {{ __('auth.check-email.heading') }}
                </h3>
                <p class="text-sm text-secondary-foreground">
                    {{ __('auth.check-email.description') }}
                    @if (session('email'))
                        <span class="font-medium text-mono">{{ session('email') }}</span>
                    @endif
                </p>
            </div>

            <div class="flex flex-col items-center gap-3 w-full mt-2">
                <x-ui.button variant="primary" tag="a" href="{{ route('login') }}" wire:navigate class="w-full justify-center">
                    {{ __('auth.check-email.back_to_login') }}
                </x-ui.button>

                <div class="flex items-center justify-center gap-1 text-sm">
                    <span class="text-secondary-foreground">{{ __('auth.check-email.no_email') }}</span>
                    <x-ui.link href="{{ route('password.request') }}" wire:navigate>
                        {{ __('auth.check-email.resend') }}
                    </x-ui.link>
                </div>
            </div>

        </div>
    </div>
</x-layouts::auth>
