<x-admin-layout>
    <div class="space-y-6" x-data="{ name: '{{ addslashes($teamMember->name) }}', role: '{{ addslashes($teamMember->role) }}', branch: '{{ $teamMember->branch }}' }">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Ubah Anggota Tim</h1>
                <p class="text-lg text-gray-600 mt-1">Ubah data personil struktur organisasi.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form action="{{ route('admin.team-members.update', $teamMember) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="branch" value="Pilih Cabang / Perusahaan*" />
                        <select id="branch" name="branch" x-model="branch" required class="w-full bg-white border border-outline-variant/40 rounded-lg text-lg py-3 px-4 focus:border-secondary focus:ring-secondary transition-colors">
                            <option value="main">PT Batam Kepri Jaya</option>
                            <option value="koperasi">Koperasi Jasa TKBM BKJ</option>
                            <option value="pt-bintang-kepri-jaya">PT Bintang Kepri Jaya</option>
                        </select>
                        <p class="text-sm text-gray-500 mt-1">Menentukan bagan struktur di mana personil akan ditampilkan.</p>
                    </div>

                    <div>
                        <x-input-label for="name" value="Nama Lengkap Anggota Tim*" />
                        <x-text-input id="name" name="name" type="text" x-model="name" required maxlength="255" class="w-full text-lg py-3 px-4" />
                        <div class="flex justify-between items-center text-sm text-gray-500 mt-1">
                            <span>Wajib diisi.</span>
                            <span><span x-text="name.length">0</span>/255</span>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="role" value="Jabatan (Indonesia)*" />
                        <x-text-input id="role" name="role" type="text" x-model="role" required maxlength="255" class="w-full text-lg py-3 px-4" />
                        <div class="flex justify-between items-center text-sm text-gray-500 mt-1">
                            <span>Sistem menerjemahkan ke Bahasa Inggris otomatis.</span>
                            <span><span x-text="role.length">0</span>/255</span>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="level" value="Tingkat Bagan Organisasi*" />
                        <select id="level" name="level" required class="w-full bg-white border border-outline-variant/40 rounded-lg text-lg py-3 px-4 focus:border-secondary focus:ring-secondary transition-colors">
                            <template x-if="branch === 'main'">
                                <>
                                    <option value="commissioner" {{ $teamMember->level === 'commissioner' ? 'selected' : '' }}>Komisaris (Paling Atas)</option>
                                    <option value="director" {{ $teamMember->level === 'director' ? 'selected' : '' }}>Direktur (Tingkat Kedua)</option>
                                    <option value="manager" {{ $teamMember->level === 'manager' ? 'selected' : '' }}>Manager (Tingkat Ketiga)</option>
                                    <option value="operational" {{ $teamMember->level === 'operational' ? 'selected' : '' }}>Operasional (Tingkat Keempat - Grid Bawah)</option>
                                </>
                            </template>
                            <template x-if="branch === 'koperasi'">
                                <>
                                    <option value="supervisor" {{ $teamMember->level === 'supervisor' ? 'selected' : '' }}>Pengawas</option>
                                    <option value="management" {{ $teamMember->level === 'management' ? 'selected' : '' }}>Pengurus</option>
                                </>
                            </template>
                            <template x-if="branch === 'pt-bintang-kepri-jaya'">
                                <>
                                    <option value="director" {{ $teamMember->level === 'director' ? 'selected' : '' }}>Direktur</option>
                                    <option value="manager" {{ $teamMember->level === 'manager' ? 'selected' : '' }}>Manager</option>
                                    <option value="operational" {{ $teamMember->level === 'operational' ? 'selected' : '' }}>Staff/Operasional</option>
                                </>
                            </template>
                        </select>
                        <p class="text-sm text-gray-500 mt-1">Menentukan posisi bagan alir organisasi di halaman depan.</p>
                    </div>

                    <div>
                        <x-input-label for="order" value="Nomor Urut Tampilan*" />
                        <x-text-input id="order" name="order" type="number" min="0" value="{{ old('order', $teamMember->order) }}" required class="w-full text-lg py-3 px-4" />
                        <p class="text-sm text-gray-500 mt-1">Gunakan angka bulat (contoh: 1, 2, 3) untuk mengurutkan posisi dari kiri ke kanan.</p>
                    </div>

                    <div class="md:col-span-2">
                        <x-admin.image-cropper 
                            id="image" 
                            name="image" 
                            label="Foto Anggota Tim (Opsional)" 
                            description="Maksimal 2 MB. Jika diunggah, foto ini akan digunakan sebagai foto profil anggota tim di website (menggantikan ikon user default). Akan dipotong dengan rasio 1:1 (Persegi)."
                            aspect-ratio="1"
                            :current-image-url="$teamMember->image_path ? Storage::url($teamMember->image_path) : null"
                        />
                    </div>

                    <div>
                        <x-input-label for="status" value="Status Penerbitan*" />
                        <select id="status" name="status" class="w-full bg-white border border-outline-variant/40 rounded-lg text-lg py-3 px-4 focus:border-secondary focus:ring-secondary transition-colors">
                            <option value="published" {{ $teamMember->status === 'published' ? 'selected' : '' }}>Diterbitkan (Published)</option>
                            <option value="draft" {{ $teamMember->status === 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.team-members.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors text-lg">
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
