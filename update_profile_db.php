<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\CompanyProfile;

$description = <<<EOT
PT. BATAM KEPRI JAYA adalah perusahaan yang bergerak di bidang Jasa Pengurusan Transportasi (JPT) yang berkomitmen memberikan solusi layanan logistik dan transportasi yang profesional, aman, serta terpercaya. Dengan dukungan sumber daya manusia yang berpengalaman dan jaringan operasional yang luas, kami hadir untuk memenuhi kebutuhan pengiriman barang dan distribusi pelanggan secara efektif dan efisien.

Kami memahami bahwa kelancaran proses transportasi dan logistik merupakan faktor penting dalam mendukung pertumbuhan bisnis. Oleh karena itu, PT. BATAM KEPRI JAYA menyediakan layanan pengurusan transportasi yang mencakup koordinasi pengiriman, pengelolaan dokumen, distribusi barang, serta layanan pendukung logistik lainnya dengan standar pelayanan yang tinggi.

Berorientasi pada kepuasan pelanggan, kami selalu mengedepankan ketepatan waktu, keamanan barang, transparansi informasi, dan profesionalisme dalam setiap layanan yang kami berikan. Dengan mengutamakan integritas dan kualitas kerja, kami bertekad menjadi mitra terpercaya bagi berbagai sektor usaha dalam mendukung kebutuhan transportasi dan logistik mereka.

Seiring dengan perkembangan industri dan kebutuhan pasar yang terus meningkat, PT. BATAM KEPRI JAYA terus berinovasi dan meningkatkan kualitas layanan guna memberikan solusi transportasi yang efektif, kompetitif, dan bernilai tambah bagi seluruh pelanggan.

PT. BATAM KEPRI JAYA – Mitra Terpercaya dalam Solusi Transportasi dan Logistik.
EOT;

$vision = <<<EOT
Menjadi perusahaan jasa pengiriman barang yang memiliki cabang dan jaringan yang luas serta profesional di seluruh indonesia. Dengan mengutamakan pelayanan secara profesional kepada semua pelanggan.
EOT;

$mission = <<<EOT
Memberikan solusi pengiriman barang yang terbaik yaitu cepat, aman dan harga yang kompetitif sesuai kebutuhan masing masing pelanggan.
Memberikan pelayanan yang profesional agar dapat meningkatkan pertumbuhan perusahaan dan mampu memberikan keuntungan secara maksimal untuk perusahaan dan seluruh karyawan.
Kami menjunjung tinggi kejujuran, tanggung jawab, dan etika bisnis dalam setiap tindakan dan keputusan. Kepercayaan pelanggan adalah fondasi utama yang kami bangun dan pertahankan.
Kami mengutamakan keselamatan kerja serta keamanan barang pelanggan dalam seluruh proses operasional, mulai dari pengelolaan hingga pengiriman.
Kami berkomitmen untuk memenuhi setiap tanggung jawab dengan penuh dedikasi dan konsisten dalam memberikan hasil terbaik bagi seluruh pemangku kepentingan.
Kami menempatkan kepuasan pelanggan sebagai prioritas utama melalui pelayanan yang responsif, komunikatif, dan berorientasi pada solusi.
EOT;

$motto = <<<EOT
CEPAT, TEPAT, TANGGAP, TUNTAS DAN BERTANGGUNG JAWAB
EOT;

CompanyProfile::updateOrCreate(['key' => 'description'], ['value' => $description]);
CompanyProfile::updateOrCreate(['key' => 'vision'], ['value' => $vision]);
CompanyProfile::updateOrCreate(['key' => 'mission'], ['value' => $mission]);
CompanyProfile::updateOrCreate(['key' => 'motto'], ['value' => $motto]);

echo "CompanyProfile updated successfully.\n";
