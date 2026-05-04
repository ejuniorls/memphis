<x-layouts::auth :title="__('auth.confirm-password.title')">
    <div class="flex flex-col gap-6">
        <x-auth-header
            :title="__('auth.confirm-password.heading')"
            :description="__('auth.confirm-password.description')"
        />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.confirm.store') }}" class="flex flex-col gap-6">
            @csrf

            <flux:input
                name="password"
                :label="__('auth.confirm-password.password')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('auth.confirm-password.password_placeholder')"
                viewable
            />

            <flux:button variant="primary" type="submit" class="w-full" data-test="confirm-password-button">
                {{ __('auth.confirm-password.submit') }}
            </flux:button>
        </form>
    </div>
</x-layouts::auth>
