<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Alerts')]
class extends Component {
    //
}; ?>

<div class="flex flex-col gap-6 p-6">

    {{-- 1. Basic Usage --}}
    <x-ui.card title="Basic Usage">
        <div class="kt-card-content space-y-5">
            <x-ui.alert title="This is a default alert" action-label="Upgrade" :dismissible="true"/>

            @foreach ([
                'primary'     => 'This is a primary alert',
                'success'     => 'This is a success alert',
                'info'        => 'This is an info alert',
                'destructive' => 'This is a destructive alert',
                'warning'     => 'This is a warning alert',
                'mono'        => 'This is a mono alert',
            ] as $variant => $label)
                <x-ui.alert
                    variant="{{ $variant }}"
                    title="{{ $label }}"
                    action-label="Upgrade"
                    :dismissible="true"
                />
            @endforeach
        </div>
    </x-ui.card>

    {{-- 2. Mono --}}
    <x-ui.card title="Mono">
        <div class="kt-card-content space-y-5">
            @foreach ([
                'primary'     => 'This is a primary alert',
                'success'     => 'This is a success alert',
                'info'        => 'This is an info alert',
                'destructive' => 'This is a destructive alert',
                'warning'     => 'This is a warning alert',
            ] as $variant => $label)
                <x-ui.alert
                    style="mono"
                    variant="{{ $variant }}"
                    title="{{ $label }}"
                    action-label="Upgrade"
                    :dismissible="true"
                />
            @endforeach
        </div>
    </x-ui.card>

    {{-- 3. Outline --}}
    <x-ui.card title="Outline">
        <div class="kt-card-content space-y-5">
            @foreach ([
                'primary'     => 'This is a primary alert',
                'success'     => 'This is a success alert',
                'info'        => 'This is an info alert',
                'destructive' => 'This is a destructive alert',
                'warning'     => 'This is a warning alert',
            ] as $variant => $label)
                <x-ui.alert
                    style="outline"
                    variant="{{ $variant }}"
                    title="{{ $label }}"
                    action-label="Upgrade"
                    :dismissible="true"
                />
            @endforeach
        </div>
    </x-ui.card>

    {{-- 4. Light --}}
    <x-ui.card title="Light">
        <div class="kt-card-content space-y-5">
            @foreach ([
                'primary'     => 'This is a primary alert',
                'success'     => 'This is a success alert',
                'info'        => 'This is an info alert',
                'destructive' => 'This is a destructive alert',
                'warning'     => 'This is a warning alert',
            ] as $variant => $label)
                <x-ui.alert
                    style="light"
                    variant="{{ $variant }}"
                    title="{{ $label }}"
                    action-label="Upgrade"
                    :dismissible="true"
                />
            @endforeach
        </div>
    </x-ui.card>

    {{-- 5. Size --}}
    <x-ui.card title="Size">
        <div class="kt-card-content space-y-5">
            <x-ui.alert
                style="outline"
                variant="primary"
                size="sm"
                title="This is a small alert"
                :dismissible="true"
            />
            <x-ui.alert
                style="outline"
                variant="primary"
                title="This is a default alert"
                :dismissible="true"
            />
            <x-ui.alert
                style="outline"
                variant="primary"
                size="lg"
                title="This is a large alert"
                :dismissible="true"
            />
        </div>
    </x-ui.card>

    {{-- 6. With Description --}}
    <x-ui.card title="With Description">
        <div class="kt-card-content space-y-5">
            <x-ui.alert
                title="Default Alert"
                description="You have successfully completed the action. Check your email for confirmation."
                action-label="Upgrade"
                :dismissible="true"
            />

            @foreach ([
                'primary'     => 'Primary Alert',
                'success'     => 'Success Alert',
                'info'        => 'Info Alert',
                'destructive' => 'Destructive Alert',
                'warning'     => 'Warning Alert',
            ] as $variant => $label)
                <x-ui.alert
                    variant="{{ $variant }}"
                    title="{{ $label }}"
                    description="You have successfully completed the action. Check your email for confirmation."
                    action-label="Upgrade"
                    :dismissible="true"
                />
            @endforeach
        </div>
    </x-ui.card>

</div>
