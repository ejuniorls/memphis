@props(['active' => null, 'components' => []])

@php
    $grouped = !empty($components) ? $components : [
        'General'  => [
            'button'     => ['label' => 'Button'],
            'badge'      => ['label' => 'Badge'],
        ],
        'Feedback' => [
            'alert'      => ['label' => 'Alert'],
        ],
        'Layout'   => [
            'card'       => ['label' => 'Card'],
            'accordion'  => ['label' => 'Accordion'],
        ],
        'Overlay'  => [
            'modal'      => ['label' => 'Modal'],
        ],
        'Data'     => [
            'table'      => ['label' => 'Table'],
        ],
        'Forms'    => [
            'form-input' => ['label' => 'Form Input'],
        ],
    ];

    $groupIcons = [
        'General'  => 'lucide-box',
        'Feedback' => 'lucide-message-circle',
        'Layout'   => 'lucide-layout-dashboard',
        'Overlay'  => 'lucide-layers',
        'Data'     => 'lucide-database',
        'Forms'    => 'lucide-form-input',
    ];
@endphp

<aside class="w-56 shrink-0 sticky top-4 flex flex-col gap-6">

    {{-- Logo / título --}}
    <div class="flex items-center gap-2.5 px-1">
        <div class="size-7 rounded-lg bg-primary flex items-center justify-center shrink-0">
            <x-lucide-component class="size-3.5 text-white" />
        </div>
        <span class="text-sm font-semibold text-mono">UI Components</span>
    </div>

    <nav class="flex flex-col gap-0.5">

        {{-- Introdução --}}
        <a
            href="{{ route('documentation.index') }}"
            wire:navigate
            @class([
                'flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-sm font-medium transition-colors',
                'text-primary bg-primary/8' => $active === 'overview',
                'text-secondary-foreground hover:text-mono hover:bg-accent' => $active !== 'overview',
            ])>
            <x-lucide-house class="size-4 shrink-0" />
            Introdução
        </a>

    </nav>

    {{-- Grupos --}}
    @foreach($grouped as $group => $items)
        <div class="flex flex-col gap-1">

            {{-- Cabeçalho do grupo --}}
            <div class="flex items-center gap-2 px-2.5 mb-0.5">
                @svg($groupIcons[$group] ?? 'lucide-folder', ['class' => 'size-3.5 text-muted-foreground shrink-0'])
                <span class="text-[11px] uppercase tracking-wider font-semibold text-muted-foreground">
                    {{ $group }}
                </span>
            </div>

            {{-- Itens --}}
            <ul class="flex flex-col gap-0.5">
                @foreach($items as $slug => $comp)
                    <li>
                        <a
                            href="{{ route('documentation.components', ['component' => $slug]) }}"
                            wire:navigate
                            @class([
                                'flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-sm transition-colors',
                                'text-primary font-medium bg-primary/8' => $active === $slug,
                                'text-secondary-foreground hover:text-mono hover:bg-accent' => $active !== $slug,
                            ])>
                            @if($active === $slug)
                                <span class="size-1.5 rounded-full bg-primary shrink-0"></span>
                            @else
                                <span class="size-1.5 rounded-full bg-transparent shrink-0"></span>
                            @endif
                            {{ $comp['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>

        </div>
    @endforeach

    {{-- Footer --}}
    <div class="pt-2 border-t border-border">
        <a
            href="https://ktui.io/docs"
            target="_blank"
            class="flex items-center gap-2 px-2.5 py-1.5 rounded-lg text-sm text-muted-foreground hover:text-mono hover:bg-accent transition-colors">
            <x-lucide-external-link class="size-4 shrink-0" />
            KTUI Docs
        </a>
    </div>

</aside>
