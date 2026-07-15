<x-admin-layout>
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Kelola Klien & Mitra</h1>
                <p class="text-lg text-gray-600 mt-1">Kelola nama klien atau mitra yang tampil di halaman depan.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.clients.create') }}" class="inline-flex items-center px-5 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary/95 transition-colors shadow-sm text-lg">
                    <x-lucide-plus class="w-5 h-5 mr-2" /> Tambah Klien
                </a>
            </div>
        </div>

        {{-- Search & Filter --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <form action="{{ route('admin.clients.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-grow">
                    <x-text-input name="q" value="{{ request('q') }}" placeholder="Cari nama klien..." class="w-full text-lg py-3 px-4" />
                </div>
                <div class="w-full md:w-48">
                    <select name="status" class="w-full bg-white border border-outline-variant/40 rounded-lg text-lg py-3 px-4 focus:border-secondary focus:ring-secondary transition-colors" onchange="this.form.submit()">
                        <option value="all">Semua Status</option>
                        <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Diterbitkan (Published)</option>
                        <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors text-lg">
                    Cari
                </button>
            </form>
        </div>

        {{-- List --}}
        <x-admin.table :headers="['Nama Klien / Perusahaan', 'Status', 'Aksi']">
            @forelse($clients as $client)
                <tr>
                    <td class="px-6 py-4 font-bold text-gray-900 text-lg">
                        {{ $client->name }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $client->status === 'published' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-gray-50 text-gray-700 border border-gray-200' }}">
                            {{ $client->status === 'published' ? 'Diterbitkan' : 'Draft' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.clients.edit', $client) }}" class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                <x-lucide-edit class="w-4 h-4" />
                            </a>
                            <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" class="inline" data-no-alert>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus klien ini?')">
                                    <x-lucide-trash-2 class="w-4 h-4" />
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <x-lucide-award class="w-12 h-12 text-gray-300 mx-auto mb-4" />
                            <h3 class="text-xl font-bold text-gray-900">Belum ada data klien</h3>
                            <p class="text-gray-500 mt-2 max-w-md mx-auto">Klik tombol "Tambah Klien" di atas untuk membuat klien baru.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </x-admin.table>
        
        <div class="mt-4">
            {{ $clients->links() }}
        </div>
    </div>
</x-admin-layout>
