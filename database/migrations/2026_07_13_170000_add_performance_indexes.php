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
        Schema::table('blogs', function (Blueprint $table) {
            $table->index(['status', 'published_at']);
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->index(['status', 'is_featured']);
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->index('is_read');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropIndex(['blogs_status_published_at_index']);
        });

        Schema::table('galleries', function (Blueprint $table) {
            $table->dropIndex(['galleries_status_is_featured_index']);
        });

        Schema::table('contacts', function (Blueprint $table) {
            $table->dropIndex(['contacts_is_read_index']);
        });
    }
};
