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
        Schema::table('subsidiaries', function (Blueprint $table) {
            $table->text('footer_desc')->nullable()->after('description_en');
            $table->text('footer_desc_en')->nullable()->after('footer_desc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subsidiaries', function (Blueprint $table) {
            $table->dropColumn(['footer_desc', 'footer_desc_en']);
        });
    }
};
