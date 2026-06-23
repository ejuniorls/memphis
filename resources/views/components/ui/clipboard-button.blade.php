@props([
    'target'      => null,
    'text'        => null,
    'action'      => 'copy',
    'label'       => 'Copy',
    'copiedLabel' => 'Copied',
    'errorLabel'  => 'Error',
    'icon'        => null,
    'variant'     => 'outline',
    'size'        => 'sm',
])

@php
    $btnId = 'clip_btn_' . uniqid();

    $classes = 'kt-btn';
    $classes .= $variant === 'outline' ? ' kt-btn-outline' : ' kt-btn-' . $variant;
    if ($size) $classes .= ' kt-btn-' . $size;

    $iconSize = match ($size) {
        'xs' => 'size-3',
        'lg' => 'size-5',
        default => 'size-4',
    };

    // Monta os data-attributes do clipboard como array — só inclui text/target
    // quando realmente preenchidos. Evita tanto "@if dentro da tag" (quebra o
    // parser do Blade neste projeto) quanto "atributo presente mas vazio"
    // (o KTClipboard trata data-kt-clipboard-text="" como texto predefinido
    // válido, ignorando o target, mesmo quando a intenção era usar o target).
    $clipAttrs = [
        'data-kt-clipboard' => 'true',
        'data-kt-clipboard-action' => $action,
    ];
    if ($text)   $clipAttrs['data-kt-clipboard-text']   = $text;
    if ($target) $clipAttrs['data-kt-clipboard-target'] = $target;
@endphp

<button
    id="{{ $btnId }}"
    type="button"
    {{ $attributes->merge(array_merge(['class' => $classes], $clipAttrs)) }}
>
    @if ($icon)
        @svg('lucide-' . $icon, ['class' => $iconSize . ' shrink-0'])
    @endif
    <span data-role="text">{{ $label }}</span>
</button>

@script
<script>
    (function () {
        var btn = document.getElementById('{{ $btnId }}');
        if (!btn) return;

        var textEl = btn.querySelector('[data-role="text"]');
        var originalLabel = @js($label);
        var copiedLabel = @js($copiedLabel);
        var errorLabel = @js($errorLabel);

        btn.addEventListener('click', function () {
            if (textEl) textEl.textContent = originalLabel;
        }, { capture: true });

        btn.addEventListener('kt.clipboard.success', function () {
            if (textEl) textEl.textContent = copiedLabel;
        });

        btn.addEventListener('kt.clipboard.error', function () {
            if (textEl) textEl.textContent = errorLabel;
        });
    })();
</script>
@endscript
