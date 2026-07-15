<x-admin-layout>
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 font-display">Tambah User Baru</h1>
                <p class="text-lg text-gray-600 mt-1">Buat data pengguna administrator baru.</p>
            </div>
            <div>
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-lg hover:bg-gray-200 transition-colors shadow-sm text-sm">
                    <x-lucide-arrow-left class="w-4 h-4 mr-2" /> Kembali
                </a>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 max-w-3xl">
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="name" value="Nama Lengkap*" />
                    <x-text-input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus class="mt-2 w-full py-3 px-4 text-lg" placeholder="Masukkan nama lengkap user..." />
                </div>

                <div>
                    <x-input-label for="email" value="Alamat Email*" />
                    <x-text-input id="email" name="email" type="email" value="{{ old('email') }}" required class="mt-2 w-full py-3 px-4 text-lg" placeholder="Masukkan alamat email aktif..." />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="password" value="Password*" />
                        <x-text-input id="password" name="password" type="password" required class="mt-2 w-full py-3 px-4 text-lg" placeholder="Minimal 8 karakter..." />
                    </div>
                    <div>
                        <x-input-label for="password_confirmation" value="Konfirmasi Password*" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password" required class="mt-2 w-full py-3 px-4 text-lg" placeholder="Ulangi password..." />
                    </div>
                </div>

                <div>
                    <x-input-label for="role_id" value="Hak Akses / Role" />
                    <div class="mt-3">
                        <span class="inline-flex items-center px-4 py-2 bg-primary/10 text-primary rounded-lg font-bold text-sm uppercase border border-primary/20 tracking-wider">
                            Super Admin
                        </span>
                        @if($roles->count() > 0)
                            <input type="hidden" name="role_id" value="{{ $roles->first()->id }}" />
                        @endif
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-gray-100">
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors text-lg">Batal</a>
                    <x-primary-button class="px-6 py-3 bg-primary text-white font-bold rounded-xl hover:bg-primary/95 transition-colors text-lg">
                        <x-lucide-save class="w-5 h-5 mr-2" /> Simpan User
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>