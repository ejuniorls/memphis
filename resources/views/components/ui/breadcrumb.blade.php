@props([
    'separator' => 'chevron-right', // string — ícone lucide | 'dot' (bolinha) | false (sem separador)
])

<ol {{ $attributes->merge(['class' => 'kt-breadcrumb']) }}>
    {{ $slot }}
</ol>
