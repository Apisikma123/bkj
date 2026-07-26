<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Client;
use App\Models\Subsidiary;
use App\Models\BankAccount;
use App\Models\CompanyProfile;
use App\Models\Setting;
use Illuminate\Support\Str;

class CmsDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Company Profile
        $profileData = [
            [
                'key' => 'name',
                'value' => 'PT Bintang Kepri Jaya',
                'value_en' => 'PT Bintang Kepri Jaya'
            ],
            [
                'key' => 'description',
                'value' => 'PT Bintang Kepri Jaya bermula dari komitmen untuk meningkatkan kualitas rantai pasok maritim di Kepulauan Riau. Kami telah berkembang dari keagenan kapal kecil menjadi penyedia logistik terintegrasi berstandar nasional.',
                'value_en' => 'PT Bintang Kepri Jaya began with a commitment to improve maritime supply chain quality in the Riau Islands. We have grown from a small shipping agency to a national-standard integrated logistics provider.'
            ],
            [
                'key' => 'vision',
                'value' => 'MENJADI PENYEDIA SOLUSI JASA BONGKAR MUAT TERBAIK SEBAGAI MITRA BONGKAR MUAT TERPERCAYA, DAN TERBAIK DI INDONESIA.',
                'value_en' => 'TO BE THE BEST CARGO HANDLING SOLUTION PROVIDER AS A TRUSTED AND LEADING STEVEDORING PARTNER IN INDONESIA.'
            ],
            [
                'key' => 'mission',
                'value' => "<ul>
<li>MENYEDIAKAN DAN MENGOPERASIKAN FASILITAS TERMINAL PELABUHAN DAN PERALATAN TEPAT GUNA</li>
<li>MEYEDIAKAN SDM YANG PROFESIONAL DI BIDANG BONGKAR MUAT</li>
<li>TURUT MENGEMBANGKAN PEREKONOMIAN NEGARA DAN MEMUPUK KEUNTUNGAN</li>
<li>MEMBERIKAN KONTRIBUSI POSITIF DEMI MENDUKUNG KEMAJUAN DAN STABILITAS PENGGUNA JASA.</li>
<li>SEBAGAI SARANA PENGEMBANGAN KUALITAS SUMBER DAYA MANUSIA YANG KOMPETEN PADA BIDANGNYA DALAM MEMBERIKAN KUALITAS PELAYANAN YANG PRIMA.</li>
<li>MENCIPTAKAN IINGKUNGAN KERJA YANG NYAMAN DAN TENTRAM PADA SELURUH LEVEL MANAJEMEN</li>
<li>MENJADI PEMBAWA SOLUSI DALAM SETIAP PERMASALAHAN TENAGA KERJA DAN PERMASALAHAN STABILITAS PERUSAHAAN BAIK BERSIFAT INTERNAL MAUPUN EKTERNAL</li>
<li>MEMBANGUN KERJASAMA YANG BAIK DENGAN KLIEN, PEMERINTAHAN SERTA UNSUR-UNSUR MASYARAKAT TERKAIT DEMI MENJAGA KEHARMONISAN BERMASYARAKAT.</li>
</ul>",
                'value_en' => "<ul>
<li>Provide and operate terminal port facilities and appropriate equipment.</li>
<li>Provide professional human resources in cargo handling.</li>
<li>Contribute to the development of the national economy and foster profitability.</li>
<li>Give positive contributions to support the progress and stability of service users.</li>
<li>Serve as a medium to develop competent human resource quality in their fields to deliver excellent service quality.</li>
<li>Create a comfortable and peaceful working environment across all management levels.</li>
<li>Be the solution provider for labor issues and company stability challenges, both internally and externally.</li>
<li>Build strong cooperation with clients, government, and related community elements to maintain social harmony.</li>
</ul>"
            ],
            [
                'key' => 'motto',
                'value' => 'CEPAT, TEPAT, TANGGAP, TUNTAS DAN BERTANGGUNG JAWAB',
                'value_en' => 'FAST, PRECISE, RESPONSIVE, COMPLETE, AND ACCOUNTABLE'
            ],
        ];

        foreach ($profileData as $p) {
            CompanyProfile::updateOrCreate(['key' => $p['key']], ['value' => $p['value']]);
            if (isset($p['value_en'])) {
                CompanyProfile::updateOrCreate(['key' => $p['key'] . '_en'], ['value' => $p['value_en']]);
            }
        }

        // 2. Seed Settings
        $settingsData = [
            ['key' => 'contact_email', 'value' => 'batamkeprijaya23@gmail.com', 'value_en' => 'batamkeprijaya23@gmail.com'],
            ['key' => 'contact_phone1', 'value' => '+6285264396766', 'value_en' => '+6285264396766'],
            ['key' => 'contact_phone2', 'value' => '+6281275885695', 'value_en' => '+6281275885695'],
            ['key' => 'contact_address', 'value' => 'Ruko Mega Legenda 2 Blok B2 No. 03 Batam Center, Kota Batam', 'value_en' => 'Ruko Mega Legenda 2 Blok B2 No. 03 Batam Center, Batam City'],
            ['key' => 'team_members', 'value' => "Sudirman Sikumbang - Komisaris\nSyafrudin - Direktur\nMaharani, S.I.Kom. - Manager\nNandi Pinto - Operasional\nAhmad Syahbudin - Operasional\nFandi Al Qomar A Karim - Operasional\nAgustinus Nong Frenky - Operasional", 'value_en' => "Sudirman Sikumbang - Commissioner\nSyafrudin - Director\nMaharani, S.I.Kom. - Manager\nNandi Pinto - Operational\nAhmad Syahbudin - Operational\nFandi Al Qomar A Karim - Operational\nAgustinus Nong Frenky - Operational"],
            ['key' => 'company_legality', 'value' => "Surat Izin Usaha Perusahaan Jasa Pengurusan Transportasi (SIUP-JPT)\nNomor Induk Berusaha (NIB)\nKeputusan Menteri Hukum dan HAM RI\nSurat Keterangan Terdaftar (SKT) Pajak", 'value_en' => "Transportation Management Services Business License (SIUP-JPT)\nBusiness Identification Number (NIB)\nDecree of the Minister of Law and Human Rights of the Republic of Indonesia\nTax Registration Certificate (SKT)"],
        ];

        foreach ($settingsData as $s) {
            Setting::updateOrCreate(['key' => $s['key']], ['value' => $s['value']]);
            if (isset($s['value_en'])) {
                Setting::updateOrCreate(['key' => $s['key'] . '_en'], ['value' => $s['value_en']]);
            }
        }

        // 3. Seed Subsidiaries & Bank Accounts
        // 3. Seed Subsidiaries & Bank Accounts
        $subsidiaries = [
            [
                'name' => 'PT Bintang Kepri Jaya',
                'name_en' => 'PT Bintang Kepri Jaya',
                'description' => 'Perusahaan Jasa Bongkar Muat (PBM) & Pengelolaan Terminal Pelabuhan Terpercaya.',
                'description_en' => 'Trusted Cargo Stevedoring Service (PBM) & Port Terminal Management Company.',
                'content' => '<div class="space-y-8 font-sans">
    <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)] border-t-4 border-t-primary">
        <h3 class="text-headline-md text-on-surface mb-4">Profil Operasional</h3>
        <p class="text-body-lg text-on-surface-variant leading-relaxed mb-6">
            PT Bintang Kepri Jaya hadir sebagai penyedia layanan Jasa Bongkar Muat (PBM) terdepan, memberikan kepastian operasional di setiap lini maritim. Fokus kami mencakup tata kelola terminal pelabuhan, efisiensi penanganan kargo, hingga pengoperasian alat berat dengan standar keamanan dan akurasi tinggi. Kami memastikan setiap muatan ditangani secara presisi untuk mendukung kelancaran rantai pasok nasional.
        </p>
        <div class="inline-block px-4 py-2 bg-primary/5 border-l-4 border-primary text-primary font-semibold text-label-md tracking-wider">
            MOTTO: CEPAT, TEPAT, TANGGAP, TUNTAS DAN BERTANGGUNG JAWAB
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)]">
            <h4 class="text-headline-sm text-primary mb-4 font-semibold">Visi Perusahaan</h4>
            <p class="text-body-md text-on-surface-variant leading-relaxed">
                Menjadi penyedia solusi tata kelola pelabuhan dan jasa bongkar muat paling andal, memposisikan diri sebagai mitra strategis utama dalam ekosistem logistik maritim di Indonesia.
            </p>
        </div>
        <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)]">
            <h4 class="text-headline-sm text-primary mb-4 font-semibold">Misi Utama</h4>
            <ul class="list-none space-y-3 text-body-md text-on-surface-variant">
                <li class="flex items-start"><span class="text-primary mr-3 font-bold block">•</span> Mengoperasikan fasilitas terminal pelabuhan dan peralatan bongkar muat secara efisien dan tepat guna.</li>
                <li class="flex items-start"><span class="text-primary mr-3 font-bold block">•</span> Menerjunkan tenaga kerja profesional yang memiliki kompetensi teknis tinggi di bidang maritim.</li>
                <li class="flex items-start"><span class="text-primary mr-3 font-bold block">•</span> Memberikan kontribusi nyata dalam menjaga stabilitas dan kelancaran operasional pengguna jasa.</li>
            </ul>
        </div>
    </div>
