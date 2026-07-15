@php
    $routeName = request()->route() ? request()->route()->getName() : '';
    
    // Ignore dashboard completely
    if (str_contains($routeName, 'admin.dashboard') || empty($routeName)) {
        return;
    }

    $helpContent = [
        'admin.content.index' => [
            'title' => 'Panduan Website Content',
            'steps' => [
                'Gunakan tab di bagian atas untuk memilih bagian konten website (Hero, About Us, Klien, Kontak, Footer).',
                'Isi data formulir dengan lengkap. Sistem akan menerjemahkan input ke Bahasa Inggris secara otomatis.',
                'Setelah selesai, klik tombol **Save** untuk menyimpan dan memperbarui cache halaman depan.'
            ]
        ],
        'admin.company-assets.index' => [
            'title' => 'Panduan Favicon & Icons',
            'steps' => [
                'Gunakan tab di bagian atas untuk mengonfigurasi aset global grup BKJ atau anak perusahaan spesifik.',
                'Unggah Icon (.png, .svg) dengan kapasitas maksimal 2MB untuk logo brand.',
                'Unggah Favicon (.ico, .png, .svg) dengan kapasitas maksimal 2MB untuk ikon tab browser.',
                'File PNG akan dikompresi otomatis demi optimasi kecepatan muat halaman.'
            ]
        ],
        'admin.blogs.index' => [
            'title' => 'Panduan Daftar Berita',
            'steps' => [
                'Halaman ini menampilkan seluruh artikel berita atau artikel informasi yang terbit di website.',
                'Gunakan tombol **Tulis Artikel Baru** di kanan atas untuk membuat berita baru.',
                'Gunakan kolom pencarian untuk memfilter berita berdasarkan judul atau isi.',
                'Anda dapat mengubah (edit) atau menghapus artikel menggunakan tombol di kolom aksi.'
            ]
        ],
        'admin.blogs.create' => [
            'title' => 'Panduan Tulis Artikel',
            'steps' => [
                'Tulis judul dan konten berita dalam Bahasa Indonesia. Sistem akan menerjemahkan ke Bahasa Inggris secara otomatis.',
                'Unggah gambar utama artikel (maksimal 2MB, disarankan lanskap).',
                'Gunakan status **Diterbitkan** agar artikel langsung tampil di halaman depan, atau **Draft** jika belum selesai.'
            ]
        ],
        'admin.blogs.edit' => [
            'title' => 'Panduan Ubah Artikel',
            'steps' => [
                'Tulis judul dan konten berita dalam Bahasa Indonesia. Sistem akan menerjemahkan ke Bahasa Inggris secara otomatis.',
                'Unggah gambar utama artikel (maksimal 2MB, disarankan lanskap).',
                'Gunakan status **Diterbitkan** agar artikel langsung tampil di halaman depan, atau **Draft** jika belum selesai.'
            ]
        ],
        'admin.galleries.index' => [
            'title' => 'Panduan Galeri Foto',
            'steps' => [
                'Kelola dokumentasi aktivitas operasional BKJ Group di halaman ini.',
                'Klik tombol **Tambah Foto Baru** untuk mengunggah gambar baru (maksimal 2MB, format JPEG/PNG/WebP).',
                'Tulis judul galeri yang representatif untuk informasi gambar di website.'
            ]
        ],
        'admin.services.index' => [
            'title' => 'Panduan Daftar Layanan',
            'steps' => [
                'Menampilkan seluruh layanan operasional kargo, logistik, dan maritim.',
                'Klik tombol **Tambah Layanan Baru** di kanan atas untuk menambah layanan.',
                'Anda dapat mengubah data layanan, mengunggah foto representatif, atau menghapusnya jika sudah tidak aktif.'
            ]
        ],
        'admin.services.create' => [
            'title' => 'Panduan Form Tambah Layanan',
            'steps' => [
                'Isi nama layanan, ikon lucide (opsional), dan penjelasan detail layanan.',
                'Anda dapat mengunggah foto layanan (maksimal 2MB) untuk dipasang sebagai banner representatif.',
                'Setelah selesai, klik simpan agar data diperbarui.'
            ]
        ],
        'admin.services.edit' => [
            'title' => 'Panduan Form Ubah Layanan',
            'steps' => [
                'Isi nama layanan, ikon lucide (opsional), dan penjelasan detail layanan.',
                'Anda dapat mengunggah foto layanan (maksimal 2MB) untuk dipasang sebagai banner representatif.',
                'Setelah selesai, klik simpan agar data diperbarui.'
            ]
        ],
        'admin.team-members.index' => [
            'title' => 'Panduan Struktur Tim',
            'steps' => [
                'Kelola daftar pengurus, komisaris, direksi, dan staf operasional.',
                'Klik tombol **Tambah Anggota Tim** untuk menambah personil baru.',
                'Gunakan nomor urut tampilan untuk mengatur posisi kemunculan tim dari kiri ke kanan.'
            ]
        ],
        'admin.team-members.create' => [
            'title' => 'Panduan Form Tambah Anggota Tim',
            'steps' => [
                'Isi nama lengkap, jabatan, dan tingkat posisi bagan bagan tim.',
                'Unggah foto profil anggota tim (maksimal 2MB) agar tampil di bagan alir dan halaman profil.'
            ]
        ],
        'admin.team-members.edit' => [
            'title' => 'Panduan Form Ubah Anggota Tim',
            'steps' => [
                'Isi nama lengkap, jabatan, dan tingkat posisi bagan bagan tim.',
                'Unggah foto profil anggota tim (maksimal 2MB) agar tampil di bagan alir dan halaman profil.'
            ]
        ],
        'admin.clients.index' => [
            'title' => 'Panduan Daftar Klien',
            'steps' => [
                'Kelola logo klien dan mitra kerjasama BKJ Group.',
                'Klik tombol **Tambah Klien Baru** untuk mengunggah logo (maksimal 2MB, latar belakang transparan disarankan).'
            ]
        ],
        'admin.contacts.index' => [
            'title' => 'Panduan Kotak Masuk Inbox',
            'steps' => [
                'Halaman ini menampung seluruh formulir pesan kontak yang dikirimkan oleh pengunjung website.',
                'Klik pesan untuk membaca detail, melihat nama, email, nomor telepon, dan pesan yang dikirimkan.',
                'Pesan dapat dihapus dari sistem jika sudah ditindaklanjuti.'
            ]
        ],
        'admin.users.index' => [
            'title' => 'Panduan User Management',
            'steps' => [
                'Halaman ini menampilkan seluruh data pengguna administrator website.',
                'Hanya Super Admin yang dapat mengakses menu ini.',
                'Gunakan tombol **Tambah User** untuk mendaftarkan akun administrator baru.',
                'Anda tidak dapat menghapus akun Anda sendiri demi keamanan.'
            ]
        ],
        'admin.users.create' => [
            'title' => 'Panduan Tambah User Baru',
            'steps' => [
                'Masukkan nama lengkap, email, password baru, serta konfirmasi password.',
                'Untuk saat ini, seluruh user baru akan otomatis dibuat dengan hak akses/role **Super Admin**.'
            ]
        ],
        'admin.users.edit' => [
            'title' => 'Panduan Ubah Data User',
            'steps' => [
                'Ubah nama lengkap atau alamat email user.',
                'Untuk mengubah password, isi kolom **Password Baru** dan **Konfirmasi Password**. Biarkan kosong jika tidak ingin mengubah password lama.',
                'Hak akses/role tetap dikunci pada level **Super Admin**.'
            ]
        ]
    ];

    // Fallback if route name is not explicitly defined in the map
    $activeHelp = $helpContent[$routeName] ?? [
        'title' => 'Panduan Penggunaan',
        'steps' => [
            'Gunakan formulir atau tabel yang disediakan untuk mengelola konten.',
            'Hubungi admin jika Anda mengalami kesulitan teknis dalam pengoperasian.'
        ]
    ];
