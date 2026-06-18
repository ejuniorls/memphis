@props([
    'size'              => null,
    'placeholder'       => null,
    'multiple'          => false,
    'tags'              => false,
    'maxSelections'     => null,
    'preSelected'       => null,
    'search'            => false,
    'searchPlaceholder' => 'Search...',
    'remote'            => false,
    'dataUrl'           => null,
    'dataFieldValue'    => null,
    'dataFieldText'     => null,
    'disabled'          => false,
    'optionsScrollable' => false,
    'config'            => null,
])

@php
    $classes = 'kt-select' . ($size ? ' kt-select-' . $size : '');

    $configData = [];
    if ($optionsScrollable) {
        $configData['optionsClass'] = 'kt-scrollable overflow-auto max-h-[250px]';
    }
    if ($config) {
        $extra = is_array($config) ? $config : json_decode($config, true);
        $configData = array_merge($configData, $extra ?? []);
    }
    $configJson = !empty($configData) ? json_encode($configData) : null;

    // Monta todos os data-attributes como array para merge — evita @if dentro de tag HTML
    $dataAttrs = ['data-kt-select' => 'true'];

    if ($placeholder)   $dataAttrs['data-kt-select-placeholder']        = $placeholder;
    if ($multiple)      $dataAttrs['data-kt-select-multiple']           = 'true';
    if ($tags)          $dataAttrs['data-kt-select-tags']               = 'true';
    if ($maxSelections) $dataAttrs['data-kt-select-max-selections']     = $maxSelections;
    if ($preSelected)   $dataAttrs['data-kt-select-pre-selected']       = $preSelected;
    if ($search)        $dataAttrs['data-kt-select-enable-search']      = 'true';
    if ($remote)        $dataAttrs['data-kt-select-remote']             = 'true';
    if ($dataUrl)       $dataAttrs['data-kt-select-data-url']           = $dataUrl;
    if ($dataFieldValue)$dataAttrs['data-kt-select-data-field-value']   = $dataFieldValue;
    if ($dataFieldText) $dataAttrs['data-kt-select-data-field-text']    = $dataFieldText;
    if ($configJson)    $dataAttrs['data-kt-select-config']             = $configJson;

    if ($searchPlaceholder !== 'Search...') {
        $dataAttrs['data-kt-select-search-placeholder'] = $searchPlaceholder;
    }

    if ($disabled) {
        $dataAttrs['disabled']                    = true;
        $dataAttrs['data-kt-select-disabled']     = 'true';
    }
@endphp

<select {{ $attributes->merge(array_merge(['class' => $classes], $dataAttrs)) }}>
    {{ $slot }}
</select>
