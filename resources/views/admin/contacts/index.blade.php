<x-admin-layout>
    <x-admin.page-header title="Inbox" icon="mail" />

    <x-admin.table :headers="['ID', 'Name', 'Message', 'Created At']">
        @forelse($contacts as $item)
            <tr>
                <td class="px-6 py-4">{{ $item->id }}</td>
                <td class="px-6 py-4">
                    <div class="font-medium text-on-surface">{{ $item->name }}</div>
                    <div class="text-xs text-outline">{{ $item->email }}</div>
                    @if($item->business_unit)
                        <div class="mt-1"><span class="inline-block text-[10px] font-semibold bg-secondary/15 text-secondary px-1.5 py-0.5 rounded">{{ $item->business_unit }}</span></div>
                    @endif
                </td>
                <td class="px-6 py-4">{{ Str::limit($item->message, 50) }}</td>
                <td class="px-6 py-4">{{ $item->created_at->format('Y-m-d') }}</td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.contacts.show', $item) }}" class="p-2 text-outline hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="View">
                            <x-lucide-eye class="w-4 h-4" />
                        </a>
                        <form action="{{ route('admin.contacts.destroy', $item) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-outline hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete">
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
                        <p>No Contacts found.</p>
                    </div>
                </td>
            </tr>
        @endforelse
    </x-admin.table>
    
    <div class="mt-4">
        {{ $contacts->links() }}
    </div>
</x-admin-layout>