<x-admin-layout>
    <x-admin.page-header title="Bank Accounts" icon="credit-card" actionText="Add Account" actionRoute="{{ route('admin.bank-accounts.create') }}" />
    <x-admin.table :headers="['ID', 'Bank Name', 'Acc Number', 'Acc Name', 'Subsidiary']">
        @forelse($bankAccounts as $item)
            <tr>
                <td class="px-6 py-4">{{ $item->id }}</td>
                <td class="px-6 py-4">{{ $item->bank_name }}</td>
                <td class="px-6 py-4">{{ $item->account_number }}</td>
                <td class="px-6 py-4">{{ $item->account_name }}</td>
                <td class="px-6 py-4">{{ optional($item->subsidiary)->name ?? '-' }}</td>
                <td class="px-6 py-4 text-right">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.bank-accounts.edit', $item) }}" class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                            <x-lucide-edit class="w-4 h-4" />
                        </a>
                        <form action="{{ route('admin.bank-accounts.destroy', $item) }}" method="POST" class="inline">
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
                <td class="px-6 py-4" colspan="6">
                    <div class="flex flex-col items-center justify-center text-on-surface-variant py-8">
                        <p>No Bank Accounts found.</p>
                    </div>
                </td>
            </tr>
        @endforelse
    </x-admin.table>
    <div class="mt-4">{{ $bankAccounts->links() }}</div>
</x-admin-layout>