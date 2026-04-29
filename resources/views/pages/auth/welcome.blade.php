<x-layouts::auth :title="__('Bem-vindo!')">
    <div class="kt-card max-w-[440px] w-full">
        <div class="kt-card-content p-10">

            <div class="flex justify-center py-10">
                <img alt="" class="dark:hidden max-h-[130px]" src="assets/media/illustrations/30.svg"/>
                <img alt="" class="light:hidden max-h-[130px]" src="assets/media/illustrations/30-dark.svg"/>
            </div>

            <h3 class="text-lg font-medium text-mono text-center mb-3">
                {{ __('Tudo certo,') }} {{ auth()->user()->name }}!
            </h3>

            <p class="text-sm text-center text-secondary-foreground mb-7.5">
                {{ __('Seu e-mail foi verificado com sucesso. Sua conta está ativa e pronta para uso.') }}
            </p>

            <div class="flex justify-center mb-5">
                <a href="{{ route('dashboard') }}" class="kt-btn kt-btn-primary flex justify-center">
                    {{ __('Ir para o dashboard') }}
                </a>
            </div>

            <div class="flex items-center justify-center gap-1 text-2sm">
                <span class="text-secondary-foreground">
                    {{ __('Precisa de ajuda?') }}
                </span>
                <a href="mailto:{{ config('mail.from.address') }}" class="font-medium kt-link">
                    {{ __('Fale conosco') }}
                </a>
            </div>

        </div>
    </div>
</x-layouts::auth>
