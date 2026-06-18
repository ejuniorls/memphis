<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Toast')]
class extends Component {
    //
}; ?>

{{--
    Todos os exemplos de Toast são programáticos — disparados via KTToast.show() no JS.
    O componente Blade <x-ui.toast> serve para renderizar toasts estáticos no HTML.
--}}

<div class="flex flex-col gap-6 p-6">

    {{-- 1. Basic Usage --}}
    <x-ui.card title="Basic Usage">
        <div class="kt-card-content">
            <x-ui.button variant="outline" onclick="KTToast.show({ message: 'Your profile has been updated.' })">
                Show Toast
            </x-ui.button>
        </div>
    </x-ui.card>

    {{-- 2. Variants --}}
    <x-ui.card title="Variants">
        <div class="kt-card-content flex flex-wrap gap-3">
            <x-ui.button :outline="true" class="text-primary"
                         onclick="KTToast.show({ message: 'Primary notification.', variant: 'primary' })">
                Primary Toast
            </x-ui.button>
            <x-ui.button :outline="true" class="text-green-500"
                         onclick="KTToast.show({ message: 'Action completed successfully.', variant: 'success' })">
                Success Toast
            </x-ui.button>
            <x-ui.button :outline="true" class="text-yellow-500"
                         onclick="KTToast.show({ message: 'Please review before continuing.', variant: 'warning' })">
                Warning Toast
            </x-ui.button>
            <x-ui.button :outline="true" class="text-destructive"
                         onclick="KTToast.show({ message: 'Something went wrong.', variant: 'destructive' })">
                Destructive Toast
            </x-ui.button>
            <x-ui.button :outline="true" class="text-violet-500"
                         onclick="KTToast.show({ message: 'Here is some useful info.', variant: 'info' })">
                Info Toast
            </x-ui.button>
            <x-ui.button :outline="true" class="text-mono"
                         onclick="KTToast.show({ message: 'Mono notification.', variant: 'mono' })">
                Mono Toast
            </x-ui.button>
            <x-ui.button :outline="true" class="text-muted-foreground"
                         onclick="KTToast.show({ message: 'Secondary notification.', variant: 'secondary' })">
                Secondary Toast
            </x-ui.button>
        </div>
    </x-ui.card>

    {{-- 3. Appearance --}}
    <x-ui.card title="Appearance">
        <div class="kt-card-content flex flex-wrap gap-3">
            <x-ui.button :outline="true"
                         onclick="KTToast.show({ message: 'Solid appearance.', variant: 'primary', appearance: 'solid' })">
                Solid
            </x-ui.button>
            <x-ui.button :outline="true"
                         onclick="KTToast.show({ message: 'Outline appearance.', variant: 'primary', appearance: 'outline' })">
                Outline
            </x-ui.button>
            <x-ui.button :outline="true"
                         onclick="KTToast.show({ message: 'Light appearance.', variant: 'primary', appearance: 'light' })">
                Light
            </x-ui.button>
        </div>
    </x-ui.card>

    {{-- 4. Position --}}
    <x-ui.card title="Position">
        <div class="kt-card-content flex flex-wrap gap-3">
            <x-ui.button :outline="true" onclick="KTToast.show({ message: 'Top end.', position: 'top-end' })">Top End</x-ui.button>
            <x-ui.button :outline="true" onclick="KTToast.show({ message: 'Top center.', position: 'top-center' })">Top Center</x-ui.button>
            <x-ui.button :outline="true" onclick="KTToast.show({ message: 'Top start.', position: 'top-start' })">Top Start</x-ui.button>
            <x-ui.button :outline="true" onclick="KTToast.show({ message: 'Bottom end.', position: 'bottom-end' })">Bottom End</x-ui.button>
            <x-ui.button :outline="true" onclick="KTToast.show({ message: 'Bottom center.', position: 'bottom-center' })">Bottom Center</x-ui.button>
            <x-ui.button :outline="true" onclick="KTToast.show({ message: 'Bottom start.', position: 'bottom-start' })">Bottom Start</x-ui.button>
        </div>
    </x-ui.card>

    {{-- 5. Size --}}
    <x-ui.card title="Size">
        <div class="kt-card-content flex flex-wrap gap-3">
            <x-ui.button :outline="true" onclick="KTToast.show({ message: 'Small toast.', size: 'sm' })">Size - Small</x-ui.button>
            <x-ui.button :outline="true" onclick="KTToast.show({ message: 'Medium toast.' })">Size - Medium</x-ui.button>
            <x-ui.button :outline="true" onclick="KTToast.show({ message: 'Large toast.', size: 'lg' })">Size - Large</x-ui.button>
        </div>
    </x-ui.card>

    {{-- 6. Icon --}}
    <x-ui.card title="Icon">
        <div class="kt-card-content flex flex-wrap gap-3">
            <x-ui.button :outline="true" onclick="KTToast.show({ message: 'Default icon toast.', variant: 'success' })">
                Default Icon
            </x-ui.button>
            <x-ui.button :outline="true" onclick="KTToast.show({ message: 'Custom icon toast.', icon: 'rocket' })">
                Custom Icon
            </x-ui.button>
            <x-ui.button :outline="true" onclick="KTToast.show({ message: 'No icon toast.', icon: false })">
                No Icon
            </x-ui.button>
        </div>
    </x-ui.card>

    {{-- 7. Progress --}}
    <x-ui.card title="Progress">
        <div class="kt-card-content">
            <x-ui.button :outline="true" onclick="KTToast.show({ message: 'Toast with progress bar.', variant: 'primary', progress: true, duration: 5000 })">
                Show Toast
            </x-ui.button>
        </div>
    </x-ui.card>

    {{-- 8. Important --}}
    <x-ui.card title="Important">
        <div class="kt-card-content">
            <x-ui.button :outline="true" onclick="KTToast.show({ message: 'Important toast — persists on navigation.', variant: 'warning', important: true })">
                Show Toast
            </x-ui.button>
        </div>
    </x-ui.card>

    {{-- 9. Pause on Hover --}}
    <x-ui.card title="Pause on Hover">
        <div class="kt-card-content flex flex-wrap gap-3">
            <x-ui.button :outline="true" onclick="KTToast.show({ message: 'Pauses when you hover.', pauseOnHover: true, duration: 6000 })">
                Pause on Hover
            </x-ui.button>
            <x-ui.button :outline="true" onclick="KTToast.show({ message: 'Does not pause on hover.', pauseOnHover: false, duration: 6000 })">
                No Pause
            </x-ui.button>
        </div>
    </x-ui.card>

    {{-- 10. Action & Cancel --}}
    <x-ui.card title="Action & Cancel">
        <div class="kt-card-content">
            <x-ui.button :outline="true" onclick="KTToast.show({
                message: 'File deleted.',
                variant: 'destructive',
                duration: 8000,
                action: { label: 'Undo', onClick: (id) => { KTToast.hide(id); alert('Undo clicked!'); } },
                cancel: { label: 'Dismiss', onClick: (id) => KTToast.hide(id) }
            })">
                Show Toast
            </x-ui.button>
        </div>
    </x-ui.card>

    {{-- 11. Custom Duration --}}
    <x-ui.card title="Custom Duration">
        <div class="kt-card-content flex flex-wrap gap-3">
            <x-ui.button :outline="true" onclick="KTToast.show({ message: 'Disappears in 1 second.', duration: 1000 })">1s</x-ui.button>
            <x-ui.button :outline="true" onclick="KTToast.show({ message: 'Disappears in 5 seconds.', duration: 5000 })">5s</x-ui.button>
            <x-ui.button :outline="true" onclick="KTToast.show({ message: 'Permanent toast.', duration: 0 })">Permanent</x-ui.button>
        </div>
    </x-ui.card>

    {{-- 12. Max Toasts --}}
    <x-ui.card title="Max Toasts">
        <div class="kt-card-content">
            <x-ui.button :outline="true" onclick="
                KTToast.show({ message: 'Toast 1', maxToasts: 3 });
                KTToast.show({ message: 'Toast 2', maxToasts: 3 });
                KTToast.show({ message: 'Toast 3', maxToasts: 3 });
                KTToast.show({ message: 'Toast 4 — replaces oldest', maxToasts: 3 });
            ">
                Show 4 Toasts (max 3)
            </x-ui.button>
        </div>
    </x-ui.card>

    {{-- 13. Static (Blade component) --}}
    <x-ui.card title="Static (Blade Component)">
        <div class="kt-card-content">
            <p class="text-sm text-muted-foreground mb-4">Toasts renderizados estaticamente no HTML — sem JS necessário.</p>
            <div class="relative h-32 border border-border rounded-lg overflow-hidden">
                <x-ui.toast message="Profile updated successfully." variant="success" position="bottom-end" :duration="0" />
            </div>
        </div>
    </x-ui.card>

</div>
