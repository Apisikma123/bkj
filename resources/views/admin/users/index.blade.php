<x-admin-layout>
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">User Management</h1>
                <p class="text-lg text-gray-600 mt-1">Kelola data administrator dan hak akses pengguna sistem.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.users.create') }}" class="inline-flex items-center px-5 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary/95 transition-colors shadow-sm text-lg">
                    <x-lucide-plus class="w-5 h-5 mr-2" /> Tambah User
                </a>
            </div>
        </div>

        {{-- Table / Data List --}}
        <x-admin.table :headers="['Nama Pengguna', 'Email', 'Role / Peran', 'Tanggal Terdaftar']">
            @forelse($users as $user)
                <tr>
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $user->name }}
                    </td>
                    <td class="px-6 py-4 text-gray-700">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary/10 text-primary uppercase">
                            {{ $user->role ? $user->role->name : 'N/A' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-500">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                <x-lucide-edit class="w-4 h-4" />
                            </a>
                            @if($user->id !== auth()->id())
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                        <x-lucide-trash-2 class="w-4 h-4" />
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <x-lucide-users class="w-12 h-12 text-gray-300 mb-3" />
                            <p class="font-medium">Tidak ada data pengguna ditemukan.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </x-admin.table>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-admin-layout>