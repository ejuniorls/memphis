<x-layouts::auth :title="__('Password changed')">
    <div class="kt-card max-w-[420px] w-full">
        <div class="kt-card-content flex flex-col items-center gap-5 p-10 text-center">

            <div class="flex justify-center py-4">
                <img alt="" class="dark:hidden max-h-[180px]" src="{{ asset('assets/media/illustrations/32.svg') }}"/>
                <img alt="" class="light:hidden max-h-[180px]" src="{{ asset('assets/media/illustrations/32-dark.svg') }}"/>
            </div>

            <div class="flex flex-col gap-2">
                <h3 class="text-lg font-medium text-mono leading-none">
                    {{ __('Password changed') }}
                </h3>
                <p class="text-sm text-secondary-foreground">
                    {{ __('Your password has been successfully updated.') }}
                    <br/>
                    {{ __("Your account's security is our priority.") }}
                </p>
            </div>

            <x-ui.button variant="primary" tag="a" href="{{ route('login') }}" wire:navigate class="w-full justify-center mt-2">
                {{ __('Sign in') }}
            </x-ui.button>

        </div>
    </div>
</x-layouts::auth>
