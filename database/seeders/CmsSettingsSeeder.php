<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class CmsSettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Hero Section (Indonesian)
            ['key' => 'home_hero_title', 'value' => 'Ekselensi Logistik & Maritim Indonesia', 'type' => 'text'],
            ['key' => 'home_hero_subtitle', 'value' => 'Mitra terpercaya untuk layanan bongkar muat, keagenan kapal, dan transportasi logistik terintegrasi di Kepulauan Riau.', 'type' => 'text'],
            ['key' => 'home_hero_cta_primary', 'value' => 'Layanan Kami', 'type' => 'text'],
            ['key' => 'home_hero_cta_secondary', 'value' => 'Hubungi Kami', 'type' => 'text'],
            
            // Hero Section (English)
            ['key' => 'home_hero_title_en', 'value' => 'Elevating Global Logistics & Maritime Excellence', 'type' => 'text'],
            ['key' => 'home_hero_subtitle_en', 'value' => 'BKJ Group Indonesia is your trusted partner for integrated stevedoring, ship agency, and logistics transport.', 'type' => 'text'],
            ['key' => 'home_hero_cta_primary_en', 'value' => 'Our Services', 'type' => 'text'],
            ['key' => 'home_hero_cta_secondary_en', 'value' => 'Contact Us', 'type' => 'text'],
            
            // Overview Section (Indonesian)
            ['key' => 'home_overview_title', 'value' => 'Membangun Jembatan Logistik Tanpa Batas', 'type' => 'text'],
            ['key' => 'home_overview_subtitle', 'value' => 'Tentang BKJ Group', 'type' => 'text'],
            ['key' => 'home_overview_content', 'value' => 'PT Bintang Kepri Jaya (BKJ Group) adalah perusahaan nasional yang bergerak di bidang layanan maritim terpadu. Dengan pengalaman lebih dari satu dekade, kami menjamin kelancaran rantai pasok Anda melalui infrastruktur modern dan SDM profesional tersertifikasi.', 'type' => 'textarea'],
            ['key' => 'home_overview_cta', 'value' => 'Pelajari Lebih Lanjut', 'type' => 'text'],

            // Overview Section (English)
            ['key' => 'home_overview_title_en', 'value' => 'Your Strategic Logistics & Maritime Partner', 'type' => 'text'],
            ['key' => 'home_overview_subtitle_en', 'value' => 'Company Overview', 'type' => 'text'],
            ['key' => 'home_overview_content_en', 'value' => 'PT Bintang Kepri Jaya (BKJ Group) is a leading entity in the Riau Islands operating in stevedoring, ship agency, and integrated logistics. By combining world-class infrastructure and local wisdom, we are here to optimize your maritime supply chain.', 'type' => 'textarea'],
            ['key' => 'home_overview_cta_en', 'value' => 'More About Us', 'type' => 'text'],
            
            // Core Values (Indonesian)
            ['key' => 'home_values_title', 'value' => 'Keunggulan Kami', 'type' => 'text'],
            ['key' => 'home_values_subtitle', 'value' => 'Nilai Utama', 'type' => 'text'],

            // Core Values (English)
            ['key' => 'home_values_title_en', 'value' => 'Foundation of BKJ Group Excellence', 'type' => 'text'],
            ['key' => 'home_values_subtitle_en', 'value' => 'Our Core Values', 'type' => 'text'],
            
            // Stats (Indonesian & Default)
            ['key' => 'home_stat_1_value', 'value' => '12', 'type' => 'text'],
            ['key' => 'home_stat_1_label', 'value' => 'Pelabuhan Aktif', 'type' => 'text'],
            ['key' => 'home_stat_1_label_en', 'value' => 'Active Ports', 'type' => 'text'],
            ['key' => 'home_stat_2_value', 'value' => '500+', 'type' => 'text'],
            ['key' => 'home_stat_2_label', 'value' => 'Kapal Tertangani', 'type' => 'text'],
            ['key' => 'home_stat_2_label_en', 'value' => 'Vessels Handled', 'type' => 'text'],
            ['key' => 'home_stat_3_value', 'value' => '150+', 'type' => 'text'],
            ['key' => 'home_stat_3_label', 'value' => 'Klien Korporat', 'type' => 'text'],
            ['key' => 'home_stat_3_label_en', 'value' => 'Corporate Clients', 'type' => 'text'],
            
            // Why Choose Us (Indonesian)
            ['key' => 'home_why_title', 'value' => 'Mengapa Memilih Kami?', 'type' => 'text'],
            ['key' => 'home_why_subtitle', 'value' => 'Keunggulan Operasional', 'type' => 'text'],
            ['key' => 'home_why_desc', 'value' => 'Komitmen kami adalah memberikan layanan tanpa cela. Didukung oleh jaringan luas dan tim ahli, kami memastikan setiap cargo tiba dengan aman, tepat waktu, dan efisien.', 'type' => 'textarea'],
            
            // Why Choose Us (English)
            ['key' => 'home_why_title_en', 'value' => 'International Standard Excellence', 'type' => 'text'],
            ['key' => 'home_why_subtitle_en', 'value' => 'Why Choose Us', 'type' => 'text'],
            ['key' => 'home_why_desc_en', 'value' => 'We don’t just move cargo. We protect your business value through a secure, fast, and legal supply chain.', 'type' => 'textarea'],
            
            ['key' => 'home_why_1_title', 'value' => 'Zero Delay Policy', 'type' => 'text'],
            ['key' => 'home_why_1_desc', 'value' => 'Ketepatan jadwal sandar dan bongkar tanpa kompromi.', 'type' => 'textarea'],
            ['key' => 'home_why_1_title_en', 'value' => 'Zero Delay Policy', 'type' => 'text'],
            ['key' => 'home_why_1_desc_en', 'value' => 'Ensuring timely loading and unloading without delays.', 'type' => 'textarea'],

            ['key' => 'site_description', 'value' => 'PT. Batam Kepri Jaya adalah perusahaan terkemuka di bidang Jasa Pengurusan Transportasi (JPT) di Indonesia.', 'type' => 'text'],
            ['key' => 'contact_address', 'value' => 'Ruko Mega Legenda II Blok B2 No 03, Batam Center - Kota Batam', 'type' => 'text'],
            ['key' => 'contact_phone1', 'value' => '+62852 6439 6766', 'type' => 'text'],
            ['key' => 'contact_phone2', 'value' => '+62812 7588 5695', 'type' => 'text'],
            ['key' => 'contact_email', 'value' => 'batamkeprijaya23@gmail.com', 'type' => 'text'],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/bkjgroup', 'type' => 'text'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/bkjgroup', 'type' => 'text'],
            ['key' => 'social_linkedin', 'value' => 'https://linkedin.com/company/bkjgroup', 'type' => 'text'],
            ['key' => 'footer_copyright', 'value' => '2026 PT. BATAM KEPRI JAYA. All rights reserved.', 'type' => 'text'],
            ['key' => 'team_members', 'value' => "Sudirman (Direktur)\nNandi (Komisaris)\nSyafrudin", 'type' => 'text'],
            ['key' => 'company_legality', 'value' => "SIUP\nNIB\nNPWP\nTDP", 'type' => 'text'],
            ['key' => 'client_testimonials', 'value' => "Layanan yang sangat memuaskan, pengiriman selalu tepat waktu. - PT. Maju Bersama\nLogistik terbaik di Batam. - CV. Sinar Terang", 'type' => 'text'],

            ['key' => 'home_why_2_title', 'value' => 'Legalitas Terjamin', 'type' => 'text'],
            ['key' => 'home_why_2_desc', 'value' => 'Perusahaan berlisensi penuh di kawasan pabean internasional.', 'type' => 'textarea'],
            ['key' => 'home_why_2_title_en', 'value' => 'Guaranteed Legality', 'type' => 'text'],
            ['key' => 'home_why_2_desc_en', 'value' => 'Fully licensed company in international customs areas.', 'type' => 'textarea'],

            ['key' => 'home_why_3_title', 'value' => 'SDM ISO Bersertifikasi', 'type' => 'text'],
            ['key' => 'home_why_3_desc', 'value' => 'Operator bersertifikat K3 resmi untuk keamanan maksimal.', 'type' => 'textarea'],
            ['key' => 'home_why_3_title_en', 'value' => 'Certified ISO HR', 'type' => 'text'],
            ['key' => 'home_why_3_desc_en', 'value' => 'Official K3 certified operators for maximum safety.', 'type' => 'textarea'],
            
            // Subsidiaries Preview (Indonesian)
            ['key' => 'home_sub_title', 'value' => 'Sinergi Ekosistem Logistik', 'type' => 'text'],
            ['key' => 'home_sub_subtitle', 'value' => 'Anak Perusahaan', 'type' => 'text'],
            ['key' => 'home_sub_desc', 'value' => 'BKJ Group didukung oleh anak perusahaan yang kuat di berbagai sektor penunjang maritim, memastikan layanan logistik ujung-ke-ujung (end-to-end) yang sempurna.', 'type' => 'textarea'],

            // Subsidiaries Preview (English)
            ['key' => 'home_sub_title_en', 'value' => 'BKJ Group Synergy', 'type' => 'text'],
            ['key' => 'home_sub_subtitle_en', 'value' => 'Corporate Network', 'type' => 'text'],
            ['key' => 'home_sub_desc_en', 'value' => 'Our service strength is supported by solid subsidiaries focused on specific expertise in the logistics industry, ensuring perfect end-to-end logistics services.', 'type' => 'textarea'],
            
            // Latest News (Indonesian)
            ['key' => 'home_news_title', 'value' => 'Wawasan & Pembaruan', 'type' => 'text'],
            ['key' => 'home_news_subtitle', 'value' => 'Media & Informasi', 'type' => 'text'],

            // Latest News (English)
            ['key' => 'home_news_title_en', 'value' => 'Logistics Updates', 'type' => 'text'],
            ['key' => 'home_news_subtitle_en', 'value' => 'News & Articles', 'type' => 'text'],
            
            // CTA (Indonesian)
            ['key' => 'home_cta_title', 'value' => 'Siap Mengoptimalkan Logistik Anda?', 'type' => 'text'],
            ['key' => 'home_cta_desc', 'value' => 'Diskusikan kebutuhan operasional maritim Anda bersama tim ahli kami hari ini.', 'type' => 'textarea'],
            ['key' => 'home_cta_button', 'value' => 'Mulai Konsultasi', 'type' => 'text'],

            // CTA (English)
            ['key' => 'home_cta_title_en', 'value' => 'Ready to Optimize Your Supply Chain?', 'type' => 'text'],
            ['key' => 'home_cta_desc_en', 'value' => 'Consult your logistics and ship agency needs with our professional team today.', 'type' => 'textarea'],
            ['key' => 'home_cta_button_en', 'value' => 'Contact Us Now', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value'], 'type' => $setting['type']]
            );
        }
    }
}
