@props([
    // ── Integração ───────────────────────────────────────────────────
    'id'              => null,    // string  — prefixo de IDs (gerado auto se omitido)
    'targetInput'     => null,    // string  — id do input file que receberá o blob cropado
    'model'           => null,    // string  — wire:model (alternativa ao targetInput)

    // ── Proporção e saída ─────────────────────────────────────────────
    'aspectRatio'     => null,    // float|null — 1 (quadrado), 16/9, 4/3, null = livre
    'outputWidth'     => 512,     // int    — largura do canvas exportado (px)
    'outputHeight'    => 512,     // int    — altura do canvas exportado (px)
    'quality'         => 0.92,    // float  — qualidade JPEG/WebP (0.0–1.0)
    'outputFormat'    => 'jpeg',  // string — 'jpeg' | 'png' | 'webp'

    // ── Comportamento do Cropper ──────────────────────────────────────
    'viewMode'        => 1,       // int    — 0=livre, 1=img dentro do crop, 2/3=preenche
    'dragMode'        => 'move',  // string — 'move' | 'crop'
    'autoCropArea'    => 0.9,     // float  — 0.0–1.0
    'movable'         => true,
    'zoomable'        => true,
    'rotatable'       => true,
    'scalable'        => true,
    'cropBoxMovable'  => true,
    'cropBoxResizable'=> true,
    'guides'          => true,
    'background'      => false,

    // ── Aparência do modal ────────────────────────────────────────────
    'modalTitle'      => 'Ajustar imagem',
    'cropAreaHeight'  => 360,     // int — altura em px da área de crop
    'showTools'       => true,
])

@php
    $uid        = $id ?? ('crop_' . uniqid());
    $mimeFormat = match($outputFormat) { 'png' => 'image/png', 'webp' => 'image/webp', default => 'image/jpeg' };
    $aspectJs   = is_null($aspectRatio) ? 'NaN' : (float) $aspectRatio;
    $bools      = fn($v) => $v ? 'true' : 'false';
@endphp

@once
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
@endonce

{{-- Âncora invisível — expõe o Alpine component para o mundo externo --}}
<div
    x-data="imageCropper_{{ $uid }}()"
    id="{{ $uid }}"
    style="display:none;"
></div>

@teleport('body')
<div
    x-data
    x-show="$store.{{ $uid }} && $store.{{ $uid }}.showModal"
    x-cloak
    @keydown.escape.window="$store.{{ $uid }} && $store.{{ $uid }}.cancel()"
    style="position:fixed;inset:0;z-index:9999;background:rgba(0,0,0,0.85);backdrop-filter:blur(6px);"