</div>',
                'content_en' => '<div class="space-y-8 font-sans">
    <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)] border-t-4 border-t-primary">
        <h3 class="text-headline-md text-on-surface mb-4">Operational Profile</h3>
        <p class="text-body-lg text-on-surface-variant leading-relaxed mb-6">
            PT Bintang Kepri Jaya stands at the forefront of cargo stevedoring (PBM) services, delivering operational certainty across maritime sectors. Our expertise encompasses port terminal management, efficient cargo handling, and heavy equipment operation governed by strict safety and accuracy standards. We ensure precision in every shipment to support seamless national supply chains.
        </p>
        <div class="inline-block px-4 py-2 bg-primary/5 border-l-4 border-primary text-primary font-semibold text-label-md tracking-wider">
            MOTTO: FAST, ACCURATE, RESPONSIVE, THOROUGH AND RESPONSIBLE
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)]">
            <h4 class="text-headline-sm text-primary mb-4 font-semibold">Corporate Vision</h4>
            <p class="text-body-md text-on-surface-variant leading-relaxed">
                To be the most reliable provider of port management and stevedoring solutions, positioning ourselves as a key strategic partner within Indonesia\'s maritime logistics ecosystem.
            </p>
        </div>
        <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)]">
            <h4 class="text-headline-sm text-primary mb-4 font-semibold">Core Mission</h4>
            <ul class="list-none space-y-3 text-body-md text-on-surface-variant">
                <li class="flex items-start"><span class="text-primary mr-3 font-bold block">•</span> Operating port terminal facilities and stevedoring equipment with maximum efficiency.</li>
                <li class="flex items-start"><span class="text-primary mr-3 font-bold block">•</span> Deploying professional workforce equipped with high technical competence in the maritime sector.</li>
                <li class="flex items-start"><span class="text-primary mr-3 font-bold block">•</span> Delivering tangible contributions to maintain stability and operational fluidity for all service users.</li>
            </ul>
        </div>
    </div>
