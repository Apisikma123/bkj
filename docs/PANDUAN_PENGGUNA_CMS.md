# Panduan Pengguna — CMS Company Profile BKJ Group

**Versi Dokumen:** 1.0  
**Tanggal:** Juli 2026  
**Diperuntukkan bagi:** Administrator & Staf Konten  
**Aplikasi:** BKJ Group — Content Management System (CMS)

---

## Daftar Isi

1. [Pendahuluan](#1-pendahuluan)
2. [Cara Login ke Dashboard Admin](#2-cara-login-ke-dashboard-admin)
3. [Pengenalan Dashboard](#3-pengenalan-dashboard)
4. [Mengelola Pengaturan Umum (Company Assets)](#4-mengelola-pengaturan-umum-company-assets)
5. [Mengelola Konten Website (Website Content)](#5-mengelola-konten-website-website-content)
6. [Mengelola Berita / Artikel (News Center)](#6-mengelola-berita--artikel-news-center)
7. [Mengelola Galeri Foto (Gallery)](#7-mengelola-galeri-foto-gallery)
8. [Mengelola Layanan (Services)](#8-mengelola-layanan-services)
9. [Mengelola Struktur Tim (Team Members)](#9-mengelola-struktur-tim-team-members)
10. [Mengelola Daftar Klien & Mitra (Clients)](#10-mengelola-daftar-klien--mitra-clients)
11. [Mengelola Anak Perusahaan (Subsidiaries)](#11-mengelola-anak-perusahaan-subsidiaries)
12. [Mengelola Rekening Bank (Bank Accounts)](#12-mengelola-rekening-bank-bank-accounts)
13. [Mengecek Pesan Masuk (Inbox)](#13-mengecek-pesan-masuk-inbox)
14. [Keluar dari Sistem (Logout)](#14-keluar-dari-sistem-logout)
15. [FAQ & Pemecahan Masalah](#15-faq--pemecahan-masalah)

---

## 1. Pendahuluan

Selamat datang di **CMS Company Profile BKJ Group**.

CMS (Content Management System) ini adalah aplikasi berbasis web yang dirancang khusus untuk membantu Anda, sebagai **Administrator** atau **Staf Konten**, dalam mengelola seluruh informasi yang tampil di website resmi perusahaan tanpa perlu memiliki keahlian pemrograman.

Melalui CMS ini, Anda dapat:

- Mengubah teks, gambar, dan informasi kontak perusahaan
- Membuat, mengedit, dan mempublikasikan berita/artikel
- Mengunggah dan mengelola galeri foto proyek
- Mengelola daftar layanan yang ditawarkan perusahaan
- Mengatur profil anggota tim dan struktur organisasi
- Mengelola informasi anak perusahaan (subsidiaries)
- Mengelola daftar klien dan mitra kerja
- Membaca pesan yang masuk dari pengunjung website
- Mengganti logo dan favicon website

> **Tips:** Dokumen panduan ini juga tersedia langsung dari dalam dashboard CMS. Klik ikon tanda tanya (?) di pojok kanan atas halaman untuk mengaksesnya.

---

## 2. Cara Login ke Dashboard Admin

### 2.1. Mengakses Halaman Login

1. Buka browser Anda (disarankan menggunakan Google Chrome, Mozilla Firefox, atau Microsoft Edge versi terbaru).
2. Ketikkan alamat URL website admin Anda di address bar, misalnya:  
   `https://www.domainanda.com/login`
3. Halaman login akan muncul dengan judul **"Welcome Back"** dan subjudul *"Sign in to manage your operations"*.

[Masukkan Screenshot: Halaman Login CMS dengan form email dan password terlihat jelas]

### 2.2. Memasukkan Kredensial

1. Pada kolom **Email**, masukkan alamat email admin yang telah didaftarkan (contoh: `admin@bkjgroup.com`).
2. Pada kolom **Password**, masukkan kata sandi Anda.
   - Klik tombol lihat password di sebelah kanan kolom password untuk menampilkan atau menyembunyikan karakter password Anda.
3. *(Opsional)* Centang kotak **Remember me** jika Anda ingin browser mengingat sesi login Anda.
4. Jika tersedia, selesaikan verifikasi keamanan **Cloudflare Turnstile** yang muncul di bawah form.
5. Klik tombol **Log in**.

[Masukkan Screenshot: Form login yang sudah terisi dengan email dan kursor di kolom password]

### 2.3. Lupa Password

Jika Anda lupa kata sandi:

1. Klik tautan **Forgot password?** yang terletak di sebelah kanan label "Password".
2. Masukkan alamat email Anda pada halaman yang muncul.
3. Periksa kotak masuk email Anda untuk tautan reset password.
4. Ikuti instruksi di dalam email untuk membuat password baru.

> **Peringatan Keamanan:**
> - Jangan pernah membagikan akun dan kata sandi Anda kepada siapa pun.
> - Gunakan password yang kuat (minimal 8 karakter, kombinasi huruf besar, huruf kecil, angka, dan simbol).
> - Selalu klik **Log Out** setelah selesai menggunakan CMS, terutama jika menggunakan komputer bersama.
> - Jangan centang **Remember me** pada perangkat publik atau milik orang lain.

---

## 3. Pengenalan Dashboard

Setelah berhasil login, Anda akan langsung diarahkan ke halaman **Dashboard Overview**. Halaman ini adalah pusat kendali Anda untuk memantau aktivitas terkini pada website.

[Masukkan Screenshot: Tampilan penuh halaman Dashboard Overview dengan semua elemen terlihat]

### 3.1. Panel Statistik Ringkasan

Di bagian atas dashboard, Anda akan melihat empat kartu statistik yang menampilkan:

| Kartu | Deskripsi |
|-------|-----------|
| **Total Berita** | Jumlah seluruh artikel/berita yang ada di sistem |
| **Total Galeri** | Jumlah seluruh item galeri foto |
| **Total Layanan** | Jumlah layanan yang terdaftar |
| **Pesan Baru** | Jumlah pesan masuk yang belum dibaca |

### 3.2. Quick Actions (Aksi Cepat)

Di bawah panel statistik, terdapat area **Quick Actions** berupa enam tombol pintasan:

| Tombol | Fungsi |
|--------|--------|
| **Edit Web Content** | Langsung menuju halaman pengelolaan konten website |
| **Write News** | Langsung membuat artikel berita baru |
| **Upload Gallery** | Langsung mengunggah foto galeri baru |
| **Tambah Layanan** | Langsung menambahkan layanan baru |
| **Tambah Tim** | Langsung menambahkan anggota tim baru |
| **Tambah Klien** | Langsung menambahkan klien/mitra baru |

### 3.3. Panel Monitoring

Di bagian bawah dashboard terdapat tiga panel pemantauan:

- **Recent Inbox** — Menampilkan pesan-pesan terbaru dari pengunjung website. Pesan yang belum dibaca ditandai dengan latar belakang biru muda. Klik ikon chevron untuk melihat detail, atau klik **View All** untuk melihat semua pesan.
- **Recent News Updates** — Menampilkan berita-berita terbaru beserta status publikasinya (*Published*, *Draft*, *Archived*). Klik **Manage News** untuk mengelola seluruh berita.
- **Latest Gallery Uploads** — Menampilkan empat gambar galeri terbaru dalam format grid. Arahkan kursor (hover) ke gambar untuk melihat judulnya. Klik **View All** untuk melihat semua galeri.

### 3.4. Navigasi Sidebar (Menu Samping Kiri)

Navigasi utama CMS terletak pada **sidebar** di sisi kiri layar dengan latar biru tua dan logo **BKJ CMS** di bagian atas. Berikut daftar menu yang tersedia:

| No. | Menu | Fungsi |
|-----|------|--------|
| 1 | **Dashboard** | Halaman utama ringkasan & monitoring |
| 2 | **Website Content** | Mengelola konten halaman website (Home, About, Contact, Footer) |
| 3 | **Favicon & Icons** | Mengelola logo dan ikon favicon perusahaan |
| 4 | **News Center** | Mengelola artikel berita |
| 5 | **Gallery** | Mengelola galeri foto |
| 6 | **Layanan** | Mengelola daftar layanan perusahaan |
| 7 | **Struktur Tim** | Mengelola profil anggota tim |
| 8 | **Daftar Klien** | Mengelola daftar klien & mitra |
| 9 | **Rekening Bank** | Mengelola informasi rekening bank |
| 10 | **Inbox** | Membaca pesan masuk dari pengunjung |
| 11 | **User Management** | Mengelola akun pengguna *(hanya Super Admin)* |

> **Tips:** Menu yang sedang aktif/dipilih akan ditandai dengan garis indikator di sisi kiri dan latar belakang yang sedikit lebih terang.

### 3.5. Top Bar (Bilah Atas)

Di bagian atas halaman terdapat **Top Bar** yang memuat:

- **Tombol hamburger** — Klik untuk menyembunyikan atau menampilkan sidebar.
- **Ikon Bantuan** — Klik untuk membuka panduan bantuan cepat.
- **Profil Pengguna** — Menampilkan nama dan peran Anda. Klik untuk membuka menu dropdown dengan opsi:
  - **View Site** — Membuka halaman depan website di tab baru.
  - **Profile Settings** — Mengatur profil dan password Anda.
  - **Log Out** — Keluar dari sistem CMS.

[Masukkan Screenshot: Top Bar dengan profil dropdown terbuka menampilkan opsi View Site, Profile Settings, dan Log Out]

---

## 4. Mengelola Pengaturan Umum (Company Assets)

Modul ini memungkinkan Anda untuk mengelola logo ikon dan favicon (ikon kecil di tab browser) untuk seluruh halaman umum perusahaan maupun untuk masing-masing anak perusahaan.

### 4.1. Mengakses Halaman Company Assets

1. Klik menu **Favicon & Icons** pada sidebar.
2. Halaman **"Company Icons & Favicons"** akan terbuka.

[Masukkan Screenshot: Halaman Company Icons & Favicons dengan tab Global aktif]

### 4.2. Mengubah Logo & Favicon Global (Semua Halaman)

Logo dan favicon global berlaku untuk semua halaman umum website yang tidak terkait anak perusahaan tertentu.

1. Pastikan tab **BKJ Group (All Pages)** sedang aktif (tab paling kiri).
2. Anda akan melihat dua kartu:
   - **Global Logo / Icon** — Ikon/logo yang tampil di bagian publik website.
   - **Global Browser Tab Favicon** — Ikon kecil yang tampil pada tab browser.

#### Mengunggah Logo Global Baru:

1. Pada kartu **Global Logo / Icon**, klik area **Upload Global Icon File**.
2. Pilih file gambar dari komputer Anda (format: `.ico`, `.png`, atau `.svg`).
3. Jendela **Image Cropper** akan muncul. Sesuaikan area pemotongan gambar dengan rasio **1:1** (persegi).
4. Setelah puas dengan hasil cropping, preview gambar akan tampil.
5. Lakukan hal yang sama untuk **Global Browser Tab Favicon** jika diperlukan.
6. Klik tombol **Save Global Assets** di bagian bawah halaman.

> **Tips:** Ukuran file gambar maksimal adalah **2 MB**. File PNG akan dikompresi secara otomatis oleh sistem.

### 4.3. Mengubah Logo & Favicon per Anak Perusahaan

1. Klik tab dengan **nama anak perusahaan** yang diinginkan (misalnya: *PT. Bintang Kepri Jaya*).
2. Proses unggah logo dan favicon sama persis seperti langkah untuk Global di atas.
3. Klik tombol **Save Settings for [Nama Anak Perusahaan]** untuk menyimpan.

[Masukkan Screenshot: Tab anak perusahaan aktif dengan preview logo dan favicon terlihat]

---

## 5. Mengelola Konten Website (Website Content)

Modul ini digunakan untuk mengedit teks dan gambar pada halaman-halaman statis website seperti Beranda, Tentang Kami, Kontak, dan Footer.

### 5.1. Mengakses Halaman Website Content

1. Klik menu **Website Content** pada sidebar.
2. Halaman **"Website Content"** akan terbuka dengan beberapa tab di bagian atas: **Home**, **About**, **Gallery**, **Subsidiaries**, **Contact**, dan **Footer**.

[Masukkan Screenshot: Halaman Website Content dengan deretan tab (Home, About, Gallery, Subsidiaries, Contact, Footer) terlihat di atas]

### 5.2. Mengedit Konten Beranda (Home)

1. Klik tab **Home** (biasanya sudah aktif secara default).
2. Anda akan melihat dua bagian utama:

#### A. Hero Section (Banner Utama)

| Field | Keterangan |
|-------|-----------|
| **Hero Title** | Judul besar yang tampil di banner utama halaman beranda |
| **Hero Subtitle** | Teks deskripsi pendukung di bawah judul |
| **Hero Image (Background)** | Gambar latar belakang banner (rasio 16:9) |

- Isi atau ubah teks pada kolom **Hero Title** dan **Hero Subtitle**.
- Untuk mengubah gambar latar, klik area **Hero Image (Background)**, pilih file, dan lakukan pemotongan gambar.

#### B. Client Testimonials

- Masukkan testimoni klien pada kolom **Testimonials**, satu testimoni per baris.
- Format penulisan: `Teks testimoni - Nama Perusahaan`
- Contoh: `Layanan yang sangat memuaskan. - PT. Maju Bersama`

3. Setelah selesai, klik tombol **Save Home Content**.

[Masukkan Screenshot: Tab Home aktif dengan form Hero Section dan Client Testimonials terisi]

### 5.3. Mengedit Konten Tentang Kami (About)

1. Klik tab **About**.
2. Lengkapi atau ubah informasi berikut:

| Field | Keterangan |
|-------|-----------|
| **Company Name** | Nama resmi perusahaan |
| **Description** | Deskripsi umum tentang perusahaan |
| **Vision** | Visi perusahaan |
| **Mission** | Misi perusahaan |
| **History / Background** | Sejarah atau latar belakang perusahaan |
| **Foto Profil Perusahaan** | Foto yang merepresentasikan perusahaan (opsional, rasio 16:9) |
| **Our Team** | Daftar anggota tim inti (satu per baris, format: `Nama (Jabatan)`) |
| **Company Legality** | Daftar dokumen legalitas perusahaan (satu per baris) |

3. Klik tombol **Save About Content** untuk menyimpan perubahan.

[Masukkan Screenshot: Tab About dengan form Company Name, Vision, Mission, dan History terisi]

### 5.4. Mengedit Konten Galeri dan Anak Perusahaan

Tab **Gallery** dan **Subsidiaries** pada halaman Website Content berfungsi sebagai pintasan navigasi ke modul khusus masing-masing:

- Klik tab **Gallery** → Klik tombol **Manage Gallery** untuk diarahkan ke modul pengelolaan galeri.
- Klik tab **Subsidiaries** → Klik tombol **Manage Subsidiaries** untuk diarahkan ke modul pengelolaan anak perusahaan.

### 5.5. Mengedit Informasi Kontak (Contact)

1. Klik tab **Contact**.
2. Lengkapi atau ubah informasi berikut:

| Field | Keterangan |
|-------|-----------|
| **Email** | Alamat email kontak resmi perusahaan |
| **Phone 1** | Nomor telepon utama |
| **Phone 2 (Optional)** | Nomor telepon alternatif |
| **Address** | Alamat lengkap kantor perusahaan |

3. Klik tombol **Save Contact Info** untuk menyimpan.

[Masukkan Screenshot: Tab Contact dengan form email, telepon, dan alamat terisi]

### 5.6. Mengedit Konten Footer & Media Sosial

1. Klik tab **Footer**.
2. Lengkapi atau ubah informasi berikut:

| Field | Keterangan |
|-------|-----------|
| **Copyright Text** | Teks hak cipta yang tampil di bagian bawah website |
| **Facebook URL** | Tautan ke halaman Facebook perusahaan |
| **Instagram URL** | Tautan ke halaman Instagram perusahaan |
| **LinkedIn URL** | Tautan ke halaman LinkedIn perusahaan |

3. Klik tombol **Save Footer** untuk menyimpan.

> **Tips:** Pastikan tautan media sosial yang Anda masukkan berupa URL lengkap, dimulai dengan `https://` (contoh: `https://www.instagram.com/bkjgroup`).

[Masukkan Screenshot: Tab Footer dengan form Copyright Text dan URL media sosial terisi]

---

## 6. Mengelola Berita / Artikel (News Center)

Modul ini memungkinkan Anda untuk membuat, mengedit, mempublikasikan, dan menghapus artikel berita yang tampil di halaman Blog/News website.

### 6.1. Mengakses Halaman News Center

1. Klik menu **News Center** pada sidebar.
2. Halaman daftar berita akan muncul dengan judul **"News Center"**.

[Masukkan Screenshot: Halaman News Center dengan tabel daftar berita dan tombol Create News di kanan atas]

### 6.2. Memfilter Berita Berdasarkan Status

Di bagian atas daftar terdapat empat tombol filter status:

| Filter | Keterangan |
|--------|-----------|
| **All** | Menampilkan semua berita |
| **Published** | Hanya berita yang sudah dipublikasikan |
| **Drafts** | Hanya berita berstatus draf (belum dipublikasikan) |
| **Archived** | Hanya berita yang telah diarsipkan |

Klik salah satu tombol filter untuk menyaring daftar.

### 6.3. Menambahkan Berita Baru

1. Klik tombol **+ Create News** di pojok kanan atas halaman News Center.
2. Halaman **"Create News"** akan terbuka.

[Masukkan Screenshot: Halaman Create News dengan form kosong siap diisi]

3. Isi formulir berita dengan lengkap:

#### A. Konten Utama (Kolom Kiri)

| Field | Keterangan |
|-------|-----------|
| **Title** | Judul berita/artikel (wajib diisi) |
| **Content** | Isi konten artikel menggunakan editor teks visual (Quill Editor) |

**Menggunakan Quill Editor:**

Editor teks visual ini menyediakan toolbar dengan berbagai opsi format:

- **H1, H2, H3** — Mengatur level heading/judul
- **Bold** — Menebalkan teks
- **Italic** — Memiringkan teks
- **Underline** — Menggarisbawahi teks
- **Strikethrough** — Mencoret teks
- **Blockquote** — Membuat kutipan blok
- **Code Block** — Membuat blok kode
- **Ordered List** — Membuat daftar bernomor
- **Bullet List** — Membuat daftar berpoin
- **Align** — Mengatur perataan teks (kiri, tengah, kanan, justify)
- **Link** — Menyisipkan tautan/hyperlink
- **Image** — Menyisipkan gambar ke dalam konten
- **Video** — Menyematkan video
- **Clean** — Menghapus semua format pada teks yang dipilih

#### B. Panel Pengaturan (Kolom Kanan)

**Publishing (Pengaturan Publikasi):**

| Field | Keterangan |
|-------|-----------|
| **Status** | Pilih status berita: **Draft** (simpan dulu, belum ditampilkan), **Published** (langsung tampil di website), **Archived** (disembunyikan dari website), atau **Expired** (kedaluwarsa) |
| **Category** | Masukkan kategori berita (contoh: *Technology*, *Lifestyle*, *Company News*) |

**Thumbnail (Gambar Unggulan):**

1. Klik area unggah pada bagian **Thumbnail**.
2. Pilih gambar dari komputer Anda.
3. Jendela **Image Cropper** akan muncul — potong gambar dengan rasio **16:9**.
4. Gambar ini akan menjadi gambar utama/cover berita di halaman daftar berita.

4. Setelah semua terisi, klik tombol **Save Article**.

> **Tips:** Jika Anda belum yakin dengan isi artikel, pilih status **Draft** terlebih dahulu. Anda bisa mengubahnya menjadi **Published** kapan saja nanti.

> **Penting:** Ukuran gambar thumbnail maksimal **2 MB**. Gambar akan otomatis dikonversi ke format **WebP** untuk performa website yang optimal.

[Masukkan Screenshot: Form Create News yang sudah terisi dengan judul, konten di editor visual, status Published, dan thumbnail terpasang]

### 6.4. Mengedit Berita yang Sudah Ada

1. Pada halaman **News Center**, temukan berita yang ingin diedit.
2. Klik ikon **pensil** pada kolom **Aksi** di baris berita tersebut.
3. Halaman **edit berita** akan terbuka dengan data berita yang sudah terisi.
4. Lakukan perubahan yang diperlukan.
5. Klik tombol **Save Article** untuk menyimpan.

[Masukkan Screenshot: Halaman edit berita dengan konten yang sudah terisi dan bisa diedit]

### 6.5. Menghapus Berita

1. Pada halaman **News Center**, temukan berita yang ingin dihapus.
2. Klik ikon **tempat sampah** pada kolom **Aksi** di baris berita tersebut.
3. Akan muncul dialog konfirmasi: *"Apakah Anda yakin ingin menghapus berita ini?"*
4. Klik **OK** untuk mengonfirmasi penghapusan, atau **Cancel** untuk membatalkan.

> **Peringatan:** Penghapusan berita bersifat permanen dan tidak dapat dikembalikan. Pastikan Anda benar-benar ingin menghapus berita tersebut.

---

## 7. Mengelola Galeri Foto (Gallery)

Modul ini memungkinkan Anda mengunggah, mengedit, dan mengelola koleksi foto yang tampil di halaman galeri website.

### 7.1. Mengakses Halaman Gallery

1. Klik menu **Gallery** pada sidebar.
2. Halaman **"Galleries"** akan muncul dengan tabel daftar foto.

[Masukkan Screenshot: Halaman Galleries dengan tabel daftar foto menampilkan kolom Image, Title, Category, Featured, dan Status]

### 7.2. Mencari & Memfilter Galeri

Di bagian atas halaman terdapat area pencarian dan filter:

1. Masukkan kata kunci pada kolom **Cari judul galeri...** untuk mencari berdasarkan judul.
2. Masukkan kata kunci pada kolom **Cari kategori...** untuk memfilter berdasarkan kategori.
3. Klik tombol **Cari** untuk menerapkan pencarian.
4. Klik tombol **Reset** (muncul setelah ada filter aktif) untuk menghapus semua filter.

### 7.3. Mengunggah Foto Galeri Baru

1. Klik tombol **+ Upload Images** di pojok kanan atas.
2. Halaman unggah galeri akan terbuka.
3. Isi informasi yang diperlukan:
   - **Title** — Judul/nama untuk foto galeri.
   - **Category** — Kategori foto (contoh: *Proyek*, *Kegiatan*, *Infrastruktur*).
   - **Image** — Klik area unggah dan pilih file gambar dari komputer Anda.
4. Klik tombol **Simpan** untuk mengunggah.

### 7.4. Mengatur Status Galeri (Published/Draft)

Pada tabel daftar galeri, kolom **Status** menampilkan status saat ini:

- Klik langsung pada badge status (misalnya: "Published" atau "Draft") untuk mengubah status secara instan tanpa harus membuka halaman edit.
  - **Published** (hijau) → Foto tampil di website publik.
  - **Draft** (abu-abu) → Foto disembunyikan dari website publik.

### 7.5. Menandai Foto sebagai Unggulan (Featured)

- Klik ikon bintang pada kolom **Featured** untuk menandai atau membatalkan tanda unggulan.
  - Bintang berwarna kuning/emas = Foto ditandai sebagai unggulan.
  - Bintang berwarna abu-abu = Foto tidak ditandai sebagai unggulan.

> **Tips:** Foto yang ditandai sebagai **Featured** biasanya akan ditampilkan secara prioritas di halaman beranda atau bagian sorotan galeri di website.

### 7.6. Mengedit & Menghapus Galeri

- **Mengedit:** Klik ikon **pensil** pada kolom aksi → ubah data → klik **Simpan**.
- **Menghapus:** Klik ikon **tempat sampah** pada kolom aksi → konfirmasi penghapusan.

---

## 8. Mengelola Layanan (Services)

Modul ini digunakan untuk mengelola daftar jasa/layanan yang ditawarkan perusahaan dan ditampilkan di halaman **Services** pada website.

### 8.1. Mengakses Halaman Layanan

1. Klik menu **Layanan** pada sidebar.
2. Halaman **"Kelola Layanan"** akan muncul.

[Masukkan Screenshot: Halaman Kelola Layanan dengan tabel daftar layanan menampilkan kolom Ikon, Judul, Deskripsi, Status, dan Aksi]

### 8.2. Mencari & Memfilter Layanan

1. Masukkan kata kunci pada kolom **Cari nama layanan atau deskripsi...** untuk mencari layanan.
2. Gunakan dropdown **Semua Status** untuk memfilter berdasarkan status:
   - **Semua Status** — Menampilkan semua layanan.
   - **Diterbitkan (Published)** — Hanya layanan yang sudah dipublikasikan.
   - **Draft** — Hanya layanan yang masih dalam draf.
3. Klik tombol **Cari** untuk menerapkan pencarian.

### 8.3. Menambahkan Layanan Baru

1. Klik tombol **+ Tambah Layanan** di pojok kanan atas.
2. Isi formulir yang muncul:

| Field | Keterangan |
|-------|-----------|
| **Judul Layanan** | Nama layanan dalam Bahasa Indonesia |
| **Judul (EN)** | Nama layanan dalam Bahasa Inggris |
| **Deskripsi Singkat** | Penjelasan ringkas tentang layanan |
| **Ikon** | Nama ikon yang akan ditampilkan (menggunakan pustaka ikon Lucide) |
| **Status** | Pilih **Published** atau **Draft** |

3. Klik tombol **Simpan** untuk menyimpan layanan baru.

> **Tips:** Untuk referensi nama ikon, kunjungi lucide.dev/icons — cukup masukkan nama ikon tanpa prefix `lucide-` (contoh: ketik `truck` untuk ikon truk).

### 8.4. Mengedit & Menghapus Layanan

- **Mengedit:** Klik ikon **pensil** → ubah data yang diperlukan → klik **Simpan**.
- **Menghapus:** Klik ikon **tempat sampah** → konfirmasi: *"Apakah Anda yakin ingin menghapus layanan ini?"* → klik **OK**.

---

## 9. Mengelola Struktur Tim (Team Members)

Modul ini digunakan untuk mengelola profil anggota tim atau struktur organisasi perusahaan yang tampil di halaman **About** atau **Team** pada website.

### 9.1. Mengakses Halaman Struktur Tim

1. Klik menu **Struktur Tim** pada sidebar.
2. Halaman daftar anggota tim akan muncul.

[Masukkan Screenshot: Halaman daftar anggota tim dengan tabel berisi nama, jabatan, dan foto anggota tim]

### 9.2. Menambahkan Anggota Tim Baru

1. Klik tombol **+ Tambah Anggota Tim** di pojok kanan atas.
2. Isi formulir yang tersedia:

| Field | Keterangan |
|-------|-----------|
| **Nama** | Nama lengkap anggota tim |
| **Jabatan** | Posisi/jabatan di perusahaan |
| **Jabatan (EN)** | Posisi/jabatan dalam Bahasa Inggris |
| **Deskripsi** | Biografi atau deskripsi singkat |
| **Foto** | Unggah foto profil anggota tim |
| **Urutan** | Angka urutan tampil di website (angka kecil tampil lebih dulu) |
| **Status** | Pilih **Published** atau **Draft** |

3. Klik tombol **Simpan** untuk menyimpan data anggota tim baru.

### 9.3. Mengedit & Menghapus Anggota Tim

- **Mengedit:** Klik ikon **pensil** pada kolom aksi → ubah data → klik **Simpan**.
- **Menghapus:** Klik ikon **tempat sampah** pada kolom aksi → konfirmasi penghapusan → klik **OK**.

---

## 10. Mengelola Daftar Klien & Mitra (Clients)

Modul ini memungkinkan Anda menambahkan, mengedit, dan mengelola daftar nama klien atau mitra kerja yang ditampilkan di halaman depan website.

### 10.1. Mengakses Halaman Daftar Klien

1. Klik menu **Daftar Klien** pada sidebar.
2. Halaman **"Kelola Klien & Mitra"** akan muncul.

[Masukkan Screenshot: Halaman Kelola Klien & Mitra dengan tabel daftar klien berisi kolom Nama, Status, dan Aksi]

### 10.2. Mencari & Memfilter Klien

1. Masukkan nama klien pada kolom **Cari nama klien...** untuk pencarian.
2. Gunakan dropdown **Semua Status** untuk memfilter:
   - **Diterbitkan (Published)** — Klien yang tampil di website.
   - **Draft** — Klien yang disembunyikan dari website.
3. Klik tombol **Cari** untuk menerapkan.

### 10.3. Menambahkan Klien Baru

1. Klik tombol **+ Tambah Klien** di pojok kanan atas.
2. Isi formulir:

| Field | Keterangan |
|-------|-----------|
| **Nama Klien / Perusahaan** | Nama resmi klien atau perusahaan mitra |
| **Status** | Pilih **Published** (langsung tampil) atau **Draft** (simpan dulu) |

3. Klik tombol **Simpan** untuk menyimpan data klien baru.

### 10.4. Mengedit & Menghapus Klien

- **Mengedit:** Klik ikon **pensil** → ubah data → klik **Simpan**.
- **Menghapus:** Klik ikon **tempat sampah** → konfirmasi: *"Apakah Anda yakin ingin menghapus klien ini?"* → klik **OK**.

---

## 11. Mengelola Anak Perusahaan (Subsidiaries)

Modul ini digunakan untuk mengelola informasi anak perusahaan atau unit bisnis yang tergabung dalam grup perusahaan. Setiap anak perusahaan memiliki halaman profilnya sendiri di website.

### 11.1. Mengakses Halaman Subsidiaries

1. Klik menu **Website Content** pada sidebar.
2. Klik tab **Subsidiaries**.
3. Klik tombol **Manage Subsidiaries** untuk membuka halaman pengelolaan.

*Alternatif:* Anda juga bisa langsung mengakses via URL `/admin/subsidiaries`.

[Masukkan Screenshot: Halaman daftar anak perusahaan dengan tabel berisi nama, slug, dan status]

### 11.2. Menambahkan Anak Perusahaan Baru

1. Klik tombol **+ Tambah Anak Perusahaan** di pojok kanan atas.
2. Isi formulir yang tersedia dengan informasi anak perusahaan.
3. Klik tombol **Simpan** untuk menyimpan.

### 11.3. Mengedit & Menghapus Anak Perusahaan

- **Mengedit:** Klik ikon **pensil** → ubah data yang diperlukan → klik **Simpan**.
- **Menghapus:** Klik ikon **tempat sampah** → konfirmasi penghapusan.

> **Tips:** Setelah menambahkan anak perusahaan baru, jangan lupa untuk mengatur logo dan favicon-nya melalui modul **Favicon & Icons** (lihat [Bab 4](#4-mengelola-pengaturan-umum-company-assets)).

---

## 12. Mengelola Rekening Bank (Bank Accounts)

Modul ini digunakan untuk mengelola informasi rekening bank perusahaan yang dapat ditampilkan di website untuk keperluan transaksi.

### 12.1. Mengakses Halaman Rekening Bank

1. Klik menu **Rekening Bank** pada sidebar.
2. Halaman daftar rekening bank akan muncul.

[Masukkan Screenshot: Halaman daftar rekening bank dengan tabel berisi nama bank, nomor rekening, dan pemegang rekening]

### 12.2. Menambahkan Rekening Bank Baru

1. Klik tombol **+ Tambah Rekening** di pojok kanan atas.
2. Isi formulir yang tersedia:

| Field | Keterangan |
|-------|-----------|
| **Nama Bank** | Nama institusi bank (contoh: *Bank Mandiri*, *BCA*, *BNI*) |
| **Nomor Rekening** | Nomor rekening bank |
| **Atas Nama** | Nama pemegang rekening |

3. Klik tombol **Simpan** untuk menyimpan.

### 12.3. Mengedit & Menghapus Rekening Bank

- **Mengedit:** Klik ikon **pensil** → ubah data → klik **Simpan**.
- **Menghapus:** Klik ikon **tempat sampah** → konfirmasi penghapusan.

---

## 13. Mengecek Pesan Masuk (Inbox)

Modul ini menampilkan semua pesan yang dikirimkan oleh pengunjung website melalui form kontak di halaman Contact.

### 13.1. Mengakses Inbox

1. Klik menu **Inbox** pada sidebar.
2. Halaman **"Inbox"** akan muncul dengan tabel daftar pesan masuk.

[Masukkan Screenshot: Halaman Inbox dengan tabel daftar pesan menampilkan kolom ID, Name, Message, dan Created At]

### 13.2. Membaca Detail Pesan

Pada tabel daftar pesan, setiap baris menampilkan:

| Kolom | Keterangan |
|-------|-----------|
| **ID** | Nomor urut pesan |
| **Name** | Nama pengirim beserta alamat email di bawahnya |
| **Message** | Potongan isi pesan (50 karakter pertama) |
| **Created At** | Tanggal pesan dikirim |

**Untuk membaca pesan secara lengkap:**

1. Klik ikon **mata** pada kolom aksi di baris pesan yang ingin dibaca.
2. Halaman **"View Message"** akan terbuka, menampilkan:
   - Nama perusahaan pengirim (jika diisi).
   - Nama pengirim dan alamat email.
   - Tanggal dan waktu pengiriman pesan.
   - Isi pesan lengkap dalam kotak teks.
3. Klik tombol **Back to Inbox** untuk kembali ke daftar pesan.

[Masukkan Screenshot: Halaman View Message menampilkan detail pesan lengkap dari pengunjung]

### 13.3. Menghapus Pesan

1. Pada halaman **Inbox**, klik ikon **tempat sampah** pada baris pesan yang ingin dihapus.
2. Pesan akan langsung dihapus dari sistem.

> **Tips:** Pesan yang belum dibaca ditandai dengan latar belakang biru muda pada panel **Recent Inbox** di halaman Dashboard. Cek dashboard secara rutin agar tidak melewatkan pesan penting!

---

## 14. Keluar dari Sistem (Logout)

Untuk menjaga keamanan akun Anda, selalu lakukan prosedur logout yang benar setelah selesai menggunakan CMS.

### 14.1. Cara Logout

1. Klik nama/foto profil Anda di pojok kanan atas halaman (pada Top Bar).
2. Menu dropdown akan muncul.
3. Klik tombol **Log Out** (berwarna merah) di bagian bawah menu.
4. Anda akan diarahkan kembali ke halaman **Login**.

[Masukkan Screenshot: Menu dropdown profil terbuka dengan opsi Log Out ditandai/disorot]

> **Penting:**
> - **Selalu logout** setelah selesai menggunakan CMS, terutama jika menggunakan perangkat bersama atau publik.
> - Jangan hanya menutup tab browser — hal ini tidak menjamin sesi Anda benar-benar berakhir.
> - Jika Anda merasa akun Anda telah diakses oleh pihak tidak berwenang, segera ubah password melalui menu **Profile Settings**.

---

## 15. FAQ & Pemecahan Masalah

### Saya tidak bisa login. Apa yang harus dilakukan?

- Pastikan alamat email dan password yang Anda masukkan sudah benar (perhatikan huruf besar/kecil).
- Coba klik **Forgot password?** untuk mereset password.
- Jika masih tidak bisa, hubungi Administrator utama (Super Admin) untuk memeriksa status akun Anda.

### Gambar yang saya unggah tidak muncul di website?

- Pastikan ukuran file tidak melebihi **2 MB**.
- Gunakan format gambar yang didukung: **JPEG**, **PNG**, **SVG**, atau **WebP**.
- Pastikan status item (berita, galeri, dll.) sudah diatur ke **Published**, bukan **Draft**.

### Perubahan yang saya simpan tidak terlihat di website?

- Coba refresh/muat ulang halaman website (tekan `Ctrl + F5` atau `Cmd + Shift + R`).
- Perubahan mungkin memerlukan waktu beberapa saat untuk tersinkronisasi karena cache browser.
- Pastikan Anda sudah menekan tombol **Simpan** / **Save** setelah melakukan perubahan.

### Saya ingin mengubah password saya. Bagaimana caranya?

1. Klik nama profil Anda di pojok kanan atas.
2. Klik **Profile Settings**.
3. Masukkan password lama dan password baru Anda.
4. Klik tombol **Simpan**.

### Tombol/menu tertentu tidak muncul di sidebar saya?

- Beberapa fitur seperti **User Management** hanya tersedia untuk akun dengan peran **Super Admin**.
- Jika Anda merasa seharusnya memiliki akses, hubungi Super Admin untuk mengubah peran akun Anda.

---

> **Butuh Bantuan Lebih Lanjut?**
>
> Jika Anda menemui kendala atau memiliki pertanyaan yang tidak tercakup dalam panduan ini, silakan hubungi tim teknis kami melalui:
> - **Email:** admin@bkjgroup.com
> - **Telepon:** Hubungi nomor kontak yang tersedia di halaman Contact website.

---

*Dokumen ini disusun untuk keperluan internal PT. Batam Kepri Jaya Group dan tidak untuk didistribusikan ke pihak luar tanpa izin.*

**© 2026 BKJ Group. Seluruh hak cipta dilindungi.**
