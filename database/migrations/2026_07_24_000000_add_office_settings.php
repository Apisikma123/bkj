<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

return new class extends Migration
{
    public function up(): void
    {
        $offices = [
            // Office 1
            'office_1_name' => 'PT. BINTANG KEPRI JAYA',
            'office_1_tagline' => 'BONGKAR MUAT',
            'office_1_address' => 'Pelabuhan Batu Ampar Jl. Lumba Lumba - Kota Batam',
            'office_1_phone' => '+62 7158 5444',
            'office_1_email' => 'bintangkeprijaya18@gmail.com',

            // Office 2
            'office_2_name' => 'KOPERASI JASA TBKM BINTANG KEPRI JAYA',
            'office_2_tagline' => 'KOPERASI JASA TBKM',
            'office_2_address' => 'Pelabuhan Batu Ampar Jl. Lumba Lumba - Kota Batam',
            'office_2_phone' => '+62 813 8171 5067',
            'office_2_email' => 'koperasitkbmbintangkeprijaya@gmail.com',

            // Office 3
            'office_3_name' => 'PT BATAM KEPRI JAYA',
            'office_3_tagline' => 'JASA PENGURUSAN TRANSPORTASI',
            'office_3_address' => 'Ruko Mega Legenda II Blok B2 No 03 Batam Center Kota Batam',
            'office_3_phone' => '0821 7158 5444',
            'office_3_email' => 'ptbatamkeprijaya@gmail.com',

            // Office 4
            'office_4_name' => 'PT BINTANG KEPRI JAYA',
            'office_4_tagline' => 'BONGKAR MUAT',
            'office_4_address' => 'Ruko Mega Legenda II Blok B2 No 03 Batam Center Kota Batam',
            'office_4_phone' => '+62821 7158 5444',
            'office_4_email' => 'bintangkeprijaya18@gmail.com',
        ];

        foreach ($offices as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'type' => 'text']
            );
            
            // Seed English defaults (which can be edited or auto-translated later)
            Setting::updateOrCreate(
                ['key' => $key . '_en'],
                ['value' => $value, 'type' => 'text']
            );
        }
    }

    public function down(): void
    {
        $keys = [];
        for ($i = 1; $i <= 4; $i++) {
            $keys[] = "office_{$i}_name";
            $keys[] = "office_{$i}_name_en";
            $keys[] = "office_{$i}_tagline";
            $keys[] = "office_{$i}_tagline_en";
            $keys[] = "office_{$i}_address";
            $keys[] = "office_{$i}_address_en";
            $keys[] = "office_{$i}_phone";
            $keys[] = "office_{$i}_phone_en";
            $keys[] = "office_{$i}_email";
            $keys[] = "office_{$i}_email_en";
        }
        Setting::whereIn('key', $keys)->delete();
    }
};
