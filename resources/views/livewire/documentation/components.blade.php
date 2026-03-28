<main class="grow" role="content">
    {{-- Toolbar --}}
    <div class="pb-6">
        <div class="kt-container-fluid flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center flex-wrap gap-1 lg:gap-5">
                <h1 class="font-medium text-lg text-mono">
                    Documentação
                </h1>
                <div class="flex items-center gap-1 text-sm font-normal">
                    <a class="text-secondary-foreground hover:text-primary" href="">
                        Home
                    </a>
                    <span class="text-muted-foreground text-sm">/</span>
                    <span class="text-mono">Documentação</span>
                    <span class="text-muted-foreground text-sm">/</span>
                    <span class="text-mono">Componentes</span>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a class="kt-btn kt-btn-outline kt-btn-sm" href="#">
                    <x-lucide-github class="size-4"/>
                    Changelog
                </a>
                <a class="kt-btn kt-btn-primary kt-btn-sm" href="">
                    <x-lucide-book-open class="size-4"/>
                    Ver Componentes
                </a>
            </div>
        </div>
    </div>
    {{-- End Toolbar --}}

    <div class="kt-container-fluid grid grid-cols-1 gap-5 lg:gap-7.5">
        <x-docs.sidebar :active="$active" :components="$components"/>
    </div>
</main>










