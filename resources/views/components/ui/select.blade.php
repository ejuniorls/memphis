@props([
    'size'              => null,         // null | 'sm' | 'md' | 'lg'
    'placeholder'       => null,         // string
    'multiple'          => false,        // bool
    'tags'              => false,        // bool — modo tags para múltipla seleção
    'maxSelections'     => null,         // int — limite de seleções (multiple)
    'preSelected'       => null,         // string — valores pré-selecionados separados por vírgula
    'search'            => false,        // bool — habilita busca no dropdown
    'searchPlaceholder' => 'Search...', // string
    'remote'            => false,        // bool — carrega opções via API
    'dataUrl'           => null,         // string — URL da API (remote=true)
    'dataFieldValue'    => null,         // string — campo do valor na API
    'dataFieldText'     => null,         // string — campo do texto na API
    'disabled'          => false,        // bool
    'optionsScrollable' => false,        // bool — adiciona scroll no dropdown
    'config'            => null,         // string|array — JSON config avançado
])

@php
    $classes = 'kt-select';
    if ($size) $classes .= ' kt-select-' . $size;

    // Monta data-kt-select-config
    $configData = [];
    if ($optionsScrollable) {
        $configData['optionsClass'] = 'kt-scrollable overflow-auto max-h-[250px]';
    }
    if ($config) {
        $extra = is_array($config) ? $config : json_decode($config, true);
        $configData = array_merge($configData, $extra ?? []);
    }
    $configJson = !empty($configData) ? json_encode($configData) : null;
@endphp

<select
    {{ $attributes->merge(['class' => $classes]) }}
    data-kt-select="true"
    @if ($placeholder)            data-kt-select-placeholder="{{ $placeholder }}" @endif
    @if ($multiple)               data-kt-select-multiple="true" @endif
    @if ($tags)                   data-kt-select-tags="true" @endif
    @if ($maxSelections)          data-kt-select-max-selections="{{ $maxSelections }}" @endif
    @if ($preSelected)            data-kt-select-pre-selected="{{ $preSelected }}" @endif
    @if ($search)                 data-kt-select-enable-search="true" @endif
    @if ($searchPlaceholder !== 'Search...') data-kt-select-search-placeholder="{{ $searchPlaceholder }}" @endif
    @if ($remote)                 data-kt-select-remote="true" @endif
    @if ($dataUrl)                data-kt-select-data-url="{{ $dataUrl }}" @endif
    @if ($dataFieldValue)         data-kt-select-data-field-value="{{ $dataFieldValue }}" @endif
    @if ($dataFieldText)          data-kt-select-data-field-text="{{ $dataFieldText }}" @endif
    @if ($disabled)               disabled data-kt-select-disabled="true" @endif
    @if ($configJson)             data-kt-select-config='{{ $configJson }}' @endif
>
    {{ $slot }}
</select>
