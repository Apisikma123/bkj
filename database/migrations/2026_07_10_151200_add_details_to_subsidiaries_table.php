<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subsidiaries', function (Blueprint $table) {
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->string('hero_title')->nullable();
            $table->string('hero_subtitle')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('subsidiaries', function (Blueprint $table) {
            $table->dropColumn([
                'vision', 'mission', 'hero_title', 'hero_subtitle', 
                'contact_email', 'contact_phone', 'seo_title', 'seo_description'
            ]);
        });
    }
};