@endphp

<div x-data="{ open: false }">
    <button @click="open = true" class="inline-flex items-center px-4 py-2.5 bg-amber-500 text-white font-medium rounded-lg hover:bg-amber-600 transition-colors shadow-sm text-sm">
        <x-lucide-help-circle class="w-4 h-4 mr-2" /> Bantuan
    </button>

    {{-- Modal Popup --}}
    <div x-show="open" 
         class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-black/50" 
         x-cloak
         style="display: none;">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 max-w-lg w-full p-8 relative text-left" @click.away="open = false">
            <button @click="open = false" class="absolute top-6 right-6 text-gray-400 hover:text-gray-600">
                <x-lucide-x class="w-6 h-6" />
            </button>
            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <x-lucide-info class="w-6 h-6 text-amber-500 animate-pulse" /> {{ $activeHelp['title'] }}
            </h2>
            <div class="space-y-4 text-base text-gray-600 leading-relaxed">
                <p class="font-medium text-gray-700">Petunjuk Penggunaan:</p>
                <ul class="list-disc pl-5 space-y-3">
                    @foreach($activeHelp['steps'] as $step)
                        <li>{!! $step !!}</li>
                    @endforeach
                </ul>
            </div>
            <button @click="open = false" class="mt-8 w-full py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors">
                Tutup
            </button>
        </div>
    </div>
</div>