</div>',
                'url' => null,
                'banks' => []
            ],
            [
                'name' => 'PT Batam Kepri Jaya',
                'name_en' => 'PT Batam Kepri Jaya',
                'description' => 'Penyedia Jasa Pengurusan Transportasi (JPT), Freight Forwarding, & Logistik Terintegrasi.',
                'description_en' => 'Integrated Freight Forwarding, Transportation Management Services (JPT), & Logistics Provider.',
                'content' => '<div class="space-y-8 font-sans">
    <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)] border-t-4 border-t-primary">
        <h3 class="text-headline-md text-on-surface mb-4">Profil Operasional</h3>
        <p class="text-body-lg text-on-surface-variant leading-relaxed mb-4">
            Berperan sebagai penggerak utama dalam Jasa Pengurusan Transportasi (JPT) dan Freight Forwarding, PT Batam Kepri Jaya merancang dan mengeksekusi solusi logistik terintegrasi. Layanan kami didesain untuk memastikan barang didistribusikan dengan tingkat keamanan, kecepatan, dan efisiensi biaya yang optimal.
        </p>
        <p class="text-body-lg text-on-surface-variant leading-relaxed mb-6">
            Melalui jaringan rute darat, laut, maupun udara yang komprehensif, kami mengambil alih kompleksitas logistik—mulai dari penjemputan muatan hingga pengurusan regulasi dokumen—memastikan kelancaran rantai pasok pelanggan secara efektif dan profesional.
        </p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6 pt-6 border-t border-outline-variant/20">
            <div class="text-center"><p class="text-primary font-bold">Integritas</p></div>
            <div class="text-center"><p class="text-primary font-bold">Keselamatan & Keamanan</p></div>
            <div class="text-center"><p class="text-primary font-bold">Komitmen</p></div>
            <div class="text-center"><p class="text-primary font-bold">Pelayanan Prima</p></div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)]">
            <h4 class="text-headline-sm text-primary mb-3 font-semibold">Jasa Pengurusan Transportasi</h4>
            <p class="text-body-md text-on-surface-variant leading-relaxed">
                Pengelolaan dan koordinasi transportasi secara menyeluruh, mencakup perencanaan, pengaturan moda transportasi, hingga pengawasan agar barang tiba dengan aman dan tepat waktu.
            </p>
        </div>
        <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)]">
            <h4 class="text-headline-sm text-primary mb-3 font-semibold">Freight Forwarding & Logistik</h4>
            <p class="text-body-md text-on-surface-variant leading-relaxed">
                Solusi logistik terintegrasi untuk jalur darat, laut, dan udara. Meliputi pengelolaan dokumen pengangkutan dan monitoring untuk mendukung rantai pasok.
            </p>
        </div>
        <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)]">
            <h4 class="text-headline-sm text-primary mb-3 font-semibold">Distribusi & Supply Chain</h4>
            <p class="text-body-md text-on-surface-variant leading-relaxed">
                Manajemen operasional distribusi barang yang fleksibel dan andal guna memastikan kelancaran penjadwalan dan efektivitas bisnis pelanggan.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)]">
            <h4 class="text-headline-sm text-primary mb-4 font-semibold">Visi Perusahaan</h4>
            <p class="text-body-md text-on-surface-variant leading-relaxed">
                Menjadi perusahaan jasa pengiriman barang yang memiliki cabang dan jaringan luas serta profesional di seluruh Indonesia, dengan mengutamakan pelayanan prima kepada pelanggan.
            </p>
        </div>
        <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)]">
            <h4 class="text-headline-sm text-primary mb-4 font-semibold">Misi Utama</h4>
            <ul class="list-none space-y-3 text-body-md text-on-surface-variant">
                <li class="flex items-start"><span class="text-primary mr-3 font-bold block">•</span> Memberikan solusi pengiriman cepat, aman, dengan harga kompetitif sesuai kebutuhan pelanggan.</li>
                <li class="flex items-start"><span class="text-primary mr-3 font-bold block">•</span> Menyajikan pelayanan profesional demi memaksimalkan pertumbuhan perusahaan, keuntungan, dan kesejahteraan tim.</li>
            </ul>
        </div>
    </div>

    <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)] flex flex-col md:flex-row gap-8">
        <div class="flex-1">
            <h5 class="text-label-md text-secondary uppercase tracking-widest mb-2">Kantor Pusat</h5>
            <p class="text-body-md text-on-surface-variant">Ruko Mega Legenda II Blok B2 No. 03<br>Batam Center, Kota Batam</p>
        </div>
        <div class="flex-1">
            <h5 class="text-label-md text-secondary uppercase tracking-widest mb-2">Pusat Layanan</h5>
            <p class="text-body-md text-on-surface-variant">+62 852 6439 6766<br>+62 812 7588 5695<br>batamkeprijaya23@gmail.com</p>
        </div>
    </div>
