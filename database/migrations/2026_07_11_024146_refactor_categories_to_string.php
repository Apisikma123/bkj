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
        Schema::disableForeignKeyConstraints();

        // Blogs Table Refactor
        if (Schema::hasTable('blogs')) {
            Schema::table('blogs', function (Blueprint $table) {
                if (Schema::hasColumn('blogs', 'blog_category_id')) {
                    $table->dropForeign(['blog_category_id']);
                    $table->dropColumn('blog_category_id');
                }
                if (!Schema::hasColumn('blogs', 'category')) {
                    $table->string('category')->nullable()->after('title');
                }
            });
        }

        // Galleries Table Refactor
        if (Schema::hasTable('galleries')) {
            Schema::table('galleries', function (Blueprint $table) {
                if (Schema::hasColumn('galleries', 'gallery_category_id')) {
                    $table->dropForeign(['gallery_category_id']);
                    $table->dropColumn('gallery_category_id');
                }
                if (!Schema::hasColumn('galleries', 'category')) {
                    $table->string('category')->nullable()->after('title');
                }
            });
        }

        // Drop relational tables
        Schema::dropIfExists('blog_categories');
        Schema::dropIfExists('gallery_categories');

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Down method omitted as this is a destructive change
    }
};
