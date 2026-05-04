<x-layouts::auth :title="__('auth.forgot-password.title')">
    <div class="kt-card max-w-[420px] w-full">
        <form action="{{ route('password.email') }}" class="kt-card-content flex flex-col gap-5 p-10" method="POST">
            @csrf

            <div class="text-center mb-2.5">
                <h3 class="text-lg font-medium text-mono leading-none mb-2.5">
                    {{ __('auth.forgot-password.heading') }}
                </h3>
                <p class="text-sm text-secondary-foreground">
                    {{ __('auth.forgot-password.description') }}
                </p>
            </div>

            <x-ui.form-field label="{{ __('auth.forgot-password.email') }}" name="email">
                <x-ui.input
                    id="email"
                    name="email"
                    type="email"
                    placeholder="email@example.com"
                    value="{{ old('email') }}"
                    :invalid="$errors->has('email')"
                    required
                    autofocus
                />
            </x-ui.form-field>

            <x-ui.button variant="primary" type="submit" class="flex justify-center grow">
                {{ __('auth.forgot-password.submit') }}
            </x-ui.button>

            <div class="flex items-center justify-center">
                <x-ui.link href="{{ route('login') }}" wire:navigate size="sm">
                    {{ __('auth.forgot-password.back_to_login') }}
                </x-ui.link>
            </div>
        </form>
    </div>
</x-layouts::auth>
