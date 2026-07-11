<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('hero_sections', function (Blueprint $table) {
            $table->string('title_en')->nullable();
            $table->string('subtitle_en')->nullable();
        });

        Schema::table('subsidiaries', function (Blueprint $table) {
            $table->string('name_en')->nullable();
            $table->text('description_en')->nullable();
            $table->longText('content_en')->nullable();
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->string('title_en')->nullable();
            $table->text('excerpt_en')->nullable();
            $table->longText('content_en')->nullable();
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->string('title_en')->nullable();
            $table->string('category_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hero_sections', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'subtitle_en']);
        });

        Schema::table('subsidiaries', function (Blueprint $table) {
            $table->dropColumn(['name_en', 'description_en', 'content_en']);
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'excerpt_en', 'content_en']);
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'category_en']);
        });
    }
};
