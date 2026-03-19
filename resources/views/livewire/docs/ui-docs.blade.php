<!-- Container -->
<div class="kt-container-fluid">
    <div class="animate-pulse bg-accent rounded-lg grow h-screen" data-slot="skeleton">
        <div class="flex gap-6 items-start">

            <x-docs.sidebar :active="$active" :components="$components"/>

            <div class="flex-1 min-w-0 space-y-8">

                {{-- Breadcrumb --}}
                <div class="flex items-center gap-2 text-xs text-gray-400 mb-2">
                    <a href="{{ route('ui-docs') }}" class="hover:text-primary">Docs</a>
                    <i class="ki-right text-[10px]"></i>
                    <span class="text-primary font-medium">{{ $currentComponent['label'] ?? $active }}</span>
                </div>

                {{-- Loading indicator --}}
                <div wire:loading class="flex items-center gap-2 text-sm text-gray-400 py-4">
                    <svg class="animate-spin size-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                    </svg>
                    Carregando...
                </div>

                {{-- Conteúdo --}}
                <div wire:key="{{ $active }}" wire:loading.remove>
                    @includeIf('livewire.docs.partials.' . $active . '.content')
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End of Container -->
