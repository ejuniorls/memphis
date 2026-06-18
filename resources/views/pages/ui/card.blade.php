<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Cards')]
class extends Component {
    //
}; ?>

<div class="flex flex-col gap-6 p-6">

    {{-- 1. Basic Usage --}}
    <x-ui.card title="Basic Usage">
        <div class="kt-card-content">
            <x-ui.card title="Recent Users" class="w-[400px]">
                <x-slot:toolbar>
                    <x-ui.button size="xs" :outline="true" :icon-only="true" icon="settings" />
                </x-slot:toolbar>
                <div class="kt-card-content py-1">
                    @foreach ([
                        ['name' => 'Kathryn Campbell', 'email' => 'kathryn@apple.com',  'status' => 'Active',   'variant' => 'primary'],
                        ['name' => 'Robert Smith',     'email' => 'robert@openai.com',  'status' => 'Inactive', 'variant' => 'secondary'],
                        ['name' => 'Sophia Johnson',   'email' => 'sophia@meta.com',    'status' => 'Active',   'variant' => 'primary'],
                        ['name' => 'Lucas Walker',     'email' => 'lucas@tesla.com',    'status' => 'Inactive', 'variant' => 'secondary'],
                        ['name' => 'Emily Davis',      'email' => 'emily@sap.com',      'status' => 'Active',   'variant' => 'primary'],
                    ] as $user)
                        <div class="flex items-center justify-between gap-2 py-2 border-b border-border border-dashed last:border-none">
                            <div class="flex items-center gap-3">
                                <div class="kt-avatar size-8">
                                    <div class="kt-avatar-image">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user['name']) }}&size=32" alt="{{ $user['name'] }}" />
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="text-sm font-medium text-foreground hover:text-primary">{{ $user['name'] }}</a>
                                    <div class="text-sm font-normal text-muted-foreground">{{ $user['email'] }}</div>
                                </div>
                            </div>
                            <x-ui.badge variant="{{ $user['variant'] }}" style="outline">{{ $user['status'] }}</x-ui.badge>
                        </div>
                    @endforeach
                </div>
                <x-slot:footer>
                    <button class="kt-link kt-link-underlined underline-dashed">Learn more</button>
                </x-slot:footer>
            </x-ui.card>
        </div>
    </x-ui.card>

    {{-- 2. Accent --}}
    <x-ui.card title="Accent">
        <div class="kt-card-content">
            <x-ui.card accent title="Recent Users" class="w-[400px]">
                <x-slot:toolbar>
                    <x-ui.button size="xs" :outline="true" :icon-only="true" icon="settings" />
                </x-slot:toolbar>
                <div class="kt-card-content py-1">
                    @foreach ([
                        ['name' => 'Kathryn Campbell', 'email' => 'kathryn@apple.com', 'status' => 'Active',   'variant' => 'primary'],
                        ['name' => 'Robert Smith',     'email' => 'robert@openai.com', 'status' => 'Inactive', 'variant' => 'secondary'],
                        ['name' => 'Sophia Johnson',   'email' => 'sophia@meta.com',   'status' => 'Active',   'variant' => 'primary'],
                    ] as $user)
                        <div class="flex items-center justify-between gap-2 py-2 border-b border-border border-dashed last:border-none">
                            <div class="flex items-center gap-3">
                                <div class="kt-avatar size-8">
                                    <div class="kt-avatar-image">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user['name']) }}&size=32" alt="{{ $user['name'] }}" />
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="text-sm font-medium text-foreground hover:text-primary">{{ $user['name'] }}</a>
                                    <div class="text-sm font-normal text-muted-foreground">{{ $user['email'] }}</div>
                                </div>
                            </div>
                            <x-ui.badge variant="{{ $user['variant'] }}" style="outline">{{ $user['status'] }}</x-ui.badge>
                        </div>
                    @endforeach
                </div>
                <x-slot:footer>
                    <button class="kt-link kt-link-underlined underline-dashed">Learn more</button>
                </x-slot:footer>
            </x-ui.card>
        </div>
    </x-ui.card>

    {{-- 3. Simple Content --}}
    <x-ui.card title="Simple Content">
        <div class="kt-card-content">
            <x-ui.card class="w-[400px]">
                <div class="kt-card-content space-y-4">
                    <div>
                        <h3 class="text-sm font-semibold text-foreground">Project Kickoff</h3>
                        <p class="mt-1 text-sm text-muted-foreground">Finalize scope, owners, and launch milestones for the next sprint.</p>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-muted-foreground">Due date</span>
                        <span class="font-medium text-foreground">May 15, 2026</span>
                    </div>
                </div>
            </x-ui.card>
        </div>
    </x-ui.card>

    {{-- 4. Media and Meta --}}
    <x-ui.card title="Media and Meta">
        <div class="kt-card-content">
            <x-ui.card overflow class="w-[400px]">
                <img
                    src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1200&q=80"
                    alt="Product roadmap"
                    class="h-44 w-full object-cover"
                />
                <div class="kt-card-content space-y-4">
                    <div class="space-y-1">
                        <h3 class="text-base font-semibold text-foreground">Product Roadmap Review</h3>
                        <p class="text-sm text-muted-foreground">Align design, engineering, and growth priorities for Q3 planning.</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3 text-sm text-muted-foreground">
                        <span class="inline-flex items-center gap-1.5">
                            @svg('lucide-calendar-clock', ['class' => 'size-4'])
                            Tue, 10:00 AM
                        </span>
                        <span class="inline-flex items-center gap-1.5">
                            @svg('lucide-users', ['class' => 'size-4'])
                            8 attendees
                        </span>
                    </div>
                </div>
            </x-ui.card>
        </div>
    </x-ui.card>

    {{-- 5. Loading Skeleton --}}
    <x-ui.card title="Loading Skeleton">
        <div class="kt-card-content">
            <x-ui.card title="Loading State" class="w-[400px]">
                <div class="kt-card-content space-y-3">
                    <div class="kt-skeleton h-4 w-2/5"></div>
                    <div class="kt-skeleton h-3 w-full"></div>
                    <div class="kt-skeleton h-3 w-4/5"></div>
                    <div class="kt-skeleton h-24 w-full rounded-lg"></div>
                </div>
            </x-ui.card>
        </div>
    </x-ui.card>

    {{-- 6. Stats Grid --}}
    <x-ui.card title="Stats Grid">
        <div class="kt-card-content">
            <x-ui.card title="Weekly Performance" class="w-[560px]">
                <div class="kt-card-content grid grid-cols-2 gap-3">
                    @foreach ([
                        ['label' => 'Revenue',    'value' => '$84.2K', 'delta' => '+12.4%'],
                        ['label' => 'Orders',     'value' => '1,482',  'delta' => '+6.9%'],
                        ['label' => 'Conversion', 'value' => '4.8%',   'delta' => '+1.1%'],
                        ['label' => 'Refunds',    'value' => '0.9%',   'delta' => '-0.3%'],
                    ] as $stat)
                        <div class="rounded-lg border border-border bg-muted/30 px-4 py-3">
                            <p class="text-xs uppercase tracking-wide text-muted-foreground">{{ $stat['label'] }}</p>
                            <p class="mt-1 text-lg font-semibold text-foreground">{{ $stat['value'] }}</p>
                            <p class="mt-1 text-xs text-muted-foreground">{{ $stat['delta'] }} vs last week</p>
                        </div>
                    @endforeach
                </div>
            </x-ui.card>
        </div>
    </x-ui.card>

    {{-- 7. Action List --}}
    <x-ui.card title="Action List">
        <div class="kt-card-content">
            <x-ui.card title="Action List" class="w-[400px]">
                <div class="kt-card-content py-1">
                    @foreach ([
                        ['label' => 'Finalize onboarding copy',  'meta' => 'Ready for review'],
                        ['label' => 'Approve email sequence',     'meta' => 'Waiting for design'],
                        ['label' => 'Publish release notes',      'meta' => 'Draft in progress'],
                    ] as $action)
                        <button type="button" class="flex w-full items-center justify-between border-b border-dashed border-border py-3 text-start last:border-none">
                            <div>
                                <p class="text-sm font-medium text-foreground">{{ $action['label'] }}</p>
                                <p class="text-xs text-muted-foreground">{{ $action['meta'] }}</p>
                            </div>
                            @svg('lucide-arrow-up-right', ['class' => 'size-4 text-muted-foreground'])
                        </button>
                    @endforeach
                </div>
            </x-ui.card>
        </div>
    </x-ui.card>

</div>
