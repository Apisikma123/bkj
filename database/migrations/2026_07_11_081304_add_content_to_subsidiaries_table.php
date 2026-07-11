<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subsidiaries', function (Blueprint $table) {
            $table->longText('content')->nullable()->after('description');
            $table->string('url')->nullable()->after('content');
        });
    }

    public function down(): void
    {
        Schema::table('subsidiaries', function (Blueprint $table) {
            $table->dropColumn(['content', 'url']);
        });
    }
};