</div>',
                'content_en' => '<div class="space-y-8 font-sans">
    <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)] border-t-4 border-t-primary">
        <h3 class="text-headline-md text-on-surface mb-4">Operational Profile</h3>
        <p class="text-body-lg text-on-surface-variant leading-relaxed mb-4">
            Acting as a driving force in Transportation Management Services (JPT) and Freight Forwarding, PT Batam Kepri Jaya designs and executes integrated logistics solutions. Our services are engineered to ensure distribution is secure, fast, and cost-efficient.
        </p>
        <p class="text-body-lg text-on-surface-variant leading-relaxed mb-6">
            Through a comprehensive network of land, sea, and air routes, we handle the complexities of logistics—from cargo pickup to regulatory documentation clearance—securing seamless supply chains professionally.
        </p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6 pt-6 border-t border-outline-variant/20">
            <div class="text-center"><p class="text-primary font-bold">Integrity</p></div>
            <div class="text-center"><p class="text-primary font-bold">Safety & Security</p></div>
            <div class="text-center"><p class="text-primary font-bold">Commitment</p></div>
            <div class="text-center"><p class="text-primary font-bold">Prime Service</p></div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)]">
            <h4 class="text-headline-sm text-primary mb-3 font-semibold">Transportation Management</h4>
            <p class="text-body-md text-on-surface-variant leading-relaxed">
                Comprehensive handling and coordination of transport, including route planning, modal arrangement, and oversight to ensure timely delivery.
            </p>
        </div>
        <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)]">
            <h4 class="text-headline-sm text-primary mb-3 font-semibold">Freight Forwarding & Logistics</h4>
            <p class="text-body-md text-on-surface-variant leading-relaxed">
                Integrated logistics solutions via land, sea, and air. This covers documentation clearance and continuous monitoring to support robust supply chains.
            </p>
        </div>
        <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)]">
            <h4 class="text-headline-sm text-primary mb-3 font-semibold">Distribution & Supply Chain</h4>
            <p class="text-body-md text-on-surface-variant leading-relaxed">
                Reliable operational management for cargo distribution, offering flexible services to maintain schedule accuracy for client businesses.
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)]">
            <h4 class="text-headline-sm text-primary mb-4 font-semibold">Corporate Vision</h4>
            <p class="text-body-md text-on-surface-variant leading-relaxed">
                To emerge as a professional freight service enterprise with a vast national network, prioritizing exceptional service to all clients across Indonesia.
            </p>
        </div>
        <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)]">
            <h4 class="text-headline-sm text-primary mb-4 font-semibold">Core Mission</h4>
            <ul class="list-none space-y-3 text-body-md text-on-surface-variant">
                <li class="flex items-start"><span class="text-primary mr-3 font-bold block">•</span> Delivering the best shipping solutions—fast, secure, and competitively priced per client needs.</li>
                <li class="flex items-start"><span class="text-primary mr-3 font-bold block">•</span> Providing professional service to maximize corporate growth, value, and employee welfare.</li>
            </ul>
        </div>
    </div>

    <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)] flex flex-col md:flex-row gap-8">
        <div class="flex-1">
            <h5 class="text-label-md text-secondary uppercase tracking-widest mb-2">Headquarters</h5>
            <p class="text-body-md text-on-surface-variant">Ruko Mega Legenda II Blok B2 No. 03<br>Batam Center, Batam City</p>
        </div>
        <div class="flex-1">
            <h5 class="text-label-md text-secondary uppercase tracking-widest mb-2">Service Center</h5>
            <p class="text-body-md text-on-surface-variant">+62 852 6439 6766<br>+62 812 7588 5695<br>batamkeprijaya23@gmail.com</p>
        </div>
    </div>
