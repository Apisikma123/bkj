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
        $subsidiaries = [
            [
                'name' => 'PT Bintang Kepri Jaya',
                'name_en' => 'PT Bintang Kepri Jaya',
                'description' => 'Perusahaan Jasa Bongkar Muat (PBM) Utama di Kepulauan Riau.',
                'description_en' => 'Primary Cargo Stevedoring Service Company in Riau Islands.',
                'content' => 'MENJADI PENYEDIA SOLUSI JASA BONGKAR MUAT TERBAIK SEBAGAI MITRA BONGKAR MUAT TERPERCAYA, DAN TERBAIK DI INDONESIA.',
                'content_en' => 'TO BE THE BEST CARGO HANDLING SOLUTION PROVIDER AS A TRUSTED AND LEADING STEVEDORING PARTNER IN INDONESIA.',
                'url' => null,
                'banks' => [
                    ['bank_name' => 'BNI MUSIM', 'account_number' => '1234567890', 'account_name' => 'PT Bintang Kepri Jaya'],
                    ['bank_name' => 'BNI BT AMP', 'account_number' => '1234567891', 'account_name' => 'PT Bintang Kepri Jaya'],
                    ['bank_name' => 'BNI PETTY', 'account_number' => '1234567892', 'account_name' => 'PT Bintang Kepri Jaya'],
                    ['bank_name' => 'MDR HINO', 'account_number' => '1234567893', 'account_name' => 'PT Bintang Kepri Jaya'],
                    ['bank_name' => 'MDR PH', 'account_number' => '1234567894', 'account_name' => 'PT Bintang Kepri Jaya'],
                    ['bank_name' => 'MDR SN', 'account_number' => '1234567895', 'account_name' => 'PT Bintang Kepri Jaya'],
                ]
            ],
            [
                'name' => 'PT Batam Kepri Jaya',
                'name_en' => 'PT Batam Kepri Jaya',
                'description' => 'Jasa Pengurusan Transportasi (JPT) dan Logistik terintegrasi.',
                'description_en' => 'Integrated Transportation Management Services (JPT) and Logistics.',
                'content' => 'PT. BATAM KEPRI JAYA adalah perusahaan yang bergerak di bidang Jasa Pengurusan Transportasi (JPT) yang berkomitmen memberikan solusi layanan logistik dan transportasi yang profesional, aman, serta terpercaya.',
                'content_en' => 'PT. BATAM KEPRI JAYA is a company engaged in Transportation Management Services (JPT) committed to providing professional, safe, and reliable logistics and transportation solutions.',
                'url' => null,
                'banks' => [
                    ['bank_name' => 'BCA', 'account_number' => '7455868777', 'account_name' => 'PT Batam Kepri Jaya'],
                    ['bank_name' => 'MDR', 'account_number' => '9876543211', 'account_name' => 'PT Batam Kepri Jaya'],
                ]
            ],
            [
                'name' => 'Koperasi TKBM Bintang Kepri Jaya',
                'name_en' => 'Koperasi TKBM Bintang Kepri Jaya',
                'description' => 'Penyedia Tenaga Kerja Bongkar Muat (TKBM) Pelabuhan kompeten.',
                'description_en' => 'Competent provider of Port Cargo Stevedoring Manpower (TKBM).',
                'content' => 'Koperasi Jasa TKBM Bintang Kepri Jaya merupakan perusahaan jasa yang bergerak di bidang Jasa Tenaga Kerja Bongkar Muat (TKBM) dengan kinerja standart pelayanan yang dibutuhkan oleh pasar saat ini.',
                'content_en' => 'Koperasi Jasa TKBM Bintang Kepri Jaya is a service cooperative engaged in Cargo Stevedoring Manpower Services (TKBM) with service standards demanded by today\'s market.',
                'url' => null,
                'banks' => [
                    ['bank_name' => 'MDR KOP', 'account_number' => '5555543210', 'account_name' => 'Koperasi TKBM'],
                    ['bank_name' => 'MDR IUR', 'account_number' => '5555543211', 'account_name' => 'Koperasi TKBM'],
                    ['bank_name' => 'BRI KOP', 'account_number' => '5555543212', 'account_name' => 'Koperasi TKBM'],
                ]
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
