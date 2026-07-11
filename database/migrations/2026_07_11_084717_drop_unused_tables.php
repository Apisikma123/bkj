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
        Schema::dropIfExists('activity_logs');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('media');
        Schema::dropIfExists('seo_metas');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not adding down methods for deleted tables.
    }
};
