<x-admin-layout>
    <div class="space-y-6" x-data="{ name: '', role: '', branch: 'main' }">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Tambah Anggota Tim</h1>
                <p class="text-lg text-gray-600 mt-1">Tambahkan personil baru ke struktur organisasi.</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <form action="{{ route('admin.team-members.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="branch" value="Pilih Cabang / Perusahaan*" />
                        <select id="branch" name="branch" x-model="branch" required class="w-full bg-white border border-outline-variant/40 rounded-lg text-lg py-3 px-4 focus:border-secondary focus:ring-secondary transition-colors">
                            <option value="main">PT Batam Kepri Jaya</option>
                            <option value="koperasi">Koperasi Jasa TKBM BKJ</option>
                        </select>
                        <p class="text-sm text-gray-500 mt-1">Menentukan bagan struktur di mana personil akan ditampilkan.</p>
                    </div>

                    <div>
                        <x-input-label for="name" value="Nama Lengkap Anggota Tim*" />
                        <x-text-input id="name" name="name" type="text" x-model="name" required maxlength="255" class="w-full text-lg py-3 px-4" placeholder="Contoh: Sudirman Sikumbang" />
                        <div class="flex justify-between items-center text-sm text-gray-500 mt-1">
                            <span>Wajib diisi.</span>
                            <span><span x-text="name.length">0</span>/255</span>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="role" value="Jabatan (Indonesia)*" />
                        <x-text-input id="role" name="role" type="text" x-model="role" required maxlength="255" class="w-full text-lg py-3 px-4" placeholder="Contoh: Komisaris Utama, Direktur, Staff Operasional" />
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
                                    <option value="commissioner">Komisaris (Paling Atas)</option>
                                    <option value="director">Direktur (Tingkat Kedua)</option>
                                    <option value="manager">Manager (Tingkat Ketiga)</option>
                                    <option value="operational">Operasional (Tingkat Keempat - Grid Bawah)</option>
                                </>
                            </template>
                            <template x-if="branch === 'koperasi'">
                                <>
                                    <option value="supervisor">Pengawas</option>
                                    <option value="management">Pengurus</option>
                                </>
                            </template>
                        </select>
                        <p class="text-sm text-gray-500 mt-1">Menentukan posisi bagan alir organisasi di halaman depan.</p>
                    </div>

                    <div>
                        <x-input-label for="order" value="Nomor Urut Tampilan*" />
                        <x-text-input id="order" name="order" type="number" min="0" value="0" required class="w-full text-lg py-3 px-4" />
                        <p class="text-sm text-gray-500 mt-1">Gunakan angka bulat (contoh: 1, 2, 3) untuk mengurutkan posisi dari kiri ke kanan.</p>
                    </div>

                    <div class="md:col-span-2">
                        <x-input-label for="image" value="Foto Anggota Tim (Opsional)" />
                        <input type="file" name="image" id="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 border border-outline-variant/40 rounded-lg bg-white mt-1 cursor-pointer">
                        <p class="text-sm text-gray-500 mt-1">Maksimal 2 MB. Jika diunggah, foto ini akan digunakan sebagai foto profil anggota tim di website (menggantikan ikon user default).</p>
                        @error('image') <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <x-input-label for="status" value="Status Penerbitan*" />
                        <select id="status" name="status" class="w-full bg-white border border-outline-variant/40 rounded-lg text-lg py-3 px-4 focus:border-secondary focus:ring-secondary transition-colors">
                            <option value="published">Diterbitkan (Published)</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.team-members.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors text-lg">
                        Batal
                    </a>
                    <x-primary-button type="submit">
                        <x-lucide-save class="w-5 h-5 mr-2" /> Simpan Anggota Tim
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
