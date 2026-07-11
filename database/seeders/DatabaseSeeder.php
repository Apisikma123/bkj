<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Subsidiary;
use App\Models\CompanyProfile;
use App\Models\Setting;
use App\Models\BankAccount;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        $adminRole = Role::create(['name' => 'Super Admin', 'slug' => 'super-admin']);
        Role::create(['name' => 'Editor', 'slug' => 'editor']);

        // Users
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@bkjgroup.com',
            'password' => Hash::make('password123'),
            'role_id' => $adminRole->id,
            'email_verified_at' => now(),
        ]);

        // Subsidiaries
        $bkj = Subsidiary::create(['name' => 'PT Bintang Kepri Jaya', 'slug' => Str::slug('PT Bintang Kepri Jaya'), 'description' => 'Perusahaan Bongkar Muat Utama']);
        $batam = Subsidiary::create(['name' => 'PT Batam Kepri Jaya', 'slug' => Str::slug('PT Batam Kepri Jaya'), 'description' => 'Layanan Logistik & Transportasi']);
        $kop = Subsidiary::create(['name' => 'Koperasi TKBM Bintang Kepri Jaya', 'slug' => Str::slug('Koperasi TKBM Bintang Kepri Jaya'), 'description' => 'Tenaga Kerja Bongkar Muat']);

        // Bank Accounts (Dummy account numbers for now, real names)
        BankAccount::insert([
            ['bank_name' => 'BNI MUSIM', 'account_number' => '1234567890', 'account_name' => 'PT Bintang Kepri Jaya', 'subsidiary_id' => $bkj->id, 'created_at' => now(), 'updated_at' => now()],
            ['bank_name' => 'BNI BT AMP', 'account_number' => '1234567891', 'account_name' => 'PT Bintang Kepri Jaya', 'subsidiary_id' => $bkj->id, 'created_at' => now(), 'updated_at' => now()],
            ['bank_name' => 'BNI PETTY', 'account_number' => '1234567892', 'account_name' => 'PT Bintang Kepri Jaya', 'subsidiary_id' => $bkj->id, 'created_at' => now(), 'updated_at' => now()],
            ['bank_name' => 'MDR HINO', 'account_number' => '1234567893', 'account_name' => 'PT Bintang Kepri Jaya', 'subsidiary_id' => $bkj->id, 'created_at' => now(), 'updated_at' => now()],
            ['bank_name' => 'MDR PH', 'account_number' => '1234567894', 'account_name' => 'PT Bintang Kepri Jaya', 'subsidiary_id' => $bkj->id, 'created_at' => now(), 'updated_at' => now()],
            ['bank_name' => 'MDR SN', 'account_number' => '1234567895', 'account_name' => 'PT Bintang Kepri Jaya', 'subsidiary_id' => $bkj->id, 'created_at' => now(), 'updated_at' => now()],
            
            ['bank_name' => 'BCA', 'account_number' => '9876543210', 'account_name' => 'PT Batam Kepri Jaya', 'subsidiary_id' => $batam->id, 'created_at' => now(), 'updated_at' => now()],
            ['bank_name' => 'MDR', 'account_number' => '9876543211', 'account_name' => 'PT Batam Kepri Jaya', 'subsidiary_id' => $batam->id, 'created_at' => now(), 'updated_at' => now()],
            
            ['bank_name' => 'MDR KOP', 'account_number' => '5555543210', 'account_name' => 'Koperasi TKBM', 'subsidiary_id' => $kop->id, 'created_at' => now(), 'updated_at' => now()],
            ['bank_name' => 'MDR IUR', 'account_number' => '5555543211', 'account_name' => 'Koperasi TKBM', 'subsidiary_id' => $kop->id, 'created_at' => now(), 'updated_at' => now()],
            ['bank_name' => 'BRI KOP', 'account_number' => '5555543212', 'account_name' => 'Koperasi TKBM', 'subsidiary_id' => $kop->id, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Company Profiles
        CompanyProfile::insert([
            ['key' => 'vision', 'value' => 'MENJADI PENYEDIA SOLUSI JASA BONGKAR MUAT TERBAIK SEBAGAI MITRA BONGKAR MUAT TERPERCAYA, DAN TERBAIK DI INDONESIA.', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'mission', 'value' => '<ul><li>MENYEDIAKAN DAN MENGOPERASIKAN FASILITAS TERMINAL PELABUHAN DAN PERALATAN TEPAT GUNA</li><li>MEYEDIAKAN SDM YANG PROFESIONAL DI BIDANG BONGKAR MUAT</li><li>TURUT MENGEMBANGKAN PEREKONOMIAN NEGARA DAN MEMUPUK KEUNTUNGAN</li><li>MEMBERIKAN KONTRIBUSI POSITIF DEMI MENDUKUNG KEMAJUAN DAN STABILITAS PENGGUNA JASA.</li><li>SEBAGAI SARANA PENGEMBANGAN KUALITAS SUMBER DAYA MANUSIA YANG KOMPETEN PADA BIDANGNYA DALAM MEMBERIKAN KUALITAS PELAYANAN YANG PRIMA.</li><li>MENCIPTAKAN IINGKUNGAN KERJA YANG NYAMAN DAN TENTRAM PADA SELURUH LEVEL MANAJEMEN</li><li>MENJADI PEMBAWA SOLUSI DALAM SETIAP PERMASALAHAN TENAGA KERJA DAN PERMASALAHAN STABILITAS PERUSAHAAN BAIK BERSIFAT INTERNAL MAUPUN EKTERNAL</li><li>MEMBANGUN KERJASAMA YANG BAIK DENGAN KLIEN, PEMERINTAHAN SERTA UNSUR-UNSUR MASYARAKAT TERKAIT DEMI MENJAGA KEHARMONISAN BERMASYARAKAT.</li></ul>', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'motto', 'value' => 'CEPAT, TEPAT, TANGGAP, TUNTAS DAN BERTANGGUNG JAWAB', 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Settings
        Setting::insert([
            ['key' => 'email', 'value' => 'info@bkjgroup.com', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'phone', 'value' => '+62 123 4567 8900', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'whatsapp', 'value' => '6281234567890', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'address', 'value' => 'Batam, Kepulauan Riau, Indonesia', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'facebook', 'value' => 'https://facebook.com/bkjgroup', 'type' => 'url', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'instagram', 'value' => 'https://instagram.com/bkjgroup', 'type' => 'url', 'created_at' => now(), 'updated_at' => now()],
        ]);


    }
}
