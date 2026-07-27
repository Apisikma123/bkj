<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




Route::get('/', [\App\Http\Controllers\PageController::class, 'home'])->name('home');
Route::get('/about', [\App\Http\Controllers\PageController::class, 'about'])->name('about');
Route::get('/services', [\App\Http\Controllers\PageController::class, 'services'])->name('services');
Route::get('/gallery', [\App\Http\Controllers\PageController::class, 'gallery'])->name('gallery');
Route::get('/blog', [\App\Http\Controllers\PageController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [\App\Http\Controllers\PageController::class, 'showBlog'])->name('blog.show');
Route::get('/clients', [\App\Http\Controllers\PageController::class, 'clients'])->name('clients');
Route::get('/contact', [\App\Http\Controllers\PageController::class, 'contact'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\PageController::class, 'submitContact'])->middleware('throttle:3,15')->name('contact.submit');

// Subsidiary route
Route::get('/subsidiaries/{slug}', [\App\Http\Controllers\PageController::class, 'showSubsidiary'])->name('subsidiaries.show');

// New static routes
Route::get('/privacy-policy', [\App\Http\Controllers\PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-service', [\App\Http\Controllers\PageController::class, 'terms'])->name('terms');
Route::get('/sitemap', [\App\Http\Controllers\PageController::class, 'sitemap'])->name('sitemap');
Route::get('/search', [\App\Http\Controllers\PageController::class, 'search'])->name('search');

// Localization Route
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

// Temporary route to create admin user on server
Route::get('/create-admin', function () {
    try {
        $role = \App\Models\Role::firstOrCreate(
            ['slug' => 'super-admin'],
            ['name' => 'Super Admin']
        );
        
        $user1 = \App\Models\User::updateOrCreate(
            ['email' => 'admin@bkjgroup.com'],
            [
                'name' => 'Administrator',
                'password' => \Illuminate\Support\Facades\Hash::make('password123'),
                'role_id' => $role->id,
                'email_verified_at' => now(),
            ]
        );

        $user2 = \App\Models\User::updateOrCreate(
            ['email' => 'agaputra62@gmail.com'],
            [
                'name' => 'Aga Putra',
                'password' => \Illuminate\Support\Facades\Hash::make('agaputra123'),
                'role_id' => $role->id,
                'email_verified_at' => now(),
            ]
        );
        
        return "Admin users created/updated successfully!<br><br>" .
               "Email: <b>admin@bkjgroup.com</b> | Password: <b>password123</b><br>" .
               "Email: <b>agaputra62@gmail.com</b> | Password: <b>agaputra123</b>";
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Admin Routes — requires authenticated + verified + admin role
Route::prefix('admin')->middleware(['auth', 'verified', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Website Content Module
    Route::get('/content', [\App\Http\Controllers\Admin\WebsiteContentController::class, 'index'])->name('content.index');
    Route::post('/content/home', [\App\Http\Controllers\Admin\WebsiteContentController::class, 'updateHome'])->name('content.updateHome');
    Route::post('/content/about', [\App\Http\Controllers\Admin\WebsiteContentController::class, 'updateAbout'])->name('content.updateAbout');
    Route::post('/content/gallery', [\App\Http\Controllers\Admin\WebsiteContentController::class, 'updateGallery'])->name('content.updateGallery');
    Route::post('/content/contact', [\App\Http\Controllers\Admin\WebsiteContentController::class, 'updateContact'])->name('content.updateContact');
    Route::post('/content/offices', [\App\Http\Controllers\Admin\WebsiteContentController::class, 'updateOffices'])->name('content.updateOffices');
    Route::post('/content/footer', [\App\Http\Controllers\Admin\WebsiteContentController::class, 'updateFooter'])->name('content.updateFooter');

    // Company Assets (Icon & Favicon)
    Route::get('/company-assets', [\App\Http\Controllers\Admin\CompanyAssetController::class, 'index'])->name('company-assets.index');
    Route::post('/company-assets/global', [\App\Http\Controllers\Admin\CompanyAssetController::class, 'updateGlobal'])->name('company-assets.update-global');
    Route::post('/company-assets/{subsidiary}', [\App\Http\Controllers\Admin\CompanyAssetController::class, 'update'])->name('company-assets.update');

    // News Center
    Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class);
    


    // Subsidiaries
    Route::resource('subsidiaries', \App\Http\Controllers\Admin\SubsidiaryController::class);

    // Galleries
    Route::patch('galleries/{gallery}/toggle-status', [\App\Http\Controllers\Admin\GalleryController::class, 'toggleStatus'])->name('galleries.toggle-status');
    Route::patch('galleries/{gallery}/toggle-featured', [\App\Http\Controllers\Admin\GalleryController::class, 'toggleFeatured'])->name('galleries.toggle-featured');
    Route::resource('galleries', \App\Http\Controllers\Admin\GalleryController::class);

    // Contacts
    Route::resource('contacts', \App\Http\Controllers\Admin\ContactController::class);

    // Bank Accounts
    // Route::resource('bank-accounts', \App\Http\Controllers\Admin\BankAccountController::class);

    // Services, Team Members, Clients
    Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
    // Route::resource('team-members', \App\Http\Controllers\Admin\TeamMemberController::class);
    Route::resource('clients', \App\Http\Controllers\Admin\ClientController::class);

    // Users — Super Admin only
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->middleware('admin:super-admin');
});

// Dynamic Favicon Route (Fallback when public/favicon.ico does not exist on disk)
Route::get('/favicon.ico', function () {
    // Attempt to load the global favicon setting
    $globalFaviconSetting = \App\Models\Setting::where('key', 'global_favicon')->first();
    
    if ($globalFaviconSetting && $globalFaviconSetting->value) {
        $disk = \Illuminate\Support\Facades\Storage::disk('public');
        if ($disk->exists($globalFaviconSetting->value)) {
            $path = $disk->path($globalFaviconSetting->value);
            $mimeType = mime_content_type($path) ?: 'image/x-icon';
            return response()->file($path, [
                'Content-Type' => $mimeType,
                'Cache-Control' => 'public, max-age=86400',
            ]);
        }
    }
    
    // Default fallback to first active subsidiary favicon
    $defaultSub = \App\Models\Subsidiary::where('slug', 'pt-bintang-kepri-jaya')->first() ?? \App\Models\Subsidiary::first();
    if ($defaultSub && $defaultSub->favicon_path) {
        $disk = \Illuminate\Support\Facades\Storage::disk('public');
        if ($disk->exists($defaultSub->favicon_path)) {
            $path = $disk->path($defaultSub->favicon_path);
            $mimeType = mime_content_type($path) ?: 'image/x-icon';
            return response()->file($path, [
                'Content-Type' => $mimeType,
                'Cache-Control' => 'public, max-age=86400',
            ]);
        }
    }
    
    // If absolutely nothing is found, return 404
    return response('', 404);
});

// Temporary route to auto-setup subsidiary content
Route::get('/setup-subsidiaries', function () {
    try {
        $subsidiary1 = \App\Models\Subsidiary::updateOrCreate(
            ['slug' => 'pt-bintang-kepri-jaya'],
            [
                'name' => 'PT Bintang Kepri Jaya',
                'description' => 'Perusahaan spesialis layanan bongkar muat (stevedoring) terkemuka dengan reputasi keandalan tinggi. Kami mengutamakan standar zero-delay policy dan keamanan maksimal untuk kelancaran arus barang di area pabean dan pelabuhan.',
                'content' => '<h2>Solusi Penanganan Kargo Terpadu dan Presisi</h2><p>PT Bintang Kepri Jaya adalah ujung tombak layanan bongkar muat kargo (Stevedoring & Cargodoring) di kawasan Kepulauan Riau. Kami berdedikasi untuk memberikan solusi penanganan barang yang efisien, aman, dan berstandar internasional demi memastikan rantai pasok maritim klien tidak pernah terputus.</p><h3>Layanan Utama Kami:</h3><ul><li><strong>Stevedoring:</strong> Proses bongkar dan muat barang dari/ke kapal menggunakan infrastruktur modern dan operator berpengalaman, menjamin proses sandar kapal yang efisien.</li><li><strong>Cargodoring:</strong> Pengelolaan, penataan, dan pemindahan kargo secara sistematis dari dermaga ke fasilitas penumpukan (gudang/lapangan) dengan sistem proteksi barang tingkat tinggi.</li><li><strong>Receiving &amp; Delivery:</strong> Penyerahan kargo secara mulus (seamless) kepada pemilik barang dengan proses administrasi pelabuhan yang sangat cepat dan tertib.</li></ul><h3>Keunggulan Operasional Kami:</h3><ul><li><strong>Zero-Delay Policy:</strong> Optimalisasi waktu sandar dan bongkar kapal secara maksimal untuk menghindari denda (demurrage) dan memangkas anggaran logistik Anda.</li><li><strong>Kepatuhan Regulasi &amp; K3:</strong> Setiap pergerakan alat diawasi secara ketat di bawah standar Keselamatan dan Kesehatan Kerja (K3) serta diawasi oleh otoritas kepelabuhanan resmi.</li><li><strong>Penanganan Segala Jenis Kargo:</strong> Berpengalaman menangani berbagai spesifikasi barang—mulai dari kargo umum, curah kering, hingga alat berat dan konstruksi.</li></ul>',
            ]
        );

        $subsidiary2 = \App\Models\Subsidiary::updateOrCreate(
            ['slug' => 'pt-batam-kepri-jaya'],
            [
                'name' => 'PT Batam Kepri Jaya',
                'description' => 'Mitra andalan Anda untuk Jasa Pengurusan Transportasi (JPT) dan Forwarding. Kami menghadirkan solusi logistik terintegrasi (darat & laut) yang cepat, legal, dan dirancang khusus untuk mengoptimalkan nilai bisnis Anda.',
                'content' => '<h2>Navigasi Logistik Tanpa Batas untuk Distribusi Kargo Anda</h2><p>PT Batam Kepri Jaya hadir sebagai solusi komprehensif bagi perusahaan yang membutuhkan Jasa Pengurusan Transportasi (JPT) yang cerdas dan strategis. Di tengah kompleksitas regulasi dan tantangan geografis Nusantara, kami hadir untuk menjembatani distribusi kargo Anda secara end-to-end—dari titik keberangkatan pertama hingga sampai ke tujuan akhir.</p><h3>Layanan Utama Kami:</h3><ul><li><strong>Distribusi Darat &amp; Laut (Land &amp; Sea Freight):</strong> Kombinasi jalur distribusi multimoda untuk menjangkau seluruh pelosok negeri secara tepat waktu dan efisien.</li><li><strong>Customs Clearance &amp; Perizinan:</strong> Penanganan administrasi pabean dan perizinan kargo yang teliti, cepat, dan sepenuhnya mematuhi regulasi hukum kepabeanan.</li><li><strong>Manajemen Distribusi:</strong> Pengaturan jadwal distribusi kargo yang sangat terukur dan disesuaikan dengan siklus kebutuhan operasional supply chain Anda.</li></ul><h3>Keunggulan Operasional Kami:</h3><ul><li><strong>Visibilitas &amp; Transparansi:</strong> Komunikasi yang proaktif dan terpusat sehingga klien selalu mengetahui dan memiliki kendali atas status pergerakan barang.</li><li><strong>Rute yang Efisien Biaya (Cost-Effective):</strong> Penentuan rute logistik dan pemilihan armada yang strategis demi meminimalisir pembengkakan biaya transportasi klien.</li><li><strong>Jaringan Kemitraan Ekstensif:</strong> Kolaborasi solid dengan armada transportasi darat dan operator pelayaran terkemuka memastikan kargo Anda selalu mendapat jalur prioritas.</li></ul>',
            ]
        );

        $subsidiary3 = \App\Models\Subsidiary::updateOrCreate(
            ['slug' => 'koperasi-jasa-tbkm-bintang-kepri-jaya'],
            [
                'name' => 'Koperasi Jasa TBKM Bintang Kepri Jaya',
                'description' => 'Pusat penyediaan Tenaga Kerja Bongkar Muat (TKBM) profesional dan bersertifikasi resmi. Kami memberdayakan SDM lokal berstandar tinggi untuk menjamin keamanan dan produktivitas pelabuhan.',
                'content' => '<h2>Sinergi Tenaga Ahli untuk Produktivitas Pelabuhan yang Maksimal</h2><p>Koperasi Jasa TBKM Bintang Kepri Jaya merupakan pilar utama perusahaan dalam pemenuhan kebutuhan Sumber Daya Manusia (SDM) yang andal dan siap pakai di area pelabuhan. Kami tidak sekadar menyalurkan tenaga kerja, melainkan membangun ekosistem profesional yang meletakkan kedisiplinan dan keselamatan kerja pada prioritas tertinggi.</p><h3>Layanan Utama Kami:</h3><ul><li><strong>Penyediaan Tenaga Bongkar Muat (TKBM):</strong> Alokasi tenaga kerja operasional harian atau shift yang siap menangani pemindahan kargo fisik dengan cekatan, kuat, dan terlatih.</li><li><strong>Penyediaan Operator Lisensi Khusus:</strong> Menyuplai operator bersertifikasi resmi (SIO) yang handal dalam mengoperasikan alat berat seperti crane, forklift, maupun instrumen pelabuhan krusial lainnya.</li><li><strong>Supervisi Lapangan &amp; Tally:</strong> Pengawas operasi lapangan (foreman/checker) yang cermat memastikan seluruh pencatatan barang dan aktivitas berjalan sesuai SOP dan target waktu.</li></ul><h3>Keunggulan Operasional Kami:</h3><ul><li><strong>Budaya Keselamatan Kerja (K3):</strong> Mewajibkan penggunaan Alat Pelindung Diri (APD) lengkap dan mematuhi regulasi pelabuhan untuk mencapai target zero-accident.</li><li><strong>Pemberdayaan Profesional:</strong> Mengedepankan model koperasi yang mengangkat ekonomi lokal sembari terus memberikan pelatihan operasional kelautan secara berkesinambungan.</li><li><strong>Skalabilitas &amp; Respons Cepat:</strong> Memiliki kapasitas memobilisasi tenaga kerja dalam jumlah massal dengan waktu yang sangat singkat untuk merespons lonjakan kapal di pelabuhan.</li></ul>',
            ]
        );

        // Update English translations automatically
        $translator = app(\App\Services\TranslationService::class);
        foreach ([$subsidiary1, $subsidiary2, $subsidiary3] as $sub) {
            if (empty($sub->name_en)) $sub->name_en = $sub->name;
            $sub->description_en = $translator->translateToEnglish($sub->description);
            $sub->content_en = $translator->translateToEnglish($sub->content);
            $sub->save();
        }

        return "Data 3 Anak Perusahaan berhasil di-setup dan diperbarui secara otomatis menggunakan teks profesional!";
    } catch (\Exception $e) {
        return "Terjadi kesalahan: " . $e->getMessage();
    }
});