>
    <div style="position:fixed;inset:0;display:flex;align-items:center;justify-content:center;padding:1.25rem;">

        <div style="position:absolute;inset:0;" @click="$store.{{ $uid }}.cancel()"></div>

        <div
            class="relative kt-card flex flex-col shadow-2xl"
            style="width:100%;max-width:500px;max-height:92vh;"
            @click.stop
        >
            {{-- Header --}}
            <div class="kt-card-header shrink-0">
                <h3 class="kt-card-title flex items-center gap-2 text-sm">
                    @svg('lucide-crop', ['class' => 'size-4 shrink-0'])
                    {{ $modalTitle }}
                </h3>
                <button type="button" @click="$store.{{ $uid }}.cancel()"
                        class="text-secondary-foreground hover:text-foreground transition-colors ml-auto">
                    @svg('lucide-x', ['class' => 'size-4'])
                </button>
            </div>

            {{-- Área de crop --}}
            <div style="height:{{ $cropAreaHeight }}px;background:#111;position:relative;overflow:hidden;flex-shrink:0;">

                <div x-show="$store.{{ $uid }}.loading"
                     style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:0.75rem;background:#111;z-index:2;">
                    <svg class="animate-spin size-8 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                    </svg>
                    <span class="text-xs" style="color:rgba(255,255,255,0.5)">Carregando...</span>
                </div>

                <div x-show="$store.{{ $uid }}.loadError"
                     style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:0.75rem;padding:1.5rem;background:#111;z-index:2;">
                    @svg('lucide-image-off', ['class' => 'size-10 text-destructive/60'])
                    <p class="text-sm text-center" style="color:rgba(255,255,255,0.6)">
                        Não foi possível carregar esta imagem.<br>Tente outro arquivo ou formato.
                    </p>
                    <x-ui.button type="button" :outline="true" size="sm" @click="$store.{{ $uid }}.cancel()">Fechar</x-ui.button>
                </div>

                <img id="{{ $uid }}_img" src="" alt=""
                     x-show="!$store.{{ $uid }}.loading && !$store.{{ $uid }}.loadError"
                     style="display:block;max-width:100%;" />
            </div>

            {{-- Info --}}
            <div class="px-4 py-2 flex items-center gap-2 text-xs text-secondary-foreground border-t border-input shrink-0">
                @svg('lucide-info', ['class' => 'size-3 shrink-0'])
                <span>
                    Arraste · Scroll para zoom
                    @if (!is_null($aspectRatio))
                        · Proporção {{ $aspectRatio == 1 ? '1:1 (quadrado)' : number_format((float)$aspectRatio, 2) }}
                    @else
                        · Proporção livre
                    @endif
                </span>
            </div>

            {{-- Footer --}}
            <div class="kt-card-footer flex items-center justify-between gap-3 py-3 shrink-0">
                @if ($showTools)
                    <div class="flex items-center gap-1">
                        @if ($zoomable)
                            <x-ui.button type="button" ghost="" size="sm" :iconOnly="true" icon="zoom-in"
                                         @click="$store.{{ $uid }}.c && $store.{{ $uid }}.c.zoom(0.1)"
                                         tooltip="Zoom in" tooltipPlacement="top" />
                            <x-ui.button type="button" ghost="" size="sm" :iconOnly="true" icon="zoom-out"
                                         @click="$store.{{ $uid }}.c && $store.{{ $uid }}.c.zoom(-0.1)"
                                         tooltip="Zoom out" tooltipPlacement="top" />
                        @endif
                        @if ($rotatable)
                            <x-ui.button type="button" ghost="" size="sm" :iconOnly="true" icon="rotate-ccw"
                                         @click="$store.{{ $uid }}.c && $store.{{ $uid }}.c.rotate(-90)"
                                         tooltip="Girar" tooltipPlacement="top" />
                        @endif
                        @if ($scalable)
                            <x-ui.button type="button" ghost="" size="sm" :iconOnly="true" icon="flip-horizontal-2"
                                         @click="$store.{{ $uid }}.c && $store.{{ $uid }}.c.scaleX($store.{{ $uid }}.flipX *= -1)"
                                         tooltip="Espelhar" tooltipPlacement="top" />
                        @endif
                        <x-ui.button type="button" ghost="" size="sm" :iconOnly="true" icon="maximize-2"
                                     @click="$store.{{ $uid }}.c && $store.{{ $uid }}.c.reset()"
                                     tooltip="Resetar" tooltipPlacement="top" />
                    </div>
                @else
                    <span></span>
                @endif

                <div class="flex items-center gap-2">
                    <x-ui.button type="button" :outline="true" size="sm"
                                 @click="$store.{{ $uid }}.cancel()">Cancelar</x-ui.button>
                    <x-ui.button type="button" variant="primary" size="sm" icon="check"
                                 @click="$store.{{ $uid }}.apply()"
                                 x-bind:disabled="$store.{{ $uid }}.loading || $store.{{ $uid }}.loadError">
                        Recortar
                    </x-ui.button>
                </div>
            </div>
        </div>
    </div>
</div>
@endteleport

