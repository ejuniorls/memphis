<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Alerts')]
class extends Component {
    //
};
?>

<div class="kt-page">
    <!-- Container -->
    <div class="kt-page-header">
        <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
            <div class="flex flex-col justify-center gap-2">
                <h1 class="text-xl font-medium leading-none text-mono">
                    Alert
                </h1>
                <div class="flex items-center gap-2 text-sm font-normal text-secondary-foreground">
                    Displays a callout for user attention, such as a success message, warning, or error.
                </div>
            </div>
            <div class="flex items-center gap-2.5">
                <a class="kt-btn kt-btn-outline" href="#">
                    Upload CSV
                </a>
                <a class="kt-btn kt-btn-primary" href="#">
                    Add User
                </a>
            </div>
        </div>
    </div>
    <!-- End of Container -->

    <!-- Container -->
    <div class="kt-page-content">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 lg:gap-7.5">
            <div class="col-span-2">
                <div class="flex flex-col gap-5 lg:gap-7.5">
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
            </div>
        </div>
    </div>
    <!-- End of Container -->
</div>

