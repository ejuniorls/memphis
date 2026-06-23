@props([
    'id'              => null,    // string — gerado automaticamente se omitido
    'autoplay'        => false,   // bool — avança sozinho
    'autoplayInterval'=> 4000,    // int — ms entre slides (com autoplay=true)
    'infiniteLoop'    => false,   // bool — Next no último volta pro primeiro e vice-versa
    'pauseOnHover'    => true,    // bool — pausa autoplay no hover/focus
    'showScrollbar'   => false,   // bool — exibe scrollbar nativa (default: oculta)
    'centered'        => false,   // bool — centraliza o slide ativo
    'autoHeight'      => false,   // bool — altura do viewport acompanha o slide ativo
    'draggable'       => false,   // bool — arrastar com mouse/touch (incompatível com snap)
    'snap'            => false,   // bool — scroll-snap (desativa draggable)
    'gap'             => 'gap-4', // string — classe de espaçamento entre slides
])

@php
    $rootId = $id ?? 'carousel_' . uniqid();
@endphp

<div
    id="{{ $rootId }}"
    data-kt-carousel="true"
    tabindex="0"
    @if ($autoplay)         data-kt-carousel-autoplay="true" @endif
    @if ($autoplay)         data-kt-carousel-autoplay-interval="{{ $autoplayInterval }}" @endif
    @if ($infiniteLoop)     data-kt-carousel-infinite-loop="true" @endif
    @if (!$pauseOnHover)    data-kt-carousel-pause-on-hover="false" @endif
    @if ($showScrollbar)    data-kt-carousel-show-scrollbar="true" @endif
    @if ($centered)         data-kt-carousel-centered="true" @endif
    @if ($autoHeight)       data-kt-carousel-auto-height="true" @endif
    @if ($draggable)        data-kt-carousel-draggable="true" @endif
    @if ($snap)              data-kt-carousel-snap="true" @endif
    {{ $attributes->merge(['class' => 'mx-auto w-full space-y-3']) }}
>
    {{ $slot }}
</div>
