<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>{{ $title ?? 'UI Docs' }} — {{ config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="antialiased">

        <div class="flex min-h-screen bg-background">

            {{-- Sidebar --}}
            <aside class="fixed top-0 left-0 z-20 flex h-screen w-64 flex-col border-r border-border bg-background">

                {{-- Logo --}}
                <div class="flex h-16 shrink-0 items-center gap-2.5 border-b border-border px-6">
                    <a href="{{ route('docs.index') }}" wire:navigate
                       class="flex items-center gap-2 font-semibold text-mono">
                        @svg('lucide-layout-panel-left', 'size-5 text-primary')
                        <span>UI Docs</span>
                    </a>
                </div>

                {{-- Nav --}}
                <nav class="flex-1 overflow-y-auto px-4 py-6 text-sm">

                    {{-- Getting Started --}}
                    <div class="mb-6">
                        <p class="mb-2 px-2 text-xs font-semibold uppercase tracking-widest text-muted-foreground">
                            Getting Started
                        </p>
                        <ul class="space-y-0.5">
                            <li>
                                <a href="{{ route('docs.index') }}"
                                   wire:navigate
                                    @class([
                                        'flex items-center gap-2 rounded-md px-2 py-1.5 font-medium transition-colors',
                                        'bg-primary/10 text-primary' => request()->routeIs('docs.index'),
                                        'text-muted-foreground hover:bg-muted hover:text-mono' => !request()->routeIs('docs.index'),
                                    ])>
                                    @svg('lucide-house', 'size-4 shrink-0')
                                    Introduction
                                </a>
                            </li>
                        </ul>
                    </div>

                    {{-- Components --}}
                    <div>
                        <p class="mb-2 px-2 text-xs font-semibold uppercase tracking-widest text-muted-foreground">
                            Components
                        </p>
                        <ul class="space-y-0.5">
                            @foreach ([
                                ['route' => 'docs.alert',  'icon' => 'bell',       'label' => 'Alert'],
                                ['route' => 'docs.button', 'icon' => 'square',     'label' => 'Button'],
                            ] as $item)
                                <li>
                                    <a href="{{ route($item['route']) }}"
                                       wire:navigate
                                        @class([
                                            'flex items-center gap-2 rounded-md px-2 py-1.5 font-medium transition-colors',
                                            'bg-primary/10 text-primary' => request()->routeIs($item['route']),
                                            'text-muted-foreground hover:bg-muted hover:text-mono' => !request()->routeIs($item['route']),
                                        ])>
                                        @svg('lucide-' . $item['icon'], 'size-4 shrink-0')
                                        {{ $item['label'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </nav>

                {{-- Footer --}}
                <div class="shrink-0 border-t border-border px-6 py-4">
                    <p class="text-xs text-muted-foreground">
                        {{ config('app.name') }} &middot; UI Docs
                    </p>
                </div>

            </aside>

            {{-- Main --}}
            <div class="flex flex-1 flex-col pl-64">

                {{-- Topbar --}}
                <header
                    class="sticky top-0 z-10 flex h-16 shrink-0 items-center justify-between border-b border-border bg-background px-8">
                    <div class="flex items-center gap-2 text-sm text-muted-foreground">
                        <a href="{{ route('docs.index') }}" wire:navigate class="hover:text-mono">Docs</a>
                        @isset($breadcrumb)
                            <span>/</span>
                            <span class="text-mono font-medium">{{ $breadcrumb }}</span>
                        @endisset
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="https://ktui.io/docs" target="_blank" rel="noopener"
                           class="flex items-center gap-1.5 text-sm text-muted-foreground hover:text-mono">
                            @svg('lucide-external-link', 'size-4')
                            KTUI Docs
                        </a>
                    </div>
                </header>

                {{-- Page content --}}
                <main class="flex-1 px-8 py-10">
                    <div class="mx-auto max-w-4xl">
                        {{ $slot }}
                    </div>
                </main>

            </div>

        </div>

        @livewireScripts
    </body>
</html>
