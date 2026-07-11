<x-admin-layout>
    <x-admin.page-header title="Subsidiaries" icon="building" actionText="Add Subsidiary" actionRoute="{{ route('admin.subsidiaries.create') }}" />

    <x-admin.table :headers="['ID', 'Name/Title', 'Created At']">
        @forelse($subsidiaries as $item)
            <tr>
                <td class="px-6 py-4">{{ $item->id }}</td>
                <td class="px-6 py-4">{{ $item->name ?? $item->title ?? 'N/A' }}</td>
                <td class="px-6 py-4">{{ $item->created_at->format('Y-m-d') }}</td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.subsidiaries.edit', $item) }}" class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                            <x-lucide-edit class="w-4 h-4" />
                        </a>
                        <form action="{{ route('admin.subsidiaries.destroy', $item) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
                                <x-lucide-trash-2 class="w-4 h-4" />
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td class="px-6 py-4" colspan="4">
                    <div class="flex flex-col items-center justify-center text-on-surface-variant py-8">
                        <x-lucide-box class="w-12 h-12 mb-2 text-outline-variant" />
                        <p>No Subsidiaries found.</p>
                    </div>
                </td>
            </tr>
        @endforelse
    </x-admin.table>
    
    <div class="mt-4">
        {{ $subsidiaries->links() }}
    </div>
</x-admin-layout>