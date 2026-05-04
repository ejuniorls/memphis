@props([
    'title',
    'description' => null,
    'code'        => null,
])

<div
    x-data="{ open: false, copied: false }"
    class="kt-card"
>
    <div class="kt-card-header gap-3">
        <div class="flex flex-col gap-0.5 flex-1 min-w-0">
            <h3 class="kt-card-title text-base">{{ $title }}</h3>
            @if ($description)
                <p class="text-sm text-secondary-foreground leading-relaxed">{!! $description !!}</p>
            @endif
        </div>

        @if ($code)
            <button
                @click="open = !open"
                :class="open ? 'kt-btn-primary' : 'kt-btn-ghost'"
                class="kt-btn kt-btn-sm shrink-0"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/>
                </svg>
                <span x-text="open ? 'Ocultar código' : 'Ver código'"></span>
            </button>
        @endif
    </div>

    <div class="kt-card-content py-6">
        {{ $slot }}
    </div>

    @if ($code)
        <div x-show="open" x-collapse class="border-t border-input">
            <div class="relative">
                <div class="flex items-center justify-between px-4 py-2 bg-muted/50 border-b border-input">
                    <div class="flex items-center gap-1.5">
                        <span class="size-2.5 rounded-full bg-destructive/50"></span>
                        <span class="size-2.5 rounded-full bg-warning/50"></span>
                        <span class="size-2.5 rounded-full bg-success/50"></span>
                    </div>
                    <span class="text-xs font-mono text-secondary-foreground">blade</span>
                    <button
                        @click="
                            navigator.clipboard.writeText($refs.codeblock.textContent);
                            copied = true;
                            setTimeout(() => copied = false, 2000)
                        "
                        class="flex items-center gap-1.5 text-xs text-secondary-foreground hover:text-mono transition-colors"
                    >
                        <template x-if="!copied">
                            <span class="flex items-center gap-1.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/>
                                </svg>
                                Copiar
                            </span>
                        </template>
                        <template x-if="copied">
                            <span class="flex items-center gap-1.5 text-success">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 6 9 17l-5-5"/>
                                </svg>
                                Copiado!
                            </span>
                        </template>
                    </button>
                </div>
                <pre class="overflow-x-auto p-4 text-xs font-mono leading-relaxed text-foreground bg-muted/20 m-0"><code x-ref="codeblock">{{ $code }}</code></pre>
            </div>
        </div>
    @endif
</div>
