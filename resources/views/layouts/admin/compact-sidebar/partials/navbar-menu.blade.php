{{--
    Partial: navbar-menu (compact-sidebar)
    Mesmo padrão do horizontal-menu, mas o kt-menu-link não tem padding vertical
    (pb-2 lg:pb-4) — a borda inferior ativa é controlada por border-b-2 no item.
--}}

@php
    $navItems = $menuTree->where('is_section_header', false)->values();
@endphp

<div class="kt-menu gap-5 lg:gap-7.5" data-kt-menu="true">

    @foreach ($navItems as $item)
        @php
            $hasChildren = $item->children->isNotEmpty();
            $isActive    = $item->isActive() || $item->hasActiveChild();
        @endphp

        @if ($hasChildren)
            <div
                class="kt-menu-item border-b-2 border-b-transparent
                       kt-menu-item-active:border-b-mono kt-menu-item-here:border-b-mono
                       {{ $isActive ? 'kt-menu-item-here' : '' }}"
                data-kt-menu-item-placement="bottom-start"
                data-kt-menu-item-placement-rtl="bottom-end"
                data-kt-menu-item-toggle="dropdown"
                data-kt-menu-item-trigger="click|lg:hover"
            >
                <div class="kt-menu-link gap-1.5" tabindex="0">
                    <span class="kt-menu-title text-nowrap text-sm
                                 {{ $isActive ? 'text-mono font-medium' : 'text-foreground' }}
                                 kt-menu-item-active:text-mono kt-menu-item-active:font-medium
                                 kt-menu-item-here:text-mono kt-menu-item-here:font-medium
                                 kt-menu-item-show:text-mono kt-menu-link-hover:text-mono">
                        {{ $item->label }}
                    </span>
                    <span class="kt-menu-arrow">
                        <i class="ki-filled ki-down text-xs text-muted-foreground"></i>
                    </span>
                </div>
                <div class="kt-menu-dropdown kt-menu-default py-2 min-w-[200px]">
                    @foreach ($item->children as $child)
                        @include('layouts.admin.compact-sidebar.partials.navbar-menu-item', [
                            'item' => $child,
                        ])
                    @endforeach
                </div>
            </div>

        @else
            <div
                class="kt-menu-item border-b-2 border-b-transparent
                       kt-menu-item-active:border-b-mono kt-menu-item-here:border-b-mono
                       {{ $isActive ? 'kt-menu-item-here' : '' }}"
            >
                <a class="kt-menu-link gap-2.5" href="{{ $item->url() }}" tabindex="0">
                    <span class="kt-menu-title text-nowrap text-sm
                                 {{ $isActive ? 'text-mono font-medium' : 'text-foreground' }}
                                 kt-menu-item-active:text-mono kt-menu-item-active:font-medium
                                 kt-menu-item-here:text-mono kt-menu-item-here:font-medium
                                 kt-menu-link-hover:text-mono">
                        {{ $item->label }}
                    </span>
                </a>
            </div>
        @endif

    @endforeach

</div>