</div>',
                'url' => null,
                'banks' => []
            ],
            [
                'name' => 'Koperasi TKBM Bintang Kepri Jaya',
                'name_en' => 'Koperasi TKBM Bintang Kepri Jaya',
                'description' => 'Penyedia Jasa Tenaga Kerja Bongkar Muat (TKBM) Pelabuhan Profesional & Berpengalaman.',
                'description_en' => 'Professional & Experienced Port Cargo Stevedoring Manpower (TKBM) Provider.',
                'content' => '<div class="space-y-8 font-sans">
    <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)] border-t-4 border-t-primary">
        <h3 class="text-headline-md text-on-surface mb-4">Profil Operasional</h3>
        <p class="text-body-lg text-on-surface-variant leading-relaxed mb-6">
            Koperasi Jasa TKBM Bintang Kepri Jaya merupakan institusi penyedia Tenaga Kerja Bongkar Muat (TKBM) pelabuhan dengan spesifikasi kompetensi tinggi. Beroperasi secara legal sejak tahun 2021 berdasarkan ketetapan SKB 3 Menteri, koperasi ini dibentuk sebagai respons atas tingginya kebutuhan industri logistik maritim terhadap ketersediaan tenaga kerja terampil yang mengutamakan kedisiplinan dan keselamatan kerja.
        </p>
        <div class="inline-block px-4 py-2 bg-primary/5 border-l-4 border-primary text-primary font-semibold text-label-md tracking-wider uppercase">
            Motto: Utamakan Keselamatan Kerja dan Kesejahteraan Buruh TKBM
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)]">
            <h4 class="text-headline-sm text-primary mb-4 font-semibold">Visi Koperasi</h4>
            <p class="text-body-md text-on-surface-variant leading-relaxed">
                Membangun fundamental Koperasi Jasa TKBM yang tangguh, berkapasitas tinggi, serta menjadi acuan standar kualitas pelayanan tenaga kerja di sektor kepelabuhanan.
            </p>
        </div>
        <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)]">
            <h4 class="text-headline-sm text-primary mb-4 font-semibold">Misi Utama</h4>
            <ul class="list-none space-y-3 text-body-md text-on-surface-variant">
                <li class="flex items-start"><span class="text-primary mr-3 font-bold block">•</span> Mengimplementasikan standar pelayanan prima bagi seluruh mitra industri.</li>
                <li class="flex items-start"><span class="text-primary mr-3 font-bold block">•</span> Mengakselerasi peningkatan kompetensi dan pengetahuan perkoperasian di kalangan anggota.</li>
                <li class="flex items-start"><span class="text-primary mr-3 font-bold block">•</span> Mengelola fasilitas dan perlengkapan keselamatan kerja guna mendukung kelancaran operasional di area pelabuhan.</li>
            </ul>
        </div>
    </div>
