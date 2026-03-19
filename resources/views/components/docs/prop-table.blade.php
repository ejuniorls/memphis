@props(['props' => []])

<div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700">
    <table class="table table-fixed w-full text-sm">
        <thead>
        <tr class="bg-gray-50 dark:bg-gray-900">
            <th class="w-1/5 text-left px-4 py-2.5 font-semibold text-mono text-xs uppercase tracking-wide">Prop</th>
            <th class="w-1/5 text-left px-4 py-2.5 font-semibold text-mono text-xs uppercase tracking-wide">Tipo</th>
            <th class="w-1/5 text-left px-4 py-2.5 font-semibold text-mono text-xs uppercase tracking-wide">Padrão</th>
            <th class="text-left px-4 py-2.5 font-semibold text-mono text-xs uppercase tracking-wide">Descrição</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
        @foreach($props as $prop)
            <tr>
                <td class="px-4 py-2.5">
                    <code class="text-primary text-xs font-mono bg-primary/10 px-1.5 py-0.5 rounded">
                        {{ $prop['name'] }}
                    </code>
                </td>
                <td class="px-4 py-2.5">
                    <span class="text-xs font-mono text-violet-600 dark:text-violet-400">{{ $prop['type'] }}</span>
                </td>
                <td class="px-4 py-2.5">
                    <span class="text-xs font-mono text-gray-500">{{ $prop['default'] ?? '—' }}</span>
                </td>
                <td class="px-4 py-2.5 text-xs text-gray-600 dark:text-gray-300">{{ $prop['description'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
