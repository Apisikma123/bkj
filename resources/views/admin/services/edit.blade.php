<x-admin-layout>
    <div class="space-y-6" x-data="{ title: '{{ addslashes($service->title) }}', short_desc: '{{ addslashes($service->short_description ?? '') }}' }">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Ubah Data Layanan</h1>
                <p class="text-lg text-gray-600 mt-1">Ubah data layanan yang sudah ada.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="title" value="Nama Layanan (Indonesia)*" />
                        <x-text-input id="title" name="title" type="text" x-model="title" required maxlength="255" class="w-full text-lg py-3 px-4" />
                        <div class="flex justify-between items-center text-sm text-gray-500 mt-1">
                            <span>Sistem akan menerjemahkan nama ini ke Bahasa Inggris secara otomatis.</span>
                            <span><span x-text="title.length">0</span>/255</span>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="icon" value="Ikon Layanan (Lucide)*" />
                        <x-text-input id="icon" name="icon" type="text" value="{{ old('icon', $service->icon) }}" required class="w-full text-lg py-3 px-4" />
                        <p class="text-sm text-gray-500 mt-1">Masukkan nama ikon kecil (misalnya: <em>truck</em>, <em>ship</em>, <em>users</em>, <em>anchor</em>).</p>
                    </div>

                    <div class="md:col-span-2">
                        <x-admin.image-cropper 
                            id="image" 
                            name="image" 
                            label="Foto Layanan (Opsional)" 
                            description="Maksimal 2 MB. Jika diunggah, foto ini akan digunakan sebagai gambar utama layanan di website (menggantikan ikon Lucide). Akan dipotong dengan rasio 16:9 (Persegi Panjang)."
                            aspect-ratio="16/9"
                            :current-image-url="$service->image_path ? Storage::url($service->image_path) : null"
                        />
                    </div>

                    <div class="md:col-span-2">
                        <x-input-label for="short_description" value="Deskripsi Singkat (Indonesia)" />
                        <x-textarea-input id="short_description" name="short_description" x-model="short_desc" maxlength="500" rows="3" class="w-full text-lg p-4">{{ old('short_description', $service->short_description) }}</x-textarea-input>
                        <div class="flex justify-between items-center text-sm text-gray-500 mt-1">
                            <span>Maksimal 500 karakter.</span>
                            <span><span x-text="short_desc.length">0</span>/500</span>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <x-input-label for="content" value="Penjelasan Lengkap (Indonesia)*" />
                        <x-textarea-input id="content" name="content" rows="6" required class="w-full text-lg p-4">{{ old('content', $service->content) }}</x-textarea-input>
                        <p class="text-sm text-gray-500 mt-1">Jelaskan secara mendalam tentang layanan ini untuk meyakinkan calon pelanggan.</p>
                    </div>

                    <div>
                        <x-input-label for="status" value="Status Penerbitan*" />
                        <select id="status" name="status" class="w-full bg-white border border-outline-variant/40 rounded-lg text-lg py-3 px-4 focus:border-secondary focus:ring-secondary transition-colors">
                            <option value="published" {{ $service->status === 'published' ? 'selected' : '' }}>Diterbitkan (Published)</option>
                            <option value="draft" {{ $service->status === 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                        <p class="text-sm text-gray-500 mt-1">Pilih "Diterbitkan" agar langsung tampil di website atau "Draft" jika masih ingin diedit.</p>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.services.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors text-lg">
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
