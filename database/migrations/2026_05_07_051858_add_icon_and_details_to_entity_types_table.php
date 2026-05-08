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
        Schema::table('entity_types', function (Blueprint $table) {
            $table->string('icon', 50)->nullable()->after('slug');
            $table->string('short_description', 255)->nullable()->after('description');
            $table->longText('description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entity_types', function (Blueprint $table) {
            $table->dropColumn(['icon', 'short_description']);
            $table->text('description')->nullable()->change();
        });
    }
};
