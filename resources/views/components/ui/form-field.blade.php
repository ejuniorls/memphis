@props([
    'label'   => null,   // string — texto do label
    'name'    => null,   // string — campo para @error e for= do label
    'id'      => null,   // string — sobrescreve o for= (padrão: $name)
    'hint'    => null,   // string — texto de ajuda abaixo do campo
    'required' => false, // bool — exibe asterisco no label
])

@php
    $forAttr = $id ?? $name;
    $hasError = $name && $errors->has($name);
@endphp

<div {{ $attributes->merge(['class' => 'flex flex-col gap-1']) }}>

    {{-- Label row: label à esquerda, slot $actions à direita (ex: link "Esqueci a senha") --}}
    @if ($label || (isset($actions) && $actions->isNotEmpty()))
        <div class="flex items-center justify-between gap-1">
            @if ($label)
                <label class="kt-form-label font-normal text-mono" @if ($forAttr) for="{{ $forAttr }}" @endif>
                    {{ $label }}
                    @if ($required)
                        <span class="text-destructive ms-0.5">*</span>
                    @endif
                </label>
            @endif

            @if (isset($actions) && $actions->isNotEmpty())
                {{ $actions }}
            @endif
        </div>
    @endif

    {{-- Campo --}}
    {{ $slot }}

    {{-- Erro de validação --}}
    @if ($name)
        @error($name)
        <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
    @endif

    {{-- Hint --}}
    @if ($hint && !$hasError)
        <span class="text-xs text-muted-foreground">{{ $hint }}</span>
    @endif

</div>
