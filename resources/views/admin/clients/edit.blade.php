<x-admin-layout>
    <div class="space-y-6" x-data="{ name: '{{ addslashes($client->name) }}' }">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Ubah Klien</h1>
                <p class="text-lg text-gray-600 mt-1">Ubah data perusahaan klien.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form action="{{ route('admin.clients.update', $client) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="name" value="Nama Instansi / Perusahaan Klien*" />
                        <x-text-input id="name" name="name" type="text" x-model="name" required maxlength="255" class="w-full text-lg py-3 px-4" />
                        <div class="flex justify-between items-center text-sm text-gray-500 mt-1">
                            <span>Wajib diisi.</span>
                            <span><span x-text="name.length">0</span>/255</span>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="status" value="Status Penerbitan*" />
                        <select id="status" name="status" class="w-full bg-white border border-outline-variant/40 rounded-lg text-lg py-3 px-4 focus:border-secondary focus:ring-secondary transition-colors">
                            <option value="published" {{ $client->status === 'published' ? 'selected' : '' }}>Diterbitkan (Published)</option>
                            <option value="draft" {{ $client->status === 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.clients.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors text-lg">
                        Batal
                    </a>
                    <x-primary-button type="submit">
                        <x-lucide-save class="w-5 h-5 mr-2" /> Simpan Perubahan
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