<script>
    (function() {
        const uid          = '{{ $uid }}';
        const targetInput  = '{{ $targetInput ?? ($model ? $uid . '_lw' : '') }}';
        const mimeFormat   = '{{ $mimeFormat }}';
        const outputWidth  = {{ $outputWidth }};
        const outputHeight = {{ $outputHeight }};
        const quality      = {{ $quality }};
        const aspectRatio  = {{ $aspectJs }};

        // Registra no Alpine.store para ser acessível de fora
        document.addEventListener('alpine:init', () => {
            Alpine.store(uid, {
                showModal: false,
                loading:   false,
                loadError: false,
                flipX:     1,
                c:         null,
                _callback: null,  // função chamada após crop: fn(dataUrl, file)

                // Abre o cropper com um src (dataURL ou URL)
                open(src, callback = null) {
                    this._callback = callback;
                    this.showModal = true;
                    this.loading   = true;
                    this.loadError = false;
                    this.flipX     = 1;

                    Alpine.nextTick(() => {
                        const imgEl = document.getElementById(uid + '_img');
                        if (!imgEl) return;
                        if (this.c) { this.c.destroy(); this.c = null; }

                        imgEl.onload = () => {
                            this.loading = false;
                            this.c = new Cropper(imgEl, {
                                aspectRatio:      aspectRatio,
                                viewMode:         {{ $viewMode }},
                                dragMode:         '{{ $dragMode }}',
                                autoCropArea:     {{ $autoCropArea }},
                                movable:          {{ $bools($movable) }},
                                zoomable:         {{ $bools($zoomable) }},
                                rotatable:        {{ $bools($rotatable) }},
                                scalable:         {{ $bools($scalable) }},
                                cropBoxMovable:   {{ $bools($cropBoxMovable) }},
                                cropBoxResizable: {{ $bools($cropBoxResizable) }},
                                guides:           {{ $bools($guides) }},
                                background:       {{ $bools($background) }},
                                checkOrientation: true,
                                responsive:       true,
                                center:           true,
                                highlight:        true,
                            });
                        };
                        imgEl.onerror = () => { this.loading = false; this.loadError = true; };
                        imgEl.src = src;
                    });
                },

                apply() {
                    if (!this.c) return;

                    const canvas = this.c.getCroppedCanvas({
                        width: outputWidth, height: outputHeight,
                        imageSmoothingEnabled: true,
                        imageSmoothingQuality: 'high',
                    });

                    canvas.toBlob((blob) => {
                        const ext  = mimeFormat.split('/')[1];
                        const file = new File([blob], `crop.${ext}`, { type: mimeFormat });
                        const dataUrl = canvas.toDataURL(mimeFormat, quality);

                        // Injeta no input alvo (wire:model ou id externo)
                        if (targetInput) {
                            const input = document.getElementById(targetInput);
                            if (input) {
                                const dt = new DataTransfer();
                                dt.items.add(file);
                                input.files = dt.files;
                                input.dispatchEvent(new Event('change', { bubbles: true }));
                            }
                        }

                        // Dispara callback customizado se houver
                        if (this._callback) this._callback(dataUrl, file);

                        // Dispara evento no documento para qualquer listener externo
                        document.dispatchEvent(new CustomEvent(uid + ':cropped', {
                            detail: { dataUrl, file }
                        }));

                        this.close();
                    }, mimeFormat, quality);
                },

                cancel() { this.close(); },

                close() {
                    this.showModal = false;
                    this.loading   = false;
                    this.loadError = false;
                    if (this.c) { this.c.destroy(); this.c = null; }
                    const imgEl = document.getElementById(uid + '_img');
                    if (imgEl) imgEl.src = '';
                },
            });
        });

        @if ($model)
        // Input oculto para wire:model
        document.addEventListener('DOMContentLoaded', () => {
            if (!document.getElementById('{{ $uid }}_lw')) {
                const input = document.createElement('input');
                input.type = 'file';
                input.id   = '{{ $uid }}_lw';
                input.accept = 'image/*';
                input.style.display = 'none';
                input.setAttribute('wire:model', '{{ $model }}');
                document.body.appendChild(input);
                if (typeof Livewire !== 'undefined') Livewire.rescan();
            }
        });
        @endif
    })();
</script>
