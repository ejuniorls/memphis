@props(['title' => null, 'language' => 'blade', 'preview' => true, 'code' => ''])

<div class="rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">

    @if($preview)
        <div x-data="{ tab: 'preview', copied: false }">

            {{-- Tab bar --}}
            <div
                class="flex items-center border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 px-4">
                @if($title)
                    <span class="text-xs text-gray-400 mr-auto py-2.5 font-medium">{{ $title }}</span>
                @endif
                <button
                    @click="tab = 'preview'"
                    :class="tab === 'preview' ? 'border-b-2 border-primary text-primary' : 'text-gray-400 hover:text-gray-700 dark:hover:text-gray-200'"
                    class="flex items-center gap-1.5 text-xs font-medium px-3 py-2.5 transition-colors">
                    <x-lucide-eye class="size-3.5"/>
                    Preview
                </button>
                <button
                    @click="tab = 'code'"
                    :class="tab === 'code' ? 'border-b-2 border-primary text-primary' : 'text-gray-400 hover:text-gray-700 dark:hover:text-gray-200'"
                    class="flex items-center gap-1.5 text-xs font-medium px-3 py-2.5 transition-colors">
                    <x-lucide-code class="size-3.5"/>
                    Code
                </button>
            </div>

            {{-- Preview panel --}}
            <div x-show="tab === 'preview'" x-transition class="p-6 bg-white dark:bg-gray-950">
                {{ $slot }}
            </div>

            {{-- Code panel --}}
            <div x-show="tab === 'code'" x-transition class="relative group">
                <button
                    @click="
                    navigator.clipboard.writeText($refs.codeblock.innerText);
                    copied = true;
                    setTimeout(() => copied = false, 2000)
                "
                    class="absolute top-3 right-3 z-10 flex items-center gap-1.5 text-xs
                       bg-gray-700 hover:bg-gray-600 text-gray-300 hover:text-white
                       px-2.5 py-1.5 rounded-lg transition-all duration-150
                       opacity-0 group-hover:opacity-100">
                    <template x-if="!copied">
                        <x-lucide-copy class="size-3.5"/>
                    </template>
                    <template x-if="copied">
                        <x-lucide-check class="size-3.5 text-green-400"/>
                    </template>
                    <span x-text="copied ? 'Copiado!' : 'Copiar'"></span>
                </button>
                <pre
                    class="bg-gray-950 text-gray-100 p-5 overflow-x-auto text-xs leading-relaxed font-mono m-0 min-h-[60px]"><code
                        x-ref="codeblock">{{ trim($code) }}</code></pre>
            </div>

        </div>
    @else

        {{-- Code only --}}
        <div x-data="{ copied: false }" class="relative group">
            @if($title)
                <div class="flex items-center border-b border-gray-700 bg-gray-900 px-4 py-2.5">
                    <span class="text-xs text-gray-400 font-medium">{{ $title }}</span>
                </div>
            @endif
            <button
                @click="
                navigator.clipboard.writeText($refs.codeblock.innerText);
                copied = true;
                setTimeout(() => copied = false, 2000)
            "
                class="absolute top-3 right-3 z-10 flex items-center gap-1.5 text-xs
                   bg-gray-700 hover:bg-gray-600 text-gray-300 hover:text-white
                   px-2.5 py-1.5 rounded-lg transition-all duration-150
                   opacity-0 group-hover:opacity-100">
                <template x-if="!copied">
                    <x-lucide-copy class="size-3.5"/>
                </template>
                <template x-if="copied">
                    <x-lucide-check class="size-3.5 text-green-400"/>
                </template>
                <span x-text="copied ? 'Copiado!' : 'Copiar'"></span>
            </button>
            <pre
                class="bg-gray-950 text-gray-100 p-5 overflow-x-auto text-xs leading-relaxed font-mono m-0 min-h-[60px]"><code
                    x-ref="codeblock">{{ trim($code) }}</code></pre>
        </div>

    @endif

</div>