</div>',
                'content_en' => '<div class="space-y-8 font-sans">
    <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)] border-t-4 border-t-primary">
        <h3 class="text-headline-md text-on-surface mb-4">Operational Profile</h3>
        <p class="text-body-lg text-on-surface-variant leading-relaxed mb-6">
            Koperasi Jasa TKBM Bintang Kepri Jaya is an institutional provider of Port Stevedoring Manpower (TKBM) defined by rigorous competency standards. Operating legally since 2021 under the Joint Ministerial Decree (SKB 3 Menteri), this cooperative was established to meet the maritime logistics industry\'s demand for a highly skilled workforce that prioritizes strict discipline and occupational safety.
        </p>
        <div class="inline-block px-4 py-2 bg-primary/5 border-l-4 border-primary text-primary font-semibold text-label-md tracking-wider uppercase">
            Motto: Prioritize Occupational Safety and Port Worker Welfare
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)]">
            <h4 class="text-headline-sm text-primary mb-4 font-semibold">Cooperative Vision</h4>
            <p class="text-body-md text-on-surface-variant leading-relaxed">
                To establish a resilient, high-capacity TKBM Cooperative that sets the benchmark for manpower service quality in the port sector.
            </p>
        </div>
        <div class="bg-surface-container-lowest p-8 rounded-xl border border-outline-variant/20 shadow-[0_8px_24px_rgba(0,50,77,0.06)]">
            <h4 class="text-headline-sm text-primary mb-4 font-semibold">Core Mission</h4>
            <ul class="list-none space-y-3 text-body-md text-on-surface-variant">
                <li class="flex items-start"><span class="text-primary mr-3 font-bold block">•</span> Executing prime service standards for all industrial partners.</li>
                <li class="flex items-start"><span class="text-primary mr-3 font-bold block">•</span> Accelerating the development of cooperative knowledge and competencies among members.</li>
                <li class="flex items-start"><span class="text-primary mr-3 font-bold block">•</span> Equipping necessary safety gear and facilities to sustain smooth port operations.</li>
            </ul>
        </div>
    </div>
