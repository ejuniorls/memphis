<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Badges')]
class extends Component {
    //
}; ?>

<div class="flex flex-col gap-6 p-6">

    {{-- 1. Basic Usage --}}
    <x-ui.card title="Basic Usage">
        <div class="kt-card-content flex flex-wrap gap-2.5">
            <x-ui.badge>Default</x-ui.badge>
            <x-ui.badge :stroke="true">Stroke</x-ui.badge>
        </div>
    </x-ui.card>

    {{-- 2. Solid --}}
    <x-ui.card title="Solid">
        <div class="kt-card-content flex flex-wrap gap-2.5">
            <x-ui.badge variant="primary">Primary</x-ui.badge>
            <x-ui.badge variant="secondary">Secondary</x-ui.badge>
            <x-ui.badge variant="destructive">Destructive</x-ui.badge>
            <x-ui.badge variant="warning">Warning</x-ui.badge>
            <x-ui.badge variant="success">Success</x-ui.badge>
            <x-ui.badge variant="info">Info</x-ui.badge>
            <x-ui.badge variant="mono">Mono</x-ui.badge>
        </div>
    </x-ui.card>

    {{-- 3. Outline --}}
    <x-ui.card title="Outline">
        <div class="kt-card-content flex flex-wrap gap-2.5">
            <x-ui.badge style="outline" variant="primary">Primary</x-ui.badge>
            <x-ui.badge style="outline" variant="secondary">Secondary</x-ui.badge>
            <x-ui.badge style="outline" variant="destructive">Destructive</x-ui.badge>
            <x-ui.badge style="outline" variant="warning">Warning</x-ui.badge>
            <x-ui.badge style="outline" variant="success">Success</x-ui.badge>
            <x-ui.badge style="outline" variant="info">Info</x-ui.badge>
            <x-ui.badge style="outline" variant="mono">Mono</x-ui.badge>
        </div>
    </x-ui.card>

    {{-- 4. Light --}}
    <x-ui.card title="Light">
        <div class="kt-card-content flex flex-wrap gap-2.5">
            <x-ui.badge style="light" variant="primary">Primary</x-ui.badge>
            <x-ui.badge style="light" variant="secondary">Secondary</x-ui.badge>
            <x-ui.badge style="light" variant="destructive">Destructive</x-ui.badge>
            <x-ui.badge style="light" variant="warning">Warning</x-ui.badge>
            <x-ui.badge style="light" variant="success">Success</x-ui.badge>
            <x-ui.badge style="light" variant="info">Info</x-ui.badge>
            <x-ui.badge style="light" variant="mono">Mono</x-ui.badge>
        </div>
    </x-ui.card>

    {{-- 5. Circle --}}
    <x-ui.card title="Circle">
        <div class="kt-card-content flex flex-wrap gap-2.5">
            <x-ui.badge style="outline" variant="primary" :circle="true">Primary</x-ui.badge>
            <x-ui.badge style="outline" variant="secondary" :circle="true">Secondary</x-ui.badge>
            <x-ui.badge style="outline" variant="destructive" :circle="true">Destructive</x-ui.badge>
            <x-ui.badge style="outline" variant="warning" :circle="true">Warning</x-ui.badge>
            <x-ui.badge style="outline" variant="success" :circle="true">Success</x-ui.badge>
            <x-ui.badge style="outline" variant="info" :circle="true">Info</x-ui.badge>
            <x-ui.badge style="outline" variant="mono" :circle="true">Mono</x-ui.badge>
        </div>
    </x-ui.card>

    {{-- 6. Square (número com todos os estilos por variante) --}}
    <x-ui.card title="Square">
        <div class="kt-card-content space-y-4">
            @foreach ([
                ['variant' => 'secondary',   'num' => '1'],
                ['variant' => 'primary',     'num' => '2'],
                ['variant' => 'destructive', 'num' => '3'],
                ['variant' => 'warning',     'num' => '4'],
                ['variant' => 'success',     'num' => '5'],
                ['variant' => 'info',        'num' => '6'],
                ['variant' => 'mono',        'num' => '7'],
            ] as $item)
                <div class="flex gap-4">
                    <x-ui.badge style="ghost"   variant="{{ $item['variant'] }}" :circle="true">{{ $item['num'] }}</x-ui.badge>
                    <x-ui.badge                 variant="{{ $item['variant'] }}" :circle="true">{{ $item['num'] }}</x-ui.badge>
                    <x-ui.badge style="outline" variant="{{ $item['variant'] }}" :circle="true">{{ $item['num'] }}</x-ui.badge>
                    <x-ui.badge style="light"   variant="{{ $item['variant'] }}" :circle="true">{{ $item['num'] }}</x-ui.badge>
                </div>
            @endforeach
        </div>
    </x-ui.card>

    {{-- 7. Dot --}}
    <x-ui.card title="Dot">
        <div class="kt-card-content space-y-4">
            @foreach (['secondary', 'primary', 'destructive', 'warning', 'success', 'info', 'mono'] as $variant)
                <div class="flex gap-4">
                    <x-ui.badge style="ghost"   variant="{{ $variant }}" :dot="true">Ghost</x-ui.badge>
                    <x-ui.badge                 variant="{{ $variant }}" :dot="true">Solid</x-ui.badge>
                    <x-ui.badge style="outline" variant="{{ $variant }}" :dot="true">Outline</x-ui.badge>
                    <x-ui.badge style="light"   variant="{{ $variant }}" :dot="true">Light</x-ui.badge>
                </div>
            @endforeach
        </div>
    </x-ui.card>

    {{-- 8. Icon --}}
    <x-ui.card title="Icon">
        <div class="kt-card-content space-y-4">
            @foreach (['secondary', 'destructive', 'warning', 'success', 'info', 'mono'] as $variant)
                <div class="flex gap-4">
                    <x-ui.badge style="ghost"   variant="{{ $variant }}" icon="tag">Ghost</x-ui.badge>
                    <x-ui.badge                 variant="{{ $variant }}" icon="mail">Solid</x-ui.badge>
                    <x-ui.badge style="outline" variant="{{ $variant }}" icon="file-plus">Outline</x-ui.badge>
                    <x-ui.badge style="light"   variant="{{ $variant }}" icon="activity">Light</x-ui.badge>
                </div>
            @endforeach
        </div>
    </x-ui.card>

    {{-- 9. Removable --}}
    <x-ui.card title="Removable">
        <div class="kt-card-content space-y-4">
            @foreach (['primary', 'secondary', 'destructive', 'warning', 'success', 'info', 'mono'] as $variant)
                <div class="flex gap-4">
                    <x-ui.badge style="ghost"   variant="{{ $variant }}" :removable="true">Ghost</x-ui.badge>
                    <x-ui.badge                 variant="{{ $variant }}" :removable="true">Solid</x-ui.badge>
                    <x-ui.badge style="outline" variant="{{ $variant }}" :removable="true">Outline</x-ui.badge>
                    <x-ui.badge style="light"   variant="{{ $variant }}" :removable="true">Light</x-ui.badge>
                </div>
            @endforeach
        </div>
    </x-ui.card>

</div>
