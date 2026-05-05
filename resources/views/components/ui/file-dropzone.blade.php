@props([
    'id'          => 'file_dropzone_' . uniqid(),   // string — id do input file
    'model'       => null,                          // string — wire:model binding
    'accept'      => 'image/*',                     // string — tipos aceitos (ex: 'image/*', '.pdf')
    'label'       => 'Arraste um arquivo aqui ou',  // string — texto da dropzone
    'buttonLabel' => 'Selecionar arquivo',          // string — label do botão
    'hint'        => null,                          // string — texto de dica abaixo (ex: 'JPG, PNG. Máx 2MB')
    'icon'        => 'upload-cloud',                // string — ícone lucide central
    'multiple'    => false,                         // bool — permite múltiplos arquivos
    'hasFile'     => false,                         // bool — quando true, exibe só o botão (sem dropzone)
    'fileLabel'   => 'Trocar arquivo',              // string — label do botão quando já há arquivo
])

<div {{ $attributes }} x-data="{ dragging: false }">

    @if ($hasFile)
        {{-- Já tem arquivo: exibe apenas o botão de troca --}}
        <label for="{{ $id }}" class="kt-btn kt-btn-outline kt-btn-sm w-full justify-center cursor-pointer">
            @svg('lucide-image', ['class' => 'size-3.5 shrink-0'])
            {{ $fileLabel }}
        </label>
    @else
        {{-- Sem arquivo: exibe a dropzone completa --}}
        <div
            x-on:dragover.prevent="dragging = true"
            x-on:dragleave.prevent="dragging = false"
            x-on:drop.prevent="
                dragging = false;
                const files = $event.dataTransfer.files;
                if (!files.length) return;
                const input = document.getElementById('{{ $id }}');
                const dt = new DataTransfer();
                {{ $multiple ? 'Array.from(files).forEach(f => dt.items.add(f))' : 'dt.items.add(files[0])' }};
                input.files = dt.files;
                input.dispatchEvent(new Event('change'));
            "
            class="border-2 border-dashed rounded-lg px-4 py-6 text-center transition-colors"
            :class="dragging ? 'border-primary bg-primary/5' : 'border-border'"
        >
            @svg('lucide-' . $icon, ['class' => 'mx-auto mb-2 size-7 text-muted-foreground'])

            <p class="text-xs text-secondary-foreground mb-2">{{ $label }}</p>

            <label for="{{ $id }}" class="kt-btn kt-btn-outline kt-btn-sm cursor-pointer">
                @svg('lucide-image', ['class' => 'size-3.5 shrink-0'])
                {{ $buttonLabel }}
            </label>

            @if ($hint)
                <p class="text-xs text-muted-foreground mt-3">{{ $hint }}</p>
            @endif
        </div>
    @endif

    <input
        id="{{ $id }}"
        type="file"
        accept="{{ $accept }}"
        @if ($model) wire:model="{{ $model }}" @endif
        @if ($multiple) multiple @endif
        class="hidden"
    />

</div>
