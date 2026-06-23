<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Carousel')]
class extends Component {
    //
}; ?>

<div class="kt-page">

    <div class="kt-page-header">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-medium leading-none text-mono">Carousel</h1>
                <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                    Horizontal slideshow with prev/next, optional pagination, thumbnails, autoplay, and scroll-snap.
                </div>
            </div>
        </div>
    </div>

    <div class="kt-page-content">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 lg:gap-7.5">
            <div class="col-span-2">
                <div class="flex flex-col gap-5 lg:gap-7.5">

                    {{-- 1. Basic --}}
                    <x-ui.card title="Basic">
                        <div class="kt-card-content">
                            <x-ui.carousel class="max-w-lg">
                                <div data-kt-carousel-viewport="true" class="flex gap-4 overflow-x-auto scroll-smooth">
                                    <x-ui.carousel-item>First slide</x-ui.carousel-item>
                                    <x-ui.carousel-item>Second slide</x-ui.carousel-item>
                                    <x-ui.carousel-item>Third slide</x-ui.carousel-item>
                                </div>
                                <x-ui.carousel-controls />
                            </x-ui.carousel>
                        </div>
                    </x-ui.card>

                    {{-- 2. Overlay Arrows --}}
                    <x-ui.card title="Overlay Arrows">
                        <div class="kt-card-content">
                            <div class="mx-auto w-full max-w-lg" data-kt-carousel="true" data-kt-carousel-infinite-loop="true" tabindex="0">
                                <div class="relative overflow-hidden rounded-xl border border-border">
                                    <div data-kt-carousel-viewport="true" class="bg-muted flex overflow-x-auto scroll-smooth">
                                        <div data-kt-carousel-item="true" class="flex min-w-full shrink-0 items-center justify-center py-16 text-sm font-medium">First slide</div>
                                        <div data-kt-carousel-item="true" class="flex min-w-full shrink-0 items-center justify-center py-16 text-sm font-medium">Second slide</div>
                                        <div data-kt-carousel-item="true" class="flex min-w-full shrink-0 items-center justify-center py-16 text-sm font-medium">Third slide</div>
                                    </div>
                                    <button type="button"
                                            class="absolute top-1/2 z-10 inline-flex size-10 -translate-y-1/2 items-center justify-center rounded-full border border-border bg-background text-foreground shadow-xs transition-all duration-200 hover:scale-105 hover:border-primary/40 hover:bg-primary/10 hover:text-primary hover:shadow-sm disabled:pointer-events-none disabled:opacity-50"
                                            style="left: 0.75rem;" data-kt-carousel-prev="true" aria-label="Previous slide">
                                        @svg('lucide-chevron-left', ['class' => 'size-5'])
                                    </button>
                                    <button type="button"
                                            class="absolute top-1/2 z-10 inline-flex size-10 -translate-y-1/2 items-center justify-center rounded-full border border-border bg-background text-foreground shadow-xs transition-all duration-200 hover:scale-105 hover:border-primary/40 hover:bg-primary/10 hover:text-primary hover:shadow-sm disabled:pointer-events-none disabled:opacity-50"
                                            style="right: 0.75rem;" data-kt-carousel-next="true" aria-label="Next slide">
                                        @svg('lucide-chevron-right', ['class' => 'size-5'])
                                    </button>
                                </div>
                            </div>
                        </div>
                    </x-ui.card>

                    {{-- 3. Pagination --}}
                    <x-ui.card title="Pagination">
                        <div class="kt-card-content">
                            <div class="mx-auto w-full max-w-lg space-y-4" data-kt-carousel="true" tabindex="0">
                                <div class="relative overflow-hidden rounded-xl border border-border">
                                    <div data-kt-carousel-viewport="true" class="flex gap-4 overflow-x-auto scroll-smooth">
                                        <div data-kt-carousel-item="true" class="bg-muted flex min-w-full shrink-0 items-center justify-center py-16 text-sm font-medium">Slide 1</div>
                                        <div data-kt-carousel-item="true" class="bg-muted flex min-w-full shrink-0 items-center justify-center py-16 text-sm font-medium">Slide 2</div>
                                        <div data-kt-carousel-item="true" class="bg-muted flex min-w-full shrink-0 items-center justify-center py-16 text-sm font-medium">Slide 3</div>
                                    </div>
                                    <div data-kt-carousel-pagination="true" class="absolute bottom-0 left-0 right-0 z-10 flex justify-center gap-2 bg-transparent px-2 py-2" role="tablist" aria-label="Slides">
                                        <button type="button" data-kt-carousel-pagination-item="true" class="size-2.5 shrink-0 rounded-full bg-background p-0 opacity-90 transition-opacity hover:opacity-100 aria-[current=true]:bg-primary aria-[current=true]:opacity-100" aria-label="Go to slide 1"></button>
                                        <button type="button" data-kt-carousel-pagination-item="true" class="size-2.5 shrink-0 rounded-full bg-background p-0 opacity-90 transition-opacity hover:opacity-100 aria-[current=true]:bg-primary aria-[current=true]:opacity-100" aria-label="Go to slide 2"></button>
                                        <button type="button" data-kt-carousel-pagination-item="true" class="size-2.5 shrink-0 rounded-full bg-background p-0 opacity-90 transition-opacity hover:opacity-100 aria-[current=true]:bg-primary aria-[current=true]:opacity-100" aria-label="Go to slide 3"></button>
                                    </div>
                                </div>
                                <x-ui.carousel-controls />
                            </div>
                        </div>
                    </x-ui.card>

                    {{-- 4. Autoplay --}}
                    <x-ui.card title="Autoplay">
                        <div class="kt-card-content">
                            <x-ui.carousel :autoplay="true" autoplay-interval="3500" :infinite-loop="true" class="max-w-lg">
                                <div data-kt-carousel-viewport="true" class="flex gap-4 overflow-x-auto scroll-smooth">
                                    <x-ui.carousel-item>Auto 1</x-ui.carousel-item>
                                    <x-ui.carousel-item>Auto 2</x-ui.carousel-item>
                                    <x-ui.carousel-item>Auto 3</x-ui.carousel-item>
                                </div>
                                <x-ui.carousel-controls />
                            </x-ui.carousel>
                        </div>
                    </x-ui.card>

                    {{-- 5. Infinite Loop --}}
                    <x-ui.card title="Infinite Loop">
                        <div class="kt-card-content">
                            <x-ui.carousel :infinite-loop="true" class="max-w-lg">
                                <div data-kt-carousel-viewport="true" class="flex gap-4 overflow-x-auto scroll-smooth">
                                    <x-ui.carousel-item>Loop A</x-ui.carousel-item>
                                    <x-ui.carousel-item>Loop B</x-ui.carousel-item>
                                    <x-ui.carousel-item>Loop C</x-ui.carousel-item>
                                </div>
                                <x-ui.carousel-controls />
                            </x-ui.carousel>
                        </div>
                    </x-ui.card>

                    {{-- 6. Multiple Slides --}}
                    <x-ui.card title="Multiple Slides">
                        <div class="kt-card-content">
                            <x-ui.carousel class="max-w-xl">
                                <div data-kt-carousel-viewport="true" class="flex gap-3 overflow-x-auto scroll-smooth">
                                    @foreach (['One', 'Two', 'Three', 'Four', 'Five', 'Six'] as $label)
                                        <div data-kt-carousel-item="true" class="bg-muted flex w-[45%] min-w-[45%] shrink-0 items-center justify-center rounded-lg py-12 text-sm font-medium sm:w-[31%] sm:min-w-[31%]">
                                            {{ $label }}
                                        </div>
                                    @endforeach
                                </div>
                                <x-ui.carousel-controls />
                            </x-ui.carousel>
                        </div>
                    </x-ui.card>

                    {{-- 7. Centered --}}
                    <x-ui.card title="Centered">
                        <div class="kt-card-content">
                            <div class="mx-auto w-full max-w-xl space-y-3" data-kt-carousel="true" data-kt-carousel-centered="true" tabindex="0">
                                <div data-kt-carousel-viewport="true" class="flex gap-3 overflow-x-auto scroll-smooth px-8">
                                    @foreach (['A', 'B', 'C', 'D', 'E', 'F'] as $label)
                                        <div data-kt-carousel-item="true" class="bg-muted flex w-[70%] min-w-[70%] shrink-0 items-center justify-center rounded-lg py-12 text-sm font-medium sm:w-[50%] sm:min-w-[50%]">
                                            {{ $label }}
                                        </div>
                                    @endforeach
                                </div>
                                <x-ui.carousel-controls />
                            </div>
                        </div>
                    </x-ui.card>

                    {{-- 8. Draggable --}}
                    <x-ui.card title="Draggable">
                        <div class="kt-card-content">
                            <div class="mx-auto w-full max-w-xl space-y-3">
                                <p class="text-muted-foreground text-center text-xs">Drag horizontally on the track.</p>
                                <div data-kt-carousel="true" data-kt-carousel-draggable="true" tabindex="0">
                                    <div data-kt-carousel-viewport="true" class="flex cursor-grab gap-3 overflow-x-auto scroll-smooth active:cursor-grabbing">
                                        @foreach (['Drag 1', 'Drag 2', 'Drag 3', 'Drag 4', 'Drag 5', 'Drag 6'] as $label)
                                            <div data-kt-carousel-item="true" class="bg-muted flex w-[45%] min-w-[45%] shrink-0 select-none items-center justify-center rounded-lg py-12 text-sm font-medium sm:w-[31%] sm:min-w-[31%]">
                                                {{ $label }}
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="pt-3">
                                        <x-ui.carousel-controls />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-ui.card>

                    {{-- 9. Auto Height --}}
                    <x-ui.card title="Auto Height">
                        <div class="kt-card-content">
                            <div class="mx-auto w-full max-w-lg space-y-3" data-kt-carousel="true" data-kt-carousel-auto-height="true" tabindex="0">
                                <div data-kt-carousel-viewport="true" class="flex gap-4 overflow-x-hidden overflow-y-visible scroll-smooth">
                                    <div data-kt-carousel-item="true" class="bg-muted flex min-w-full shrink-0 items-center justify-center rounded-lg py-8 text-sm font-medium">Short slide</div>
                                    <div data-kt-carousel-item="true" class="bg-muted flex min-w-full shrink-0 items-center justify-center rounded-lg py-20 text-sm font-medium">Taller slide</div>
                                    <div data-kt-carousel-item="true" class="bg-muted flex min-w-full shrink-0 items-center justify-center rounded-lg py-12 text-sm font-medium">Medium slide</div>
                                </div>
                                <x-ui.carousel-controls />
                            </div>
                        </div>
                    </x-ui.card>

                    {{-- 10. Snap --}}
                    <x-ui.card title="Snap">
                        <div class="kt-card-content">
                            <div class="mx-auto w-full max-w-xl space-y-3">
                                <p class="text-muted-foreground text-center text-xs">Viewport uses scroll snap; draggable is disabled when snap is on.</p>
                                <div data-kt-carousel="true" data-kt-carousel-snap="true" tabindex="0">
                                    <div data-kt-carousel-viewport="true" class="flex snap-x snap-mandatory gap-3 overflow-x-auto scroll-smooth">
                                        @foreach (['Snap 1', 'Snap 2', 'Snap 3', 'Snap 4', 'Snap 5', 'Snap 6'] as $label)
                                            <div data-kt-carousel-item="true" class="bg-muted flex w-[45%] min-w-[45%] shrink-0 snap-center items-center justify-center rounded-lg py-12 text-sm font-medium sm:w-[31%] sm:min-w-[31%]">
                                                {{ $label }}
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="pt-3">
                                        <x-ui.carousel-controls />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-ui.card>

                    {{-- 11. Info (current / total) --}}
                    <x-ui.card title="Info">
                        <div class="kt-card-content">
                            <div class="mx-auto w-full max-w-lg space-y-3" data-kt-carousel="true" tabindex="0">
                                <div data-kt-carousel-viewport="true" class="flex gap-4 overflow-x-auto scroll-smooth">
                                    <x-ui.carousel-item>Alpha</x-ui.carousel-item>
                                    <x-ui.carousel-item>Beta</x-ui.carousel-item>
                                    <x-ui.carousel-item>Gamma</x-ui.carousel-item>
                                </div>
                                <div class="flex items-center justify-between gap-2">
                                    <div class="text-muted-foreground text-sm tabular-nums">
                                        <span data-kt-carousel-current="true" class="text-foreground font-medium">0</span>
                                        <span> / </span>
                                        <span data-kt-carousel-total="true">0</span>
                                    </div>
                                    <x-ui.carousel-controls />
                                </div>
                            </div>
                        </div>
                    </x-ui.card>

                    {{-- 12. Thumbnails (horizontal) --}}
                    <x-ui.card title="Thumbnails">
                        <div class="kt-card-content">
                            <div class="mx-auto w-full max-w-xl space-y-4" data-kt-carousel="true" tabindex="0">
                                <div data-kt-carousel-viewport="true" class="flex gap-3 overflow-x-auto scroll-smooth">
                                    @foreach (['T1', 'T2', 'T3', 'T4', 'T5', 'T6'] as $label)
                                        <div data-kt-carousel-item="true" class="bg-muted flex min-w-full shrink-0 items-center justify-center rounded-lg py-14 text-sm font-medium">{{ $label }}</div>
                                    @endforeach
                                </div>
                                <div data-kt-carousel-thumbnails="true" class="flex justify-center gap-2 overflow-x-auto scroll-smooth pb-1" role="tablist" aria-label="Thumbnails">
                                    @foreach (['T1', 'T2', 'T3', 'T4', 'T5', 'T6'] as $i => $label)
                                        <button type="button" data-kt-carousel-thumbnail="true"
                                                class="bg-muted hover:bg-accent border-border text-muted-foreground hover:text-foreground shrink-0 rounded-md border px-3 py-2 text-xs font-medium data-[kt-carousel-thumbnail-active]:border-primary data-[kt-carousel-thumbnail-active]:text-foreground"
                                                aria-label="Thumbnail {{ $i + 1 }}">
                                            {{ $label }}
                                        </button>
                                    @endforeach
                                </div>
                                <x-ui.carousel-controls />
                            </div>
                        </div>
                    </x-ui.card>

                </div>
            </div>
        </div>
    </div>

</div>
