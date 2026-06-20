<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Avatar')]
class extends Component {
    //
};
?>

@php
    // randomuser.me fornece fotos estáveis de pessoas (mesmo seed = mesma foto sempre)
    $photo = fn($gender, $n) => "https://randomuser.me/api/portraits/{$gender}/{$n}.jpg";
@endphp

<div class="kt-page">
    <!-- Container -->
    <div class="kt-page-header">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-medium leading-none text-mono">Avatar</h1>
                <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                    An image element with a fallback for representing the user.
                </div>
            </div>
        </div>
    </div>
    <!-- End of Container -->

    <!-- Container -->
    <div class="kt-page-content">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 lg:gap-7.5">
            <div class="col-span-2">
                <div class="flex flex-col gap-5 lg:gap-7.5">

                    {{-- 1. Basic Usage --}}
                    <x-ui.card title="Basic Usage">
                        <div class="kt-card-content">
                            <x-ui.avatar :src="$photo('women', 44)" alt="Jane Doe" />
                        </div>
                    </x-ui.card>

                    {{-- 2. Fallback --}}
                    <x-ui.card title="Fallback">
                        <div class="kt-card-content flex gap-4 flex-wrap">
                            <x-ui.avatar fallback="B.A" />
                            <x-ui.avatar fallback="A.J" variant="destructive" />
                            <x-ui.avatar icon="user" variant="primary" />
                        </div>
                    </x-ui.card>

                    {{-- 3. Indicator --}}
                    <x-ui.card title="Indicator">
                        <div class="kt-card-content flex gap-4 flex-wrap">
                            <x-ui.avatar size="lg" :src="$photo('men', 32)" alt="Mike Johnson" status="online" indicator-position="top-end" />
                            <x-ui.avatar size="lg" :src="$photo('women', 68)" alt="Sarah Davis" status="online" indicator-position="bottom-end" />
                        </div>
                    </x-ui.card>

                    {{-- 4. Status --}}
                    <x-ui.card title="Status">
                        <div class="kt-card-content flex gap-4 flex-wrap">
                            <x-ui.avatar :src="$photo('women', 65)" alt="Jenny Wilson" status="online" indicator-position="top-end" />
                            <x-ui.avatar :src="$photo('men', 46)" alt="David Brown" status="offline" indicator-position="top-end" />
                            <x-ui.avatar :src="$photo('men', 29)" alt="Robert Smith" status="busy" indicator-position="bottom-end" />
                            <x-ui.avatar :src="$photo('women', 48)" alt="Emily Clark" status="away" indicator-position="bottom-end" />
                        </div>
                    </x-ui.card>

                    {{-- 5. Badge --}}
                    <x-ui.card title="Badge">
                        <div class="kt-card-content flex gap-4 flex-wrap">
                            <x-ui.avatar :src="$photo('women', 12)" alt="Anna Lee" :badge="5" badge-variant="primary" indicator-position="top-end" />
                            <x-ui.avatar :src="$photo('men', 52)" alt="Tom Wilson" :badge="2" badge-variant="destructive" indicator-position="bottom-end" />
                        </div>
                    </x-ui.card>

                    {{-- 6. Size --}}
                    <x-ui.card title="Size">
                        <div class="kt-card-content flex gap-6 flex-wrap items-end">
                            <x-ui.avatar size="xs" :src="$photo('men', 11)" status="online" indicator-position="top-end" />
                            <x-ui.avatar size="sm" :src="$photo('women', 22)" status="online" indicator-position="top-end" />
                            <x-ui.avatar :src="$photo('men', 33)" status="online" indicator-position="top-end" />
                            <x-ui.avatar size="lg" :src="$photo('women', 44)" status="online" indicator-position="top-end" />
                            <x-ui.avatar size="xl" :src="$photo('men', 55)" status="online" indicator-position="top-end" />
                        </div>
                    </x-ui.card>

                    {{-- 7. Group --}}
                    <x-ui.card title="Group">
                        <div class="kt-card-content">
                            <div class="flex -space-x-2">
                                <x-ui.avatar :src="$photo('women', 21)" :bordered="true" />
                                <x-ui.avatar :src="$photo('men', 22)" :bordered="true" />
                                <x-ui.avatar :src="$photo('women', 23)" :bordered="true" />
                                <x-ui.avatar :src="$photo('men', 24)" :bordered="true" />
                                <div class="flex justify-center items-center bg-accent text-accent-foreground relative text-xs size-10 rounded-full border-2 border-background hover:z-10">
                                    +7
                                </div>
                            </div>
                        </div>
                    </x-ui.card>

                    {{-- 8. Users --}}
                    <x-ui.card title="Users">
                        <div class="kt-card-content">
                            <div class="inline-flex items-center rounded-full p-0.5 gap-1.5 border border-border shadow-sm shadow-black/5">
                                <div class="flex -space-x-2">
                                    <x-ui.avatar size="sm" :src="$photo('women', 31)" :bordered="true" />
                                    <x-ui.avatar size="sm" :src="$photo('men', 32)" :bordered="true" />
                                    <x-ui.avatar size="sm" :src="$photo('women', 33)" :bordered="true" />
                                    <x-ui.avatar size="sm" :src="$photo('men', 34)" :bordered="true" />
                                </div>
                                <p class="text-xs text-muted-foreground me-1.5">
                                    Trusted by <span class="font-semibold text-foreground">100K+</span> users.
                                </p>
                            </div>
                        </div>
                    </x-ui.card>

                </div>
            </div>
        </div>
    </div>
    <!-- End of Container -->
</div>
