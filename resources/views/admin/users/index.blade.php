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
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            @if($users->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 border-b border-gray-100 text-sm font-semibold text-gray-500">
                                <th class="p-6">Nama Pengguna</th>
                                <th class="p-6">Email</th>
                                <th class="p-6">Role / Peran</th>
                                <th class="p-6">Tanggal Terdaftar</th>
                                <th class="p-6 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50/30 transition-colors">
                                    <td class="p-6 font-bold text-gray-900 text-lg">
                                        {{ $user->name }}
                                    </td>
                                    <td class="p-6 text-gray-700 text-lg">
                                        {{ $user->email }}
                                    </td>
                                    <td class="p-6 text-lg">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary/10 text-primary uppercase">
                                            {{ $user->role ? $user->role->name : 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="p-6 text-gray-500 text-lg">
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>
                                    <td class="p-6 text-right">
                                        <div class="flex items-center justify-end gap-3">
                                            <a href="{{ route('admin.users.edit', $user) }}" class="p-2.5 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                                <x-lucide-edit class="w-5 h-5" />
                                            </a>
                                            @if($user->id !== auth()->id())
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2.5 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                                        <x-lucide-trash-2 class="w-5 h-5" />
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="flex flex-col items-center justify-center text-gray-500 py-16">
                    <x-lucide-users class="w-16 h-16 mb-4 text-gray-300" />
                    <p class="text-lg font-medium">Tidak ada data pengguna ditemukan.</p>
                </div>
            @endif
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-admin-layout>