<x-layouts::auth :title="__('pages.auth.confirm-password.title')">
    <div class="flex flex-col gap-6">
        <x-auth-header
            :title="__('pages.auth.confirm-password.heading')"
            :description="__('pages.auth.confirm-password.description')"
        />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.confirm.store') }}" class="flex flex-col gap-6">
            @csrf

            <flux:input
                name="password"
                :label="__('pages.auth.confirm-password.password')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('pages.auth.confirm-password.password_placeholder')"
                viewable
            />

            <flux:button variant="primary" type="submit" class="w-full" data-test="confirm-password-button">
                {{ __('pages.auth.confirm-password.submit') }}
            </flux:button>
        </form>
    </div>
</x-layouts::auth>
