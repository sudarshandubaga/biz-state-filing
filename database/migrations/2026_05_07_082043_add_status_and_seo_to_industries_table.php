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
        Schema::table('industries', function (Blueprint $table) {
            $table->boolean('status')->default(true)->after('description');
            $table->string('icon', 50)->nullable()->after('slug');
            $table->string('short_description', 255)->nullable()->after('description');
            $table->string('seo_title', 255)->nullable();
            $table->text('seo_keywords')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('canonical_url', 255)->nullable();
            $table->longText('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('industries', function (Blueprint $table) {
            $table->dropColumn(['status', 'icon', 'short_description', 'seo_title', 'seo_keywords', 'seo_description', 'canonical_url']);
            $table->text('description')->nullable()->change();
        });
    }
};