</div>',
                'url' => null,
                'banks' => []
            ],
        ];

        foreach ($subsidiaries as $s) {
            $sub = Subsidiary::updateOrCreate(
                ['slug' => Str::slug($s['name'])],
                [
                    'name' => $s['name'],
                    'name_en' => $s['name_en'],
                    'description' => $s['description'],
                    'description_en' => $s['description_en'],
                    'content' => $s['content'],
                    'content_en' => $s['content_en'],
                    'url' => $s['url'],
                ]
            );

            // Seed Bank Accounts
            foreach ($s['banks'] as $b) {
                BankAccount::updateOrCreate(
                    [
                        'subsidiary_id' => $sub->id,
                        'account_number' => $b['account_number']
                    ],
                    [
                        'bank_name' => $b['bank_name'],
                        'account_name' => $b['account_name'],
                    ]
                );
            }
        }

        // 4. Seed Services (From Batam Kepri Jaya and general profile)
        $services = [
            [
                'slug' => 'jasa-pengurusan-transportasi',
                'title' => 'Jasa Pengurusan Transportasi',
                'title_en' => 'Transportation Management Services',
                'short_description' => 'Layanan pengelolaan dan koordinasi transportasi barang secara menyeluruh, mulai dari perencanaan hingga pengiriman.',
                'short_description_en' => 'Comprehensive management and coordination services for cargo transportation, from planning to delivery.',
                'content' => 'Kami menyediakan layanan pengelolaan dan koordinasi transportasi barang secara menyeluruh, mulai dari perencanaan, pengaturan moda transportasi, hingga pengawasan proses pengiriman. Dengan dukungan tim yang berpengalaman, kami memastikan setiap pengiriman berjalan aman, efisien, dan tepat waktu.',
                'content_en' => 'We provide comprehensive cargo transportation management and coordination services, ranging from planning and transportation mode arrangements to monitoring shipments. Supported by an experienced team, we ensure every delivery runs safely, efficiently, and on schedule.',
                'icon' => 'truck',
                'status' => 'published',
            ],
            [
                'slug' => 'freight-forwarding',
                'title' => 'Freight Forwarding & Solusi Logistik',
                'title_en' => 'Freight Forwarding & Logistics Solutions',
                'short_description' => 'Layanan pengiriman barang melalui jalur darat, laut, dan udara dengan solusi logistik yang terintegrasi.',
                'short_description_en' => 'Cargo shipping services via land, sea, and air pathways with integrated logistics solutions.',
                'content' => 'Kami melayani kebutuhan pengiriman barang melalui jalur darat, laut, dan udara dengan solusi logistik yang terintegrasi. Layanan ini mencakup pengaturan pengangkutan, pengelolaan dokumen, koordinasi distribusi, serta monitoring pengiriman untuk mendukung kelancaran rantai pasok pelanggan.',
                'content_en' => 'We serve cargo shipping needs via land, sea, and air pathways with integrated logistics solutions. This service covers transport booking, document management, distribution coordination, and shipment monitoring to support client supply chain efficiency.',
                'icon' => 'ship',
                'status' => 'published',
            ],
            [
                'slug' => 'distribution-supply-chain',
                'title' => 'Dukungan Distribusi & Rantai Pasok',
                'title_en' => 'Distribution & Supply Chain Support',
                'short_description' => 'Membantu pengelolaan logistik dan proses distribusi barang agar sampai ke tujuan secara aman sesuai jadwal.',
                'short_description_en' => 'Assisting logistics management and cargo distribution processes to safely arrive at the destination on schedule.',
                'content' => 'Kami membantu pelanggan dalam proses distribusi dan pengelolaan logistik untuk memastikan barang dapat sampai ke tujuan dengan aman dan sesuai jadwal. Melalui layanan yang fleksibel dan terpercaya, kami berkomitmen memberikan solusi yang efektif untuk mendukung operasional bisnis pelanggan.',
                'content_en' => 'We assist clients in distribution and logistics management to ensure goods arrive safely and on schedule. Through flexible and trusted services, we commit to providing effective solutions that support our clients\' business operations.',
                'icon' => 'users',
                'status' => 'published',
            ],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(['slug' => $service['slug']], $service);
        }

        // 5. Seed Team Members (From PT. Batam Kepri Jaya structure)
        $team = [
            ['name' => 'Sudirman Sikumbang', 'role' => 'Komisaris Utama', 'role_en' => 'President Commissioner', 'level' => 'commissioner', 'order' => 1],
            ['name' => 'Syafrudin', 'role' => 'Direktur Utama', 'role_en' => 'President Director', 'level' => 'director', 'order' => 2],
            ['name' => 'Maharani, S.I.Kom.', 'role' => 'Manager Operasional & Keuangan', 'role_en' => 'Operational & Finance Manager', 'level' => 'manager', 'order' => 3],
            ['name' => 'Nandi Pinto', 'role' => 'Staff Operasional Pelabuhan', 'role_en' => 'Port Operational Staff', 'level' => 'operational', 'order' => 4],
            ['name' => 'Ahmad Syahbudin', 'role' => 'Staff Operasional Lapangan', 'role_en' => 'Field Operational Staff', 'level' => 'operational', 'order' => 5],
            ['name' => 'Fandi Al Qomar A Karim', 'role' => 'Staff Operasional Logistik', 'role_en' => 'Logistics Operational Staff', 'level' => 'operational', 'order' => 6],
            ['name' => 'Agustinus Nong Frenky', 'role' => 'Staff Operasional Logistik', 'role_en' => 'Logistics Operational Staff', 'level' => 'operational', 'order' => 7],
        ];

        foreach ($team as $member) {
            TeamMember::updateOrCreate(
                ['name' => $member['name']],
                [
                    'role' => $member['role'],
                    'role_en' => $member['role_en'],
                    'level' => $member['level'],
                    'order' => $member['order'],
                    'status' => 'published'
                ]
            );
        }

        // 6. Seed Clients
        $clients = [
            ['name' => 'PT. Samudera Indonesia'],
            ['name' => 'PT. Pelayaran Nasional Indonesia'],
            ['name' => 'PT. Batam Shipyard & Logistics'],
            ['name' => 'PT. Maju Bersama Logistik'],
            ['name' => 'CV. Sinar Riau Terang'],
            ['name' => 'PT. Pelabuhan Indonesia (Pelindo)'],
            ['name' => 'PT. Indofood CBP Sukses Makmur'],
            ['name' => 'PT. Astra Otoparts'],
            ['name' => 'PT. Wilmar Nabati Indonesia'],
            ['name' => 'PT. Musim Mas Group'],
            ['name' => 'PT. Sumber Alfaria Trijaya Tbk'],
            ['name' => 'PT. Indomarco Prismatama'],
        ];

        foreach ($clients as $client) {
            Client::updateOrCreate(
                ['name' => $client['name']],
                ['status' => 'published']
            );
        }
    }
}
